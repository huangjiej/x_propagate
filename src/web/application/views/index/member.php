<div class="weui_search_bar" id="search_bar">
    <form action="" method="get"  class="weui_search_outer">
        <div class="weui_search_inner">
            <i class="weui_icon_search"></i>
            <input type="search" name="search" class="weui_search_input" id="search_input" placeholder="搜索" value="<?= empty($search) ? '' : $search  ?>" required="">
            <a href="javascript:" class="weui_icon_clear" id="search_clear"></a>
        </div>
        <label for="search_input" class="weui_search_text" id="search_text" style="display: none;">
            <i class="weui_icon_search"></i>
            <span>搜索名字或手机号码</span>
        </label>
    </form>
    <a href="javascript:" class="weui_search_cancel" id="search_cancel">取消</a>
</div>

<!--<div class="weui_cells weui_cells_access search_show" id="search_show" style="display: none;margin-top: 0;">
    <div class="weui_cell ">
        <div class="weui_cell_bd weui_cell_primary">
            <p>实时搜索文本</p>
        </div>
    </div>
    <div class="weui_cell">
        <div class="weui_cell_bd weui_cell_primary">
            <p>实时搜索文本</p>
        </div>
    </div>
    <div class="weui_cell">
        <div class="weui_cell_bd weui_cell_primary">
            <p>实时搜索文本</p>
        </div>
    </div>
    <div class="weui_cell">
        <div class="weui_cell_bd weui_cell_primary">
            <p>实时搜索文本</p>
        </div>
    </div>
</div>-->

<!--会员列表-->
<div class="member-list">
    <?php if (empty($members)) { ?>
    <!--普通查询结果-->
        <?php if (empty($result)) { ?>
            <p>没有找到！</p>
        <?php } else { ?>
            <?php foreach ($result as $item) { ?>
                <a class="member" href="<?= U('member/report', ['wx_id'=>$item['wx_id']], $domain=true) ?>">
                    <div class="table ">
                        <div class="table-cell-left">
                            <span><img class="member-header" src="<?= $item['headimgurl'] ?>" alt=""></span>
                            <span class="member-name"><?= $item['name'] ?></span>
                        </div>
                        <div class="table-cell-right">
                            <div class="ui-label-list">
                                <label class="ui-label-s">体重:<?= $item['weight'] / 2 ?>KG</label>
                                <label class="ui-label-s">体脂率:<?= $item['fat'] ?>%</label>
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?>
        <?php } ?>
    <?php } else {  ?>
    <!--搜索结果-->
        <?php if (empty($members)) { ?>
            <p>暂时没有会员加入！</p>
        <?php } else { ?>
            <?php foreach ($members as $item) { ?>
                <a class="member" href="<?= U('member/report', ['wx_id'=>$item['wx_id']], $domain=true) ?>">
                    <div class="table ">
                        <div class="table-cell-left">
                            <span><img class="member-header" src="<?= $item['headimgurl'] ?>" alt=""></span>
                            <span class="member-name"><?= $item['name'] ?></span>
                        </div>
                        <div class="table-cell-right">
                            <div class="ui-label-list">
                                <label class="ui-label-s">体重:<?= $item['weight'] / 2 ?>KG</label>
                                <label class="ui-label-s">体脂率:<?= $item['fat'] ?>%</label>
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?>
        <?php } ?>
    <?php } ?>
</div>

<a href="/index/addmember" style="width: 100%;padding: 0;left: 0;right: 0;bottom: 0.001rem;" class="fixbot"><img src="/images/添加新会员.png" alt=""></a>
<script src="/javascript/vendor/zepto.js"></script>
<script>
    $('body').on('focus', '#search_input', function () {
        var $weuiSearchBar = $('#search_bar');
        $weuiSearchBar.addClass('weui_search_focusing');
    }).on('blur', '#search_input', function () {
        var $weuiSearchBar = $('#search_bar');
        $weuiSearchBar.removeClass('weui_search_focusing');
        if ($(this).val()) {
            $('#search_text').hide();
        } else {
            $('#search_text').show();
        }
    }).on('input', '#search_input', function () {
//        var $searchShow = $("#search_show");
//        if ($(this).val()) {
//            $searchShow.show();
//        } else {
//            $searchShow.hide();
//        }
    }).on('touchend', '#search_cancel', function () {
        //$("#search_show").hide();
        $('#search_input').val('');
    }).on('touchend', '#search_clear', function () {
        //$("#search_show").hide();
        $('#search_input').val('');
    });
</script>


