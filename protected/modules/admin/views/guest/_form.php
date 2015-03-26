<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'data-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype'=>'multipart/form-data'
    )
)); ?>
<div class="controls">
    <div class="label">
        <?=$form->labelEx($model,'username', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->textField($model,'username',array('class'=>'txt-form')); ?>
        <?=$form->error($model,'username', array('class'=>'error'));?>
    </div>
</div>
<div class="controls">
    <div class="label">
        <?=$form->labelEx($model,'password', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->passwordField($model,'password',array('class'=>'txt-form')); ?>
        <?=$form->error($model,'password', array('class'=>'error'));?>
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
    <div class="label">
        <?=$form->labelEx($model,'first_name', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->textField($model,'first_name',array('class'=>'txt-form')); ?>
        <?=$form->error($model,'first_name', array('class'=>'error'));?>
    </div>
</div>

<div class="controls">
    <div class="label">
        <?=$form->labelEx($model,'last_name', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->textField($model,'last_name',array('class'=>'txt-form')); ?>
        <?=$form->error($model,'last_name', array('class'=>'error'));?>
    </div>
</div>

<div class="controls">
    <div class="label">
        <?=$form->labelEx($model,'email', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->textField($model,'email',array('class'=>'txt-form')); ?>
        <?=$form->error($model,'email', array('class'=>'error'));?>
    </div>
</div>

<div class="controls">
    <div class="label">
        <?=$form->labelEx($model,'phone', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->textField($model,'phone',array('class'=>'txt-form')); ?>
        <?=$form->error($model,'phone', array('class'=>'error'));?>
    </div>
</div>

<div class="controls">
    <div class="label">
        <?=$form->labelEx($model,'address', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->textField($model,'address',array('class'=>'txt-form')); ?>
        <?=$form->error($model,'address', array('class'=>'error'));?>
    </div>
</div>
<div class="controls">
    <div class="label">&nbsp;</div>
    <div class="input">
        <?=CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save Change', array('class'=>'bnt-form')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>