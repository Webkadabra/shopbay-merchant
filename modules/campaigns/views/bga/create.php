<?php $this->module->registerFormCssFile();?>
<?php $this->module->registerCkeditor('campaign');?>
<?php $this->module->registerChosen();?>
<?php $this->module->registerMediaGalleryAssets();?>
<?php
$this->breadcrumbs=$this->getBreadcrumbsData(Sii::t('sii','Create'));

$this->menu=array();

$this->getPage(array(
    'id'=>'campaign_page',
    'breadcrumbs'=>$this->breadcrumbs,
    'menu'=>$this->menu,
    'flash'  => get_class($model),
    'heading'=> array(
        'name'=> Sii::t('sii','Create {object}',array('{object}'=>CampaignBga::model()->displayName())),
        'image'=> $this->hasParentShop()?$this->getParentShop()->getImageThumbnail(Image::VERSION_ORIGINAL,array('style'=>'width:'.Image::VERSION_XSMALL.'px;')):null,
    ),
    'description'=>Sii::t('sii','BGA stands for "Buy", "Get", "At": Buy X Product Get Y Product At special offer.'),
    'body'=>$this->renderPartial('_form', array('model'=>$model),true),
));