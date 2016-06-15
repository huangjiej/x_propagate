<div class="page">
    <div class="weui_msg">
        <div class="weui_icon_area"><i class="weui_icon_success weui_icon_msg"></i></div>
        <div class="weui_text_area">
            <h2 class="weui_msg_title">提示</h2>
            <p class="weui_msg_desc"><?=$message?></p>
        </div>
        <?php if(!empty($jumpUrl)):?>
            <div class="weui_opr_area">
                <p class="weui_btn_area">
                    <a href="<?=$jumpUrl?>" class="weui_btn weui_btn_primary"><?=isset($data['btn_text']) ? $data['btn_text'] : '返回'?></a>
                </p>
            </div>
        <?php endif;?>    
</div>
</div>
<?php if(!empty($jumpUrl)):?>
    <block name="script">
        <!-- @NOPARSE -->
        <script>
            setTimeout(function(){
                window.location = '<?=$jumpUrl?>';
            },<?=$waitSecond*1000?>);
        </script>
        <!-- /@NOPARSE -->
    </block>
<?php endif;?>
