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
<div style="text-align: center;margin-top: 0.3rem;font-size: 16px">
手机号<?=$mobile?>已与微信绑定成功<br>现在可以点击左上角退出
    </div>

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