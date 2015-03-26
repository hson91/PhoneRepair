<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'data-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype'=>'multipart/form-data'
    )
)); ?>

<div class="controls">
    <div class="label">
        <?=$form->labelEx($model,'fullname', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->textField($model,'fullname',array('class'=>'txt-form')); ?>
        <?=$form->error($model,'fullname', array('class'=>'error'));?>
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
        <?=$form->labelEx($model,'email', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->textField($model,'email',array('class'=>'txt-form')); ?>
        <?=$form->error($model,'email', array('class'=>'error'));?>
    </div>
</div>

<div class="controls">
    <div class="label">
        <?=$form->labelEx($model,'title', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->textField($model,'title',array('class'=>'txt-form')); ?>
        <?=$form->error($model,'title', array('class'=>'error'));?>
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
        <?=$form->labelEx($model,'description', array('class'=>'lbl-form')); ?>
    </div>
    <div class="input">
        <?=$form->textArea($model, 'description', array('class'=>'txtare-form'));?>
        <?=$form->error($model,'description',array('class'=>'error'));?>
    </div>
</div>

<div class="controls">
    <div class="label">&nbsp;</div>
    <div class="input">
        <?=CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save Change', array('class'=>'bnt-form')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>

<?php $this->widget('ext.alias.alias', array(
    'model'=>$model,
)); ?>