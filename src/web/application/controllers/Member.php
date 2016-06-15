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
class MemberController extends Mall {

    public function indexAction() {
        //幻灯片
        $banner = M('t_banner(b)')->select(
            ['b.*'],
            [
                'AND' => [
                    'status'=>1,
                    'type'=>1
                ]
            ]
        );
        foreach ($banner as &$v) {
            $v['pic'] = imageView2($v['pic']);
        }
        $this->assign('banner', $banner);
        //俱乐部动态
        $club_news = M('t_document(a)')->select(
            [
                '[>]t_document_article(b)' => ['a.id'=>'id']
            ],
            [
                'a.*',
                'b.*'
            ],
            [
                'AND' => [
                    'a.status[>]'=>0,
                    'a.category_id'=> [47,48]
                ],
                "ORDER" => "a.create_time DESC",]
        );
        foreach ($club_news as &$v) {
            $v['cover_id'] = imageView2($v['cover_id'],100,100);
            $v['insert_time'] = time_format($v['create_time'], 'Y-m-d');
            $v['title'] = subtext($v['title'], 14);

        }
        $this->assign('club_news',$club_news);
        //会员精彩
        $amazing = M('t_document(a)')->select(
            [
                '[>]t_document_article(b)' => ['a.id'=>'id']
            ],
            [
                'a.*',
                'b.*'
            ],
            [
                'AND' => [
                    'a.status[>]'=>0,
                    'a.category_id'=> [45]
                ],
                "ORDER" => "a.create_time DESC",]
        );
        foreach ($amazing as &$v) {
            $v['cover_id'] = imageView2($v['cover_id'],100,100);
            $v['insert_time'] = time_format($v['create_time'], 'Y-m-d');
            $v['title'] = subtext($v['title'], 14);
        }

        $this->assign('amazing', $amazing);

        //感恩
        $banner =  M('t_banner(b)')->get(
            ['b.*'],
            [
                'AND' => [
                    'status'=>1,
                    'type'=>2
                ]
            ]
        );
        $result = M('t_order')->query('SELECT count(DISTINCT wx_id) as p_nums,sum(product_num) as g_nums FROM t_order  where order_status=\'ok#\' AND pay_status=1 AND order_type=2');

        $data = $result->fetch();
        $data['banner'] = imageView2($banner['pic'],380,120);
        $this->assign('thank', $data);

        //俱乐部活动
        $club = M('t_document(a)')->select(
            [
                '[>]t_document_article(b)' => ['a.id'=>'id']
            ],
            [
                'a.*',
                'b.*'
            ],
            [
                'AND' => [
                    'a.status[>]'=>0,
                    'a.category_id'=> [46]
                ],
                "ORDER" => "a.create_time DESC",]
        );
        foreach ($club as &$v) {
            $v['cover_id'] = imageView2($v['cover_id'],100,100);
            $v['insert_time'] = time_format($v['create_time'], 'Y-m-d');
            $v['title'] = subtext($v['title'], 14);
        }

        $this->assign('club', $club);

        $this->assign('wx_id', $this->user['wx_id']);


        $card = M('t_club_member(a)')->get(
            [
                '[>]t_club(b)' => ['a.cid'=>'id']
            ],
            [
                'b.wx_id'
            ],
            [
                'a.wx_id' => $this->user['wx_id']
            ]
        );

        $this->assign('card_wx_id', $card['wx_id']);
    }
    
    public function centerAction() {
        $club = M('t_club_member(a)')->get(
            [
                '[>]t_wx_user(b)'=>['a.wx_id'=>'wx_id'],
                '[>]t_club(c)' => ['a.cid'=>'id']
            ],
            ['c.*','b.nickname','b.headimgurl'],
            ['a.wx_id'=>$this->user['wx_id']]
        );
        $this->assign('club', $club);
        $this->layout->meta_title = '个人中心';
    }
    
    
    //会员健康状态汇总表
    public function infoAction() {
        $wx_id = I('wx_id');
        if (empty($wx_id)) {
            $this->error('参数错误!');
        }
        $mobile = M('t_club_member')->get('*', ['wx_id'=> $wx_id])['mobile'];
        if (empty($mobile)) {
            $this->error('参数错误!');
        }
        
        //通过手机号码查询健康状况
        $health = get_user_body_index($mobile);
        $this->assign('health', $health);
        if (!empty(I('tab'))) {
            $this->assign('tab', I('tab'));
        }

        $this->layout->meta_title = '健康报告';
    }

    //我的健康
    public function healthAction() {
        $member = M('t_club_member')->get('*', ['wx_id'=>$this->user['wx_id']]);
        if (empty($member)) {
            $this->error('请先绑定手机号码!','/member/bind',['btn_text'=>'立即绑定']);
        }
        
        //通过手机号码查询健康状况
        $health = get_user_body_index($member['mobile']);
        if($health == 3){
            $this->error('对不起，您还没有购买体感称！');
        }
        $this->assign('health', $health);
        $this->assign('wx_id', $this->user['wx_id']);

        $this->layout->meta_title = '我的健康';
    }
    
    //健康报告
    public function reportAction() {
        $wx_id = I('wx_id');
        if (empty($wx_id)) {
            $this->error('参数错误!');
        }
        $mobile = M('t_club_member')->get('*', ['wx_id'=> intval($wx_id)])['mobile'];
        if (empty($mobile)) {
            $this->error('参数错误');
        }

        //通过手机号码查询健康状况
        $health = get_user_body_index($mobile);
        $this->assign('health', $health);
        
        //查询最近30天的数据
        $data = M()->query('SELECT a.*
            FROM (SELECT * from t_user_body_index ORDER BY insert_time DESC) as a
            WHERE a.mobile = '. $mobile .'
            GROUP BY DATE(a.date)
            LIMIT 30;')->fetchAll();
        $weights = []; //体重
        $fats = []; //体脂率
        $dates = []; //日期
        foreach ($data as $item) {
            $weights[] = $item['weight']/2;
            $fats[] = $item['fat']/100;
            $dates[] = substr($item['date'], 5, 5);
        }

        //用0填充一个月的数据
        if (($arr_len = count($weights)) < 30) {
            $weights = array_merge(array_fill(0, 30-$arr_len , 0),$weights);
            $fats = array_merge(array_fill(0, 30-$arr_len , 0),$fats);
            $dates = array_merge(array_fill(0, 30-$arr_len , 0),$dates);
        }
        $this->assign('weights', json_encode($weights));
        $this->assign('fats', json_encode($fats));
        $this->assign('dates', json_encode($dates));
        $this->assign('wx_id', $wx_id);
        //查询最近30天的体脂率

        $this->layout->meta_title = '健康报告';
    }

    //健康排行榜
    public function listAction() {
        if (!empty(I('tab'))) $this->assign('tab', I('tab'));
        //读取最新一期排行榜
        $dare_time = M('t_dare')->get('*', ["ORDER" => "insert_time DESC"]);
        //读取减重排名列表
        $weights = $this->getDare($dare_time['id'], 'weight');
        $fats = $this->getDare($dare_time['id'], 'fat');
        //当前用户的信息
        $mydata = $this->getData($dare_time['id']);
        $this->assign('weights', $weights);
        $this->assign('fats', $fats);
        $this->assign('mydata', $mydata);
        $this->assign('user', $this->user);
        $this->layout->meta_title = '健康排行榜';
    }


    private function getDare($did, $type) {
        $data =  M('t_dare_data(a)')->select(
            [
                '[>]t_wx_user(b)' => ['a.wx_id'=>'wx_id']
            ],
            [
                'a.*',
                'b.*'
            ],
            [
                'a.did' => $did,
                "ORDER"=>'a.'.$type.'_position DESC',
                'LIMIT'=>10
            ]
        );

        if ($data) {
            return $data;
        } else {
            $this->error('读取数据失败！');
        }
    }


    
    //健康挑战赛
    public function dareAction() {
        $member = M('t_club_member')->get('*', ['wx_id'=>$this->user['wx_id']]);
        if (empty($member)) {
            $this->error('请先绑定手机号码!','/member/bind',['btn_text'=>'立即绑定']);
        }
        //读取最新一期排行榜
        $dare_time = M('t_dare')->get('*', ["ORDER" => "insert_time DESC"]);
        //读取减重最新一期的第一名
        $weight_number_one = $this->getNumberOne($dare_time['id'], 'weight_position');
        $weight_number_one['nickname'] = subtext($weight_number_one['nickname'], 6);
        //读取减脂最新一期的第一名
        $fat_number_one = $this->getNumberOne($dare_time['id'], 'fat_position');
        $fat_number_one['nickname'] = subtext($fat_number_one['nickname'], 6);
        //读取用户的当前排名情况
        $self_number = $this->getData($dare_time['id']);
        
        $this->assign('dare_time', $dare_time);
        $this->assign('weight_number_one',$weight_number_one);
        $this->assign('fat_number_one',$fat_number_one);
        $this->assign('self_number', $self_number);
    }

    /*
     * 读取减重或减脂的排名及减少比例
     */
    private function getData($did) {
        $data = M('t_dare_data')->get('*',
            [
                'AND'=> [
                    'wx_id' => $this->user['wx_id'],
                    'did' =>$did
                ]
            ]);
        if ($data) {
            return $data;
        }else {
            $this->error('读取数据失败');
        }
    }

    /*
     * $type string 'weight_position' or 'fat_position'
     * */
    private function getNumberOne($did, $type) {
         $data =  M('t_dare_data(a)')->get(
            [
                '[>]t_wx_user(b)' => ['a.wx_id'=>'wx_id']
            ],
            [
                'b.*'
            ],
            [
                'AND' => [
                    'a.'.$type => 1,
                    'a.did' => 1
                ]
            ]
        );

        if ($data) {
            return $data;
        } else {
            $this->error('读取数据失败！');
        }
    }

    //用户绑定
    public function bindAction() {
        if (IS_POST) {
            $refer = session('refer'); //添加成功返回连接
            $data = I('post.');

            //TODO:添加手机验证码验证
            $msg = test_mobile_sms($data['mobile'],$data['code']);
            if(!empty($msg)){
                $this->error($msg);
            }

            unset($data['code']);

            if(!empty($msg)){
                $this->error($msg);
            }

            //判断用户是否存在,存在的话，将该用户wx_id添加到t_user表中
            $member = new MemberModel();
            if ($member->is_bind(intval($data['mobile']))) {
                if ($member->bind($this->user['wx_id'], $data['mobile'])) {
                    $this->success('绑定成功!', $refer);
                } else {
                    $this->error('绑定失败，请重新绑定！');
                }
            } else {
                $data['wx_id'] = $this->user['wx_id'];

                if ($member->add($data)) {
                    session('refer', null);
                    $this->success('绑定成功!', empty($refer) ? '' : $refer);
                } else {
                    $this->error('绑定失败，请重新绑定！');
                }
            }
        }
        if(isset($_SERVER['HTTP_REFERER'])){
            session('refer', $_SERVER['HTTP_REFERER']);
        }
        $this->display('bind');
        die();
    }

    public function sendSmsCodeAction(){
        $mobileNum = I('mobile','');
        if(empty($mobileNum)){
            $this->error('手机号码不能为空！');
        }

        $code = mt_rand(1000,9999);
        $content = "您的短信验证是%s，有效期10分钟！【蜂鸟娱乐】";
        if(send_sms($mobileNum,sprintf($content,$code))){
            //将短信验证码、手机、创建时间保存至会话中
            session('MobileSmsCode',['code'=>$code,'time'=>time(),'mobile'=>$mobileNum]);
            $this->success('验证码发送成功！');
        }else{
            $this->error('验证码发送失败，请重新再试！');
        }
    }
}