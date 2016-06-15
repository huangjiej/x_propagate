<extend name="Public/base" />

<block name="body">
    <div class="alert alert-danger">
        第一次登录系统，需要先设置用户密码！
    </div>
        <?php
        echo ace_form_open();
        $options = array(
            'label_text'=>'新密码',
            'icon'=>'icon-key'
        );
        echo ace_password($options ,array('name'=>'password','autocomplete'=>'off'));

        $options = array(
            'label_text'=>'确认密码',
            'icon'=>'icon-retweet'
        );
        echo ace_password($options ,array('name'=>'repassword','autocomplete'=>'off'));

        echo ace_srbtn();
        echo ace_form_close()
       ?>
</block>

<block name="script">
	<script>
        highlight_subnav('{:U('User/updatepassword')}');
    </script>
</block>
