<?php

/**
 * @name OrderController
 * @author xuebingwang
 * @desc 商城订单控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class OrderController extends \Core\Api
{

    protected $uid;

    public function dopayAction(){
        $sn = I('sn');
        if (empty($sn)) {
            $this->error('订单编号不能为空！');
        }

        $order = M('t_order(a)')->get(
            [
                '[><]t_wx_user(b)'=>['a.wx_id'=>'wx_id']
            ],
            ['a.*','b.openid'],
            ['a.sn'=>$sn]);

        if (empty($order)) {
            $this->error('订单不存在!');
        }

        if ($order['order_status'] != OrderModel::STATUS_WATI_PAY || $order['pay_status'] != OrderModel::PAY_STATUS_NO_PAY) {
            $this->error('订单状态不正确!');
        }

        $pay_server = new \Payment\Wxpay\Wxpay($this->wechat_setting);
        $pay_server->setOrder($order)->doPay(); //返回支付信息
    }

    /**
     * 结算
     */
    public function balanceAction(){

        if(empty($this->user)){
            $this->error('用户不存在！');
        }

        $order          = [];
        $order['sn']    = gen_order_no();
        $order['wx_id'] = $this->user['wx_id'];
        $order['product_id']    = intval(I('pid'));
        $order['product_num']   = intval(I('count',1));
        if($order['product_num'] < 1){
            $this->error('商品数量不能小于1件');
        }
        $where = ['wx_id'=>$order['wx_id'],'order_status'=>OrderModel::STATUS_WATI_PAY,'pay_status'=>OrderModel::PAY_STATUS_NO_PAY];

        if(!empty($order['product_id'])){
            //如果有传产品id，价格必须从数据库中计算。
            $product         = M('t_product')->get(['name','cur_price', 'type'],['id'=>$order['product_id']]);
            //保存订单类型
            $order['order_type'] = $product['type'];

            $order['amount'] = $order['product_num'] * $product['cur_price'];
            $order['desc']   = I('desc',$product['name']);
            //保存感恩的话
            $order['remark'] = I('remark', '');


            $where['product_id'] = $order['product_id'];

        }else{
            $order['amount'] = price_dispose(I('amount'));
            $order['desc'] = I('desc','自定义订单');
        }
        if($order['amount'] < 0){
            $this->error('金额不能小于0元！');
        }

        $where['amount'] = $order['amount'];
        $model = M('t_order');
        $order_sn = $model->get('sn',['AND'=>$where]);
        if(!empty($order_sn)){

            $this->success('订单已存在！','',['order_sn'=>$order_sn]);
        }

        $order['insert_time']   = time_format();

        if ($model->insert($order)) {
            $this->success('创建订单成功','',['order_sn'=>$order['sn']]);
        } else {
            $this->error('创建订单失败,未知错误!');
        }
    }

    public function genAction() {
        $curl = new Curl();
        var_dump($curl->setData3(['wx_id'=>181])->send2('api/order/genCode')['msg']['ticket']) ;
    }

    //返回 string 生成的二维码图片地址
    public function genCodeAction() {
        $this->sendOutPut($this->wechat->getQRCode($this->request_data['wx_id'], 1));
    }
}
