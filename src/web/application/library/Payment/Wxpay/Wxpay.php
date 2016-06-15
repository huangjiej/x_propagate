<?php
namespace Payment\Wxpay;
use Payment\AbstractPayment;

/**
 * 支付方式 - 支付宝
 * 默认即时到账接口
 * @author xuebingwang2010@gmail.com
 *
 */
class Wxpay extends AbstractPayment{
	//服务器异步通知页面路径
    const URL_REMOTE_NOTIFY = '/payment/wxpay.html';
    
    static $config = array();
    
    //交易状态
    var $trade_status = null;
    
    public function _initialize(){
    	
    	self::$config['MCHID']		= $this->account['mer_id'];
    	
    	self::$config['KEY']	    = $this->account['mer_key'];

    	self::$config['APPID']		= $this->account['appid'];

    	self::$config['APPSECRET']	= $this->account['appsecret'];

    	//ca证书路径地址，用于curl中ssl校验
    	self::$config['SSLCERT_PATH']    		= __DIR__.'/apiclient_cert.pem';
    	self::$config['SSLKEY_PATH']    		= __DIR__.'/apiclient_key.pem';

    	self::$config['CURL_PROXY_HOST']    	= '0.0.0.0';
    	self::$config['CURL_PROXY_PORT']    	= '0';

    	self::$config['REPORT_LEVENL']    	    = 1;
    }
    
	/**
	 * 进行支付跳转到第三方支付网关
	 * (non-PHPdoc)
	 * @see AbstractPayment::doPay()
	 */
    public function doPay(){
        require_once 'WxPay.Data.php';
        require_once "WxPay.Api.php";
        require_once 'WxPay.JsApiPay.php';

        //②、统一下单
        $input = new \WxPayUnifiedOrder();
        $tools = new \JsApiPay();
        $input->SetBody($this->order['desc']);
        $input->SetAttach("");
        $input->SetOut_trade_no($this->order['sn']);
        $input->SetTotal_fee($this->order['amount']);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("");
        $input->SetNotify_url('http://'.$_SERVER['HTTP_HOST'].self::URL_REMOTE_NOTIFY);
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($this->order['openid']);


        $order = \WxPayApi::unifiedOrder($input);

        return $tools->GetJsApiParameters($order);//返回支付结果
    }
    
    /**
     * 支付成功后续处理，如订单处理
     * @param bool $isNotify  是否后台付款通知
     * @return bool
     */
    protected function _doCustomerAfterPay($isNotify=false){
        if($isNotify){
        	$returnMessage = $this->notify_callback();
        }else{
        	$returnMessage = $this->return_callback();
        }
        return $returnMessage;
    }

    protected function return_callback(){
        return true;
    }

    protected function notify_callback(){

        $msg = 'OK';
        $notify = new \Payment\Wxpay\WxPayNotify();
        $result = $notify->Handle($msg);

        if($result == false){
            $notify->ReplyNotify(false);
        }else{
            $this->order['sn']      = $result['out_trade_no'];
            $this->trade_no 		= $result['transaction_id'];

            $this->pay_amount 		= intval($result['total_fee']);

            $this->payok 			= true;

            $notify->ReplyNotify(false);
            return true;
        }

        return false;
    }

}
?>