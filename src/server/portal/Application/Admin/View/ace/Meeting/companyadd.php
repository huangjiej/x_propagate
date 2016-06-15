<extend name="Public/base"/>

<block name="body">
    <div class="tabbable">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#person">
                    注册信息详情
                </a>
            </li>
        </ul>
        <form id="reg" action="<?= empty($item) ? U('companyadd?eid='.$enroll['id']) : U('companyedit?eid='.$enroll['id']) ?>" method="post" class="form-horizontal">
            <div class="tab-content">
                <div id="person" class="tab-pane in active">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right"><?= $item['position'] ?>姓名</label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="clearfix">
                                <input type="text" id="chairman_name" class="width-100" name="chairman_name"
                                       value="{$item.chairman_name}"/>
                            </div>

                        </div>
                        <span class="check-tips"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            习惯称呼
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" name="chairman_nickname" class="width-100" value="{$item.chairman_nickname|default=''}">
                        </div>
                        <span class="check-tips"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            性别
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <label><input type="radio" <?= $item['sex']=='MAN' ? 'checked' : '' ?> class="ace" name="sex" value="MAN"><span class="lbl">男&nbsp;</span></label>
                            <label><input type="radio" <?= $item['sex']=='MRS' ? 'checked' : '' ?> class="ace" name="sex" value="MRS"><span class="lbl">女&nbsp;</span></label>
                        </div>
                        <span class="check-tips"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            出生日期
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <input name="birthday" class="form-control birthday" value="{$item.birthday}" type="text" data-date-format="dd-mm-yyyy">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            身份证号码
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="clearfix">
                                <input type="text"  id="id_number"
                                       name="id_number" class="width-100" value="{$item.id_number|default=''}">
                            </div>
                        </div>
                        <span class="check-tips"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            手机号码
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="clearfix">
                                <input type="text" id="mobile" class="width-100" name="mobile"
                                       value="<?= empty($item['mobile']) ? $enroll['mobile'] : $item['mobile']?>"/>
                            </div>
                        </div>
                        <span class="check-tips"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            办公电话
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" name="telephone" class="width-100" value="{$item.telephone|default=''}">
                        </div>
                        <span class="check-tips"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            住宅电话
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" name="homephone" class="width-100" value="{$item.homephone|default=''}">
                        </div>
                        <span class="check-tips"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            邮箱
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" name="email" class="width-100" value="{$item.email|default=''}">
                        </div>
                        <span class="check-tips"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            个人简介
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <textarea name="chairman_desc" class="form-control"></textarea>
                        </div>
                        <span class="check-tips"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            公司名称
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" class="width-100" name="company_name"
                                   value="<?= empty($item['company_name']) ? $enroll['company_name'] : $item['company_name']?>"/>
                        </div>
                        <span class="check-tips"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            公司地址
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" name="address" class="width-100"
                                   value="{$item.address|default=''}">
                        </div>
                        <span class="check-tips"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            成立时间
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <input name="founding_time" class="form-control founding_time" value="{$item.founding_time}" type="text" data-date-format="dd-mm-yyyy">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            营业执照注册号
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="clearfix">
                                <input type="text" id="business_licence_num" name="business_licence_num" class="width-100"
                                       value="{$item.business_licence_num|default=''}">
                            </div>
                        </div>
                        <span class="check-tips"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            主营业务及产品
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" name="primary_business" class="width-100"
                                   value="{$item.primary_business|default=''}">
                        </div>
                        <span class="check-tips"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            常用联系人姓名
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" name="general_contact" class="width-100"
                                   value="{$item.general_contact|default=''}">
                        </div>
                        <span class="check-tips"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            职位
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <input type="text" name="position" class="width-100"
                                   value="{$item.position|default=''}">
                        </div>
                        <span class="check-tips"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            企业分类
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <select name="industry_id" id="catid" data-id="{$item.industry_id}">
                                <option value="0">选择行业分类</option>
                                <option value="1">电脑、通讯、数码</option><option value="43">家具、洁具、日用品</option><option value="10">建材、五金、装饰</option><option value="8">纺织、服装、鞋帽</option><option value="23">礼品、玩具、工艺品</option><option value="11">家电、照明、电子</option><option value="9">文具、乐器、体育</option><option value="3">机电、仪器、设备</option><option value="25">食品、饮料、酒类</option><option value="14">汽车、摩托、电动车</option><option value="46">能源、环保、节能</option><option value="45">冶金、金属、零件</option><option value="18">农业、水产、养殖</option><option value="29">矿产、石油、化工</option><option value="17">珠宝、首饰、化妆品</option><option value="44">医药、医器、保健品</option><option value="47">包装、印刷、造纸</option><option value="26">书画、艺术、收藏</option><option value="39">通用、其他制造业</option><option value="2">房地产、建筑、装修</option><option value="13">餐饮、咖啡、茶楼</option><option value="34">咨询、策划、翻译</option><option value="31">金融、证券、典当</option><option value="16">健身、运动俱乐部</option><option value="27">家政、保洁、搬家</option><option value="19">医院、诊所、保健</option><option value="36">旅游、宾馆、农家乐</option><option value="22">美容、休闲、养生</option><option value="15">婚庆、摄影、影楼</option><option value="40">仓储、物流、租车</option><option value="33">维修、保养、回收</option><option value="42">广告、会展、设计</option><option value="41">文化、教育、培训</option><option value="32">政府、协会、机构</option><option value="12">其他行业网站</option>
                            </select>
                        </div>
                        <span class="check-tips">（仅对当前层级分类有效）</span>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            企业性质
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <select name="enterprise_nature" id="enterprise_nature" data-id="{$item.enterprise_nature}">
                                <option value="0">选择企业</option>
                                <option value="GFZ">股份制企业</option>
                                <option value="SY#">私营企业</option>
                                <option value="GT#">个体企业</option>
                                <option value="WSD">外商独资企业</option>
                                <option value="ZWH">中外合资企业</option>
                                <option value="GY#">国营企业</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            企业规模
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <select name="scale" id="scale" data-id="{$item.scale}">
                                <option value="0">选择企业规模</option>
                                <option value="QIN">1000以上</option>
                                <option value="F2Q">501-1000人</option>
                                <option value="O2F">100-500人</option>
                                <option value="F2O">50-100人</option>
                                <option value="FIV">50人一下</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            管理经验
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <select name="manage_experience" id="manage_experience" data-id="{$item.manage_experience}">
                                <option value="0">选择管理经验</option>
                                <option value="TEN">10年以上</option>
                                <option value="E2T">8-10年</option>
                                <option value="F2S">5-7年</option>
                                <option value="T3F">2-4年</option>
                                <option value="TWO">两年以下</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                            学历
                        </label>
                        <div class="col-xs-12 col-sm-6">
                            <select name="edu_degree" id="edu_degree" data-id="{$item.edu_degree}">
                                <option value="0">选择学历</option>
                                <option value="BS">博士</option>
                                <option value="SS">硕士</option>
                                <option value="BK">本科</option>
                                <option value="DZ">大专</option>
                                <option value="ZZ">中专</option>
                                <option value="GZ">高中</option>
                                <option value="QT">其他</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">公司LOGO</label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="upload-wrap">
                                <a href="javascript:" class="btn btn-sm btn-success pic-upload" name="logo" val="{$item['logo']|default=''}" >
                                    <i class="icon-cloud-upload "></i>上传图片
                                </a>
                                <notempty name="item['logo']">
                                    <div class="preview"><img src="<?=imageView2($item['logo'],120,120)?>" width="120"/></div>
                                </notempty>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">公司照片</label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="upload-wrap">
                                <a href="javascript:" class="btn btn-sm btn-success pic-upload" name="company_photo" val="{$item['company_photo']|default=''}" >
                                    <i class="icon-cloud-upload "></i>上传图片
                                </a>
                                <notempty name="item['company_photo']">
                                    <div class="preview"><img src="<?=imageView2($item['company_photo'],120,120)?>" width="120"/></div>
                                </notempty>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">个人正装图片</label>
                        <div class="col-xs-12 col-sm-6">
                            <div class="upload-wrap">
                                <a href="javascript:" class="btn btn-sm btn-success pic-upload" name="person_photo" val="{$item['person_photo']|default=''}" >
                                    <i class="icon-cloud-upload "></i>上传图片
                                </a>
                                <notempty name="item['person_photo']">
                                    <div class="preview"><img src="<?=imageView2($item['person_photo'],120,120)?>" width="120"/></div>
                                </notempty>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix form-actions">
                    <if condition="!empty($item)">
                        <input type="hidden" name="id" value="{$item.id}">
                    </if>
                    <div class="col-xs-12">
                        <a id="sub-btn"
                           class="btn btn-sm btn-success no-border">
                            确认保存
                        </a>
                        <button id="hidebtn" class="btn hide btn-sm btn-success no-border ajax-post no-refresh" target-form="form-horizontal" type="submit">
                            确认保存
                        </button>
                        <a id="affirm-enroll" class="btn btn-sm btn-primary no-border ajax-post no-refresh" target-form="form-horizontal">
                            确认并发送通知
                        </a>
                        <a href="javascript:;" class="btn btn-white" onclick="history.go(-1)">
                            返回
                        </a>
                    </div>
                </div>
                <input id="notify" name="notify" value="" type="hidden">
            </div>
        </form>
    </div>
</block>

<block name="script">

    <include file="Public/upload.js"/>
    <include file="Public/upload.pic"/>
    <link href="__STATIC__/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
    <php>if(C('COLOR_STYLE')=='blue_color') echo '<link href="__STATIC__/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" type="text/css">';</php>
    <link href="__STATIC__/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="__STATIC__/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="__STATIC__/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script src="__ACE__/js/query.validate.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#reg').validate({
                errorElement: 'div',
                errorClass: 'help-block',
                focusInvalid: false,
                rules: {
                    id_number: {
                        number: true,
                        minlength:18,
                        maxlength:18,
                    },
                    mobile:{
                        number: true,
                        minlength:11,
                        maxlength:11,
                    },
                    chairman_name:{
                        maxlength:5,
                    },
                    business_licence_num:{
                        number: true,
                        minlength:15,
                        maxlength:15,
                    }
                },
                messages:{
                    business_licence_num:{
                        number: "请输入数字",
                        minlength:"请输入15位营业执照号",
                        maxlength:"请输入15位营业执照号"
                    },
                    chairman_name:{
                        maxlength: "最大长度5个字符"
                    },
                    id_number: {
                        number: "请输入数字",
                        minlength:"请输入18位身份证号",
                        maxlength:"请输入18位身份证号"
                    },
                    mobile : {
                        number: "请输入数字",
                        minlength:"请输入11位手机号码",
                        maxlength:"请输入11位手机号码"
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit
                    $('.alert-danger', $('.login-form')).show();
                },

                highlight: function (e) {
                    $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                },

                success: function (e) {
                    $(e).closest('.form-group').removeClass('has-error')
                    $(e).remove();
                },

                errorPlacement: function (error, element) {
                    if(element.is(':checkbox') || element.is(':radio')) {
                        var controls = element.closest('div[class*="col-"]');
                        if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                        else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                    }
                    else if(element.is('.select2')) {
                        error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                    }
                    else if(element.is('.chosen-select')) {
                        error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
                    }
                    else error.insertAfter(element.parent());
                },

                submitHandler: function (form) {
                },
                invalidHandler: function (form) {
                }
            });
            $('#sub-btn').click(function (event) {
                if(!$('#reg').valid()) {
                    alert("表单填写有错误，请检查！");
                } else {
                    $('#hidebtn').click();
                }
            });
            $("input[name=reply]").change(function(){
                var $reply = $(".form-group.reply");
                parseInt(this.value) ? $reply.show() : $reply.hide();
            }).filter(":checked").change();

            $('#affirm-enroll').click(function(){
                $('#notify').val(1);
                $('#sub-btn').trigger('click')
            });
        });
        //导航高亮
        highlight_subnav('{:U('Meeting/enroll')}');
        (function ($) {
            $('.birthday').datetimepicker({
                format: 'yyyy-mm-dd',
                language:"zh-CN",
                minView:2,
                autoclose:true
            });
            $('.founding_time').datetimepicker({
                format: 'yyyy-mm-dd',
                language:"zh-CN",
                minView:2,
                autoclose:true
            });
            //选择企业分类
            var cate = $('#catid');
            var id = cate.data('id');
            if(!!id)cate.val(id);
            //企业性质
            var enterprise_nature = $('#enterprise_nature');
            var eid = enterprise_nature.data('id');
            if (!!eid)enterprise_nature.val(eid);
            //企业规模
            var scale = $('#scale');
            var sid = scale.data('id');
            if (!!sid)scale.val(sid);
            //管理经验
            var manage_experience = $('#manage_experience');
            var mid = manage_experience.data('id');
            if(!!mid) manage_experience.val(mid);
            //学历
            var edu_degree = $('#edu_degree');
            var edid = edu_degree.data('id');
            if (!!edid) edu_degree.val(edid);
        })(jQuery);
    </script>
</block>
