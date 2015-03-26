<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8" />
   <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/css/bootstrap.min.css" />
   <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/css/fonts/font-awesome/css/font-awesome.css" />
   <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/css/theme.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/css/custom.css" />
</head>
<body>
	<div class="site-wrapper">
		<!-- Header -->
		<header class="header header-menu-fullw">
			<div class="header-main">
				<nav class="navbar navbar-default fhmm" role="navigation">
					<div class="navbar-header">
						<div class="container">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
								<i class="fa fa-bars"></i>
							</button>
							<!-- Logo -->
							<div class="logo">
                                <?php echo  isset($this->configs['logo'])?$this->configs['logo']:'';?>
							</div>
							<!-- Logo / End -->
							<!-- Banner -->
					      <div class="head-banner">
					      	<a href="<?php echo Yii::app()->baseUrl.'/';?>"><?php echo  isset($this->configs['banner'])?$this->configs['banner']:'<img src="'.Yii::app()->baseUrl.'/images/728_90_bx_cable_en.jpg" alt="PHONE REPAIR" title="PHONE REPAIR">';?></a>
					      </div>
					      <!-- Banner / End -->
						</div>
					</div><!-- end navbar-header -->
					<div id="main-nav" class="navbar-collapse collapse">
						<div class="container">
							<ul class="nav navbar-nav" style="width:100%">
                                <li <?php echo ($this->active == '/')?'class="active"':'';?> ><a href="<?php echo Yii::app()->baseUrl.'/'?>">Home</a></li>
                                <li <?php echo ($this->active == 'about')?'class="active"':'';?>><a href="<?php echo Yii::app()->baseUrl.'/about.html'?>">About</a></li>
                                <?php if($this->guestLogin != null && $this->guestLogin['statusLogin'] == true):?><li <?php echo ($this->active == 'devices')?'class="active"':'';?> ><a href="<?php echo Yii::app()->baseUrl.'/devices.html'?>">DEVICES</a></li><?php endif;?>
                                <li <?php echo ($this->active == 'prices-list')?'class="active"':'';?>><a href="<?php echo Yii::app()->baseUrl.'/prices-list.html'?>">Prices List</a></li>
                                <li <?php echo ($this->active == 'contact')?'class="active"':'';?>><a href="<?php echo Yii::app()->baseUrl.'/contact.html';?>">Contacts</a></li>
                                <li style="float: right; line-height: 50px; font-size: 24px; font-weight: bold;color: red;"><img alt="" src="<?php echo Yii::app()->baseUrl.'/images/icon-hotline.jpg'?>" style="height:30px" /> +65 6353 5321</li>
							</ul><!-- end nav navbar-nav -->
						</div>
					</div><!-- end #main-nav -->
				</nav><!-- end navbar navbar-default fhmm -->
			</div>
		</header>
		<!-- Header / End -->
		<!-- Main -->
		<div class="main" role="main" style="min-height:410px">
			<!-- Page Content -->
            <?php echo $content;?>
			<!-- Page Content / End -->
			<!-- Footer -->
			<footer class="footer" id="footer">
				<div class="footer-copyright">
					<div class="container">
						<div class="row">
							<div class="col-sm-6 col-md-4">
								Copyright &copy; 2014  <a href="<?php echo Yii::app()->baseUrl.'/'?>">Phone Repair</a> &nbsp;| &nbsp;All Rights Reserved
							</div>
							<div class="col-sm-6 col-md-8">
								<div class="social-links-wrapper">
									<span class="social-links-txt">Connect with us</span>
									<ul class="social-links social-links__dark">
										<li><a href="<?php if($this->configs['link-facebook']) echo $this->configs['link-facebook'];?>"><i class="fa fa-facebook"></i></a></li>
										<li><a href="<?php if($this->configs['link-twitter']) echo $this->configs['link-twitter'];?>"><i class="fa fa-twitter"></i></a></li>
                                                                                <li><a href="<?php if($this->configs['link-google-plus']) echo $this->configs['link-google-plus'];?>"><i class="fa fa-google-plus"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<!-- Footer / End -->
		</div>
		<!-- Main / End -->
	</div>
	<script src="<?php echo Yii::app()->baseUrl;?>/vendor/jquery-1.11.0.min.js"></script>
	<script src="<?php echo Yii::app()->baseUrl;?>/vendor/bootstrap.js"></script>
	<script src="<?php echo Yii::app()->baseUrl;?>/vendor/bootstrap-hover-dropdown.js"></script>

	<script src="<?php echo Yii::app()->baseUrl;?>/js/custom.js"></script>	
</body>
</html>