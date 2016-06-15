<!-- @NOPARSE -->
<script type="text/javascript" src="http://cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script type="text/javascript" src="http://7xrote.com2.z0.glb.qiniucdn.com/layer.mobile.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<!-- /@NOPARSE -->
<div style="text-align: center; margin-top: 45%;">
    <img src="/images/loading.gif">
    <br>
    <span>请稍后，正在支付！</span>
</div>
<!-- @NOPARSE -->
<script>
    wx.config({
        appId: '<?= $js_sign['appid']?>',
        timestamp: <?= $js_sign['timestamp']?>,
        nonceStr: '<?= $js_sign['noncestr']?>',
        signature: '<?php echo $js_sign['signature']?>',
        jsApiList: [
            'checkJsApi',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
            'scanQRCode'
        ]
    });

    wx.ready(function () {
//        wx.scanQRCode({
//            needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
//            scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
//            success: function (res) {
//            }
//        });

        function wx_pay(res,order_sn)
        {
            WeixinJSBridge.invoke('getBrandWCPayRequest',{
                "appId":res.appId,
                "timeStamp":res.timeStamp,
                "nonceStr":res.nonceStr,
                "package":res.package,
                "signType":res.signType,
                "paySign":res.paySign
            },function(data){
                if(data.err_msg == "get_brand_wcpay_request:ok" ) {
                    setInterval(function(){check_pay(order_sn)},1000);
                } else {
                    layer.alert("支付未完成",function(){
                        history.back();
                    });
                    //取消订单
                }
            });
        }

        function check_pay(order_sn){
            $.post('/order/checkpay/sn/'+order_sn +'?'+Math.random(), function(res){
                layer.load('处理中...');
                if(res.status == 0)
                {   //俱乐部产品 1：加入俱乐部 2：礼物 3：普通产品
                    if (res.type == 1){
                        window.location.href = '/#/m/founder-my/edit-name/';
                    } else if(res.type == 2) {
                        window.location.href = '/#/m/thankgiving/';
                }
                    else {
                        history.back();
                    }
                }
            },'json');
        }

        wx_pay($.parseJSON('<?= $pay_info ?>'), '<?= $sn ?>');
    });

    wx.error(function (res) {
        alert('wx.error: '+JSON.stringify(res));
    });
</script>
<!-- /@NOPARSE -->
