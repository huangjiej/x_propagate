<section class="main padb110">
    <div class="class-info">
        <div class="info-tit" style="text-align: center;"><a href="<?=U('/propagate/type3',['articleid'=>$item['id']])?>" style="font-size: 1rem"><?=$item['title']?></a></div>
        <?=$item['content']?>
    </div>
</section>

<block name="script">
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="http://112.124.6.88:8099/if/userRecord/propagate.js?x_articleId=<?=isset($item['id'])?$item['id']:null?>"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <!-- @NOPARSE -->
    <script>

        var userinfoParam = "openid=<?=isset($userinfo['openid'])?$userinfo['openid']:null ?>&nickname=<?=$userinfo['nickname']?>&language=<?=$userinfo['language']?>&unionid=<?=$userinfo['unionid']?>&province=<?=$userinfo['province']?>&city=<?=$userinfo['city']?>&country=<?=$userinfo['country']?>&headimgurl=<?=$userinfo['headimgurl']?>&Ticket=<?=$userinfo['qr_ticket']?>&tagidist=";
        sendUserInfo(userinfoParam);
        //原用户想分享的链接
        var localhref=window.location.href;
        //生成分享链接
        var sharehref=add4share(localhref);
        wx.config({
            appId: '<?=  $js_sign['appid']?>',
            timestamp: <?=  $js_sign['timestamp']?>,
            nonceStr: '<?=  $js_sign['noncestr']?>',
            signature: '<?=  $js_sign['signature']?>',
            jsApiList: [
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
                'onMenuShareQQ',
                'onMenuShareWeibo',
                'onMenuShareQZone'
            ]
        });

        wx.ready(function () {
            //分享到朋友圈
            wx.onMenuShareTimeline({
                title: sharehref, // 分享标题
                link: sharehref, // 分享链接
                imgUrl: '', // 分享图标
                desc: sharehref, // 分享描述
                success: function () {

                    // 用户确认分享后执行的回调函数
                    //layer.alert('分享成功');
                    var shareParam="shareType=MenuShareTimeline";
                    saveShareRecord(shareParam);

                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
            //分享给朋友
            wx.onMenuShareAppMessage({
                title: sharehref, // 分享标题
                desc: sharehref, // 分享描述
                link: sharehref, // 分享链接// 分享链接
                imgUrl: '', // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () {
                    // 用户确认分享后执行的回调函数
                    //layer.alert('分享成功');
                    var shareParam="shareType=MenuShareTimeline";
                    saveShareRecord(shareParam);
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
            //分享到QQ
            wx.onMenuShareQQ({
                title: sharehref, // 分享标题
                desc: sharehref, // 分享描述
                link: sharehref, // 分享链接
                imgUrl: '', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    //layer.alert('分享成功');
                    var shareParam="shareType=MenuShareTimeline";
                    saveShareRecord(shareParam);
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
            //分享到腾讯微博
            wx.onMenuShareWeibo({
                title: sharehref, // 分享标题
                desc: sharehref, // 分享描述
                link: sharehref, // 分享链接
                imgUrl: '', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    //layer.alert('分享成功');
                    var shareParam="shareType=MenuShareTimeline";
                    saveShareRecord(shareParam);
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
            //分享到空间
            wx.onMenuShareQZone({
                title: sharehref, // 分享标题
                desc: sharehref, // 分享描述
                link: sharehref, // 分享链接
                imgUrl: '', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    //layer.alert('分享成功');
                    var shareParam="shareType=MenuShareTimeline";
                    saveShareRecord(shareParam);
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
        });

        wx.error(function (res) {
            alert('wx.error: '+JSON.stringify(res));
        });
    </script>
    <!-- /@NOPARSE -->
</block>
<block name="style">
    <link rel="stylesheet" type="text/css" href="/css/swiper.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="/css/reset.css"/>
    <style>
        .class-info img{ width: 100%;}
    </style>
</block>