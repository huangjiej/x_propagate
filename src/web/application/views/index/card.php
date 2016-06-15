<link rel="stylesheet" href="/style/reset.css">
<link rel="stylesheet" href="/style/main.css">
<!-- @NOPARSE -->
<script type="text/javascript" src="http://cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script type="text/javascript" src="http://7xrote.com2.z0.glb.qiniucdn.com/layer.mobile.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<!-- /@NOPARSE -->
<article class="vcard">
    <section style="margin: .3rem;border: 1px solid #e5e5e5;border-radius: .1rem;">
        <div class="my-card-img" style="background: #fff;border-radius: .1rem;">
            <img style="border-radius: .1rem;" width="100%" src="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=<?= $club['qr_code'] ?>" class="avtar">
            <p style="text-align: center;font-size: .29rem;">长按二维码识别，加入我的俱乐部吧!</p>
        </div>
    </section>
    <section style="margin: .3rem;border: 1px solid #e5e5e5;border-radius: .1rem;border-bottom: none;">
        <div class=" txt1">
            <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg">
                <div class="weui_media_hd">
                    <img class="weui_media_appmsg_thumb" src="<?= $club['headimgurl'] ?>" alt="">
                </div>
                <div class="weui_media_bd">
                    <h4 style="font-size: .29rem;" class="weui_media_title"><?= $club['club_name'] ?></h4>
                    <h3 style="font-size: .29rem;" class="weui_media_title">教练：<?= $club['nickname'] ?></h3>
                </div>
            </a>
            <div style="padding: 15px;font-size: .24rem;">
                <?= $club['description'] ?>
            </div>
        </div>
        <div class="box2 form">
            <ul style="margin-top: 0;border-bottom-right-radius: 0.1rem;
    border-bottom-left-radius: 0.1rem;">
                <li>
                    <a href="javascript:;">
                        <div class="lab" style="font-size: .29rem">联系电话</div>
                        <div class="value" style="font-size: .24rem;"><a href="tel:<?= $club['mobile'] ?>"><?= $club['mobile'] ?><img style="width: .4rem;margin-right: 10px;margin-left: 10px;" src="/images/mobile.png" alt=""></a></div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <div class="lab"  style="font-size: .29rem">微信号</div>
                        <div class="value" style="font-size: .24rem;"><p style="margin-right: 10px;"><?= $club['wx'] ?></p></div>
                    </a>
                </li>
            </ul>
        </div>
    </section>
</article>

<block name="script">
    <!-- @NOPARSE -->
    <script>
        var images = {localId: [], serverId: []};
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
                title: '<?= $club["club_name"] ?>', // 分享标题
                link: '<?= DOMAIN . "/index/card?id=" . $club["wx_id"] ?>', // 分享链接
                imgUrl: '<?= $club["headimgurl"] ?>', // 分享图标
                desc: '<?= $club["description"] ?>', // 分享描述
                success: function () {
                    // 用户确认分享后执行的回调函数
                    layer.alert('分享成功');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });

            wx.onMenuShareAppMessage({
                title: '<?= $club["club_name"] ?>', // 分享标题
                desc: '<?= $club["description"] ?>', // 分享描述
                link: '<?= DOMAIN . "/index/card?id=" . $club["wx_id"] ?>', // 分享链接// 分享链接
                imgUrl: '<?= $club["headimgurl"] ?>', // 分享图标
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
                title: '<?= $club["club_name"] ?>', // 分享标题
                desc: '<?= $club["description"] ?>', // 分享描述
                link: '<?= DOMAIN . "/index/card?id=" . $club["wx_id"] ?>', // 分享链接
                imgUrl: '<?= $club["headimgurl"] ?>', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    layer.alert('分享成功');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });

            wx.onMenuShareWeibo({
                title: '<?= $club["club_name"] ?>', // 分享标题
                desc: '<?= $club["description"] ?>', // 分享描述
                link: '<?= DOMAIN . "/index/card?id=" . $club["wx_id"] ?>', // 分享链接
                imgUrl: '<?= $club["headimgurl"] ?>', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    layer.alert('分享成功');
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });

            wx.onMenuShareQZone({
                title: '<?= $club["club_name"] ?>', // 分享标题
                desc: '<?= $club["description"] ?>', // 分享描述
                link: '<?= DOMAIN . "/index/card?id=" . $club["wx_id"] ?>', // 分享链接
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
    <!-- /@NOPARSE -->
</block>