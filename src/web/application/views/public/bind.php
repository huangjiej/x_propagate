<div class="page">
    <div class="hd">
        <h1 class="page_title">绑定运营账号</h1>
    </div>

    <div class="weui_cells_title">运营人员第一次使用本系纺，需要进行账号绑定！</div>

    <form action="<?=U('/public/bind')?>" method="post" class="ajax-form">
        <div class="weui_cells weui_cells_form">
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">用户名</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" type="text" name="username" placeholder="请输入用户名"/>
                </div>
            </div>
            <div class="weui_cell">
                <div class="weui_cell_hd"><label class="weui_label">密码</label></div>
                <div class="weui_cell_bd weui_cell_primary">
                    <input class="weui_input" type="password" name="password" placeholder="请输入用户密码"/>
                </div>
            </div>
        </div>
        <div class="weui_cells_tips"></div>
        <div class="weui_btn_area">
            <button class="weui_btn weui_btn_primary" type="submit">确定</button>
        </div>
    </form>
</div>