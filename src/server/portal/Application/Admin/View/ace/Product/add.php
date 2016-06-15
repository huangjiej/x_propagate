<extend name="Public/base" />

<block name="body">
    <!-- 表单 -->
    <style>
        td{width:50%;}
        img{max-width:400px;}
    </style>
    <form action="{:U('')}" method="post" class="form-horizontal">
        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">产品名称</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="name"
                       value="{$item.name}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">产品类型</label>
            <div class="col-xs-12 col-sm-7">
                <select name="type" id="product_type" data-type="{$item.type}">
                    <option value="">选择产品类型</option>
                    <option value="1">申请俱乐部</option>
                    <option value="2">礼物</option>
                    <option value="3">培训产品</option>
                </select>
            </div>
        </div>


        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">产品描述</label>
            <div class="col-xs-12 col-sm-7">
                <textarea name="description">{$item.description}</textarea>
                {:hook('adminArticleEdit', array('name'=>'description'))}
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">产品现价（单位元）</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="cur_price"
                       value="{$item.cur_price|price_format}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">产品原价：（单位元）</label>
            <div class="col-xs-12 col-sm-7">
                <input type="text" class="width-100" name="old_price"
                       value="{$item.old_price|price_format}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">产品图片</label>
            <div class="col-xs-12 col-sm-6">
                <div class="upload-wrap">
                    <a href="javascript:" class="btn btn-sm btn-success pic-upload" name="main_pic" val="{$item['main_pic']|default=''}" >
                        <i class="icon-cloud-upload "></i>上传图片
                    </a>
                    <notempty name="item['main_pic']">
                        <div class="preview"><img width="240" height="240" src="<?=imageView2($item['main_pic'],240,240)?>" /></div>
                    </notempty>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label class="col-xs-12 col-sm-2 control-label no-padding-right">产品简介</label>
            <div class="col-xs-12 col-sm-7">
                <textarea name="info">{$item.info}</textarea>
                {:hook('adminArticleEdit', array('name'=>'info'))}
            </div>
        </div>

        <if condition="!empty($item)">
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 control-label no-padding-right">状态</label>
                <div class="col-xs-12 col-sm-7">
                    <label><input type="radio" <?= $item['status'] == 1 ? 'checked' : '' ?> class="ace" name="status" value="1"><span class="lbl">上架&nbsp;</span></label>
                    <label><input type="radio" <?= $item['status'] == -1 ? 'checked' : '' ?> class="ace" name="status" value="-1"><span class="lbl">下架&nbsp;</span></label>
                </div>
            </div>
        </if>

        <hr>

        <div class="clearfix form-actions">
            <div class="col-xs-12">
                <if condition="!empty($item)">
                <input type="hidden" name="id" value="{$item.id}" />
                </if>
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
    <script>
        var product_type = $('#product_type').data('type');
        if (!!product_type) {
            $('#product_type').val(product_type);
        } else  {
            $('#product_type').val(3);
        }
        //导航高亮
        highlight_subnav('{:U("product/index")}');
    </script>
</block>