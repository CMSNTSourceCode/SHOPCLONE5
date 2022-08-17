<?php
class MomoLogin{
	private $config;
	public function __construct(){
		$this->config = [
			'aaid'                  => '',
			'idfa'                  => '',
			'csp'                   => 'Viettel',
			'icc'                   => '',
			'mcc'                   => '452',
			'mnc'                   => '04',
			'cname'                 => 'Vietnam',
			'ccode'                 => '084',
			'channel'               => 'APP',
			'lang'                  => 'vi',
			'device'                => 'iPhone',
			'firmware'              => '13.5.1',
			'manufacture'           => 'Apple',
			'hardware'              => 'iPhone',
			'simulator'             => false,
			'appVer'                => '21530',
			'appCode'               => "2.1.53",
			'deviceOS'              => "IOS"
		];
	}
	public function rkey($length) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$size = strlen($chars);
		$str = '';
		for ($i = 0; $i < $length; $i++) {
			$str .= $chars[rand(0, $size - 1)];
		}
		return $str;
	}
	private function get_microtime(){
		return floor(microtime(true) * 1000);
	}
	public function get_imei() {
		$time = md5($this->get_microtime());
		$text = substr($time, 0, 8) . '-';
		$text .= substr($time, 8, 4) . '-';
		$text .= substr($time, 12, 4) . '-';
		$text .= substr($time, 16, 4) . '-';
		$text .= substr($time, 17, 12);
		$text = strtoupper($text);
		return $text;
	}
	public function onesignal() {
		$time = md5($this->get_microtime() . '000000');
		$text = substr($time, 0, 8) . '-';
		$text .= substr($time, 8, 4) . '-';
		$text .= substr($time, 12, 4) . '-';
		$text .= substr($time, 16, 4) . '-';
		$text .= substr($time, 17, 12);
		return $text;
	}
	public function send_otp($phone,$rkey,$onesignal,$imei,$isVoice) {
		$config = $this->config;
		$type = 'SEND_OTP_MSG';
		$data_body = [
			'user' => $phone,
			'msgType' => $type,
			'cmdId' => $this->get_microtime() . '000000',
			'lang' => $config['lang'],
			'channel' => $config['channel'],
			'time' => $this->get_microtime(),
			'appVer' => $config['appVer'],
			'appCode' => $config['appCode'],
			'deviceOS' => $config['deviceOS'],
			'result' => true,
			'errorCode' => 0,
			'errorDesc' => '',
			'extra' => [
				'action' => 'SEND',
				'rkey' => $rkey,
				'AAID' => '',
				'IDFA' => '',
				'TOKEN' => '',
				'ONESIGNAL_TOKEN' => $onesignal,
				'SIMULATOR' => 'false',
				'isVoice' => $isVoice, // true => call,false => sms
				'REQUIRE_HASH_STRING_OTP' => false,
			],
			'momoMsg' => [
				'_class' => 'mservice.backend.entity.msg.RegDeviceMsg',
				'number' => $phone,
				'imei' => $imei,
				'cname' => $config['cname'],
				'ccode' => $config['ccode'],
				'device' => $config['device'],
				'firmware' => $config['firmware'],
				'hardware' => $config['hardware'],
				'manufacture' => $config['manufacture'],
				'csp' => $config['csp'],
				'icc' => $config['icc'],
				'mcc' => $config['mcc'],
				'mnc' => $config['mnc'],
				'device_os' => $config['deviceOS'],
			],
		];
		//return $data_body;die;
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://owa.momo.vn/public",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($data_body),
			CURLOPT_HTTPHEADER => array(
				'User-Agent' => "MoMoApp-Release/%s CFNetwork/978.0.7 Darwin/18.6.0",
				'Msgtype' => "USER_LOGIN_MSG",
				'Accept' => 'application/json',
				'Content-Type' => 'application/json',
				'Userhash' => md5($phone),
			),
		));
		$response = curl_exec($curl);
		if (!$response) {
			return false;
		}
		return $response;
	}
	public function comfirm_otp($phone,$otp,$rkey,$onesignalToken,$imei) {
		$config = $this->config;
		$type = 'REG_DEVICE_MSG';
		$data_body = [
			'user' => $phone,
			'msgType' => $type,
			'cmdId' => $this->get_microtime() . '000000',
			'lang' => $config['lang'],
			'channel' => $config['channel'],
			'time' => $this->get_microtime(),
			'appVer' => $config['appVer'],
			'appCode' => $config['appCode'],
			'deviceOS' => $config['deviceOS'],
			'result' => true,
			'errorCode' => 0,
			'errorDesc' => '',
			'extra' => [
				'ohash' => hash('sha256', $phone . $rkey . $otp),
				'AAID' => '',
				'IDFA' => '',
				'TOKEN' => '',
				'ONESIGNAL_TOKEN' => $onesignalToken,
				'SIMULATOR' => 'false',
			],
			'momoMsg' => [
				'_class' => 'mservice.backend.entity.msg.RegDeviceMsg',
				'number' => $phone,
				'imei' => $imei,
				'cname' => $config['cname'],
				'ccode' => $config['ccode'],
				'device' => $config['device'],
				'firmware' => $config['firmware'],
				'hardware' => $config['hardware'],
				'manufacture' => $config['manufacture'],
				'csp' => $config['csp'],
				'icc' => $config['icc'],
				'mcc' => $config['mcc'],
				'mnc' => $config['mnc'],
				'device_os' => $config['deviceOS'],
			],
		];
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://owa.momo.vn/public",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($data_body),
			CURLOPT_HTTPHEADER => array(
				'User-Agent' => "MoMoApp-Release/%s CFNetwork/978.0.7 Darwin/18.6.0",
				'Msgtype' => "USER_LOGIN_MSG",
				'Accept' => 'application/json',
				'Content-Type' => 'application/json',
				'Userhash' => md5($phone),
			),
		));
		$response = curl_exec($curl);
		if (!$response) {
			return false;
		}
		return $response;
	}
}

$api = new MomoLogin;
$rkey = $api->rkey(20);
$get_imei = $api->get_imei();
$onesignal = $api->onesignal();
$isVoice = true;

if (!empty($_GET['get_otp']) && ($_GET['get_otp'] == true)) {
	$phone = $_GET['sdt']  ?? '';

	$otp = json_decode($api->send_otp($phone,$rkey,$onesignal,$get_imei,$isVoice));
	$build = [
		'rkey' => $rkey,
		'imei' => $get_imei,
		'onesignal' =>  $onesignal,
	];

	$json = json_encode($build);
	echo $json;
}

if (!empty($_GET['comfirm_otp']) && ($_GET['comfirm_otp'] == true)) {
	$comfirm = $api->comfirm_otp(
		$_GET['sdt']  ?? '',
		$_GET['otp'] ?? '',
		$_GET['rkey'] ?? '',
		$_GET['onesignal'] ?? '',
		$_GET['imei'] ?? '',
	);

	$setupkey = explode('"', explode('"setupKey":"', $comfirm)[1])[0] ??  false;

	$build = [
		'setup_key' => $setupkey,
	];

	$json = json_encode($build);
	echo $json;
}