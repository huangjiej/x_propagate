<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>欢迎您登录{:C('WEB_SITE_TITLE')}</title>
    <link rel="stylesheet" href="__ACE__/css/login.css">
    <style>
        .barcode-container {
            display: inline-block;
            _display: inline-block;
            display: table-cell;
            float: left;
            width: 120px;
            height: 120px;
        }

        .barcode-container .status, .barcode-container .mask {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 999;
            color: #fff;
        }

        .barcode-container .status {
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            font-family: tahoma, arial, "Hiragino Sans GB", "Microsoft Yahei", \5b8b\4f53;
            color: #fff;
        }

        .barcode-container .status .first {
            margin-top: 32%;
        }

        .barcode-container .status .second {
            margin-top: 15%;
        }

        .barcode-container .status button {
            outline: none;
            line-height: 1.5;
            height: 30px;
            color: #fff;
            border: none;
            background-color: #0ae;
            display: inline-block;
            margin-top: 6px;
            margin-top: 4px \0;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            font-size: 14px;
            border-radius: 2px;
            padding: 0 20px;
            cursor: pointer;
        }

        .barcode-container .status button:hover {
            background-color: #00a3d2;
        }

        .barcode-container .status button:active {
            position: relative;
            top: 1px;
            box-shadow: 1px 1px 3px #999 inset;
        }

        .barcode-container .mask {
            opacity: 0.6;
            filter: alpha(opacity=60);
            -moz-opacity: 0.6;
            background: #000;
        }

        .barcode-container .status, .barcode-container .mask {
            width: 100%;
            height: 100%;
        }

        .barcode-container .mask {
            top: -7px;
            left: -7px;
            width: 112%;
            height: 112%;
        }

        .barcode-container.error .status.error, .barcode-container.error .mask {
            display: block;
        }

        .barcode-container.timeout .status.timeout, .barcode-container.timeout .mask {
            display: block;
        }

        .barcode-container.scanned .status.scanned, .barcode-container.scanned .mask {
            display: block;
        }

        .barcode-container.confirmed .status.confirmed, .barcode-container.confirmed .mask {
            display: block;
        }

        .barcode-container {
            position: relative;
        }

        .barcode-container .barcode img {
            top: 46px \0 !important;
            left: 46px \0 !important;
        }

    </style>
    <style>
        .ui-nav li {
            float: left;
            width: 50%;
            color: #fff;
            text-align: center;
            border-bottom: 2px #fff solid;
            font-size: 16px;
            padding: 15px 0 4px;
            cursor: pointer;
        }

        .ui-nav li.active {
            color: #0AE;
            border-bottom-color: #0AE;
        }

        .ui-nav {
            background: rgba(0, 0, 0, .5);
            _background: 0 0;
            filter: progid:DXImageTransform.Microsoft.Gradient(GradientType=0, StartColorStr='#66000000', EndColorStr='#66000000');
        }

        .clear-float {
            clear: both;
        }

        .login-modern form {
            padding-top: 20px;
        }

        .sl-error-display {
            margin-top: 0px;
        }                </style>
    <style type="text/css">
        input.sixDigitPassword {
            position: absolute;
            color: #fff;
            opacity: 0;
            width: 1px;
            height: 1px;
            font-size: 1px;
            left: 0;
            -webkit-box-sizing: content-box;
            box-sizing: content-box;
            -webkit-user-select: initial; /* 取消禁用选择页面元素 */
            outline: 'none';
            margin-left: '-9999px';
        }

        div.sixDigitPassword {
            cursor: text;
            background: #fff;
            outline: none;
            position: relative;
            padding: 8px 0;
            height: 14px;
            border: 1px solid #cccccc;
            border-radius: 2px;
        }

        div.sixDigitPassword i {
            float: left;
            display: block;
            padding: 4px 0;
            height: 7px;
            border-left: 1px solid #cccccc;
        }

        div.sixDigitPassword i.active {
            background-image: url("https://t.alipayobjects.com/images/rmsweb/T1nYJhXalXXXXXXXXX.gif");
            background-repeat: no-repeat;
            background-position: center center;
        }

        div.sixDigitPassword b {
            display: block;
            margin: 0 auto;
            width: 7px;
            height: 7px;
            overflow: hidden;
            visibility: hidden;
            background-image: url("https://t.alipayobjects.com/tfscom/T1sl0fXcBnXXXXXXXX.png");
        }

        div.sixDigitPassword span {
            position: absolute;
            display: block;
            left: 0px;
            top: -1px;
            height: 30px;
            border: 1px solid rgba(82, 168, 236, .8);
            border: 1px solid #00ffff \9;
            border-radius: 2px;
            visibility: hidden;
            -webkit-box-shadow: inset 0px 2px 2px rgba(0, 0, 0, 0.75), 0 0 8px rgba(82, 168, 236, 0.6);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
        }
    </style>
    <script src="//cdn.bootcss.com/jquery/1.12.1/jquery.js"></script>
    <script type="text/javascript" src="__STATIC__/layer/layer.min.js"></script>
</head>
<body>
<style>
    .authcenter-head .header {
        display: table;
        height: 100px;;
    }

    .authcenter-head .header .cell {
        display: table-cell; /*让元素以表格的单元素格形式渲染*/
        vertical-align: middle; /*使用元素的垂直对齐*/
        width: 100px;
    }

    .authcenter-head .header .title {
        font-size: 26px;
        font-weight: bold;
        width: auto;
    }
</style>
<div class="authcenter" id="J-authcenter">
    <div class="authcenter-head">
        <div class="container">
            <div class="header">
                <div class="cell"><img src="__ACE__/images/logo.png" alt=""></div>
                <div class="cell title"><h1>健康加俱乐部</h1></div>
            </div>
        </div>
    </div>
    <div class="authcenter-body fn-clear">
        <div class="authcenter-body-login" id="nav">
            <ul class="ui-nav">
                <li class="active" data-status="show_login">账密登录</li>
                <li data-status="show_login">短信登录</li>
                <br class="clear-float">
            </ul>
            <div class="login login-modern" id="login">
                <form name="loginForm" action="{:U('login')}" method="post"
                      class="ui-form" novalidate="novalidate" data-widget-cid="widget-3" data-qrcode="false">
                    <fieldset>
                        <div class="sl-error" id="J-errorBox" errortype="2">
                            <span class="sl-error-text">请输入登录密码</span>
                        </div>
                        <div class="ui-form-item" id="J-username">
                            <label id="J-label-user" class="ui-label" seed="authcenter-switch-account">
                                <span class="ui-icon ui-icon-userDEF"><i class="iconauth"></i></span>
                            </label>
                            <input
                                type="text" id="J-input-user" class="ui-input ui-input-normal" name="username"
                                tabindex="1" value="" autocomplete="off" maxlength="100" placeholder="邮箱/手机号"
                                seed="authcenter-input-account" data-widget-cid="widget-4" data-explain="">
                            <div class="ui-form-explain"></div>
                        </div>

                        <div class="ui-form-item ui-form-item-20pd" id="J-password">
                            <label id="J-label-editer" class="ui-label" data-desc="登录密码"
                                   seed="authcenter-switch-aliedit">
                                <span class="ui-icon ui-icon-securityON" id="safeSignCheck"><i
                                        class="iconauth"></i></span>
                                <div id="J-label-editer-pop" class="ui-poptip fn-hide" data-widget-cid="widget-0">
                                    <div class="ui-poptip-container">
                                        <div class="ui-poptip-arrow ui-poptip-arrow-7">
                                            <em></em>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            <span class="alieditContainer" id="password_container">
                                <input type="password" tabindex="2"
                                       id="password_rsainput"
                                       name="password"
                                       class="ui-input i-text"
                                       oncontextmenu="return false"
                                       onpaste="return false"
                                       oncopy="return false"
                                       oncut="return false"
                                       autocomplete="off"
                                       value=""></span>
                            <div class="ui-form-explain"></div>
                        </div>
                        <div id="J-checkcode" class="ui-form-item">
                            <label id="J-label-checkcode" class="ui-label" seed="authcenter-switch-checkcode">
                                <i class="ui-icon iconauth ui-icon-checkcodeT" id="J-switchCheckcode"></i>
                                <div id="J-label-checkcode-pop" class="ui-poptip fn-hide" data-widget-cid="widget-1">
                                    <div class="ui-poptip-container">
                                        <div class="ui-poptip-arrow ui-poptip-arrow-7">
                                            <em></em>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            <input type="text" placeholder="验证码" value="" class="ui-input ui-input-normal"
                                   id="J-input-checkcode" data-type="IMAGE" maxlength="4" name="verify"
                                   autocomplete="off" tabindex="3" data="validate" seed="authcenter-input-checkcode"
                                   data-widget-cid="widget-7" data-explain="">
                            <span class="sl-checkcode" id="J-checkcodeIcon"></span>
                            <div class="ui-checkcode">
                                <img class="ui-checkcode-img reloadverify verifyimg" id="J-checkcode-img"
                                     src="{:U('Public/verify')}"
                                     title="点击图片刷新验证码" alt="点击图片刷新验证码" seed="authcenter-img-checkcode">
                            </div>
                            <div class="ui-form-explain"></div>
                        </div>
                        <div class="ui-form-item ui-form-item-30pd" id="J-submit">
                            <input type="submit" value="登 录" class="ui-button" id="J-login-btn" tabindex="4"
                                   seed="authcenter-submit-sso_index">
                        </div>
                    </fieldset>
                </form>
            </div>
            <div id="show-mobile" class="login qrcode-modern fn-hide">
                <form name="loginForm" action="{:U('login2')}" method="post"
                      class="ui-form" novalidate="novalidate" data-widget-cid="widget-3" data-qrcode="false">
                    <fieldset>
                        <div class="sl-error" style="margin-top: 10px;" errortype="2">
                            <span class="sl-error-text"></span>
                        </div>
                        <div class="ui-form-item">
                            <label class="ui-label" seed="authcenter-switch-account">
                                <span class="ui-icon ui-icon-userDEF"><i class="iconauth"></i></span>
                            </label>
                            <input id="mobile"
                                   type="text" class="ui-input ui-input-normal" name="username"
                                   tabindex="1" value="" autocomplete="off" maxlength="100" placeholder="手机号"
                                   seed="authcenter-input-account" data-widget-cid="widget-4" data-explain="">
                            <div class="ui-form-explain"></div>
                        </div>

                        <div class="ui-form-item">
                            <label class="ui-label" seed="authcenter-switch-checkcode">
                                <i class="ui-icon iconauth ui-icon-checkcodeT"></i>
                                <div class="ui-poptip fn-hide" data-widget-cid="widget-1">
                                    <div class="ui-poptip-container">
                                        <div class="ui-poptip-arrow ui-poptip-arrow-7">
                                            <em></em>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            <input id="checkcode" type="text" placeholder="验证码" value=""
                                   class="ui-input ui-input-checkcode"
                                   data-type="IMAGE" maxlength="4" name="verify"
                                   autocomplete="off" tabindex="3" data="validate" seed="authcenter-input-checkcode"
                                   data-widget-cid="widget-7" data-explain="">
                            <input type="hidden" name="idPrefix" value="">
                            <span class="sl-checkcode"></span>
                            <a id="getcheckcode" style="background-color:#DB7C22; font-size: 12px;" class="ui-button">
                                &nbsp;&nbsp;获取验证码</a>
                            <div class="ui-form-explain"></div>
                        </div>
                        <div class="ui-form-item ui-form-item-30pd">
                            <input type="submit" value="登 录" class="ui-button" tabindex="4" id="mobile_sumbit"
                                   seed="authcenter-submit-sso_index">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="ui-box">
            <div class="ui-box-head">
                <h3 class="ui-box-head-title">俱乐部活动</h3>
                <a href="#" class="ui-box-head-more">更多<i class="iconfont">&#xe60a;</i></a>
            </div>
            <div class="ui-box-container">
                <div class="ui-box-content fn-clear">
                    <div class="fn-left">
                        <img src="__ACE__/images/jlbhd.jpg" alt="">
                    </div>
                    <div class="fn-left ui-list-cont">
                        <ul class="ui-list ui-list-graylink">
                            <volist name="meetings" id="vo">
                            <li class="ui-list-item fn-clear">
                                <a href="<?= C('WECHAT_ADDR') . 'public/enroll?meeting_id=' . $vo['id'] ?>">{$vo.title}</a>
                                <span class="ui-list-item-text fn-right">{$vo.insert_time}</span>
                            </li>
                            </volist>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui-box">
            <div class="ui-box-head">
                <h3 class="ui-box-head-title">俱乐部动态</h3>
                <a href="#" class="ui-box-head-more">更多<i class="iconfont">&#xe60a;</i></a>
            </div>
            <div class="ui-box-container">
                <div class="ui-box-content fn-clear">
                    <div class="fn-left">
                        <img src="__ACE__/images/jlbdt.jpg" alt="">
                    </div>
                    <div class="fn-left ui-list-cont">
                        <ul class="ui-list ui-list-graylink">
                            <volist name="twitters" id="vo">
                                <li class="ui-list-item fn-clear">
                                    <a href="{$vo.wx_url}">{$vo.title}</a>
                                    <span class="ui-list-item-text fn-right">{$vo.create_time}</span>
                                </li>
                            </volist>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <style>
        </style>
    </div>
    <div class="ui-help-cont">
        <div class="container">
            <div class="ui-help fn-clear">
                <div class="ui-help-item fn-left">
                    <h3>网站自助</h3>
                    <p>常见问题查看帮助</p>
                    <p>查看帮助</p>
                </div>

                <div class="ui-help-item fn-left">
                    <h3>在线客服</h3>
                    <p>常见问题查看帮助</p>
                    <p>查看帮助</p>
                </div>

                <div class="ui-help-item fn-left">
                    <h3>网站自助</h3>
                    <p>常见问题查看帮助</p>
                    <p>查看帮助</p>
                </div>
            </div>
        </div>
    </div>
    <div class="cpy-cnt">
        <div class="cpy">
            <p><a>诚征英才</a><span>|</span><a href="">联系我们</a></p>
            <p>2015-2016@深圳麦圈科技有限公司</p>
        </div>
    </div>
    <div class="authcenter-background" id="J-authcenter-bg" style="width: 100%; height: 540px;">
        <img id="J-authcenter-bgImg" class="authcenter-bg authcenter-bg-show" seed="JAuthcenterBg-J-authcenter-bgImg"
             smartracker="on" src="__ACE__/images/new-header.jpg"
             style="width: 100%; height: 540px;">
    </div>
</div>
<script>
    var verifyimg = $(".verifyimg").attr("src");
    $(".reloadverify").click(function(){
        if( verifyimg.indexOf('?')>0){
            $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
        }else{
            $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
        }
    });

    var list = $('#nav').find('.login');
    $('#nav').find('li').each(function (idx, itm) {
        itm.idx = idx;
        $(itm).click(function (event) {
            $('#nav').find('li').each(function (idx, itm) {
                $(itm).removeClass('active')
            });
            $(this).addClass('active');
            list.each(function (idx, itm) {
                $(itm).removeClass('fn-hide');
            });
            var new_idx = this.idx > 0 ? 0 : 1;
            $(list[new_idx]).addClass('fn-hide');
        })
    })

    $('#J-login-btn').click(function () {
        if ($('#J-input-user').val() == '') {
            $('#login').find('.sl-error').addClass('sl-error-display');
            $('#login').find('.sl-error-text').html('请输入登录帐号');
            return false;
        }

        if ($('#password_rsainput').val() == '') {
            $('#login').find('.sl-error').addClass('sl-error-display');
            $('#login').find('.sl-error-text').html('请输入登录密码');
            return false;
        }

        if ($('#J-input-checkcode').val() == '') {
            $('#login').find('.sl-error').addClass('sl-error-display');
            $('#login').find('.sl-error-text').html('请输入验证码');
            return false;
        }
        $('#login').find('form').submit(function () {
            var self = $(this);
            $("button:submit").addClass("log-in").attr("disabled", true);
            loading = layer.load();

            $.post(self.attr("action"), self.serialize(), success, "json").always(function () {
                $("button:submit").removeClass("log-in").attr("disabled", false);
                layer.close(loading);
            });
            ;
            return false;

            function success(data) {
                if (data.status) {
                    layer.msg(data.info, {icon: 1}, function () {
                        window.location.href = data.url;
                    });
                } else {
                    if (data.url != '') {
                        layer.msg(data.info, {icon: 2}, function () {
                            show_box("signup-box");
                        });
                    } else {
                        layer.alert(data.info, {icon: 2});
                    }
                    //刷新验证码
                    $(".reloadverify").click();
                }
            }
        });
    });
    var mobile = $('#mobile').val();
    $('#getcheckcode').click(function () {
        if (/^1\d{10}$/.test(mobile)) {
            $.post("{:U('getAuthCode')}", {mobile: mobile}).done(function (resp) {
                if (resp.status == 1) {
                    layer.msg(resp.info, {icon: 1});
                } else {
                    layer.alert(resp.info, {icon: 2});
                }
            }).fail(function () {

                layer.alert('验证码获取失败！', {icon: 2});
            });
        } else {
            layer.alert('请输入正确的手机号码！', {icon: 2});
        }
    });

    $('#mobile_sumbit').click(function () {
        if ($('#mobile').val() == '') {
            $('#show-mobile').find('.sl-error').addClass('sl-error-display');
            $('#show-mobile').find('.sl-error-text').html('请输入手机号码');
            return false;
        }
        if (!/^1\d{10}$/.test(parseInt($('#mobile').val()))) {
            $('#show-mobile').find('.sl-error').addClass('sl-error-display');
            $('#show-mobile').find('.sl-error-text').html('请输入正确手机号码');
            return false;
        }

        if ($('#checkcode').val() == '') {
            $('#show-mobile').find('.sl-error').addClass('sl-error-display');
            $('#show-mobile').find('.sl-error-text').html('请输入手机验证码');
            return false;
        }

        $('#show-mobile').find('form').submit(function () {
            var self = $(this);
            $("button:submit").addClass("log-in").attr("disabled", true);
            loading = layer.load();

            $.post(self.attr("action"), self.serialize(), success, "json").always(function () {
                $("button:submit").removeClass("log-in").attr("disabled", false);
                layer.close(loading);
            });
            ;
            return false;

            function success(data) {
                if (data.status) {
                    layer.msg(data.info, {icon: 1}, function () {
                        window.location.href = data.url;
                    });
                } else {
                    if (data.url != '') {
                        layer.msg(data.info, {icon: 2}, function () {
                            show_box("signup-box");
                        });
                    } else {
                        layer.alert(data.info, {icon: 2});
                    }
                    //刷新验证码
                    $(".reloadverify").click();
                }
            }
        });
    });
</script>
</body>
</html>