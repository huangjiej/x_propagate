<div class="ui-tab">
    <ul class="ui-tab-nav ui-border-b">
        <li>减重排行</li>
        <li>减脂排行</li>
    </ul>
    <ul class="ui-tab-content" style="width:300%">
        <li>
            <div class="new-split"></div>
            <!--当前会员的情况-->
            <a class="hlist table" style="border: none;" href="">
                <div class="table-cell-left hlist-num"></div>
                <div class="table-cell-left hlist-img">
                    <img class="hlist-header" src="<?= $user['headimgurl'] ?>" alt="">
                </div>
                <div class="table-cell-left">
                    <p class="hlist-name"><?= $user['nickname'] ?></p>
                    <p class="hlist-name" style="color: #808080;">第<?= $mydata['weight_position'] ?>名</p>
                </div>
                <div class="table-cell-right">
                    <p style="color: #ffb622;"><?= $mydata['minus_weight'] ?>%</p>
                </div>
            </a>
            <div class="new-split"></div>

            <!--排行榜-->
            <?php foreach ($weights as $k => $itm) { ?>
                <a class="hlist table" href="">
                    <div class="table-cell-left hlist-num"><?= $k+1 ?></div>
                    <div class="table-cell-left hlist-img">
                        <img class="hlist-header" src="<?= $itm['headimgurl'] ?>" alt="">
                    </div>
                    <div class="table-cell-left">
                        <p class="hlist-name"><?= $itm['nickname'] ?></p>
                    </div>
                    <div class="table-cell-right">
                        <p><?= $itm['minus_weight'] ?>%</p>
                    </div>
                </a>
            <?php } ?>
        </li>
        <li>
            <div class="new-split"></div>
            <!--当前会员的情况-->
            <a class="hlist table" style="border: none;" href="">
                <div class="table-cell-left hlist-num"></div>
                <div class="table-cell-left hlist-img">
                    <img class="hlist-header" src="<?= $user['headimgurl'] ?>" alt="">
                </div>
                <div class="table-cell-left">
                    <p class="hlist-name"><?= $user['nickname'] ?></p>
                    <p class="hlist-name" style="color: #808080;">第<?= $mydata['fat_position'] ?>名</p>
                </div>
                <div class="table-cell-right">
                    <p style="color: #ffb622;"><?= $mydata['minus_fat'] ?>%</p>
                </div>
            </a>
            <div class="new-split"></div>

            <!--排行榜-->
            <?php foreach ($fats as $k => $itm) { ?>
                <a class="hlist table" href="">
                    <div class="table-cell-left hlist-num"><?= $k+1 ?></div>
                    <div class="table-cell-left hlist-img">
                        <img class="hlist-header" src="<?= $itm['headimgurl'] ?>" alt="">
                    </div>
                    <div class="table-cell-left">
                        <p class="hlist-name"><?= $itm['nickname'] ?></p>
                    </div>
                    <div class="table-cell-right">
                        <p><?= $itm['minus_fat'] ?>%</p>
                    </div>
                </a>
            <?php } ?>

        </li>

    </ul>
</div>




<script src="/javascript/vendor/zepto.js"></script>
<script src="/javascript/vendor/frozen.js"></script>
<script>
    (function (){
        var tab = new fz.Scroll('.ui-tab', {
            role: 'tab',
        });
        <?php if (!empty($tab)) { ?>
        tab.scrollToElement($('.ui-tab-content').children()[<?= $tab ?>]);
        $('.ui-tab-nav').children().each(function (idx, itm) {
            $(itm).removeClass('current');
        });
        $($('.ui-tab-nav').children()[<?= $tab ?>]).addClass('current');
        <?php } ?>
        /* 滑动开始前 */
        tab.on('beforeScrollStart', function(fromIndex, toIndex) {
            console.log(fromIndex,toIndex);// from 为当前页，to 为下一页
        })
    })();
</script>
