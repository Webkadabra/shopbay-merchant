<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code. 
 */
/**
 * Description of SupportController
 *
 * @author kwlok
 */
class SupportController extends AuthenticatedController
{
    protected $formModel = 'ChatbotSupportForm';
    /**
     * Init
     */
    public function init()
    {
        parent::init();
        $this->pageTitle = Sii::t('sii','Chatbot Support');
    }
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array_merge(parent::actions(),[
            'update'=>[
                'class'=>'chatbots.actions.UpdateSettingsAction',
                'formModel'=>$this->formModel,
            ],                   
        ]);
    }    
}
