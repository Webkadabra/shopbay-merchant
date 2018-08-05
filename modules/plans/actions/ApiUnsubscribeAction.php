<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code. 
 */
Yii::import("common.components.actions.CRUDBaseAction");
Yii::import('common.components.actions.api.ApiActionTrait');
Yii::import('common.components.actions.api.ApiActionInterface');
/**
 * Description of ApiUnsubscribeAction
 *
 * @author kwlok
 */
class ApiUnsubscribeAction extends CRUDBaseAction implements ApiActionInterface
{
    use ApiActionTrait {
        init as traitInit;
    }
    /**
     * The call back function after unsubscribe
     * @var type 
     */
    public $afterUnsubscribe;
    /**
     * @var string The subscription no to be cancelled
     */
    private $_subscription;
    /**
     * @var string The shop id (for display purpose on successful cancellation)
     */
    private $_shop;
    /**
     * @var string The package id to be cancelled (for display purpose on successful cancellation)
     */
    private $_package;
    /**
     * Constructor
     * @param type $controller
     * @param type $id
     * @param type $subscription
     * @param type $shop
     * @param type $package
     */
    public function __construct($controller, $id, $subscription, $shop, $package) 
    {
        if (!isset($subscription))
            throw new CHttpException(500,Sii::t('sii','Subscription not defined'));    
        $this->_subscription = $subscription;
        $this->_shop = $shop;
        $this->_package = $package;
        parent::__construct($controller, $id);
    }
    /**
     * Init trait
     */
    public function init()
    {
        $this->httpVerb = 'DELETE';
        $this->retryAccessToken = true;
        $this->apiRoute = '/plans/unsubscribe';
        $this->queryParams = '/'.$this->_subscription;
        $this->traitInit();
    }   
    /**
     * Run in "api" mode 
     */
    public function callApi() 
    {
        $this->findAccessToken(true);//set $force to true as subscription cannot failed due to token expired
        $this->execCurl($this->getAuthBearerHeader());
    } 
    
    public function onSuccess($response,$httpCode)
    {
        if ($httpCode==204&&isset($this->afterUnsubscribe))
            $this->controller->{$this->afterUnsubscribe}([
                'subscription_no'=>$this->_subscription,
                'shop_id'=>$this->_shop,
                'package_id'=>$this->_package,
            ]);
    }
    
    public function onError($error, $httpCode) 
    {
        if (isset($error->details))
            throw new CHttpException($httpCode,Helper::htmlErrors($error->details));
        else
            throw new CHttpException($httpCode,$error->message);
    }
    
}
