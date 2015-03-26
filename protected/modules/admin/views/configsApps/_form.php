<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'data-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype'=>'multipart/form-data'
    )
)); ?>

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
        <?=$form->labelEx($model,'hotline', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->textField($model,'hotline',array('class'=>'txt-form')); ?>
        <?=$form->error($model,'hotline', array('class'=>'error'));?>
    </div>
</div>
<div class="controls">
    <div class="label">
        <?=$form->labelEx($model,'logo', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->fileField($model, 'logo', array('class'=>'file-form'));?>
        <?=$form->error($model,'logo',array('class'=>'error'));?>
    </div>
</div>
<div class="controls">
    <div class="label">
        <?=$form->labelEx($model,'image', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->fileField($model, 'image', array('class'=>'file-form'));?>
        <?=$form->error($model,'image',array('class'=>'error'));?>
    </div>
</div>

<div class="controls">
    <div class="label">
        <?=$form->labelEx($model,'status', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->dropDownList($model,'status', Yii::app()->params['status'], array('options' => array(1 => array('selected' => 'selected')), 'class'=>'sel-form')); ?>
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