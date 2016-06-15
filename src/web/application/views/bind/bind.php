<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title><?= isset($meta_title) ? $meta_title.' - ' : ''?>土筑虎</title>
    <link rel="stylesheet" href="/style/weui.css">
    <style>
        input:disabled{
            border: 1px solid #DDD;
            background-color: #eb6b00;
            color:#ACA899;
        }
    </style>
</head>

<body ontouchstart>
<form id="post-form" method="post" action="">
    <div class="weui_cells_title">绑定手机号码</div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">手机号码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input name="mobile" class="weui_input" type="number" pattern="[0-9]*"
                       placeholder="请输入手机号码">
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">请输入密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input type="password" name="password" class="weui_input"
                       placeholder="请输入密码">
            </div>
        </div>
    </div>
    <div class="weui_btn_area">
        <a class="weui_btn weui_btn_primary" href="javascript:" id="post-new">绑定</a>
    </div>
</form>

<script type="text/javascript" src="http://cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script type="text/javascript" src="http://7xrote.com2.z0.glb.qiniucdn.com/layer.mobile.js"></script>
<script>

    $('#post-new').click(function () {
        var success  = true;


        if ($('input[name=mobile]').val() == '') {
            layer.alert('手机号码不能为空');
            success = false;
        }
        if ($('input[name=paasword]').val() == '') {
            layer.alert('密码不能为空');
            success = false;
        }

        if(!(/^1[3|4|5|8][0-9]\d{4,8}$/.test($('input[name=mobile]').val()))){
            layer.alert("请输入正确的手机号码");
            success = false;
        }

        if (success) {
            $.ajax({
                type: 'POST',
                url: '<?=DOMAIN?>' + '/bind/bind',
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

</script>
</body>
</html>