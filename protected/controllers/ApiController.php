<?php
/**
 * ApiController class file
 * @author Joachim Werner <joachim.werner@diggin-data.de>  
 */
/**
 * ApiController 
 * 
 * @uses Controller
 * @author Joachim Werner <joachim.werner@diggin-data.de>
 * @author 
 * @see http://www.gen-x-design.com/archives/making-restful-requests-in-php/
 * @license (tbd)
 */
class ApiController extends Controller
{
    /**
     * Key which has to be in HTTP USERNAME and PASSWORD headers 
     */
    Const APPLICATION_ID = 'REPAIRDEVICES';
    Const TESTAPI = 'khoisang';
    
    private $format = 'json';
	
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array();
    }
    public function actionCheckDevices(){
        $json = array();
        $data = array();
    	if(isset($_REQUEST["test"]) && $_REQUEST["test"]== self::TESTAPI ){
			$json["test"]="Test";
		}else{
			$this->_checkAuth();
		}
        if(isset($_REQUEST['device_serial']) && $_REQUEST['device_serial'] != ''){
            $idDevice = $_REQUEST['device_serial'];
        }
        if(isset($_REQUEST['device_token'])){
            $device_token = $_REQUEST['device_token'];
        }else{
            $device_token = '';
        }
        if(isset($idDevice)){
            $arr_device = explode(',',$idDevice);
            foreach($arr_device as $k=>$device){
                $model = RepairOrder::model()->find('device_serial = :device_serial',array(':device_serial'=>$device));
                if($model){
                    $data[] = array('device_serial'=>$model->device_serial,'status'=>$model->status);
                    $model->device_token = $device_token;
                    $model->save();
                }else{
                    $data[] = array('device_serial'=>$device,'status'=>'-1');
                }
            }
            //$data = Yii::app()->db->createCommand("SELECT device_serial,status FROM repair_order WHERE device_serial in ($idDevice)")->queryAll(true);
        }else{
            $json['mss'] = 'Error! Device not exist';
            $json['status'] = 0;
            $this->_sendResponse(401,CJSON::encode($json));
            Yii::app()->end();
        }
		if($data != null){
            $json['status'] = 1;
            $json['data'] = $data;
            $this->_sendResponse(200,CJSON::encode($json));
            Yii::app()->end();
        }else{
            $json['status'] = 0;
            $json['mss'] = $this->_getStatusCodeMessage(204);
            $this->_sendResponse(200,CJSON::encode($json));
            Yii::app()->end();
        }
    }
    
    public function actionPushMessageForAccount(){
        if(isset($_REQUEST["test"]) && $_REQUEST["test"]== self::TESTAPI ){
			$json["test"]="Test";
		}else{
			$this->_checkAuth();
		}
        if(isset($_REQUEST['account_name']) && $_REQUEST['account_name'] != ''){
            $account_name = $_REQUEST['account_name'];
        }
    }
public function actionDeviceDetail(){
        $json = array();
    	if(isset($_REQUEST["test"]) && $_REQUEST["test"]== self::TESTAPI ){
			$json["test"]="Test";
		}else{
			$this->_checkAuth();
		}
        if(isset($_REQUEST['device_serial']) && $_REQUEST['device_serial'] != ''){
            $device_serial = $_REQUEST['device_serial'];
            $data = Yii::app()->db->createCommand("SELECT * FROM repair_order WHERE device_serial = :device_serial")->queryRow(true,array(':device_serial' => $device_serial));
            if($data != null){
                $json['status'] = 1;               
                $json['data'] = $data;
                $this->_sendResponse(200,CJSON::encode($json));
                Yii::app()->end();
            }else{
                $json['status'] = 0;
                $json['mss'] = $this->_getStatusCodeMessage(204);
                $this->_sendResponse(200,CJSON::encode($json));
                Yii::app()->end();
            }
        }else{
            $json['mss'] = 'Error! Version not exist';
            $json['status'] = 0;
            $this->_sendResponse(401,CJSON::encode($json));
            Yii::app()->end();
        }
    }
    public function actionConfigs(){
        $json = array();
    	if(isset($_REQUEST["test"]) && $_REQUEST["test"]== self::TESTAPI ){
			$json["test"]="Test";
		}else{
			$this->_checkAuth();
		}
        if(isset($_REQUEST['version']) && $_REQUEST['version'] != ''){
            $version = $_REQUEST['version'];
            $data = Yii::app()->db->createCommand("SELECT image,logo,hotline FROM configs_app WHERE version = :version")->queryRow(true,array(':version' => $version));
            if($data != null){
                $json['status'] = 1;
                $data['image'] = "http://sieuthi24h.org/phonerepair/images/".$data['image'];
                $data['logo'] = "http://sieuthi24h.org/phonerepair/images/".$data['logo'];
                $json['data'] = $data;
                $this->_sendResponse(200,CJSON::encode($json));
                Yii::app()->end();
            }else{
                $json['status'] = 0;
                $json['mss'] = $this->_getStatusCodeMessage(204);
                $this->_sendResponse(200,CJSON::encode($json));
                Yii::app()->end();
            }
        }else{
            $json['mss'] = 'Error! Version not exist';
            $json['status'] = 0;
            $this->_sendResponse(401,CJSON::encode($json));
            Yii::app()->end();
        }
    }
    /**
     * Creates a new item
     * 
     * @access public
     * @return void
     */
    public function actionCreate(){
    }
	
    /**
     * Update a single iten
     * 
     * @access public
     * @return void
     */
    public function actionUpdate(){
        
    }
	
    /**
     * Deletes a single item
     * 
     * @access public
     * @return void
     */
    public function actionDelete(){
        
    }
	
    /**
     * Sends the API response 
     * 
     * @param int $status 
     * @param string $body 
     * @param string $content_type 
     * @access private
     * @return void
     */
    private function _sendResponse($status = 200, $body = '', $content_type = 'application/json')
    {
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        // set the status
        header($status_header);
        // set the content type
        header('Content-type: '.$content_type);

        // pages with body are easy
        if($body != '')
        {
            // send the body
            echo $body;
            Yii::app()->end();
        }
        // we need to create the body if none is passed
        else
        {
            // create some body messages
            $message = '';

            // this is purely optional, but makes the pages a little nicer to read
            // for your users.  Since you won't likely send a lot of different status codes,
            // this also shouldn't be too ponderous to maintain
            switch($status)
            {
                case 401:
                    $message = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }

            // servers don't always have a signature turned on (this is an apache directive "ServerSignature On")
            $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

            // this should be templatized in a real-world solution
            $body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
                        <html>
                            <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
                                <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
                            </head>
                            <body>
                                <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
                                <p>' . $message . '</p>
                                <hr />
                                <address>' . $signature . '</address>
                            </body>
                        </html>';

            echo $body;
            exit;
        }
    }
	
    /**
     * Gets the message for a status code
     * 
     * @param mixed $status 
     * @access private
     * @return string
     */
    private function _getStatusCodeMessage($status)
    {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported'
        );

        return (isset($codes[$status])) ? $codes[$status] : '';
    }
    
    private function _getTransactionMessage($code){
		$arrCode = array(
		   '00'=>  'Giao dịch thành công',
		   '99'=>  'Lỗi, tuy nhiên lỗi chưa được định nghĩa hoặc chưa xác định được nguyên nhân',
		   '01'=>  'Lỗi, địa chỉ IP truy cập API của NgânLượng.vn bị từ chối',
		   '02'=>  'Lỗi, tham số gửi từ merchant tới NgânLượng.vn chưa chính xác (thường sai tên tham số hoặc thiếu tham số)',
		   '03'=>  'Lỗi, Mã merchant không tồn tại hoặc merchant đang bị khóa kết nối tới NgânLượng.vn',
		   '04'=>  'Lỗi, Mã checksum không chính xác (lỗi này thường xảy ra khi mật khẩu giao tiếp giữa merchant và NgânLượng.vn không chính xác, hoặc cách sắp xếp các tham số trong biến params không đúng)',
		   '05'=>  'Tài khoản nhận tiền nạp của merchant không tồn tại',
		   '06'=>  'Tài khoản nhận tiền nạp của merchant đang bị khóa hoặc bị phong tỏa, không thể thực hiện được giao dịch nạp tiền',
		   '07'=>  'Thẻ đã được sử dụng ',
		   '08'=>  'Thẻ bị khóa',
		   '09'=>  'Thẻ hết hạn sử dụng',
		   '10'=>  'Thẻ chưa được kích hoạt hoặc không tồn tại',
		   '11'=>  'Mã thẻ sai định dạng',
		   '12'=>  'Sai số serial của thẻ',
		   '13'=>  'Mã thẻ và số serial không khớp',
		   '14'=>  'Thẻ không tồn tại',
		   '15'=>  'Thẻ không sử dụng được',
		   '16'=>  'Số lần thử (nhập sai liên tiếp) của thẻ vượt quá giới hạn cho phép',
		   '17'=>  'Hệ thống Telco bị lỗi hoặc quá tải, thẻ chưa bị trừ',
		   '18'=>  'Hệ thống Telco bị lỗi hoặc quá tải, thẻ có thể bị trừ, cần phối hợp với NgânLượng.vn để tra soát',
		   '19'=>  'Kết nối từ NgânLượng.vn tới hệ thống Telco bị lỗi, thẻ chưa bị trừ (thường do lỗi kết nối giữa NgânLượng.vn với Telco, ví dụ sai tham số kết nối, mà không liên quan đến merchant)',
		   '20'=>  'Kết nối tới telco thành công, thẻ bị trừ nhưng chưa cộng tiền trên NgânLượng.vn');
		   
		   return $arrCode[$code];   
    }
	
    /**
     * Checks if a request is authorized
     * 
     * @access private
     * @return void
     */
    private function _checkAuth()
    {
        // Check if we have the USERNAME and PASSWORD HTTP headers set?
        // HTTP_X_CONCOVANG_USERNAME  HTTP_X_CONCOVANG_PASSWORD 
        if(!(isset($_SERVER['HTTP_X_'.self::APPLICATION_ID.'_USERNAME']) and isset($_SERVER['HTTP_X_'.self::APPLICATION_ID.'_PASSWORD']))) {
            // Error: Unauthorized
            $json['status'] = 'GENERIC_EXCEPTION';
            $this->_sendResponse(200,CJSON::encode($json));
        }
        $username = $_SERVER['HTTP_X_'.self::APPLICATION_ID.'_USERNAME'];
        $password = $_SERVER['HTTP_X_'.self::APPLICATION_ID.'_PASSWORD'];
         
        // set default user: appMobile  : pass: 2014@pp MD5 aa7c49a0f225ae1bbee72f52b628455c 
        if($username!="appMobile" || $password!= "aa7c49a0f225ae1bbee72f52b628455c") {
            // Error: Unauthorized
            $json['status'] = '401';
            $this->_sendResponse(200,CJSON::encode($json));
        } 
    }
	
    /**
     * Returns the json or xml encoded array
     * 
     * @param mixed $model 
     * @param mixed $array Data to be encoded
     * @access private
     * @return void
     */
    private function _getObjectEncoded($model, $array)
    {
        if(isset($_GET['format']))
            $this->format = $_GET['format'];

        if($this->format=='json')
        {
            return CJSON::encode($array);
        }
        elseif($this->format=='xml')
        {
            $result = '<?xml version="1.0">';
            $result .= "\n<$model>\n";
            foreach($array as $key=>$value)
                $result .= "    <$key>".utf8_encode($value)."</$key>\n"; 
            $result .= '</'.$model.'>';
            return $result;
        }
        else
        {
            return;
        }
    }
}