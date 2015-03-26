<div class="action">
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
    'htmlOptions'=>array('class'=>'table'),
    'summaryText'=>'',
    'filter' => $model,
    'afterAjaxUpdate'=>'function(id, data){$("#data-grid").append("<script type=\"text\/javascript\" src=\"'.Yii::app()->controller->module->assetsUrl.'\/js\/status.js\"><\/script>");}',
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
            'filterHtmlOptions' => array('class' => 'ct id')
        ),
        array(
            'name'=>'fullname',
        ),
        array(
            'name'=>'email',
        ),
        array(
            'name' => 'phone',
            'htmlOptions'=>array('class'=>'ct'),
        ),
        array(
            'name' => 'title',
        ),
        array(
            'name'=>'status',
            'filter'=>Yii::app()->params['status'],
            'value'=>'$data->status==1?CHtml::link("&#xf06e;", array("status","id"=>$data->id), array("class"=>"status-dis status icon", "id"=>"stt".$data->id)):CHtml::link("&#xf070;", array("status","id"=>$data->id), array("class"=>"status-en status icon", "id"=>"stt".$data->id))',
            'type'=>'raw',
            'htmlOptions'=>array('class'=>'ct'),
        ),
        array(
            'name' => 'updated',
            'value'=> 'date("d-m-Y",strtotime($data->updated))',
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