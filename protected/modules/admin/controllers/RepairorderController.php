<?php
class RepairorderController extends AController
{
	/**
	 * Declares class-based actions.
	 */
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
            'upload'=>'application.controllers.upload.UploadFileAction',
		);
	}
    /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}
    
    public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('tests', 'delete','index','create','update','status','isnew','showhome','cates', 'detail'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
    public function actionIndex()
    {
        //$this->breadcrumbs = array($this->ID.' Manager'=>array('index'));
        $this->pageTitle = "PHONE REPAIR - ORDER MANAGEMENT";
        $model=new RepairOrder('search');
        $model->unsetAttributes();
        if(isset($_GET['RepairOrder']))
            $model->attributes=$_GET['RepairOrder'];
        $this->render('index',array(
            'model' => $model
        ));
    }
    
    public function actionCreate(){
        //$this->breadcrumbs = array($this->ID.' Manager'=>array('index'),'Create'=>array('create'));
        $this->pageTitle = "PHONE REPAIR - ORDER CREATE";
        $model = new RepairOrder;
        $model->status = 0;
        if(isset($_POST['RepairOrder']))
		{
			$model->attributes=$_POST['RepairOrder'];
            if($model->validate()){
                $otherModel = RepairOrder::model()->find('device_serial = :device_serial', array(':device_serial' => $model->device_serial));
                if($otherModel == null){
                    if($model->save(false)){
                        $this->redirect(array('index'));    
                    }
                }else{
                    $model->addError('device_serial','Devices existing');
                }
            }
        }
        $this->render('create',array(
            'model'=>$model,
        ));
    }
    
    public function actionUpdate($id){
        set_time_limit(0);
        $this->pageTitle = "PHONE REPAIR - ORDER UPDATE";
        $this->breadcrumbs = array($this->ID.' Manager'=>array('index'),'Update'=>array('update', 'id'=>$id));
        $model = $this->loadModel($id);
        $deviceOld = $model->device_serial;
        $statusOld = $model->status;        
        if(isset($_POST['RepairOrder']))
		{
		    //$arr = explode('<br />',nl2br($_POST['RepairOrder']['email']));
			$model->attributes=$_POST['RepairOrder'];
            if($model->validate()){
                $otherModel = RepairOrder::model()->find('device_serial = :device_serial', array(':device_serial' => $model->device_serial));
                if($otherModel != null && $deviceOld != $otherModel->device_serial){
                    $model->addError('device_serial','Devices existing');
                }else{
                    $model->email = ($model->email != '')?nl2br($model->email):'';
                    if($model->save()){
                        if($model->status != $statusOld){
                            $this->PushMessage($id); 
                        }
                                            
                    }
                    if($model->save()){
                        Yii::app()->user->setFlash('statusUpdate','true');
                    }
                }
            }
        }
        $this->render('create',array(
            'model'=>$model,
        ));
    }
    
    public function actionDelete($id)
	{
	    $model = $this->loadModel($id)->delete();
	}
    
    public function actionDeleteList(){
        set_time_limit(0);
        if ($_POST['ids']) {
            $ids = implode(',',$_POST['ids']);
            Yii::app()->db->createCommand()->delete('repair_order','id in ('.$ids.')');
        }
    }
    public function PushMessage($id){
        $model = $this->loadModel($id);
            $message = array(
                'title' => 'PHONE REPAIR UPDATE STATUS',
                'message' => $model->status,
                'type' => '1',
                'page' => '0',
                'item_id' => $model->device_serial,
                
                );
            $arr_post = array(
                                'application_id' => 1,
                                'device_token' => $model->device_token,
                                'json' => json_encode($message),
                            );
            $data_post = json_encode($arr_post);
            $headers_post = array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_post),
            );
            $curl = curl_init("http://54.251.186.76/pushmessageprocessor/api/PushMessage/PushMessageForDevice");
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST"); 
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_post);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers_post);
            curl_exec($curl);
            curl_close($curl);
    }    
    public function actionStatus($id = null){
        $data = array();
        $model = $this->loadModel($id);
        if($model->status == 0){
            $model->status = 1;
        }elseif($model->status == 1){
            $model->status = 2;
        }else{
            $model->status = 0;
        }
        if($model->save()){
            $this->PushMessage($id);
        }
        $data['statusDevice'] = $model->status;
        echo json_encode($data);
        if(!isset($_GET['ajax'])){
            $this->redirect(array('index'));
        }
    }
    
    public function actionInstock($id = null){
        $data = array();
        $model = $this->loadModel($id);
        if($model->in_stock == 1){
            $model->in_stock = 0;
        }else{
            $model->in_stock = 1;
        }
        $model->save();
        $data['status'] = $model->in_stock;
        echo json_encode($data);
        if(!isset($_GET['ajax'])){
            $this->redirect(array('index'));
        }
    }
    
    public function loadModel($id)
	{
		$model = RepairOrder::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
    public function loadModelWithSerial($device_serial){
        $model = RepairOrder::model()->findByAttributes(array('device_serial'=>$device_serial));
        if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
    }
 }