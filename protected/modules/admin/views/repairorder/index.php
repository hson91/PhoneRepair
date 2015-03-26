<div class="action">
    <?php echo CHtml::link('<i>&#xf055;</i>Create', array('create')); ?>
    <?php echo CHtml::ajaxLink("<i>&#xf014;</i>Delete item select", array('deleteList'), array(
        "type"    => "post",
        "data"    => "js:{ids:$.fn.yiiGridView.getChecked('data-grid','ids')}",
        "success" => "function(data){
            $.fn.yiiGridView.update('data-grid'); 
        }"),
        array('class'=>'red', 'confirm' => 'Do you want to delete?')); 
    ?>
</div>
<?php
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'data-grid',
	'dataProvider'=>$model->search(),
    'htmlOptions'=>array('class'=>'table tbuser'),
    'summaryText'=>'',
    'filter'=>$model,
    'afterAjaxUpdate'=>'function(id, data){$("#data-grid").append("<script type=\"text\/javascript\" src=\"'.Yii::app()->controller->module->assetsUrl.'\/js\/status.js\"><\/script><script type=\"text\/javascript\" src=\"'.Yii::app()->controller->module->assetsUrl.'\/js\/detail.js\"><\/script>");}',
    'columns'=>array(
        array(
            'id'=>'ids',
            'class'=>'CCheckBoxColumn',
            'selectableRows'=>2,
            'htmlOptions'=>array('class'=>'ct id'),
        ),
		array(
            'name'=>'id',
            'htmlOptions'=>array('class'=>'ct id'),
            'filterHtmlOptions' => array('class' => 'ct id'),
            'type'=>'raw',
        ),
        array(
            'name'=>'device_serial',
            'htmlOptions'=>array('class'=>'ct'),
        ),
        array(
            'name'=>'device_name',
            'htmlOptions'=>array('class'=>'ct'),
        ),
        array(
            'name'=>'email',
            'htmlOptions'=>array('class'=>'ct'),
            'value' => '"[".str_replace("<br />","];[",$data->email)."]"',
        ), /*
        array(
            'name'=>'status',
            'filter'=>false,
            //'value'=>'$data->status==1?:',
            'value' => '$data->status==1?CHtml::link("&#xf0ad;", array("status","id"=>$data->id), array("class"=>"statusdevice icon", "id"=>"stt".$data->id,"title"=>"Repair in progress")):(($data->status ==2)?CHtml::link("&#xf00c;", array("status","id"=>$data->id), array("class"=>"statusdevice icon", "id"=>"stt".$data->id,"title"=>"Ready for collection")):CHtml::link("&#xf050;", array("status","id"=>$data->id), array("class"=>"statusdevice icon", "id"=>"stt".$data->id,"title"=>"Received")))',
            'type'=>'raw',
            'htmlOptions'=>array('class'=>'ct'),
        ), */
        array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
            'buttons' => array(
                'update'=>array(
                    'label'=>'<i>&#xf040;</i>',
                    'imageUrl' => false,
                    'options'=>array( 'title'=>'Edit' ),
                ),
                'delete'=>array(
                    'label'=>'<i>&#xf014;</i>',
                    'imageUrl' => false,
                    'options'=>array( 'title'=>'Delete' ),
                ),
            ),
            'header'=>CHtml::dropDownList('pageSize',$pageSize,Yii::app()->params['recordsPerPage'],array(
                          'onchange'=>"$.fn.yiiGridView.update('data-grid',{data:{pageSize: $(this).val()}})")),
            'htmlOptions'=>array('class'=>'ct act'),
		),
	),
    'pager'=>array(
        'cssFile'=>false,
        'class'=>'CLinkPager',
        'firstPageLabel' => 'First',
        'prevPageLabel' => 'Previous',
        'nextPageLabel' => 'Next',
        'lastPageLabel' => 'Last',
        'header'=>'',
        'selectedPageCssClass'=>'active',
    ),
    'pagerCssClass' => 'pagination',
));?>