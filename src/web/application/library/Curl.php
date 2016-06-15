<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 王雪兵 <406964108@qq.com>
// +----------------------------------------------------------------------
class Curl{
    private $api_url;

    protected $data;
    public $error;

    public function __construct($api_url=null){

        $this->api_url = empty($api_url) ? Yaf\Registry::get('config')->url->api->club : $api_url;
    }

    public function setApiUrl($url){
        $this->api_url = $url;
        return $this;
    }

    public function setData($data=array()){

        $data = ['body'=>$data];

        if(!array_key_exists('app',$data)){
            $data['app'] = get_app();
        }

        $this->data = json_encode($data,JSON_UNESCAPED_UNICODE);
        return $this;
    }

    public function setData2($data=array(),$flag=true){

        if($flag && !array_key_exists('app',$data)){
            $data['app'] = get_app();
        }

        $this->data = json_encode($data,JSON_UNESCAPED_UNICODE);
        return $this;
    }

    public function setData3($data=array()){

        $this->data = json_encode($data,JSON_UNESCAPED_UNICODE);
        return $this;
    }

    public function send($path=''){
        if(empty($this->data)){
            $this->setData();
        }

        $resp = curlRequest($this->api_url.$path,$this->data);

        return json_to_array($resp);
    }
}