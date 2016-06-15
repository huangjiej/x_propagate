<script>
    /*global Qiniu */
    /*global plupload */
    /*global FileProgress */
    /*global hljs */
    <?php
    $upload_config = C('PICTURE_UPLOAD');
    $qiniu_config = C('UPLOAD_QINIU_CONFIG');
    ?>
    $(function() {

        $.getJSON('<?=U('/file/picToken')?>',function(resp){
            Qiniu.token = resp.uptoken;
        });

        $.fn.pic_upload = function() {
            this.each(function(){
                var target, id;

                target = $(this);
                id = target.attr('id');

                target.after('<input id="'+target.attr('name')+'" name="'+target.attr('name')+'" value="'+target.attr('val')+'" type="hidden" />');

                if (!id) {
                    id = plupload.guid();
                    target.attr('id', id);
                }

                var uploader = Qiniu.uploader({
                    runtimes: 'html5,flash,html4',
                    browse_button: id,
                    max_file_size : '<?=$upload_config['maxSize']?>', //最大上传
                    filters: {
                        mime_types : [ //允许上传文件后辍
                            { title : "Image files", extensions : "<?=$upload_config['exts']?>" }
                        ]
//                        ,
//                        prevent_duplicates : true //不允许选取重复文件
                    },
                    flash_swf_url: '__STATIC_/plupload/Moxie.swf',
                    dragdrop: true,
                    chunk_size: '4mb',
                    uptoken_url: '<?=U('/file/picToken')?>',
                    domain: 'http://<?=$qiniu_config['domain']?>/',
                    get_new_uptoken: false,
                    downtoken_url: '<?=U('/file/downToken')?>',
                    unique_names: true,
                    multi_selection:false,
                    auto_start: true,
                    init: {
                        'FilesAdded': function(up, files) {
                        },
                        'BeforeUpload': function(up, file) {
                            target.hide().before(
                                '<div class="progress progress-striped">' +
                                    '<div class="progress-bar progress-bar-success" style="width: 0%;"></div>' +
                                    '<span class="red cancel glyphicon glyphicon-remove-sign bigger-130" style="position: absolute; right: 0;"></span>'+
                                '</div>');

                            target.prev().find('.cancel').click(function(){
                                target.show().prev().remove();
                                up.removeFile(file);
                            })
                        },
                        'UploadProgress': function(up, file) {
                            target.prev().find('.progress-bar')
                                .css('width',file.percent + '%');
                        },
                        'UploadComplete': function() {
                            target.show().prev().remove();
                        },
                        'FileUploaded': function(up, file, info) {
                            target.next().val(Qiniu.getUrl(info.key));
                            $.post(up.settings.downtoken_url,{
                                source:Qiniu.imageView2({mode:1,w:120,h:120},info.key)
                            },function(resp){
                                var parent = target.closest('.upload-wrap');
                                if(parent.find('img').length == 0){
                                    parent.append('<div class="preview"><img src="'+resp.source+'" ></div>');
                                }else{
                                    parent.find('img').attr('src',resp.source);
                                }

                            },'json');
                        },
                        'Error': function(up, err, errTip) {
                            layer.alert(errTip);
                            target.show().prev().remove();
                        }
                    }
                });

            });
        }

        $('.pic-upload').pic_upload();
    });
</script>