<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title><?= isset($meta_title) ? $meta_title.' - ' : ''?>土筑虎</title>
    <link rel="stylesheet" href="/style/reset.css">
    <link rel="stylesheet" href="/style/main.css">
    <link rel="stylesheet" href="/style/weui.css">
    <block name="style"></block>
</head>

<body ontouchstart>

<block name="header">
    <?php if(isset($title)):?>
        <header class="header">
            <a href="<?=(isset($back_url) ? $back_url : 'javascript:back();')?>" class="back"><i class="ico i-back"></i></a>
            <div class="txt"><?=$title?></div>
        </header>
    <?php endif;?>
</block>

<?php echo $content?>


    <script type="text/javascript" src="/js/jquery.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript" src="/js/swiper.min.js"></script>
    <script type="text/javascript">

        wx.config({
            debug: false,
            appId: '<?= $js_sign['appid']?>',
            timestamp: <?= $js_sign['timestamp']?>,
            nonceStr: '<?= $js_sign['noncestr']?>',
            signature: '<?= $js_sign['signature']?>',
            jsApiList: [
                'checkJsApi',
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
                'onMenuShareQQ',
                'onMenuShareWeibo',
                'onMenuShareQZone',
                'hideMenuItems',
                'showMenuItems',
                'hideAllNonBaseMenuItem',
                'showAllNonBaseMenuItem',
                'translateVoice',
                'startRecord',
                'stopRecord',
                'onVoiceRecordEnd',
                'playVoice',
                'onVoicePlayEnd',
                'pauseVoice',
                'stopVoice',
                'uploadVoice',
                'downloadVoice',
                'chooseImage',
                'previewImage',
                'uploadImage',
                'downloadImage',
                'getNetworkType',
                'openLocation',
                'getLocation',
                'hideOptionMenu',
                'showOptionMenu',
                'closeWindow',
                'scanQRCode',
                'chooseWXPay',
                'openProductSpecificView',
                'addCard',
                'chooseCard',
                'openCard'
            ]
        });
    </script>
<block name="script">
</block>
</body>
</html>
