<div class="action">
    <?php echo CHtml::link('<i>&#xf055;</i>Create', array('create')); ?>
    <?php echo CHtml::ajaxLink("<i>&#xf014;</i>Delete item slect", array('deleteList'), array(
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
            'name'=>'first_name'
        ),
        array(
            'name'=>'last_name'
        ),
        array(
            'name'=>'username',
        ),
        array(
            'name'=>'email',
        ),
        array(
            'name'=>'address',
        ),
        array(
            'name'=>'detail',
            'value'=>'CHtml::link("&#xf06e;", array("detail","id"=>$data->id), array("class"=>"status-en icon", "id"=>"dt".$data->id))',
            'type'=>'raw',
            'filter'=>false,
            'htmlOptions'=>array('class'=>'ct'),
        ),
        array(
            'name' => 'List Devices',
            'type'=>'raw',
            'filter'=>false,
            'htmlOptions'=>array('class'=>'ct id'),
            'value' => 'CHtml::link("&#xf055;", array("/admin/vouchers","Vouchers[guest_id]"=>$data->id), array("class"=>"icon", "title"=>"List Devices"))'
        ),
        array(
            'name'=>'status',
            'filter'=>false,
            'value'=>'$data->status==1?CHtml::link("&#xf06e;", array("status","id"=>$data->id), array("class"=>"status-dis status icon", "id"=>"stt".$data->id)):CHtml::link("&#xf070;", array("status","id"=>$data->id), array("class"=>"status-en status icon", "id"=>"stt".$data->id))',
            'type'=>'raw',
            'htmlOptions'=>array('class'=>'ct'),
        ),
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