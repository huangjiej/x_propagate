<!-- @NOPARSE -->
<script type="text/javascript" src="http://cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script type="text/javascript" src="http://7xrote.com2.z0.glb.qiniucdn.com/layer.mobile.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<!-- /@NOPARSE -->
<form id="post-form" method="post" action="">
    <div class="weui_cells_title">新增俱乐部动态</div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">标题</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input name="title" class="weui_input" type="text" placeholder="请输入标题">
            </div>
        </div>
    </div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <div class="weui_uploader">
                    <div class="weui_uploader_hd weui_cell">
                        <div class="weui_cell_bd weui_cell_primary">上传封面</div>
                        <div class="weui_cell_ft"></div>
                    </div>
                    <div class="weui_uploader_bd">
                        <ul class="weui_uploader_files">
                            <li class="weui_uploader_file" style="background-image:url(/images/place79&79.png)"></li>
                        </ul>
                        <div class="weui_uploader_input_wrp">
                            <div class="weui_uploader_input" type="text"></div>
                            <input type="hidden" name="cover_id" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <textarea name="content" class="weui_textarea" placeholder="请输入内容" rows="3"></textarea>
                <div class="weui_textarea_counter"></div>
            </div>
        </div>
    </div>
    <input type="hidden" name="cid" value="<?= $cid ?>">
    <div class="weui_btn_area">
        <a class="weui_btn weui_btn_primary" href="javascript:" id="post-new">确定</a>
    </div>
</form>
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
                'chooseImage',
                'previewImage',
                'uploadImage',
                'downloadImage'
            ]
        });

        function chooseImage() {
            wx.chooseImage({
                count: 1, // 默认9
                sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                sourceType: ['album'], // 可以指定来源是相册还是相机，默认二者都有
                success: function (res) {
                    if (res.errMsg == 'chooseImage:ok') {
//                    if (res.localIds.length != 1) {
//                        layer.alert('只能上传一张图片');
//                        return;
//                    }
                        $('.weui_uploader_file').css('background-image', 'url(' + res.localIds[0] + ')');
                        images.localId = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                        wx.uploadImage({
                            localId: images.localId[0], // 需要上传的图片的本地ID，由chooseImage接口获得
                            isShowProgressTips: 1, // 默认为1，显示进度提示
                            success: function (res) {
                                if (res.errMsg = 'uploadImage:ok') {
                                    $.ajax({
                                        type: "POST",
                                        url: '<?=DOMAIN?>' + '/api/index/upload',
                                        data: {id: res.serverId}, // 返回图片的服务器端ID
                                        success: function (data) {
                                            if (data.status > 0) {
                                                layer.alert(data.msg);
                                            } else {
                                                $('input[name=cover_id]').val(data.img_url);
                                            }
                                        },
                                        dataType: 'json'
                                    });
                                }
                                else {
                                    layer.alert('上传到微信服务器失败，请重新选择图片')
                                }
                            }
                        });
                    } else {
                        //加载选择图片js sdk失败
                        layer.alert(res.errMsg);
                    }

                }
            });
        }

        $('.weui_uploader_input').click(function (event) {
            event.preventDefault()
            chooseImage()
        });


        wx.error(function (res) {
            alert('wx.error: '+JSON.stringify(res));
        });

        $('#post-new').click(function () {
            var success  = true;

            if ($('input[name=title]').val() == '') {
                layer.alert('标题不能为空');
                success = false;
            }

            if ($('input[name=cover_id]').val() == '') {
                layer.alert('封面不能为空');
                success = false;
            }

            if ($('textarea[name=content]').val() == '') {
                layer.alert('内容不能为空');
                success = false;
            }

            if (success) {
                $.ajax({
                    type: 'POST',
                    url: '<?=DOMAIN?>' + '/api/index/addclubtwitter',
                    data: $('#post-form').serialize(),
                    success: function (data) {
                        if (data.status > 0) {
                            layer.alert(data.msg);
                        } else {
                            window.location.href = ('/index/clubnews');
                        }
                    },
                    dataType: 'json'
                });
            }
        });
    </script>
    <!-- /@NOPARSE -->
</block>