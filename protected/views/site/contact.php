<!-- Page Content -->
<section class="page-content" style="padding-top: 0;">
    <div class="container">
        <div class="row">
			<div class="col-md-8">
                <h3 style="color: #6d6d6d; margin-bottom: 15px;">CONTACT FORM</h3>
				<form action="<?php echo Yii::app()->baseUrl?>/contact.html" method="post">
                    <?php if(Yii::app()->user->hasFlash('mss')) echo Yii::app()->user->getFlash('mss');?>
					<div class="row contact-form">
						<div class="col-md-6">
							<div class="form-group">
                                <i class="fa fa-user"></i>
								<input type="text"
                                    placeholder="NAME/SURNAME"
									value=""
									data-msg-required="Fullname can not be blank."
									class="form-control"
									name="name" id="name" />
							</div>
						</div>
                        <div class="col-md-6">
							<div class="form-group">
                                <i class="fa fa-phone"></i>
								<input type="text" 
                                    placeholder="PHONE NUMBER"
									value=""
									data-msg-required="Phone number can not be blank."
									class="form-control"
									name="phone"
									id="phone" />
							</div>
						</div>
                        
						<div class="col-md-6">
							<div class="form-group">
                                <i class="fa fa-envelope"></i>
								<input type="email" <?php echo !empty($errors['email'])?"style='border:1px solid red'":''?>
                                    placeholder="EMAIL ADDRESS"
									value=""
									data-msg-required="Email can not be blank."
									data-msg-email="Email invalid."
									class="form-control"
									name="email"
									id="email" />
							</div>
						</div>
                        
                        <div class="col-md-6">
							<div class="form-group">
                                <i class="fa fa-map-marker"></i>
								<input type="text" 
                                    placeholder="ADDRESS"
									value=""
									data-msg-required="Address can not be blank."
									class="form-control"
									name="address"
									id="address" />
							</div>
						</div>
                        <div class="col-md-12">
							<div class="form-group">
                                <i class="fa fa-bookmark"></i>
								<input type="text" <?php echo !empty($errors['subject'])?"style='border:1px solid red'":''?>
                                    placeholder="SUBJECT"
									value=""
									data-msg-required="Subject can not be blank."
									class="form-control"
									name="subject"
									id="subject" />
							</div>
						</div>
                        
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<textarea <?php echo !empty($errors['message'])?"style='border:1px solid red'":''?>
									data-msg-required="Message can not be blank."
                                    placeholder="MESSAGE"
									rows="10"
									class="form-control"
									name="message"
									id="message"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<input type="submit" name="btnContact" value="Send Contact" class="btn btn-primary" />
						</div>
					</div>
				</form>
			</div>
            <div class="col-md-4">
                <div class="contacts-widget widget widget__sidebar">
					<h3 style="color: #6d6d6d; margin-bottom: 15px;">CONTACT US</h3>
					<ul class="contacts-info-list">
						<li>
							<i class="fa fa-map-marker"></i>
							<div class="info-item">
								<?php if($this->configs['address']) echo $this->configs['address'];?>
							</div>
						</li>
						<li>
							<i class="fa fa-phone"></i>
							<div class="info-item">
								<?php if($this->configs['phone-number']) echo $this->configs['phone-number'];?>
							</div>
						</li>
						<li>
							<i class="fa fa-envelope"></i>
							<span class="info-item">
								<a href="mailto:<?php if($this->configs['email']) echo $this->configs['email'];?>"><?php if($this->configs['email']) echo $this->configs['email'];?></a>
							</span>
						</li>
						<li>
							<i class="fa fa-skype"></i>
							<div class="info-item">
								<?php if($this->configs['skype']) echo $this->configs['skype'];?>
							</div>
						</li>
					</ul>
				</div>
            </div>

	</div>
	<div class="row" style="margin-top: 20px;">
        <div class="col-md-12" style="margin-bottom: 20px;">
            <?php if($this->configs['maps']) echo $this->configs['maps'];?>
        </div>
    </div>
</section>
<!-- Page Content / End -->