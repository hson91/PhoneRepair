<?php if(Yii::app()->user->hasFlash('statusUpdate')):
?>
<script type="text/javascript"> window.location = '<?php echo Yii::app()->baseUrl.'/admin/repairorder'?>'</script>
<?php
endif;?>
<div class="form">
<?=$this->renderPartial('_form', array('model'=>$model)); ?>
</div>