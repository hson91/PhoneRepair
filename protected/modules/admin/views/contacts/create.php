<div class="head blue">
    <img src="<?=Yii::app()->controller->module->assetsUrl?>/images/websites/globe.png" />
    <span><?=!$model->isNewRecord ? 'Update' : ($model->scenario == 'addlang' ? 'Add Language for' : 'Create')?> <?=$this->ID;?></span>
</div>
<?=$this->renderPartial('_form', array('model'=>$model)); ?>
