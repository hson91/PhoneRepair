<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="<?=Yii::app()->controller->module->assetsUrl;?>/css/style.css" />
    <link rel="stylesheet" href="<?=Yii::app()->controller->module->assetsUrl;?>/farbtastic/farbtastic.css" type="text/css" />
	<title><?=$this->pageTitle?></title>
    
    <style type="text/css">
        .left, .left ul li a, .home-item a, .bnt-form, .message-show, .filter-external input[type="button"]{background:<?=$this->bgColor?>}
        .header, .profiles{border-bottom:2px solid <?=$this->bgColor?>}
        .footer{border-top:2px solid <?=$this->bgColor?>}
        .action a i, .head i, .filter-external a.download{color:<?=$this->bgColor?>}
        .table table thead tr{border-bottom:1px solid <?=$this->bgColor?>}
        .pagination ul li.active a{background: <?=$this->bgColor?>;border:1px solid <?=$this->bgColor?>}
        
        .left ul li a:hover, .home-item a:hover, .left ul li.active a{background:<?=$this->activeColor?>}
        .left ul li{border-bottom:1px solid <?=$this->borderColor?>}
        
    </style>
    <script type="text/javascript" src="<?=Yii::app()->controller->module->assetsUrl;?>/js/app.js"></script>
    <script type="text/javascript" src="<?=Yii::app()->controller->module->assetsUrl;?>/js/status.js"></script>
    <script type="text/javascript" src="<?=Yii::app()->controller->module->assetsUrl;?>/js/detail.js"></script>
    <script type="text/javascript" src="<?=Yii::app()->controller->module->assetsUrl;?>/js/addcart.js"></script>
    <script type="text/javascript" src="<?=Yii::app()->controller->module->assetsUrl;?>/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        var url = '<?=Yii::app()->baseUrl;?>/admin';
        var sss = '<?=Yii::app()->controller->module->assetsUrl;?>';
    </script>
</head>
<body>
    <div class="message-show"></div>
    <div class="header">
        <div class="h-left">
            <a href="<?=Yii::app()->baseUrl?>/admin">Admin Dashboard</a>
        </div>
        <div class="h-right">
            <span><?=Yii::app()->user->getState('fullname');?></span>
            <div class="user-action">
                <i>&#xf0c9;</i>
                <div class="profiles">
                    <div class="profile"><a href="<?=Yii::app()->baseUrl?>/admin/site/profiles">Profile</a></div>
                    <div class="profile"><a href="<?=Yii::app()->baseUrl?>/admin/site/profiles">Change Password</a></div>
                    <div class="profile"><a href="<?=Yii::app()->baseUrl?>/admin/site/logout">Logout</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="left">
            <?php
                $cMenu = array();
                $cMenu[] = array('label'=>'<i>&#xf015;</i><span>Dashboard</span>', 'url'=>array('site/index'), 'active'=>$this->ID == 'site');
                $cMenu[] = array('label'=>'<i>&#xf10b;</i><span>Repair Orders</span>', 'url'=>array('repairorder/index'), 'active'=>$this->ID == 'repairorder');
                $cMenu[] = array('label'=>'<i>&#xf0e0;</i><span>Contacts</span>', 'url'=>array('contacts/index'), 'active'=>$this->ID == 'contacts');
                $cMenu[] = array('label'=>'<i>&#xf013;</i><span>Setting </span>', 'url'=>array('configs/index'), 'active'=>$this->ID == 'configs');
            ?>
			<?php $this->widget('zii.widgets.CMenu', array(
				'encodeLabel'=>false,
				'items'=>$cMenu));
			?>
        </div>
        <div class="right">
            <div class="title">
                <?=$this->pageTitle?>
            </div>
            <ul class="breadcrumb">
                <?php /*
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links'=>$this->breadcrumbs,
						'homeLink' => '<a href="'.Yii::app()->baseUrl.'/admin">Trang chủ</a>',
                        'separator'=>'<span>/</span>',
                        'tagName'=>'li',
                    )); */
                ?>
            </ul>
            <?=$content?>
        </div>
    </div>
    <div class="footer">
        <span>&COPY 2014 by Appoint </span>
    </div>
</body>
</html>