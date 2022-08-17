<?php
class Momo{
	private $config;
	public function __construct($phone, $password, $otp, $rkey, $setupKeyEncrypted, $imei, $token, $onesignalToken){
		$ohash = hash('sha256', $phone . $rkey . $otp);
		$this->config = [
			'phone'                 => $phone,
			'otp'                   => $otp,
			'password'              => $password,
			'rkey'                  => $rkey,
			'setupKeyEncrypted'     => $setupKeyEncrypted,
			'imei'                  => $imei,
			'token'                 => $token,
			'onesignalToken'        => $onesignalToken,
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
			'deviceOS'              => "IOS",
			'setupKeyDecrypted'     => $this->encryptDecrypt($setupKeyEncrypted, $ohash, 'DECRYPT')
		];
	}
	private function encryptDecrypt($data, $key, $mode = 'ENCRYPT'){
		if (strlen($key) < 32) {
			$key = str_pad($key, 32, 'x');
		}
		$key = substr($key, 0, 32);
		$iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
		if ($mode === 'ENCRYPT') {
			return base64_encode(openssl_encrypt($data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
		}
		else {
			return openssl_decrypt(base64_decode($data), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
		}
	}
	private function get_microtime(){
		return floor(microtime(true) * 1000);
	}

	private function get_checksum($type){
		$config         = $this->config;
		$checkSumSyntax = $config['phone'] . $this->get_microtime() . '000000' . $type . ($this->get_microtime() / 1000000000000.0) . 'E12';
		return $this->encryptDecrypt($checkSumSyntax, $config['setupKeyDecrypted']);
	}
	private function get_pHash(){
		$config         = $this->config;
		$pHashSyntax    = $config['imei'] . '|' . $config['password'];
		return $this->encryptDecrypt($pHashSyntax, $config['setupKeyDecrypted']);
	}
	// get token from momo account
	private function get_auth(){
		$config         = $this->config;
		$type           = 'USER_LOGIN_MSG';
		$data_body = [
			'user'      => $config['phone'],
			'pass'      => $config['password'],
			'msgType'   => $type,
			'cmdId'     => $this->get_microtime() . '000000',
			'lang'      => $config['lang'],
			'channel'   => $config['channel'],
			'time'      => $this->get_microtime(),
			'appVer'    => $config['appVer'],
			'appCode'   => $config['appCode'],
			'deviceOS'  => $config['deviceOS'],
			'result'    => true,
			'errorCode' => 0,
			'errorDesc' => '',
			'extra'     => [
				'checkSum'          => $this->get_checksum($type),
				'pHash'             => $this->get_pHash(),
				'AAID'              => $config['aaid'],
				'IDFA'              => $config['idfa'],
				'TOKEN'             => $config['token'],
				'ONESIGNAL_TOKEN'   => $config['onesignalToken'],
				'SIMULATOR'         => $config['simulator']
			],
			'momoMsg'   => [
				'_class'    => 'mservice.backend.entity.msg.LoginMsg'
				, 'isSetup' => true
			]
		];
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL             => "https://owa.momo.vn/public",
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_ENCODING        => "",
			CURLOPT_MAXREDIRS       => 10,
			CURLOPT_TIMEOUT         => 30,
			CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST   => "POST",
			CURLOPT_POSTFIELDS      => json_encode($data_body),
			CURLOPT_HTTPHEADER      => array(
				'User-Agent'    => "MoMoApp-Release/%s CFNetwork/978.0.7 Darwin/18.6.0",
				'Msgtype'       => "USER_LOGIN_MSG",
				'Accept'        => 'application/json',
				'Content-Type'  => 'application/json',
				'Userhash'      => md5($config['phone'])  ,
			)
		));
		$response = curl_exec($curl);
		if(!$response){
			return false;
		}
		return json_decode($response)->extra->AUTH_TOKEN;
	}
	// begin function *Check Info Momo Account* 
	public function get_info(){
		$config         = $this->config;
		$type           = 'USER_LOGIN_MSG';
		$data_body = [
			'user'      => $config['phone'],
			'pass'      => $config['password'],
			'msgType'   => $type,
			'cmdId'     => $this->get_microtime() . '000000',
			'lang'      => $config['lang'],
			'channel'   => $config['channel'],
			'time'      => $this->get_microtime(),
			'appVer'    => $config['appVer'],
			'appCode'   => $config['appCode'],
			'deviceOS'  => $config['deviceOS'],
			'result'    => true,
			'errorCode' => 0,
			'errorDesc' => '',
			'extra'     => [
				'checkSum'          => $this->get_checksum($type),
				'pHash'             => $this->get_pHash(),
				'AAID'              => $config['aaid'],
				'IDFA'              => $config['idfa'],
				'TOKEN'             => $config['token'],
				'ONESIGNAL_TOKEN'   => $config['onesignalToken'],
				'SIMULATOR'         => $config['simulator']
			],
			'momoMsg'   => [
				'_class'    => 'mservice.backend.entity.msg.LoginMsg'
				, 'isSetup' => true
			]
		];
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL             => "https://owa.momo.vn/public",
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_ENCODING        => "",
			CURLOPT_MAXREDIRS       => 10,
			CURLOPT_TIMEOUT         => 30,
			CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST   => "POST",
			CURLOPT_POSTFIELDS      => json_encode($data_body),
			CURLOPT_HTTPHEADER      => array(
				'User-Agent'    => "MoMoApp-Release/%s CFNetwork/978.0.7 Darwin/18.6.0",
				'Msgtype'       => "USER_LOGIN_MSG",
				'Accept'        => 'application/json',
				'Content-Type'  => 'application/json',
				'Userhash'      => md5($config['phone'])  ,
			)
		));
		$response = curl_exec($curl);
		if(!$response){
			return false;
		}
		return $response;
	}
	// begin function *Check lsgd (1 h trước )* 
	public function history($day = 1){
		$config = $this->config;
		$type   = 'QUERY_TRAN_HIS_MSG';
		$data_post =  [
			'user'      => $config['phone'],
			'msgType'   => $type,
			'cmdId'     => $this->get_microtime() . '000000',
			'lang'      => $config['lang'],
			'channel'   => $config['channel'],
			'time'      => $this->get_microtime(),
			'appVer'    => $config['appVer'],
			'appCode'   => $config['appCode'],
			'deviceOS'  => $config['deviceOS'],
			'result'    => true,
			'errorCode' => 0,
			'errorDesc' => '',
			'extra'     => [
				'checkSum' => $this->get_checksum($type)
			],
			'momoMsg'   => [
				'_class'    => 'mservice.backend.entity.msg.QueryTranhisMsg',
				'begin'     => strtotime('1 hour ago') * 1000,
				'end'       => $this->get_microtime()
			]
		];
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL             => "https://owa.momo.vn/api/sync/$type",
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_ENCODING        => "",
			CURLOPT_MAXREDIRS       => 10,
			CURLOPT_TIMEOUT         => 60,
			CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST   => "POST",
			CURLOPT_POSTFIELDS      => json_encode($data_post),
			CURLOPT_HTTPHEADER      => array(
				'User-Agent'    => "MoMoApp-Release/%s CFNetwork/978.0.7 Darwin/18.6.0",
				'Msgtype'       => $type,
				'Userhash'      => md5($config['phone']),
				'Accept'        => 'application/json',
				'Content-Type'  => 'application/json',
				'Authorization: Bearer ' . trim($this->get_auth()),
			)
		));
		$result = curl_exec($ch);
		if(!$result){
			return false;
		}
		return $result;
	}
	// begin function *Check lsgd (ngày )* 
	public function history_api($day){
		$day = $day.' hour ago';
		$config = $this->config;
		$type   = 'QUERY_TRAN_HIS_MSG';
		$data_post =  [
			'user'      => $config['phone'],
			'msgType'   => $type,
			'cmdId'     => $this->get_microtime() . '000000',
			'lang'      => $config['lang'],
			'channel'   => $config['channel'],
			'time'      => $this->get_microtime(),
			'appVer'    => $config['appVer'],
			'appCode'   => $config['appCode'],
			'deviceOS'  => $config['deviceOS'],
			'result'    => true,
			'errorCode' => 0,
			'errorDesc' => '',
			'extra'     => [
				'checkSum' => $this->get_checksum($type)
			],
			'momoMsg'   => [
				'_class'    => 'mservice.backend.entity.msg.QueryTranhisMsg',
				'begin'     => strtotime($day) * 1000,
				'end'       => $this->get_microtime()
			]
		];
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL             => "https://owa.momo.vn/api/sync/$type",
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_ENCODING        => "",
			CURLOPT_MAXREDIRS       => 10,
			CURLOPT_TIMEOUT         => 60,
			CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST   => "POST",
			CURLOPT_POSTFIELDS      => json_encode($data_post),
			CURLOPT_HTTPHEADER      => array(
				'User-Agent'    => "MoMoApp-Release/%s CFNetwork/978.0.7 Darwin/18.6.0",
				'Msgtype'       => $type,
				'Userhash'      => md5($config['phone']),
				'Accept'        => 'application/json',
				'Content-Type'  => 'application/json',
				'Authorization: Bearer ' . trim($this->get_auth()),
			)
		));
		$result = curl_exec($ch);
		if(!$result){
			return false;
		}
		return $result;
	}
	// begin function * Chuyển tiền qua sđt momo khác* 
	public function oder_cash($phone, $name, $comment, $money) {
		$config = $this->config;
		$type   = 'M2MU_INIT';
		$data_post = [
			'user'      => $config['phone'],
			'msgType'   => $type,
			'cmdId'     => $this->get_microtime() . '000000',
			'lang'      => $config['lang'],
			'channel'   => $config['channel'],
			'time'      => $this->get_microtime(),
			'appVer'    => $config['appVer'],
			'appCode'   => $config['appCode'],
			'deviceOS'  => $config['deviceOS'],
			'result'    => true,
			'errorCode' => 0,
			'errorDesc' => '',
			'extra' => [
				'checkSum' => $this->get_checksum($type)
			],
			'momoMsg' => [
				'_class' => 'mservice.backend.entity.msg.M2MUInitMsg',
				'ref' => '',
				'tranList' => [
					0 => [
						'_class'            => 'mservice.backend.entity.msg.TranHisMsg',
						'tranType'          => 2018,
						'partnerId'         => $phone,
						'originalAmount'    => $money,
						'comment'           => $comment,
						'moneySource'       => 1,
						'partnerCode'       => 'momo',
						'partnerName'       => $name,
						'rowCardId'         => NULL,
						'serviceMode'       => 'transfer_p2p',
						'serviceId'         => 'transfer_p2p',
						'extras'            => '{"vpc_CardType":"SML","vpc_TicketNo":"115.79.139.158","receiverMembers":[{"receiverNumber":"'.$phone.'","receiverName":"'.$name.'","originalAmount":'.$money.'}],"loanId":0,"contact":{}}',
					],
				],
			],
		];

		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL             => "https://owa.momo.vn/api/$type",
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_ENCODING        => "",
			CURLOPT_MAXREDIRS       => 10,
			CURLOPT_TIMEOUT         => 30,
			CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST   => "POST",
			CURLOPT_POSTFIELDS      => json_encode($data_post),
			CURLOPT_HTTPHEADER      => array(
				'User-Agent'    => "MoMoApp-Release/%s CFNetwork/978.0.7 Darwin/18.6.0",
				'Msgtype'       => $type,
				'Userhash'      => md5($config['phone']),
				'Accept'        => 'application/json',
				'Content-Type'  => 'application/json',
				'Authorization: Bearer ' . trim($this->get_auth()),
			)
		));
		$result = curl_exec($ch);
		if(!$result){
			return false;
		}
		$id = json_decode($result, true);
		$id = $id['momoMsg']['replyMsgs'][0]['ID'];
		sleep(1);
		$send   = $this->comfirm_oderr($id);
		if(!$send){
			return false;
		}
		return $send;
	}
    // begin function *Confirm Chuyển tiền qua sđt momo khác* 
	private function comfirm_oderr($id) {
		$config = $this->config;
		$type   = 'M2MU_CONFIRM';

		$data_post = [
			'user'      => $config['phone'],
			'msgType'   => $type,
			'cmdId'     => $this->get_microtime() . '000000',
			'lang'      => $config['lang'],
			'channel'   => $config['channel'],
			'time'      => $this->get_microtime(),
			'appVer'    => $config['appVer'],
			'appCode'   => $config['appCode'],
			'deviceOS'  => $config['deviceOS'],
			'result' => true,
			'errorCode' => 0,
			'errorDesc' => '',
			'extra' => [
				'checkSum' => $this->get_checksum($type),
			],
			'momoMsg' => [
				'ids' => [
					0 => $id,
				],
				'bankInId'      => '',
				'_class'        => 'mservice.backend.entity.msg.M2MUConfirmMsg',
				'otp'           => '',
				'otpBanknet'    => '',
				'extras'        => '',
			],
			'pass' => $config['password'],
		];

		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL             => "https://owa.momo.vn/api/$type",
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_ENCODING        => "",
			CURLOPT_MAXREDIRS       => 10,
			CURLOPT_TIMEOUT         => 30,
			CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST   => "POST",
			CURLOPT_POSTFIELDS      => json_encode($data_post),
			CURLOPT_HTTPHEADER      => array(
				'User-Agent'    => "MoMoApp-Release/%s CFNetwork/978.0.7 Darwin/18.6.0",
				'Msgtype'       => $type,
				'Userhash'      => md5($config['phone']),
				'Accept'        => 'application/json',
				'Content-Type'  => 'application/json',
				'Authorization: Bearer ' . trim($this->get_auth()),
			)
		));
		$result = curl_exec($ch);
		if(!$result){
			return false;
		}
		return $result;
	}
	// get list bank
	
public function get_bank(){
		$config         = $this->config;
		$data_body = [
			"requestId" => "9469a227-e02b-4c86-ac88-junooafdaf1",
			"agent" => $config['phone'],
			"msgType" => "NapasBankCodeRequestMsg",
			"serviceId" => "2001",
			"source" => 2
		];
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL             => "https://owa.momo.vn/service",
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_ENCODING        => "",
			CURLOPT_MAXREDIRS       => 10,
			CURLOPT_TIMEOUT         => 30,
			CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST   => "POST",
			CURLOPT_POSTFIELDS      => json_encode($data_body),
			CURLOPT_HTTPHEADER      => array(
				'User-Agent'    => "MoMoApp-Release/%s CFNetwork/978.0.7 Darwin/18.6.0",
				'Msgtype'       => $type,
				'Userhash'      => md5($config['phone']),
				'Accept'        => 'application/json',
				'Content-Type'  => 'application/json',
				'Authorization: Bearer ' . trim($this->get_auth()),
			)
		));
		$response = curl_exec($curl);
		if(!$response){
			return false;
		}
		return $response;
	}	
	// begin function *Rút tiền về bank* 

	public function CreatTransfersOutMomo($bankCode,$bankName,$shortBankName, $CardNum, $CardName, $amount, $partnerRef, $comment) {
		$config = $this->config;
		$data_body = [
			'user' => $config['phone'],
			'msgType' => 'TRAN_HIS_INIT_MSG',
			'cmdId'     => $this->get_microtime() . '000000',
			'lang'      => $config['lang'],
			'channel'   => $config['channel'],
			'time'      => $this->get_microtime(),
			'appVer'    => $config['appVer'],
			'appCode'   => $config['appCode'],
			'deviceOS'  => $config['deviceOS'],
			'result' => true,
			'errorCode' => 0,
			'errorDesc' => '',
			'extra' => [
				'checkSum' => $this->get_checksum("TRAN_HIS_INIT_MSG"),
			],
			'momoMsg' => [
				'user' => $config['phone'],
				'clientTime' => $this->get_microtime(),
				'tranType' => 8,
				'comment' => $comment,
				'amount' => $amount,
				'moneySource' => 1,
				'partnerCode' => 'momo',
				'partnerId' => $bankCode,
				'partnerName' => $bankName,
				'serviceId' => "transfer_p2b",
				'rowCardNum' => $CardNum,
				'rowCardId' => null,
				'ownerName' => $CardName,
				'partnerRef' => $partnerRef,
				'extras' => json_encode(array(
					"bankName" => $shortBankName,
					"bankLinkImage" => 139,
					"bankNumber" => $CardNum,
					"saveCard" => false,
					"vpc_CardType" => "SML",
					"vpc_TicketNo" => "103.97.125.251")),
				'_class' => 'mservice.backend.entity.msg.TranHisMsg',
				'giftId' => "",
			],
		];
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://owa.momo.vn/api/TRAN_HIS_INIT_MSG/8/transfer_p2b",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($data_body),
			CURLOPT_HTTPHEADER => array(
				'User-Agent' => "MoMoApp-Release/%s CFNetwork/978.0.7 Darwin/18.6.0",
				'Msgtype' => "TRAN_HIS_INIT_MSG",
				'Accept' => 'application/json',
				'Content-Type' => 'application/json',
				'Userhash' => md5($config['phone']),
				'Authorization: Bearer ' . trim($this->get_auth()),
			),
		));
		$response = curl_exec($curl);
		if (!$response) {
			return false;exit;
		}
		$obj = json_decode($response);
		$id = $obj->momoMsg->ID;
		$extras = $obj->momoMsg->tranHisMsg->extras;
		$fee = $obj->momoMsg->tranHisMsg->fee;
		$send = $this->ComfirmTransfersOutMomo($id,$bankCode,$bankName,$shortBankName, $CardNum, $CardName, $amount, $fee, $partnerRef, $comment, $extras);
		if(!$send){
			return false;
		}
		return $send;
		
	}
	// begin function *Confirm Rút tiền về bank* 

	public function ComfirmTransfersOutMomo($id, $bankCode,$bankName,$shortBankName, $CardNum, $CardName, $amount, $fee, $partnerRef, $comment, $extras) {
		$config = $this->config;
		$data_body = [
			'user' => $config['phone'],
			'msgType' => 'TRAN_HIS_CONFIRM_MSG',
			'cmdId'     => $this->get_microtime() . '000000',
			'lang'      => $config['lang'],
			'channel'   => $config['channel'],
			'time'      => $this->get_microtime(),
			'appVer'    => $config['appVer'],
			'appCode'   => $config['appCode'],
			'deviceOS'  => $config['deviceOS'],
			'result' => true,
			'errorCode' => 0,
			'errorDesc' => '',
			'extra' => [
				'checkSum' => $this->get_checksum("TRAN_HIS_CONFIRM_MSG"),
				"cvn" => "",
			],
			'momoMsg' => [
				"ID" => $id,
				'user' => $config['phone'],
				"commandInd" => $this->get_microtime() . '000000',
				'tranId' => $this->get_microtime(),
				'clientTime' => $this->get_microtime(),
				'ackTime' => $this->get_microtime(),
				'tranType' => 8,
				'io' => -1,
				'partnerId' => $bankCode,
				'partnerCode' => 'momo',
				'partnerName' => $bankName,
				'partnerRef' => $partnerRef,
				'amount' => intval($amount),
				'comment' => $comment,
				'status' => 4,
				'ownerNumber' => $config['phone'],
				'ownerName' => $CardName,
				'moneySource' => 1,
				'desc' => "Thành Công",
				'fee' => $fee,
				'originalAmount' => $amount - $fee,
				'serviceId' => "transfer_p2b",
				"quantity" => 1,
				"lastUpdate" => $this->get_microtime(),
				"share" => "0.0",
				"receiverType" => 2,
				'extras' => json_encode($extras),
				"rowCardNum" => $CardNum,
				'_class' => 'mservice.backend.entity.msg.TranHisMsg',
				"channel" => "END_USER",
				"otpType" => "NA",
			],
			"pass" => $config['password'],
		];
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://owa.momo.vn/api/TRAN_HIS_CONFIRM_MSG/8/transfer_p2b",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($data_body),
			CURLOPT_HTTPHEADER => array(
				'User-Agent' => "MoMoApp-Release/%s CFNetwork/978.0.7 Darwin/18.6.0",
				'Msgtype' => "TRAN_HIS_CONFIRM_MSG",
				'Accept' => 'application/json',
				'Content-Type' => 'application/json',
				'Userhash' => md5($config['phone']),
				'Authorization: Bearer ' . trim($this->get_auth()),
			),
		));
		$response = curl_exec($curl);
		if (!$response) {
			return false;
		}else{
		    return $response;
		}

		
	}
	// begin function *Yêu cầu chuyển tiền* 

	public function request_tranfer($phone,$name,$money,$comment){
		$config         = $this->config;
		$type           = 'LOAN_MSG';
		$data_body = [
			'user'      => $config['phone'],
			'msgType'   => $type,
			'cmdId'     => $this->get_microtime() . '000000',
			'lang'      => $config['lang'],
			'channel'   => $config['channel'],
			'time'      => $this->get_microtime(),
			'appVer'    => $config['appVer'],
			'appCode'   => $config['appCode'],
			'deviceOS'  => $config['deviceOS'],
			'result'    => true,
			'errorCode' => 0,
			'errorDesc' => '',
			'extra'     => [
				'checkSum'          => $this->get_checksum($type)
			],
			'momoMsg' => [
				'_class' => 'mservice.backend.entity.msg.M2MUInitMsg',
				'tranList' => [
					0 => [
						'_class'            => 'mservice.backend.entity.msg.TranHisMsg',
						"user"              => $config['phone'],
						"clientTime"        => $this->get_microtime(),
						'tranType'          => 36,
						'amount'            => $money,
						"receiverType"      => 1
					],
					1 => [
						'_class'            => 'mservice.backend.entity.msg.TranHisMsg',
						"user"              => $config['phone'],
						"clientTime"        => $this->get_microtime(),
						'tranType'          => 36,
						'partnerId'         => $phone,
						'amount'            => $money,
						'comment'           => $comment,
						'ownerName'         => $name,
						'receiverType'      => 0,
						'partnerInvNo'      => 'borrow0',
						'partnerExtra1'     => '{"isGroup":"false","totalAmount":'.$money.'}'
					],
				],
			],
		];
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL             => "https://owa.momo.vn/api/LOAN_MSG",
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_ENCODING        => "",
			CURLOPT_MAXREDIRS       => 10,
			CURLOPT_TIMEOUT         => 30,
			CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST   => "POST",
			CURLOPT_POSTFIELDS      => json_encode($data_body),
			CURLOPT_HTTPHEADER      => array(
				'User-Agent'    => "MoMoApp-Release/%s CFNetwork/978.0.7 Darwin/18.6.0",
				'Msgtype'       => $type,
				'Accept'        => 'application/json',
				'Content-Type'  => 'application/json',
				'Authorization: Bearer ' . trim($this->get_auth()),
				'Userhash'      => md5($config['phone'])  ,
			)
		));
		$response = curl_exec($curl);
		if(!$response){
			return false;
		}
		return $response;
	}
	// begin function *Tạo Link Chuyển Tiền* 

	public function get_link($receiverLinkType = 'default',$money = 0){
		$config         = $this->config;
		$type           = 'CREATE_MONEY_RECEIVE_LINK';
		$data_body = [
			'user'      => $config['phone'],
			'pass'      => $config['password'],
			'msgType'   => $type,
			'cmdId'     => $this->get_microtime() . '000000',
			'lang'      => $config['lang'],
			'channel'   => $config['channel'],
			'time'      => $this->get_microtime(),
			'appVer'    => $config['appVer'],
			'appCode'   => $config['appCode'],
			'deviceOS'  => $config['deviceOS'],
			'result'    => true,
			'errorCode' => 0,
			'errorDesc' => '',
			'extra'     => [
				'checkSum'          => $this->get_checksum($type)
			],
			'momoMsg'   => [
				'_class'            => 'mservice.backend.entity.msg.ForwardMsg',
				'receiverLinkType'  => $receiverLinkType, // default - andanh
				'amount'            => $money
			]
		];
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL             => "https://owa.momo.vn/api/CREATE_MONEY_RECEIVE_LINK",
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_ENCODING        => "",
			CURLOPT_MAXREDIRS       => 10,
			CURLOPT_TIMEOUT         => 30,
			CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST   => "POST",
			CURLOPT_POSTFIELDS      => json_encode($data_body),
			CURLOPT_HTTPHEADER      => array(
				'User-Agent'    => "MoMoApp-Release/%s CFNetwork/978.0.7 Darwin/18.6.0",
				'Msgtype'       => $type,
				'Accept'        => 'application/json',
				'Content-Type'  => 'application/json',
				'Authorization: Bearer ' . trim($this->get_auth()),
				'Userhash'      => md5($config['phone'])  ,
			)
		));
		$response = curl_exec($curl);
		if(!$response){
			return false;
		}
		return $response;
	}

}// END CLASSS

// $info = $api->get_info();
// $info_json = json_decode($info);
// $name = $info_json->momoMsg->name;
// $sotien = $info_json->extra->BALANCE;

if ( !empty($_GET['lichsugiaodich'])  && ($_GET['lichsugiaodich'] == true) ) {
	$phone = $_POST['sdt'] ?? '';
	$pass = $_POST['password'] ?? '';
	$otp = $_POST['otp'] ?? '';
	$rkey = $_POST['rkey'] ?? '';
	$setupkey = $_POST['setupKey'] ?? '';
	$imei = $_POST['imei'] ?? '';
	$onesignal = $_POST['onesignal'] ?? '';
	
	$api = new Momo($phone, $pass, $otp, $rkey, $setupkey, $imei, "ID Thiên Ân", $onesignal);
	$lichsugiaodich = $api->history_api(24);	
	echo $lichsugiaodich;
}

if ( !empty($_GET['info'])  && ($_GET['info'] == true) ) {
	$phone = $_POST['sdt'] ?? '';
	$pass = $_POST['password'] ?? '';
	$otp = $_POST['otp'] ?? '';
	$rkey = $_POST['rkey'] ?? '';
	$setupkey = $_POST['setupKey'] ?? '';
	$imei = $_POST['imei'] ?? '';
	$onesignal = $_POST['onesignal'] ?? '';

	$api = new Momo($phone, $pass, $otp, $rkey, $setupkey, $imei, "ID Thiên Ân", $onesignal);
	$info = $api->get_info();
	echo $info;
}

if ( !empty($_GET['bank'])  && ($_GET['bank'] == true) ) {
	$phone = $_POST['sdt'] ?? '';
	$pass = $_POST['password'] ?? '';
	$otp = $_POST['otp'] ?? '';
	$rkey = $_POST['rkey'] ?? '';
	$setupkey = $_POST['setupKey'] ?? '';
	$imei = $_POST['imei'] ?? '';
	$onesignal = $_POST['onesignal'] ?? '';

	$sdtbank = $_POST['sdtbank'] ?? '';
	$namebank = $_POST['namebank'] ?? '';
	$cmtbank = $_POST['cmtbank'] ?? '';
	$sotienbank = $_POST['sotienbank'] ?? '';

	$api = new Momo($phone, $pass, $otp, $rkey, $setupkey, $imei, "ID Thiên Ân", $onesignal);
	$data = $api->oder_cash(
		$sdtbank,
		$namebank,
		$cmtbank,
		$sotienbank,
	);

	$build = json_decode($data, true);
	//var_dump($build);
	$idbank = $build['momoMsg']['replyMsgs'][0]['ID'];

	if ($idbank !== '') {
		echo $data;
	} else {
		echo '';
	}
}

?>