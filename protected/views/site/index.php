<section class="page-content" style="margin-top: 5px;background: no-repeat left fixed url(<?php echo Yii::app()->baseUrl.'/images/bg_check_devices.png'?>); background-size: cover;">
	<div class="container">
		<div class="row">
			<div class="col-md-6" style="float: right;">
                <?php if(Yii::app()->user->hasFlash('mss')) echo Yii::app()->user->getFlash('mss');?>
				<div class="box">
					<h3 style="margin-top: 0; color: #d25f0a; font-size: 20px;">Enter your Repair codes</h3>
					<form action="<?php echo Yii::app()->baseUrl.'/'?>" method="post">
						<div class="form-group">
                            <textarea class="form-control" style="width: 100%; height: 200px; resize: none;font-size: 30px;letter-spacing: 2px;line-height: 35px;" name="serial-number-check" 
                                        placeholder="Serial number 1&#10Serial number 2&#10.... "></textarea>
						</div>
                        <div class="form-group">
                            <label style="color: #d25f0a; font-size: 14px;">Enter your email to receive notification:</label>
                            <input type="email" placeholder="ex: youremail@example.com" value="" name="email" class="form-control" />
						</div>
						<button type="submit" class="btn btn-primary btn-inline">Check</button>
					</form>
				</div>
			</div>
		</div>
     </div>
</section>
<section class="page-content" style="margin-top: 20px;">
	<div class="container">
		<div class="row">
            <div class="title-about-home">
                <div class="line-l"></div>
                <div class="title-center">BRING YOU BACK TO LIFE WITH ABC</div>
                <div class="line-r"></div>
            </div>
            <div class="col-md-12" style="text-align: center;">
                <h4 style="line-height: 22px;">
                    We tack care of your loved ones <br />
                    Electronic Device Repair: Fast - Affordable - Experienced
                </h4>
                <h5 style="line-height: 22px;">
                    If your cellphone, laptop, or gaming systems break, you want an expert to handle the repair. That's <br />
                    where we come in. With over 16 year of experience in electronic repair, we can get the job done quickly and effectively 
                    
                </h5>
            </div>
		</div>
        <div class="row" style="margin-top: 15px;">
            <div style="color: #d25f0a; font-size:20px; margin: 10px 0;">OURR PARTNER </div>
            <div class="partners">
                <div class="control-left" id="control-left"></div>
                <div class="viewer" id="viewer">
                    <div class="slides">
                        <div class="slide-item"><img src="<?php echo Yii::app()->baseUrl.'/images/partners/IBM.gif'?>" /></div>
                        <div class="slide-item"><img src="<?php echo Yii::app()->baseUrl.'/images/partners/Hewlett-Packard.gif'?>" /></div>
                        <div class="slide-item"><img src="<?php echo Yii::app()->baseUrl.'/images/partners/SingTel.gif'?>" /></div>
                        <div class="slide-item"><img src="<?php echo Yii::app()->baseUrl.'/images/partners/singnet.gif'?>" /></div>
                        <div class="slide-item"><img src="<?php echo Yii::app()->baseUrl.'/images/partners/adrc.gif'?>" /></div>
                        <div class="slide-item"><img src="<?php echo Yii::app()->baseUrl.'/images/partners/Aztech.gif'?>" /></div>
                        <div class="slide-item"><img src="<?php echo Yii::app()->baseUrl.'/images/partners/Belkin.gif'?>" /></div>
                        <div class="slide-item"><img src="<?php echo Yii::app()->baseUrl.'/images/partners/DLink.gif'?>" /></div>
                        <div class="slide-item"><img src="<?php echo Yii::app()->baseUrl.'/images/partners/avastilogo.gif'?>" /></div>
                        <div class="slide-item"><img src="<?php echo Yii::app()->baseUrl.'/images/partners/levelone.gif'?>" /></div>
                    </div>
                </div>
                <div class="control-right" id="control-right"></div>
            </div>
        </div>
     </div>
</section>
