<article class="person">
    <form id="form" action="" method="post">
        <div class="box2 form mart20 j-flag">
            <div class="weui_cells_title">请填写俱乐部信息</div>
            <div class="weui_cells weui_cells_form">
                <div class="weui_cell">
                    <div class="weui_cell_hd"><label style="font-size: .24rem" class="weui_label">俱乐部名称：</label></div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <input name="club_name" style="font-size: .24rem" id="club_name" type="text" value="<?= $club['club_name'] ?>"
                               class="weui_input" placeholder="请输入俱乐部名称">
                    </div>
                </div>
            </div>

            <div class="weui_cells weui_cells_form">
                <div class="weui_cell">
                    <div class="weui_cell_hd"><label style="font-size: .24rem" class="weui_label">微信号：</label></div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <input name="wx" style="font-size: .24rem" id="wx" value="<?= $club['wx'] ?>" class="weui_input"
                               type="text" placeholder="请输入您的微信号">
                    </div>
                </div>
            </div>

            <div class="weui_cells weui_cells_form">
                <div class="weui_cell">
                    <div class="weui_cell_hd"><label style="font-size: .24rem" class="weui_label">手机：</label></div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <input name="mobile" style="font-size: .24rem" id="mobile" value="<?= $club['mobile'] ?>" class="weui_input"
                               type="number" pattern="[0-9]*" placeholder="请输入您的手机号">
                    </div>
                </div>
            </div>

            <div class="weui_cells weui_cells_form">
                <div class="weui_cell">
                    <div class="weui_cell_bd weui_cell_primary">
                        <textarea name="description" id="desc" style="font-size: .24rem" class="weui_textarea" placeholder="请输入描述"
                                  rows="3"><?= $club['description'] ?></textarea>
                    </div>
                </div>
            </div>

            <div class="weui_btn_area" id="dopost">
                <input value="确认" type="submit" class="weui_btn weui_btn_warn" id="showTooltips" />
            </div>
        </div>
    </form>
</article>
<script type="text/javascript" src="/javascript/lib/nej/define.js?p=wk|td-1&pro=/javascript/"></script>
<script>
    define([
        'base/element',
        'base/event',
        'util/ajax/xdr',
        'pro/vendor/zepto',
        'pro/vendor/layer'
    ], function (elem, event, ajax) {
        event._$addEvent('showTooltips', 'click', function (e) {
            if (elem._$get('club_name').value.length < 1) {
                layer.alert('俱乐部名称不能为空');
                event._$stopDefault(e);
            }

            if (elem._$get('wx').value.length < 1) {
                layer.alert('请输入您的微信号');
                event._$stopDefault(e);
            }

            if (elem._$get('mobile').value.length != 11) {
                layer.alert('请输入正确的手机号码');
                event._$stopDefault(e);
            }

            if (elem._$get('desc').value.length < 1) {
                layer.alert('俱乐部说明不能为空');
                event._$stopDefault(e);
            }
        });
    })
</script>