<?php
use Core\Mall;
/**
 * @name IndexController
 * @author xuebingwang
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class IndexController extends Mall {
    /**
     * 微信端菜单：首页
     */
    public function indexAction(){
        if (empty($this->user)){
            $this->redirect('index/founder');
        } else {
            $model = M('t_club(c)');
            $member = M('t_club_member(cm)')->get(['cm.*'],['wx_id'=>$this->user['wx_id']]);
            /*$club = $model->get(
                ['c.*'],['wx_id'=>$this->user['wx_id']]);*/
            if (empty($member)) {
                $this->redirect('index/founder');
            } else {
                $this->redirect('member/index');
            }
        }
    }

    /*
     * 微信端菜单：个人中心
     * */
    public function centerAction(){
        $member = M('t_club_member')->get(['*'],['wx_id'=>$this->user['wx_id']]);
        $club   = M('t_club')->get('*', ['wx_id'=>$this->user['wx_id']]);
        if ($member) {
            $this->redirect('member/center');
        } elseif ($club) {
            $this->redirect('index/myclub');
        }

        $user = M('t_wx_user')->get('*', ['wx_id'=>$this->user['wx_id']]);
        $this->assign('user', $user);
    }
    
    //创始人首页
    public function founderAction() {
        $club   = M('t_club')->get('*', ['wx_id'=>$this->user['wx_id']]);
        if (empty($club)) {
            $this->error('请先申请俱乐部哦!','/index/apply',['btn_text'=>'立即申请']);
        }

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
        $this->assign('wx_id', $this->user['wx_id']);
    }

    //房老师感悟列表
    public function ganwuAction() {
        $this->layout->meta_title = '俱乐部动态';
    }
    
    //房老师动态
    public function newsAction() {
        $this->layout->meta_title = '俱乐部活动';
    }

    public function amazingAction() {
        $this->layout->meta_title = '会员精彩';
    }

    //加入俱乐部的协议书
    public function protocolAction() {
        $protocol = M('t_document(a)')->get(
            [
                '[>]t_document_article(b)' => ['a.id'=>'id']
            ],
            [
                'a.*',
                'b.*'
            ],
            [
                'b.id'=>186
            ]
        );

        $this->assign('protocol', $protocol);
    }

    //负责人 我的俱乐部
    public function myclubAction() {
        $club = M('t_club(c)')->get(
            ['c.*'],['wx_id'=>$this->user['wx_id']]);
        if (empty($club)) {
            $this->error('请先申请俱乐部哦!','/index/apply',['btn_text'=>'立即申请']);
        }

        $club = M('t_club(c)')->get(
            [
                '[>]t_wx_user(wu)'=>['c.wx_id'=>'wx_id']
            ],
            ['c.*','wu.nickname','wu.headimgurl'],
            ['c.wx_id'=>$this->user['wx_id']]
        );
        $this->assign('club', $club);
        $this->layout->meta_title = '个人中心';
    }
    
    //编辑俱乐部信息
    public function editAction() {
        $club = M('t_club(c)')->get(
            ['c.*'],['wx_id'=>$this->user['wx_id']]);
        if (empty($club)) {
            $this->error('请先申请俱乐部哦!','/index/apply',['btn_text'=>'立即申请']);
        }
        
        if (IS_POST) {
            if(M('t_club')->update(
                    [
                        'club_name'=>I('club_name'),
                        'wx'=> I('wx'),
                        'description'=> I('description'),
                        'mobile' => I('mobile')
                    ],
                    ['id'=>$club['id']]
                ) >= 0) {
                $this->success('更新成功', '/index/myclub');
            } else {
                $this->error('更新失败');
            }
        }

        $club = M('t_club(c)')->get(
            [
                '[>]t_wx_user(wu)'=>['c.wx_id'=>'wx_id']
            ],
            ['c.*','wu.nickname','wu.headimgurl'],
            ['c.wx_id'=>$this->user['wx_id']]
        );
        $this->assign('club', $club);
        $this->layout->meta_title = '编辑俱乐部信息';
    }
    
    //购买俱乐部页面
    public function applyAction() {
        if (is_not_wx()) {
            $this->error('请在微信端打开!','/');
        }
        $product = M('t_product(p)')->get(['p.*'], ['id' => 1]);
        $product['cur_price'] = price_format($product['cur_price']);
        $product['old_price'] = price_format($product['old_price']);
        $product['main_pic'] = imageView2($product['main_pic'],100,100);
        $this->assign('product', $product);
        $this->layout->meta_title = '申请俱乐部';
    }
    
    //俱乐部会员
    public function memberAction() {
        $club = M('t_club(c)')->get(
            ['c.*'],['wx_id'=>$this->user['wx_id']]);
        if (empty($club)) {
            $this->error('俱乐部不存在');
        } else {
            $search = I('search');
            if (!empty(I('search'))) {
                $result = M()->query('SELECT a.*, c.headimgurl, b.name FROM
                                        (SELECT * FROM t_user_body_index ORDER BY insert_time DESC) as a
                                        LEFT JOIN t_club_member as b 
                                        ON a.mobile = b.mobile
                                        LEFT JOIN t_wx_user as c
                                        on c.wx_id = b.wx_id
                                        WHERE a.mobile LIKE \'%' . $search . '%\' OR b.name LIKE \'%' . $search . '%\'
                                        GROUP BY a.mobile LIMIT 1')->fetchAll();
                $this->assign('result',$result);
                $this->assign('search', $search);
            } else {
                $members = M()->query('SELECT a.*, c.headimgurl, b.name FROM 
                                        (SELECT * FROM t_user_body_index ORDER BY insert_time DESC) as a
                                        LEFT JOIN t_club_member as b 
                                        ON a.mobile = b.mobile
                                        LEFT JOIN t_wx_user as c
                                        on c.wx_id = a.wx_id
                                        GROUP BY a.mobile LIMIT 1')->fetchAll();
                $this->assign('members', $members);
            }
        }

        $this->layout->meta_title = '我的会员';
    }

    // 添加俱乐部会员
    public function addmemberAction() {
        $club = M('t_club(c)')->get(
            ['c.*'],['wx_id'=>$this->user['wx_id']]);
        if (empty($club)) {
            $this->error('俱乐部不存在');
        } else {
            if (IS_POST) {
                $data = I('post.');
                //判断用户是否存在，提示已经绑定了
                //TODO:添加手机验证码验证
                unset($data['code']);

                $user_model = new MemberModel();
                //用户已经自己绑定过手机的情况
                if ($user_model->is_bind(intval($data['mobile']))) {
                    //这里应该要判断下, 用户已经存在，并且cid为空时添加到该教练的俱乐部
                    $data['cid'] = $club['id'];
                    //用户标签处理
                    if (!empty($data['tag'])) {
                        $data['tag'] = json_encode(explode(' ',$data['tag']));
                    }
                    if (M('t_club_member')->update($data, ['mobile' => $data['mobile']])) {
                        $this->success('添加成功');
                    }else {
                        $this->error('添加失败');
                    }
                }
                //用户没有绑定手机的情况
                else {
                    $data['cid'] = $club['id']; //所属俱乐部

                    //用户标签处理
                    if (!empty($data['tag'])) {
                        $data['tag'] = json_encode(explode(' ',$data['tag']));
                    }

                    if ($user_model->add($data)) {
                        $this->success('添加成功!');
                    } else {
                        $this->error('添加失败！');
                    }
                }
            }
        }
        $this->display('addmember');
        $this->layout->meta_title = '添加会员';
        die;
    }
    
    //查看俱乐部动态
    public function clubnewsAction() {
        $club = M('t_club(c)')->get(
            ['c.*'],['wx_id'=>$this->user['wx_id']]);
        if (empty($club)) {
            $this->error('俱乐部不存在');
        } else {
            $list = M('t_club_news(cn)')->select(['cn.*'],[ 'and'=>['cid'=>$club['id'],'status'=>1,],  'LIMIT'=>I('num', '6'), "ORDER" => "cn.insert_time DESC"]);
            foreach ($list as &$v) {
                $v['cover_id'] = imageView2($v['cover_id'],100,100);
                $v['insert_time'] = substr($v['insert_time'] , 0, 10);
                $v['title'] = subtext($v['title'] , 14);
            }
            $this->assign('list',$list);
        }

        $this->layout->meta_title = '我的俱乐部动态';
    }


    //编辑动态
    public function clubAction() {
        $club_id = M('t_club')->get('id', ['wx_id'=>$this->user['wx_id']]);
        $this->layout->meta_title = '编辑俱乐部动态';
        $this->assign('cid', $club_id);

        $this->layout->meta_title = '编辑动态';
    }
    
    
    //名片
    public function cardAction() {
        $id = I('id');
        if (empty($id)) {
            $this->error('该名片不存在');
        }

        $club = M('t_club(c)')->get(
            [
                '[>]t_wx_user(wu)'=>['c.wx_id'=>'wx_id']
            ],
            ['c.*','wu.nickname','wu.headimgurl'],
            ['c.wx_id'=>$id]
        );


        if (empty($club)) {
            $this->error('请先申请俱乐部','/index/apply',['btn_text'=>'立即申请']);
        }

        if (empty($club['club_name']) || empty($club['wx']) || empty($club['description'])) {
            $this->error('请先完善俱乐部信息', '/index/edit', ['btn_text' => '去完善']);
        }
        $this->layout->meta_title = '我的名片';
        $this->assign('club', $club);

        $this->layout->meta_title = '俱乐部名片';
    }

    //俱乐部动态详情页
    public function clubnewsitemAction() {
        $id = I('id');
        if (empty($id)) {
            $this->error('该动态不存在');
        }
        
        $item = M('t_club_news')->get('*', ['id'=>$id]);
        $item['insert_time'] = substr($item['insert_time'] , 0, 10);
        $this->assign('item', $item);
    }


    public function signAction(){
        if(is_not_wx()){
            $this->error('本功能仅允许在微信内使用！');
        }
        if(empty($this->user['uid'])){
            $this->error('您还没有绑定运营账号！',U('/public/bind'),['btn_text'=>'去绑定']);
        }
        if($this->user['group_id'] != 1){
            $this->error('本功能仅允许运营人员使用！');
        }
        $query = M()->query("select id,title,address from t_meeting where date(agenda_date) = '".date('Y-m-d')."'");
        $list = $query ? $query->fetchAll(PDO::FETCH_ASSOC) : false;
        if(empty($list)){
            $this->error('啊哈，今天没有任何会议哦！');
        }
        $meeting = $list[0];

        if(IS_POST){
            $enroll_id = intval(I('enroll_id'));

            if(empty(I('enroll_id'))){
                $this->error('参数错误，报名ID不能为空！');
            }
            if(M('t_enroll')->update(['is_sign'=>Model::BOOL_YES,'sign_time'=>time_format()],['AND'=>['id'=>$enroll_id,'meeting_id'=>$meeting['id'],'is_affirm'=>Model::BOOL_YES]])){
                $this->success('签到成功！');
            }else{
                $this->error('签到失败，请重新再试或联系管理人员！');
            }
        }

        $id = intval(I('enroll_id'));
        if(!empty($id)){
            $item = M('t_enroll(a)')->get(
                [
                    '[><]t_company_reg(b)'=>['a.id'=>'eid'],
                ],
                [
                    'a.id',
                    'a.mobile',
                    'a.create_time',
                    'a.is_affirm',
                    'a.is_sign',
                    'b.chairman_name',
                    'b.sex',
                    'b.company_name',
                ],
                [
                    'AND'=>['a.id'=>$id,'meeting_id'=>$meeting['id']]
                ]);

            if(empty($item)){
                $this->error('没有找到报名记录！');
            }

            if($item['is_affirm'] != Model::BOOL_YES){
                $this->error('此报名还没经过确认！');
            }
            if($item['is_sign'] == Model::BOOL_YES){
                $this->error('此报名已经签到过，无需重复签到！');
            }
            $this->assign('item',$item);
        }
        if(!is_not_wx()){
            $js_ticket = $this->wechat->getJsTicket();
            if (!$js_ticket) {
                echo "获取js_ticket失败！<br>";
                echo '错误码：'.$this->wechat->errCode;
                echo ' 错误原因：'.ErrCode::getErrText($this->wechat->errCode);
                exit;
            }

            $url = DOMAIN.$_SERVER['REQUEST_URI'];
            $js_sign = $this->wechat->getJsSign($url);
            $this->assign('js_sign',$js_sign);
        }

        $this->assign('meeting',$meeting);
    }

    public function searchAction(){

        $keyword = I('keyword');
        if(empty($keyword)){
            $this->error('请输入手机号码！');
        }
        $meeting_id = intval(I('meeting_id'));

        $list = M('t_enroll(a)')->select(
            [
                '[><]t_company_reg(b)'=>['a.id'=>'eid'],
            ],
            [
                'a.id',
                'a.mobile',
                'a.create_time',
                'b.chairman_name',
                'b.sex',
                'b.company_name',
            ],
            [
                'AND'=>[
                    'a.meeting_id'=>$meeting_id,
                    'a.is_affirm'=>Model::BOOL_YES,
                    'a.is_sign'=>Model::BOOL_NO,
                    'a.mobile[~]'=>$keyword,
                ]
            ]);
//        SeasLog::info(M()->last_query());
        $this->success('','',['list'=>$list]);
    }

    public function meetingsAction() {
        $list = M('t_meeting(a)')->select(
            ['a.*'],
            [
                'AND' => [
                    'a.agenda_date[>=]' => time_format()
                ]
            ]
        );
        $this->assign('list', $list);
        $this->layout->setLayoutFile(null);
    }


    //定时任务获取排行榜数据
    public function getlistAction() {
        //开始时间，结束时间
        $start = time();
        $end = strtotime('-7 days');

        //读取所有用户
        $members = M('t_club_member')->select('*');
        //发送到接口数据查询指定日期内的用户数据
        foreach ($members as $member) {
            $body = get_user_bodies($member['mobile'], $end, $start);
            $highest_weight = max(array_column($body, 'weight'));
            $highest_fat = max(array_column($body, 'fat'));
            $lowest_weight = max(array_column($body, 'weight'));
            $lowest_fat = max(array_column($body, 'fat'));

            
        }

        //
    }
}
