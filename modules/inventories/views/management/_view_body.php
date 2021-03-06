<?php 
$this->widget('common.widgets.SDetailView', array(
    'data'=>$model,
    'columns'=>array(
        array(
            array('name'=>'shop_id','type'=>'raw','value'=>l($model->shop->displayLanguageValue('name',user()->getLocale()),$model->shop->viewUrl),'visible'=>!$this->hasParentShop()),
            array('name'=>'quantity'),
            array('name'=>'available'),
            array('name'=>'hold'),
            array('name'=>'sold'),
            array('name'=>'bad'),
        ),
        array(
            array('name'=>'create_time','value'=>$model->formatDatetime($model->create_time,true)),
            array('name'=>'update_time','value'=>$model->formatDatetime($model->update_time,true)),
        ),
    ),
));