<extend name="Public/base" />

<block name="body">
    <!-- 表单 -->
    <style>
        td{width:50%;}
        img{max-width:400px;}
    </style>
    <form action="{:U('')}" class="form-horizontal">
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">俱乐部名称</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="club_name"
                       value="{$item.club_name}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">创始人微信昵称</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100"
                       value="{$item.nickname}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">联系方式</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="mobile"
                       value="{$item.mobile}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">俱乐部二维码</label>
            <div class="col-xs-12 col-sm-6">
                <div class="upload-wrap">
                    <a href="javascript:" class="btn btn-sm btn-success pic-upload" name="qr_code" val="{$item['qr_code']|default=''}" >
                        <i class="icon-cloud-upload "></i>上传图片
                    </a>
                    <notempty name="item['qr_code']">
                        <div class="preview"><img src="<?=imageView2($item['qr_code'],240,240)?>" /></div>
                    </notempty>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">俱乐部描述</label>
            <div class="col-xs-12 col-sm-7">
                <textarea  style="width: 100%;height: 100px;" name="description">{$item.description}</textarea>
            </div>
        </div>

        <if condition="$item.status eq 'WAT'">
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 control-label no-padding-right">审核状态</label>
                <div class="col-xs-12 col-sm-7">
                    <label><input type="radio" checked class="ace" name="status" value="OK#"><span class="lbl">通过&nbsp;</span></label>
                    <label><input type="radio" class="ace" name="status" value="RJT"><span class="lbl">不通过&nbsp;</span></label>
                </div>
            </div>
        </if>

        <hr>

        <div class="clearfix form-actions">
            <div class="col-xs-12">
                <input type="hidden" name="id" value="{$item.id}" />
                <button type="submit" target-form="form-horizontal" class="btn btn-sm btn-success no-border ajax-post no-refresh" id="sub-btn">
                    确认
                </button>
                <a class="btn btn-white" href="javascript:history.go(-1)">
                    返回
                </a>
            </div>
        </div>
    </form>
</block>

<block name="script">
    <include file="Public/upload.js"/>
    <include file="Public/upload.pic"/>
    <script src="__STATIC__/thinkbox/jquery.thinkbox.js"></script>
    <link href="__STATIC__/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
    <link href="__STATIC__/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="__STATIC__/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="__STATIC__/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script src="__ACE__/js/bootstrap-colorpicker.min.js"></script>
    <script type="text/javascript">
        jQuery(function ($) {


            var background = $('#simple-colorpicker-1').data('id');
            if (!!background) $('#simple-colorpicker-1').val(background);

            var font_color = $('#simple-colorpicker-2').data('id');
            if (!!font_color) $('#simple-colorpicker-2').val(font_color);

            $('#simple-colorpicker-1').ace_colorpicker();
            $('#simple-colorpicker-2').ace_colorpicker();
        });
        //搜索功能
        $("#search").click(function(){
            var url = $(this).attr('url');
            var query  = $('.search-form').find('input').serialize();
            query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g,'');
            query = query.replace(/^&/g,'');
            if( url.indexOf('?')>0 ){
                url += '&' + query;
            }else{
                url += '?' + query;
            }
            window.location.href = url;
        });
        //回车搜索
        $(".search-input").keyup(function(e){
            if(e.keyCode === 13){
                console.info($("#search"));
                $("#search").click();
                return false;
            }
        });
        $('.date-picker').datetimepicker({
            format: 'yyyy-mm-dd hh:ii:ss',
            language:"zh-CN",
            minView:2,
            autoclose:true
        });
        //导航高亮
        highlight_subnav('{:U('Meeting/index')}');
    </script>
</block>