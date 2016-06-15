<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>报名表-<?=$item['title']?></title>
    <link href="/style/weui.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container" id="container">
    <div class="cell">
        <form id="submit-form" action="<?= U('enroll') ?>" method="post">
            <div class="bd">
                <div class="weui_cells weui_cells_form">
                    <div class="weui_cell">
                        <div class="weui_cell_hd"><label class="weui_label">姓名</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" name="name" type="text" placeholder="请输入您的名字">
                        </div>
                    </div>
                    <div class="weui_cell">
                        <div class="weui_cell_hd"><label class="weui_label">手机</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" name="mobile" type="number" placeholder="请输入您的手机号码">
                        </div>
                    </div>
                    <div class="weui_cell">
                        <div class="weui_cell_hd"><label class="weui_label">邮箱</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" name="email" type="text" placeholder="请输入您的邮箱">
                        </div>
                    </div>
                    <div class="weui_cell weui_cell_select">
                        <div class="weui_cell_hd"><label class="weui_label">年龄</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <select data-type="age" name="age" class="weui_select">
                                <option value=""> 请选择您的年龄 </option>
                                <option value="1"> 30-40岁 </option>
                                <option value="2"> 40-50岁 </option>
                                <option value="3"> 50岁以上 </option>
                            </select>
                        </div>
                    </div>
                    <div class="weui_cell">
                        <div class="weui_cell_hd"><label class="weui_label">公司</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" name="company_name" type="text" placeholder="请输入您的公司名称">
                        </div>
                    </div>
                    <div class="weui_cell weui_cell_select">
                        <div class="weui_cell_hd"><label class="weui_label">职位</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <select data-type="age" name="position" class="weui_select">
                                <option value=""> 请选择您的职位 </option>
                                <option value="董事长"> 董事长 </option>
                                <option value="总裁"> 总裁 </option>
                                <option value="总经理"> 总经理 </option>
                                <option value="其他"> 其他 </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="weui_cells weui_cells_form">
                    <div class="weui_cell weui_cell_select">
                        <div class="weui_cell_hd"><label class="weui_label">企业分类</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <select data-type="age" name="industry_id" class="weui_select">
                                <option value="">请选择企业分类</option>
                                <option value="1">电脑、通讯、数码</option><option value="43">家具、洁具、日用品</option><option value="10">建材、五金、装饰</option><option value="8">纺织、服装、鞋帽</option><option value="23">礼品、玩具、工艺品</option><option value="11">家电、照明、电子</option><option value="9">文具、乐器、体育</option><option value="3">机电、仪器、设备</option><option value="25">食品、饮料、酒类</option><option value="14">汽车、摩托、电动车</option><option value="46">能源、环保、节能</option><option value="45">冶金、金属、零件</option><option value="18">农业、水产、养殖</option><option value="29">矿产、石油、化工</option><option value="17">珠宝、首饰、化妆品</option><option value="44">医药、医器、保健品</option><option value="47">包装、印刷、造纸</option><option value="26">书画、艺术、收藏</option><option value="39">通用、其他制造业</option><option value="2">房地产、建筑、装修</option><option value="13">餐饮、咖啡、茶楼</option><option value="34">咨询、策划、翻译</option><option value="31">金融、证券、典当</option><option value="16">健身、运动俱乐部</option><option value="27">家政、保洁、搬家</option><option value="19">医院、诊所、保健</option><option value="36">旅游、宾馆、农家乐</option><option value="22">美容、休闲、养生</option><option value="15">婚庆、摄影、影楼</option><option value="40">仓储、物流、租车</option><option value="33">维修、保养、回收</option><option value="42">广告、会展、设计</option><option value="41">文化、教育、培训</option><option value="32">政府、协会、机构</option><option value="12">其他行业网站</option>

                            </select>
                        </div>
                    </div>
                    <div class="weui_cell weui_cell_select">
                        <div class="weui_cell_hd"><label class="weui_label">企业性质</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <select data-type="age" name="enterprise_nature" class="weui_select">
                                <option value="">请选择企业性质</option>
                                <option value="GFZ">股份制企业</option>
                                <option value="SY#">私营企业</option>
                                <option value="GT#">个体企业</option>
                                <option value="WSD">外商独资企业</option>
                                <option value="ZWH">中外合资企业</option>
                                <option value="GY#">国营企业</option>
                            </select>
                        </div>
                    </div>
                    <div class="weui_cell weui_cell_select">
                        <div class="weui_cell_hd"><label class="weui_label">企业规模</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <select data-type="age" name="scale" class="weui_select">
                                <option value="">请选择企业规模</option>
                                <option value="QIN">1000以上</option>
                                <option value="F2Q">501-1000人</option>
                                <option value="O2F">100-500人</option>
                                <option value="F2O">50-100人</option>
                                <option value="FIV">50人一下</option>
                            </select>
                        </div>
                    </div>
                    <div class="weui_cell">
                        <div class="weui_cell_hd"><label class="weui_label">成立时间</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" name="founding_time" type="date" value="">
                        </div>
                    </div>

                    <div class="weui_cell">
                        <div class="weui_cell_hd"><label class="weui_label">主营业务</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" name="primary_business" type="text" placeholder="请输入您的公司名称">
                        </div>
                    </div>

                    <div class="weui_cell">
                        <div class="weui_cell_hd"><label class="weui_label">营业执照</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" name="business_licence_num" type="text" placeholder="请输入您的营业执照(选填)">
                        </div>
                    </div>
                </div>

                <div class="weui_cells weui_cells_form">
                    <div class="weui_cell">
                        <div class="weui_cell_hd"><label class="weui_label">推荐人</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" name="referee" type="text" placeholder="请输入您的推荐人(选填)">
                            <input type="hidden" name="meeting_id" value="<?= $item['id'] ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div style="padding:0 1.5em 1.5em 1.5em;">
                 <a id="sbt" style="background-color: #EBBD45;margin-top: 2em;font-size: 20px;font-weight: bold;"  class="weui_btn weui_btn_primary">立即报名</a>
            </div>
        </form>
    </div>
</div>
<script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script type="text/javascript" src="http://7xrote.com2.z0.glb.qiniucdn.com/layer.mobile.js"></script>
<script>
    //weui_cell_warn
    function show_error(obj){
        if (!obj.parent().parent().hasClass('weui_cell_warn')) {
            obj.parent().parent().addClass('weui_cell_warn');
            obj.parent().parent().append('<div class="weui_cell_ft"><i class="weui_icon_warn"></i></div>');
        }
    }

    function  select_show_error(obj){
        if (!obj.parent().parent().hasClass('weui_cell_warn')) {
            obj.parent().parent().addClass('weui_cell_warn');
        }
    }

    function remove_error(obj){
        obj.parent().parent().removeClass('weui_cell_warn');
        obj.parent().parent().remove('<div class="weui_cell_ft"><i class="weui_icon_warn"></i></div>');
    }
    $('#submit-form').find('input').each(function () {
        var self = $(this);
        self.focus(function () {
            if (self.parent().parent().hasClass('weui_cell_warn')) {
                self.parent().parent().removeClass('weui_cell_warn')
                self.parent().parent().find('.weui_cell_ft').remove();
            }
       });
    });

    $('#submit-form').find('select').each(function () {
        var self = $(this);
        self.change(function () {
            if (self.parent().parent().hasClass('weui_cell_warn')) {
                self.parent().parent().removeClass('weui_cell_warn')
                self.parent().parent().find('.weui_cell_ft').remove();
            }
        });
    });
    $('#sbt').click(function(){
        var flag = true;
        $('#submit-form').find('input').each(function(){
            if ($(this).attr('name') ==  'name' ) {
                if ($.trim(this.value) == ''){
                    show_error($(this));
                    layer.alert('名字不能为空！');
                    flag =false;
                }
            }

            if ($(this).attr('name') ==  'mobile' ) {
                if ($.trim(this.value) == ''){
                    show_error($(this));
                    layer.alert('手机号码不能为空！');
                    flag =false;
                }
                else {
                    var pattern=/(^(([0\+]\d{2,3}-)?(0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$)|(^0{0,1}1[3|4|5|6|7|8|9][0-9]{9}$)/;

                    if(!pattern.test($.trim(this.value))) {
                        show_error($(this));
                        layer.alert('手机号码格式不正确！');
                        flag =false;
                    }
                }
            }

            if ($(this).attr('name') ==  'company_name' ) {
                if ($.trim(this.value) == ''){
                    show_error($(this));
                    layer.alert('公司名称不能为空！');
                    flag =false;
                }
            }


            if ($(this).attr('name') ==  'founding_time' ) {
                if ($.trim(this.value) == ''){
                    show_error($(this));
                    layer.alert('成立时间不能为空！');
                    flag =false;
                }
            }


            if ($(this).attr('name') ==  'primary_business' ) {
                if ($.trim(this.value) == ''){
                    show_error($(this));
                    layer.alert('主营业务及产品不能为空！');
                    flag =false;
                }
            }

            if($(this).attr('name') == 'email') {
                if($.trim(this.value) == '') {
                    show_error($(this));
                    layer.alert('邮箱不能为空！');
                    flag =false;
                }
                else {
                    var reg=/^[a-z0-9](\w|\.|-)*@([a-z0-9]+-?[a-z0-9]+\.){1,3}[a-z]{2,4}$/i;
                    if(!reg.test($.trim(this.value))) {
                        show_error($(this));
                        layer.alert('邮箱格式不正确！');
                        flag =false;
                    }
                }
            }
        });
        $('#submit-form').find('select').each(function () {
            if ($(this).attr('name') ==  'age' ) {
                if ($.trim(this.value) == ''){
                    layer.alert('请选择年龄！');
                    select_show_error($(this), '请选择年龄');
                    flag = false
                }
            }
            if ($(this).attr('name') ==  'position' ) {
                if ($.trim(this.value) == ''){
                    layer.alert('请选择职位！');
                    select_show_error($(this), '请选择职位');
                    flag = false
                }
            }
            if ($(this).attr('name') ==  'industry_id' ) {
                if ($.trim(this.value) == ''){
                    layer.alert('请选择企业分类！');
                    select_show_error($(this), '请选择企业分类');
                    flag = false
                }
            }
            if ($(this).attr('name') ==  'enterprise_nature' ) {
                if ($.trim(this.value) == ''){
                    layer.alert('请选择企业性质！');
                    select_show_error($(this), '请选择企业性质');
                    flag = false
                }
            }
            if ($(this).attr('name') ==  'scale' ) {
                if ($.trim(this.value) == ''){
                    layer.alert('请选择企业规模！');
                    select_show_error($(this), '请选择企业规模');
                    flag = false
                }
            }
        });

        if(flag){
            $("#submit-form").submit();
        }

        return false;
    });
</script>
</body>
</html>