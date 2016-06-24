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
    <script src="/js/propagate.js"></script>
    <script type="text/javascript">
        var localhref=window.location.href;
        var arr=localhref.split('?');
        if(!arr[1]){
            localhref=localhref+"?x_articleId=<?=$item['id']?>&x_reader=<?=$userinfo['openid']?>";
        }else{
            localhref=localhref+"&x_articleId=<?=$item['id']?>&x_reader=<?=$userinfo['openid']?>";
        }
        localhref=add4share(localhref);
        sendUserInfo(<?=$user?>);
        wx.onMenuShareTimeline({
            title: '<?=$item['title']?>', // 分享标题
            link: localhref, // 分享链接
            imgUrl: '', // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
                //调用分享接口


               /* $.ajax({url:<?=U('article/share',['articleid'=>$item['id']])?>, success: function(){
                    $(this).addClass("done");
                }});*/
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
                alert(JSON.stringify(res));
            }
        });
        wx.ready(function () {
            wx.onMenuShareTimeline({
                title: '<?=$item['title']?>', // 分享标题
                link: localhref, // 分享链接
                imgUrl: '', // 分享图标
                desc: '', // 分享描述
                success: function () {
                    // 用户确认分享后执行的回调函数
                    layer.alert('分享成功');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });

            wx.onMenuShareAppMessage({
                title: '<?=$item['title']?>', // 分享标题
                desc: '', // 分享描述
                link: localhref, // 分享链接// 分享链接
                imgUrl: '', // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () {
                    // 用户确认分享后执行的回调函数
                    layer.alert('分享成功');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });

            wx.onMenuShareQQ({
                title: '<?=$item['title']?>', // 分享标题
                desc: '', // 分享描述
                link: localhref, // 分享链接
                imgUrl: '', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    layer.alert('分享成功');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });

            wx.onMenuShareWeibo({
                title: '<?=$item['title']?>', // 分享标题
                desc: '', // 分享描述
                link: localhref, // 分享链接
                imgUrl: '', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    layer.alert('分享成功');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });

            wx.onMenuShareQZone({
                title: '<?=$item['title']?>', // 分享标题
                desc: '', // 分享描述
                link: localhref, // 分享链接
                imgUrl: '', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    layer.alert('分享成功');
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
</block>
<block name="style">
    <link rel="stylesheet" type="text/css" href="/css/swiper.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="/css/reset.css"/>
    <style>
        .class-info img{ width: 100%;}
    </style>
</block>