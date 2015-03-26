<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'data-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype'=>'multipart/form-data'
    )
)); ?>

<div class="controls">
    <div class="label">
        <?=$form->labelEx($model,'email', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->textArea($model,'email',array('class'=>'txt-form','style'=>'resize:none;height:150px')); ?>
        <?=$form->error($model,'email', array('class'=>'error'));?>
    </div>
</div>

<div class="controls">
    <div class="label">
        <?=$form->labelEx($model,'device_serial', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->textField($model,'device_serial',array('class'=>'txt-form')); ?>
        <?=$form->error($model,'device_serial', array('class'=>'error'));?>
    </div>
</div>
<div class="controls">
    <div class="label">
        <?=$form->labelEx($model,'device_name', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->textField($model,'device_name',array('class'=>'txt-form')); ?>
        <?=$form->error($model,'device_name', array('class'=>'error'));?>
    </div>
</div>
<div class="controls">
    <div class="label">
        <?=$form->labelEx($model,'comments', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->textArea($model,'comments',array('class'=>'txtare-form')); ?>
        <?=$form->error($model,'comments', array('class'=>'error'));?>
    </div>
</div>
<div class="controls">
    <div class="label">
        <?=$form->labelEx($model,'status', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->dropDownList($model,'status', Yii::app()->params['statusdevice'], array('class'=>'sel-form')); ?>
        <?=$form->error($model,'status', array('class'=>'error'));?>
    </div>
</div>
<div class="controls">
    <div class="label">&nbsp;</div>
    <div class="input">
        <?=CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save Change', array('class'=>'bnt-form')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>