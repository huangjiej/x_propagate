<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title><?= isset($meta_title) ? $meta_title.' - ' : ''?>健康GO俱乐部</title>
    <link rel="stylesheet" href="/style/weui.css">
    <style>
        input:disabled{
            border: 1px solid #DDD;
            background-color: #F5F5F5;
            color:#ACA899;
        }
    </style>
</head>

<body ontouchstart>
<form id="post-form" method="post" action="">
    <div class="weui_cells_title">绑定手机号码</div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">昵称</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input name="name" class="weui_input" type="text"
                       placeholder="请输入昵称">
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">手机号码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input name="mobile" class="weui_input" type="number" pattern="[0-9]*"
                       placeholder="请输入手机号码">
            </div>
        </div>
        <div class="weui_cell weui_vcode">
            <div class="weui_cell_hd"><label class="weui_label">验证码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input name="code" class="weui_input" type="number" pattern="[0-9]*"
                       placeholder="请输入验证码">
            </div>
            <div class="weui_cell_ft" style="margin-left: 5px;height: 44px;line-height: 44px;margin-right: 5px;">
                <input type="button" value="获取验证码" style="vertical-align: middle;    width: 120px;" id="code" href="javascript:;" class="weui_btn weui_btn_mini weui_btn_primary">
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <textarea name="address" id="address" class="weui_textarea" placeholder="请输入地址" rows="3"></textarea>
            </div>
        </div>
    </div>
    <div class="weui_btn_area">
        <a class="weui_btn weui_btn_primary" href="javascript:" id="post-new">确定</a>
    </div>
</form>

<script type="text/javascript" src="http://cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script type="text/javascript" src="http://7xrote.com2.z0.glb.qiniucdn.com/layer.mobile.js"></script>
<script>
    var messcode;
    var InterValObj; //timer变量，控制时间
    var count = 60; //间隔函数，1秒执行
    var curCount;//当前剩余秒数

    $("#code").click ( function () {
        var mobile=$("input[name=mobile]").val();
        if(""!=$.trim(mobile)){
            if(!(/^1[3|4|5|8][0-9]\d{4,8}$/.test($('input[name=mobile]').val()))){
                layer.alert("请输入正确的手机号码");
            } else {
                curCount = count;
                $("#code").attr("disabled","true");
                $("#code").val(curCount + "秒后重新发送");

                $.post('/member/sendSmsCode',{mobile:mobile}, function (resp) {
                    layer.msg(resp.msg);
                    if(resp.status == '0'){
                        InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
                    }
                },'json');
            }
        }else{
            layer.alert("请输入手机号！")
        }

    });

    //timer处理函数
    function SetRemainTime() {
        if (curCount == 0) {
            window.clearInterval(InterValObj);//停止计时器
            $("#code").removeAttr("disabled");//启用按钮
            $("#code").val("重新发送验证码");
        }
        else {
            curCount--;
            $("#code").val(curCount + "秒后重新发送");
        }
    }

    $('#post-new').click(function () {
        var success  = true;

        if ($('input[name=name]').val() == '') {
            layer.alert('昵称不能为空');
            success = false;
        }

        if ($('input[name=mobile]').val() == '') {
            layer.alert('手机号码不能为空');
            success = false;
        }

        if(!(/^1[3|4|5|8][0-9]\d{4,8}$/.test($('input[name=mobile]').val()))){
            layer.alert("请输入正确的手机号码");
            success = false;
        }

        if ($('input[name=code]').val() == '') {
            layer.alert('验证码不能为空');
            success = false;
        }


        if (success) {
            $.ajax({
                type: 'POST',
                url: '<?=DOMAIN?>' + '/member/bind',
                data: $('#post-form').serialize(),
                success: function (data) {
                    if (data.status > 0) {
                        layer.alert(data.msg);
                    } else {
                        layer.alert(data.msg, function () {
                            window.location.href = data.url;
                        });
                    }
                },
                dataType: 'json'
            });
        }
    });

    function FitToContent(id, maxHeight) {
        var text = id && id.style ? id : document.getElementById(id);
        if ( !text )
            return;

        var adjustedHeight = text.clientHeight;
        if ( !maxHeight || maxHeight > adjustedHeight )
        {
            adjustedHeight = Math.max(text.scrollHeight, adjustedHeight);
            if ( maxHeight )
                adjustedHeight = Math.min(maxHeight, adjustedHeight);
            if ( adjustedHeight > text.clientHeight )
                text.style.height = adjustedHeight + "px";
        }
    }

    window.onload = function() {
        document.getElementById("address").onkeyup = function() {
            FitToContent( this, 500 )
        };
    }
</script>
</body>
</html>