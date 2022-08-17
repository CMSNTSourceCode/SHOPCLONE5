<?php
/** 
 * @package TÍCH HỢP TRUMTHE.VN
 * @author CMSNT.CO
 */

/*
    $trumthe = new TrumThe;
    $trumthe->partner_id = '';
    $trumthe->sign_trumthe = '';
    $trumthe->telco = '';
    $trumthe->code = '';
    $trumthe->serial = '';
    $trumthe->amount = '';
    $trumthe->request_id = '';
*/
 class TrumThe
 {
    public $partner_id;
    public $sign_trumthe;
    public $telco;
    public $code;
    public $serial;
    public $amount;
    public $request_id;

    function NapThe()
    {
        $url = 'https://trumthe.vn/chargingws/v2?sign='.md5($this->sign_trumthe.$this->code.$this->serial).'&telco='.$this->telco.'&code='.$this->code.'&serial='.$this->serial.'&amount='.$this->amount.'&request_id='.$this->request_id.'&partner_id='.$this->partner_id.'&command=charging';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data, true);
    }

 }