<section class="main padb110">
    <div class="class-info">
        <div class="info-tit"><?=$item['title']?></div>
        <?=$item['content']?>
    </div>
</section>
<div class="footbar clear">
    <a href="javascript:;" data-toggle="share-btn" ><i class="ico i-share2"></i></a>
</div>
<block name="script">
    <script type="text/javascript">
        wx.onMenuShareTimeline({
            title: '<?=$item['title']?>', // 分享标题
            link: window.location.href, // 分享链接
            imgUrl: '', // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
                //调用分享接口
                $.ajax({url:<?=U('article/share',['articleid'=>$item['id']])?>});

            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
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