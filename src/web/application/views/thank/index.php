<div class="app-desc think-list">
    <div style="position: relative;" class="">
        <img style="width: 100%;border-bottom:1px solid #e5e5e5"  src="<?= $banner['pic'] ?>" alt="">
        <img style="position: absolute;top: -3px;left: 0;height: .6rem" data-src="/images/ganen.jpg?sdds" src="/images/ganen.jpg?sdds" alt="">
    </div>
    <div class="list-user">
        <ul class="j-flag">
            <!--用户排名列表-->
            <?php foreach($users as $key => $item) { ?>
            <li>
                <div class="list-01 b-num"><?= $key+1 ?></div>
                <div class="list-02 th-list-02">
                    <div style="overflow: hidden;float: left;width: 20%;text-align: center;">
                        <?php if ($key == 0) { ?>
                            <p class="cover no-1">
                        <?php } elseif ($key == 1) { ?>
                            <p class="cover no-2">
                        <?php } elseif ($key == 2) { ?>
                            <p class="cover no-3">
                        <?php } else { ?>
                            <p class="cover">
                        <?php } ?>
                            <img src="<?= $item['headimgurl'] ?>" width="50">
                        </p>
                        <a><?= $item['nickname'] ?></a>
                    </div>
                    <p class="desc" style="padding-top: 20px;"><?= $item['13'] ?></p>
                    <p class="liwu-num" style="padding-top: 0"><span>x</span><?= $item['product_num'] ?></p>
                    <p class="liwu" style="padding-top: 0;line-height: 100px;"><img src="<?= $item['main_pic'] ?>" width="30"></p>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div class="myge fixbot"><input type="button" value=""></div>
    <div id="Popup" style="display:none;">
        <div id="close" style="width: 100%;height: 100%;background-color: rgba(0,0,0,0.5);"></div>
        <div class="liwu-box">
            <div class="liwu-list multipleColumn" id="leftTabBox">
                <div class="bd">
                    <div class="ulWrap j-flag">
                        <?php foreach($gifts as $gs) { ?>
                            <ul class="">
                                <?php foreach($gs as $g) { ?>
                                <li >
                                    <p class="img"><img src="<?= $g['main_pic'] ?>" width="100%"></p>
                                    <p class="jine">¥<?= $g['cur_price'] ?></p>
                                    <p class="j-cur" data-pid="<?= $g['id'] ?>" data-price="<?= $g['price'] ?>"></p>
                                </li>                       <!--礼物列表-->
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
                <div class="hd">
                    <ul></ul>
                </div>
            </div>
            <div class="zs fn-clear"><!--
                    <div style="float: left">
                        <span class="close" id="cboxClose">
<span style="height: 40px;background: #A9A9A9;border: 0px;color: #ffffff;font-size: 18px;border-radius: 4px;">关闭</span>
                        </span>
                    </div>-->
                <div style="float: right">
                    <span class="jian">-</span><span class="shu"><input id="gift_nums" type="text" value="1" name=""
                                                                        class="number"></span><span
                        class="jia">+</span><span class="zs-btn">
                        <img id="dogift" width="80" height="40" src="/images/zs.png" alt="赠送">
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/javascript/lib/nej/define.js?p=wk|td-1&pro=/javascript/"></script>
<script>
    NEJ.define([
        'base/element',
        'pro/cache/club_news',
        'base/event',
        'base/util',
        'pro/vendor/zepto',
        'pro/vendor/layer',
        'pro/vendor/touchsilde'
    ], function (elem, cn, event, u ,_p, _pro) {
        $(".myge").click(function () {
            $("#Popup").show();//tempWrap
            TouchSlide({
                slideCell: "#leftTabBox",
                titCell: ".hd ul", // 开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
                mainCell: ".bd .ulWrap",
                effect: "left",
                autoPlay: false, // 自动播放
                autoPage: true, // 自动分页
                delayTime: 200, // 毫秒；切换效果持续时间（执行一次效果用多少毫秒）
                interTime: 2500, // 毫秒；自动运行间隔（隔多少毫秒后执行下一个效果）
                switchLoad: "_src" // 切换加载，真实图片路径为"_src"
            });

            // var h=$(".ulWrap ul li").height();
            // $(".ulWrap ul li .focus").height((h*1.167)-7.67);
            // $(window).resize(function(){
            //
            //     h=$(".ulWrap ul li").height();
            //     $(".ulWrap ul li .focus").height((h*1.167)-7.67);
            // })

            $(".ulWrap ul li").click(function () {
                $(".ulWrap ul li .j-cur").removeClass('focus').hide();
                $(this).find(".j-cur").addClass('focus').show();
            })
        });

        $("#close").click(function (event) {
            $("#Popup").hide();
        });
        $(".jia").click(function () {
            var n = $(".number").val();
            $(".number").val(parseInt(n) + 1);

        });

        $(".jian").click(function () {

            var n = $(".number").val();

            if (n == 1) {
                $(".number").val(1);
                return;

            }
            $(".number").val(parseInt(n) - 1);

        })
        $(".number").keyup(function () {

            var n = $(".number").val();
            if (isNaN(n)) {//不是数字
                $(this).val(1);

            } else {
                if (n == 0) {
                    $(this).val(1);
                }
            }

        });
        event._$addEvent('dogift', 'click', function (e) {
            var gift_nums = elem._$get('gift_nums').value;
            var gift = elem._$dataset(elem._$getByClassName('Popup', 'focus')[0], 'pid');
            if (!!gift && !!gift_nums) {
                window.location.href = '/thank/gift?pid=' + gift + '&nums=' + gift_nums;
            } else {
                layer.alert('请先选择要赠送的礼物!')
            }
        });
    });
</script>