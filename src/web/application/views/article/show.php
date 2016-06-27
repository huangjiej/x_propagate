<section class="main padb110">
    <div class="class-info">
        <div class="info-tit"><a href="<?=U('/propagate/index',['articleid'=>$item['id']])?>"><?=$item['title']?></a></div>
        <?=$item['content']?>
    </div>
</section>
<div class="footbar clear">
    <a href="javascript:;" data-toggle="share-btn" ><i class="ico i-share2"></i></a>
</div>
<block name="script">
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="http://112.124.6.88:8099/if/js/propagate.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <!-- @NOPARSE -->
    <script>

        var userinfoParam = "openid=<?=$userinfo['openid']?>&nickname=<?=$userinfo['nickname']?>&language=<?=$userinfo['language']?>&unionid=<?=$userinfo['unionid']?>&province=<?=$userinfo['province']?>&city=<?=$userinfo['city']?>&country=<?=$userinfo['country']?>&headimgurl=<?=$userinfo['headimgurl']?>&Ticket=<?=$userinfo['qr_ticket']?>&tagidist=";
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
            wx.onMenuShareTimeline({
                title: sharehref, // 分享标题
                link: sharehref, // 分享链接
                imgUrl: '', // 分享图标
                desc: sharehref, // 分享描述
                success: function () {
                    // 用户确认分享后执行的回调函数
                    //layer.alert('分享成功');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });

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
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });

            wx.onMenuShareQQ({
                title: sharehref, // 分享标题
                desc: sharehref, // 分享描述
                link: sharehref, // 分享链接
                imgUrl: '', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    //layer.alert('分享成功');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });

            wx.onMenuShareWeibo({
                title: sharehref, // 分享标题
                desc: sharehref, // 分享描述
                link: sharehref, // 分享链接
                imgUrl: '', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    //layer.alert('分享成功');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });

            wx.onMenuShareQZone({
                title: sharehref, // 分享标题
                desc: sharehref, // 分享描述
                link: sharehref, // 分享链接
                imgUrl: '', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    //layer.alert('分享成功');
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