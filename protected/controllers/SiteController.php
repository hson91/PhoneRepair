<?php

class SiteController extends Controller
{
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
    public function actionPushMessageServer(){
        $deviceToken = 'cd9ad827e0b1d21b58fc196828c38c9913f0d0da1c706f41700b7a7e1c246679';

        // Put your private key's passphrase here:
        $passphrase = 'htam1234';//pass tuong ung voi file pem
        
        // Put your alert message here:
        $message = 'My first push notification!';
        
        ////////////////////////////////////////////////////////////////////////////////
        
        $ctx = stream_context_create();
        //Neu la ban product thi thay file pem cho ban product
        stream_context_set_option($ctx, 'ssl', 'local_cert', Yii::app()->baseUrl.'/file/PhoneRepairck.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
        
        // Open a connection to the APNS server
        $fp = stream_socket_client(
        	'ssl://gateway.sandbox.push.apple.com:2195', $err,
        	$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        
        //neu la ban product thi thay link: 'ssl://gateway.sandbox.push.apple.com:2195' bang ssl://gateway.push.apple.com:2195'
        
        if (!$fp)
        	exit("Failed to connect: $err $errstr" . PHP_EOL);
        
        echo 'Connected to APNS' . PHP_EOL;
        
        // Create the payload body
        $body['aps'] = array(
        	'alert' => $message,
        	'sound' => 'default'
        	);
        
        // Encode the payload as JSON
        $payload = json_encode($body);
        
        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        
        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));
        
        if (!$result)
        	echo 'Message not delivered' . PHP_EOL;
        else
        	echo 'Message successfully delivered' . PHP_EOL;
        
        // Close the connection to the server
        fclose($fp);
    }
	public function actionIndex()
	{
	   $this->active = "/";
       if(isset($_POST['serial-number-check'])){
            if($_POST['serial-number-check'] != ''){
               if(!empty($_POST['email'])){
                    $email = $_POST['email'];
               }
               $r_serial = $_POST['serial-number-check']; 
               $r_serial = nl2br($_POST['serial-number-check']);
               $search = array("<br />","<br>",";","*");
               $r_serial = str_replace($search,',',$r_serial);
               $r_serial = str_replace("\n",'',$r_serial);
               $r_serial = trim($r_serial,"\t\n\r\0\x0B,");
               $arr_search = explode(',',$r_serial);
               $data = array();
               foreach($arr_search as $k=>$v){
                    $model = RepairOrder::model()->find('device_serial = :device_serial',array(':device_serial'=>trim($v)));
                    if($model != null){
                        if(isset($email)){
                            $arr_email = explode('<br />',$model->email);
                            if(!in_array($email,$arr_email)){
                                $model->email = $model->email.'<br />'.$email;$model->save();
                            }
                        }
                        $data[$k] = array('device_serial'=> $model->device_serial,'status'=>$model->status,'comments'=>$model->comments);
                    }else{
                        $data[$k] = array('device_serial'=> $v,'status'=>'Not exist','comments'=>'');
                    }
               }
               //$models = RepairOrder::model()->findAll('device_serial in ('.$r_serial.')');
               $this->render('devices-list', array('models'=>$data));
               Yii::app()->end();
               
            }else{
                $this->redirect(Yii::app()->baseUrl.'/');
            }
       }
	   $this->render('index');
	}
    public function actionListDevices($id = null){
        if($this->guestLogin != null){
            if($id != null){
                $model = Vouchers::model()->find('device_serial = :device_serial',array(':device_serial'=>$id));
                if($model){
                    $this->render('device-detail', array('model'=>$model));
                    Yii::app()->end();
                }
            }
            $models = Vouchers::model()->findAll('guest_id = :guest_id',array(':guest_id'=>$this->guestLogin['guestID']));
            if($models){
                $this->render('devices-list', array('models'=>$models));
                Yii::app()->end();
            }else{
                $this->redirect(Yii::app()->baseUrl);
            }
        }else{
            $this->redirect(Yii::app()->baseUrl);
        }
    }
    public function actionListPrices($alias = null){
        $this->active = "prices-list";
        $prices = $this->configs['prices-list'];
        if($prices){
            $this->render('prices-list', array('prices_list'=>$prices));
        }else{
            $this->redirect(Yii::app()->baseUrl);
        }
    }
    public function actionLogoutGuest(){
        Yii::app()->session->destroy();
        $this->redirect(Yii::app()->baseUrl.'/');
    }
	public function actionAbout(){
	   $this->active = "about";
	   $about = $this->configs['gioi-thieu'];
       if($about){
            $this->render('about', array('about'=>$about));
       }else{
            $this->redirect(Yii::app()->baseUrl);
       }
	}
	//Trang liên hệ
	public function actionContact(){
        $this->active = 'contact';
        if(isset($_POST['btnContact'])){
            $mss = '';
            $err =  array();
            $model =new Contacts;
            $model->status = 0;
            $model->fullname = $_POST['name'];
            $model->phone = $_POST['phone'];
            $model->address = $_POST['address'];
            $model->title = $_POST['subject'];
            $model->email = $_POST['email'];
            $model->description = $_POST['message'];
            
            if($model->email == ''){
                $err['email'] = 'Email can not blank !';
            }
            if($model->title == ''){
                $err['subject'] = 'Subject can not blank !';
            }
            if($model->description == ''){
                $err['message'] = 'Message can not blank !';
            }
            if($err != null){
                $this->render('contact',array('errors'=>$err));
                Yii::app()->end();
            }
            if($model->save()){
				$name='=?UTF-8?B?'.base64_encode($model->fullname).'?=';
				$subject='=?UTF-8?B?'.base64_encode('Liên hệ số '.date('dmYHis')).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";
				
				$body = '';
				$body .= "Fullname:       ".$model->fullname."\r\n";
				$body .= "Address:      ".$model->address."\r\n";
				$body .= "Phone number:   ".$model->phone."\r\n";
				$body .= "Email:        ".$model->email."\r\n";
				
				$body .= "\r\n\r\n".$model->description."\r\n";
				Yii::import('ext.yiimail.YiiMailMessage');
				$message = new YiiMailMessage;
				$message->setBody($body);
				$message->subject = $subject;
				$mailTo = '';//Configs::getConfig('email', $this->lang);
				if($mailTo == '')
					$mailTo = ($this->configs['mail-letter'] != '')?$this->configs['mail-letter']:'hson91@gmail.com';
				$message->addTo($mailTo);
				$message->from = $model->email;
                if(Yii::app()->mail->send($message)){
                    unset($_POST);
                    $mss = '<div class="alert alert-success" id="contact-alert-success">
						      <strong>Send contact Success!</strong>.
					       </div>';
                    Yii::app()->user->setFlash('mss',$mss);
                    $this->redirect('contact.html');
                }else{
                    $mss = '<div class="alert alert-danger hidden" id="contact-alert-error">
						      <strong>Error!</strong> Send contact faild.
					       </div>';
                    Yii::app()->user->setFlash('mss',$mss);
                    $this->redirect('contact.html');
                }
			}else{
			   $mss = '<div class="alert alert-danger hidden" id="contact-alert-error">
						      <strong>Error!</strong> Send contact faild.
					       </div>';
                Yii::app()->user->setFlash('mss',$mss);
                $this->redirect('contact.html');
			}
        }
        $this->render('contact');
	}
    
    public function actionError(){
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}else{
		      $this->render('error', $error);
		} 
        //$this->redirect(Yii::app()->baseUrl);
	}
}