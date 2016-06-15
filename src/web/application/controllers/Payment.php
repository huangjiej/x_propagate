<?php
/**
 * @name ArticleController
 * @author xuebingwang
 * @desc 文章控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
*/
class PaymentController extends \Core\Api {

    public function init(){

        parent::init();

        SeasLog::setLogger('api/payment');
    }

    public function wxpayAction(){

        $pay_server = new \Payment\Wxpay\Wxpay($this->wechat_setting);
        $pay_server->afterPay('notify');
        exit;
    }
}
