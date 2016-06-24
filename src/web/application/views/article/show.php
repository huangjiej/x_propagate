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
            localhref=localhref+"?x_articleId=<?=$item['id']?>&x_reader=<?=$user['openid']?>";
        }else{
            localhref=localhref+"&x_articleId=<?=$item['id']?>&x_reader=<?=$user['openid']?>";
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
        wx.onMenuShareAppMessage({
            title: '<?=$item['title']?>',
            desc: '在长大的过程中，我才慢慢发现，我身边的所有事，别人跟我说的所有事，那些所谓本来如此，注定如此的事，它们其实没有非得如此，事情是可以改变的。更重要的是，有些事既然错了，那就该做出改变。',
            link: localhref,
            imgUrl: 'http://demo.open.weixin.qq.com/jssdk/images/p2166127561.jpg',
            trigger: function (res) {
                // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回

            },
            success: function (res) {
                $.ajax({url:"xp.fengniao.info/article/share",data:<?=$item['id']?>, success: function(){
                    $(this).addClass("done");
                }});
            },
            cancel: function (res) {
            },
            fail: function (res) {
                alert(JSON.stringify(res));
            }
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