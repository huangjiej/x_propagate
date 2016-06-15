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
class ThankController extends Mall {
    public function indexAction() {
        //感恩图片
        $banner = M('t_banner(b)')->get(
            ['b.*'],
            [
                'AND' => [
                    'status'=>1,
                    'type'=>2
                ]
            ]
        );
        $banner['pic'] = imageView2($banner['pic']);
        $this->assign('banner', $banner);
        
        //用户排行榜
        $users = M()->query('SELECT
                          a.*,
                          b.*,
                          c.main_pic
                        FROM (SELECT
                                *
                              FROM t_order
                              WHERE order_type = 2 AND order_status = \'OK#\' AND pay_status = 1
                              ORDER BY t_order.amount DESC
                             )
                          AS a LEFT JOIN t_wx_user AS b ON a.wx_id = b.wx_id
                          LEFT
                          JOIN t_product AS c ON a.product_id = c.id
                        GROUP BY a.wx_id
                        ORDER BY a.amount DESC 
                        LIMIT 7

              ')->fetchAll();;

        foreach ($users as &$user) {
            $user['main_pic'] = imageView2($user['main_pic'], 30,30);
        }
        $this->assign('users', $users);
        
        //所有礼物
        $gifts = M('t_product')->select(
            [
                '*'
            ],
            [
                'AND' => [
                    'status'=>1,
                    'type'=>2
                ]
            ]
        );

        foreach ($gifts as &$gift) {
            $gift['main_pic'] = imageView2($gift['main_pic'],53,53);
            $gift['price'] = price_convert($gift['cur_price']);
            $gift['cur_price'] = price_format($gift['cur_price']);
        }
        
        $gifts = array_chunk($gifts, 10);
        $this->assign('gifts', $gifts);

        $this->layout->meta_title = '感恩墙';
    }

    public function giftAction() {
        if (is_not_wx()) {
            $this->error('请在微信端赠送礼物!');
        }
        $pid = I('pid');
        $nums = I('nums');
        if (empty($pid) ||  empty($nums)) {
            $this->error('赠送的礼物不存在!');
        }
        $pid = intval($pid);
        $gift = M('t_product(p)')->get(['p.*'], ['p.id' => $pid]);
        if ($gift) {
            $gift['main_pic'] = imageView2($gift['main_pic'],120,120);
            $gift['amount'] = price_format($gift['cur_price']*intval($nums));
            $gift['cur_price'] = price_format($gift['cur_price']);
            $gift['nums'] = $nums;
            $this->assign('gift', $gift);
        } else {
            $this->error('赠送的礼物不存在!');
        }
        $this->layout->meta_title = '赠送';
    }
}