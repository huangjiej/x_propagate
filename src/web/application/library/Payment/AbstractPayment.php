<?php
namespace Payment;

abstract class AbstractPayment
{
    /**
     * 订单
     * @var array
     */
    public $order;

    /**
     * 支付成功
     * @var boolean
     */
    var $payok = false;

    /**
     * 第三方支付单号
     * @var string
     */
    var $trade_no;
    
    /**
     * 支付网关返回的成功支付金额
     * @var float
     */
    var $pay_amount;
    
    /**
     * 收款账号
     * @var object
     */
    var $account = null;
    
    public function __construct($payment){
    	$this->account = $payment;
    	$this->_initialize();
    }
    
    /**
     * 子类实现的构造方法
     */
    protected function _initialize(){}

    /**
     * 子类根据具体的支付接口实现支付后续动作
     * @param bool $isNotify
     * @return string  返回输出的信息, 用于日志记录(可选).
     */
    abstract protected function _doCustomerAfterPay($isNotify=false);

	/**
	 * 
	 * @param array $order
	 * @return AbstractPayment
	 */
    function setOrder($order=array()){
        $this->order = $order;
        return $this;
    }
    
    /**
     * 获取表单
     * @return Form
     */
    function beforePay(){}
    
    /**
     * 进行支付
     * 包括申请token 等前置动作
     */
    function doPay(){}
    
    /**
     * @param bool $isNotify
     * @return bool
     * 完成支付后续动作
     */
    function afterPay($isNotify=false){
    	$success = false;

        //微信支付测试
//        $GLOBALS['HTTP_RAW_POST_DATA'] = <<<xml
//<xml><appid><![CDATA[wx5d91ac7faf52f893]]></appid>
//<bank_type><![CDATA[CFT]]></bank_type>
//<cash_fee><![CDATA[1]]></cash_fee>
//<fee_type><![CDATA[CNY]]></fee_type>
//<is_subscribe><![CDATA[Y]]></is_subscribe>
//<mch_id><![CDATA[1259466701]]></mch_id>
//<nonce_str><![CDATA[jsh5comk52wxyufitmsd4bo5t0asurv3]]></nonce_str>
//<openid><![CDATA[oGg5Ew0AYPEbBB27DGPxHHlIxl80]]></openid>
//<out_trade_no><![CDATA[CL16042818225356100462]]></out_trade_no>
//<result_code><![CDATA[SUCCESS]]></result_code>
//<return_code><![CDATA[SUCCESS]]></return_code>
//<sign><![CDATA[7056CCEBBA4FF87608DC063C1F118CB1]]></sign>
//<time_end><![CDATA[20160428182001]]></time_end>
//<total_fee>1</total_fee>
//<trade_type><![CDATA[JSAPI]]></trade_type>
//<transaction_id><![CDATA[4006272001201604285311951208]]></transaction_id>
//</xml>
//xml;

    	//记录请求日志
        if(isset($GLOBALS['HTTP_RAW_POST_DATA'])){

            \SeasLog::debug('notify: '.$GLOBALS['HTTP_RAW_POST_DATA']);
        }else{

            \SeasLog::debug(($isNotify ? 'notify2: ' : 'return: ').var_export($_REQUEST,true));
        }

		$verify_result = $this->_doCustomerAfterPay($isNotify);
		$model = M('t_order');

		if($verify_result && isset($this->order['sn'])){

    		$where['sn'] 	    = $this->order['sn'];
    		$where['amount'] 	= $this->pay_amount;
    		//数据库查找对应的订单
    		$this->order 		= $model->get('*',['AND'=>$where]);

    		if($this->order && $this->order['order_status'] == \OrderModel::STATUS_WATI_PAY && $this->order['pay_status'] == \OrderModel::PAY_STATUS_NO_PAY){
    		    //记录订单支付日志
    		    $this->addPayLog();

    		    if($this->payok) {
    		        \SeasLog::debug('付款成功'.var_export($this->order,TRUE));

                    $wx_user_model = new \Model('t_wx_user');
    		        $user 	= $wx_user_model->get('*',['wx_id'=>$this->order['wx_id']]);
                    $success = $this->runOrderHook($user);
    		    }

    		}elseif($this->order && $this->order['order_status'] == \OrderModel::STATUS_COMPLETED && $this->order['pay_status'] == \OrderModel::PAY_STATUS_PAYD){
    		    //如果已经完成了付款的订单直接返回true.
    		    $success = true;
    		}else{
    		    \SeasLog::debug('没有找到订单!'.$model->last_query());
    		}
		}

        if(!$success){

            \SeasLog::debug('付款失败,订单信息：'.var_export($this->order,TRUE));
        }
		//如果找到了对应的订单,并且订单状态为未完成  支付状态为未付款

    	return $success;
    }

    /**
     * @param $user
     * @return bool
     * 支付成功后调用订单钩子进行后续处理
     */
    protected function runOrderHook($user)
    {	
    	if(empty($this->order) || empty($user)) {
            return false;
        }
        $data['pay_time'] 	    = time_format();
        $data['trade_no'] 	    = $this->trade_no;
        $data['order_status'] 	= \OrderModel::STATUS_COMPLETED;
        $data['pay_status']     = \OrderModel::PAY_STATUS_PAYD;
        $data['update_time']    = time_format();

        //更新订单状态
        M('t_order')->update($data,['AND'=>['sn'=>$this->order['sn'],'wx_id'=>$user['wx_id']]]);
        $order = M('t_order')->get(
            [
                'product_id'
            ],
            [
                'AND'=>[
                    'sn'=>$this->order['sn'],
                    'wx_id'=>$user['wx_id']
                ]
            ]);
        if ($order['product_id'] == 1) {
            \SeasLog::debug('订单更新完成，产品是申请俱乐部，将用户变成俱乐部会员!:' . M()->last_query());
            //如果该产品是俱乐部就把将会员变成俱乐部负责人
            $club['insert_time'] = time_format();
            $club['status'] = 'OK#'; //TODO:后期可能需要先审核
            $club['wx_id'] = $user['wx_id'];
            $curl = new \Curl();
            $qrCode    = $curl->setData3(['wx_id'=>$user['wx_id']])->send('api/order/genCode');
            $club['qr_code'] = $qrCode['ticket'];

            M('t_club')->insert($club);
        }

        \SeasLog::debug('更新订单完成!'.M()->last_query());
        //如果还有其他处理请写在这下面

    	return true;
    }
    
    /**
     * 写订单付款日志
     * @return bool
     */
    protected function addPayLog(){
        $data['sn']	        = $this->order['sn'];
        $data['create_time']= time_format();
        $data['comment']    = time_format()."对" . $this->order['sn'] . "订单支付成功,支付金额".price_format($this->pay_amount).'元';
        $data['userid']     = is_login();
        $model = new \Model('t_order_logs');
        return $model->insert($data);
    }

}
