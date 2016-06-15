<?php
/**
 * Created by PhpStorm.
 * User: sks
 * Date: 2016/4/28
 * Time: 20:08
 */
use Core\Mall;
/**
 * @name IndexController
 * @author xuebingwang
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class OrderController extends Mall {

    public function dopayAction($sn = ''){
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
            SeasLog::info(M()->last_query());
            $this->error('订单不存在!');
        }

        if ($order['order_status'] != OrderModel::STATUS_WATI_PAY || $order['pay_status'] != OrderModel::PAY_STATUS_NO_PAY) {
            $this->error('订单状态不正确!');
        }
        $pay_server = new \Payment\Wxpay\Wxpay($this->wechat_setting);
        $pay_info = $pay_server->setOrder($order)->doPay(); //返回支付信息
        $this->assign('pay_info', $pay_info);
        $this->assign('sn', $sn);
    }

    
    public function checkPayAction($sn = ''){
        if (empty($sn)) {
            $this->error('订单号不能为空!');
        }
        $model = new Model('t_order');
        $where = [
            'sn' => $sn,
            'pay_status' => OrderModel::PAY_STATUS_PAYD
        ];
        $pid = $model->get(['product_id'], ['AND' => $where]);
        if ($pid) {
            $this->success('订单已经付款成功!','',M('t_product')->get(['type'],['id'=>$pid['product_id']]));
        } else {
            if (IS_AJAX) {
                $this->error();
            }
            $this->error('订单尚未支付成功，如果您已经支付成功。请联系管理员');
            
        }
    }

    public function ordersAction() {
        $orders = M('t_order(a)')->select(
            [
                '[>]t_product(b)' => ['a.product_id'=>'id']
            ],
            [
                'b.*',
                'a.*',
            ],
            [
                'AND' => [
                    'a.wx_id'=>$this->user['wx_id'],
                ],
                //'LIMIT'=> [$offset,$limit],
                "ORDER" => "a.insert_time DESC",
            ]
        );
        foreach ($orders as &$order){
            $order['main_pic'] = imageView2($order['main_pic'],100,100);
            $order['cur_price'] = price_format($order['cur_price']);
            $order['old_price'] = price_format($order['old_price']);
            $order['amount'] = price_format($order['amount']);
        }

        $this->assign('orders', $orders);
        $this->layout->meta_title = '我的订单';
    }
}
