<extend name="Public/base" />

<block name="body">
<script type="text/javascript" src="__STATIC__/uploadify/jquery.uploadify.min.js"></script>
<!-- 标签页导航 -->
<div class="tabbable">

    <?php
    $tabs = parse_config_attr($model['field_group']);
    if(count($tabs) > 1):
    ?>
    <ul class="nav nav-tabs padding-18">
        <volist name="tabs" id="group">
        <li <eq name="key" value="1">class="active"</eq>><a data-toggle="tab" href="#tab{$key}">{$group}</a></li>
        </volist>
    </ul>
    <?php endif;?>
    <!-- 表单 -->
    <form id="form" action="<?=isset($form_action) ? U($form_action) : U('edit',['model'=>$model['id']])?>" method="post" class="form-horizontal">
    <div class="tab-content no-border padding-24">
        <!-- 基础文档模型 -->
		<volist name=":parse_config_attr($model['field_group'])" id="group">
		<div id="tab{$key}" class="tab-pane <eq name="key" value="1">active</eq> tab{$key}">
            <volist name="fields[$key]" id="field">
                <php>$field['name'] = strtolower($field['name']);</php>
                <if condition="$field['is_show'] == 1 || $field['is_show'] == 3">
                <div class="form-group cf">
                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">{$field['title']}</label>
                    <div class="col-xs-12 col-sm-6">
                        <switch name="field.type">
                            <case value="num">
                                <input type="text" class="width-100" name="{$field.name}" value="{$data[$field['name']]}">
                            </case>
                            <case value="string">
                                <input type="text" class="width-100" name="{$field.name}" value="{$data[$field['name']]}">
                            </case>
                            <case value="textarea">
                                <textarea name="{$field.name}" class="form-control">{$data[$field['name']]}</textarea>
                            </case>
                            <case value="date">
                                <?php if(strpos($data['field'],'int') !== false):?>
                                    <input type="text" name="{$field.name}" class="width-100 date" value="{$data[$field['name']]|date='Y-m-d',###}" placeholder="请选择日期" />
                                <?php else:?>
                                    <input type="text" name="{$field.name}" class="width-100 time" value="{$data[$field['name']]}" placeholder="请选择时间" />
                                <?php endif;?>
                            </case>
                            <case value="datetime">
                                <?php if(strpos($data['field'],'int') !== false):?>
                                    <input type="text" name="{$field.name}" class="width-100 time" value="{$data[$field['name']]|date='Y-m-d H:i',###}" placeholder="请选择时间" />
                                <?php else:?>
                                    <input type="text" name="{$field.name}" class="width-100 time" value="{$data[$field['name']]}" placeholder="请选择时间" />
                                <?php endif;?>
                            </case>
                            <case value="bool">
                                <select name="{$field.name}">
                                    <volist name=":parse_field_attr($field['extra'])" id="vo">
                                        <option value="{$key}" <eq name="data[$field['name']]" value="$key">selected</eq>>{$vo}</option>
                                    </volist>
                                </select>
                            </case>
                            <case value="select">
                                <select  class="width-100" name="{$field.name}">
                                    <volist name=":parse_field_attr($field['extra'])" id="vo">
                                        <option value="{$key}" <eq name="data[$field['name']]" value="$key">selected</eq>>{$vo}</option>
                                    </volist>
                                </select>
                            </case>
                            <case value="radio">
                                <volist name=":parse_field_attr($field['extra'])" id="vo">
                                	<label>
                                        <input type="radio" class="ace" value="{$key}" name="{$field.name}" <eq name="data[$field['name']]" value="$key">checked="checked"</eq> />
                                        <span class="lbl">{$vo}&nbsp;</span>
                                	</label>
                                </volist>
                            </case>
                            <case value="checkbox">
                                <volist name=":parse_field_attr($field['extra'])" id="vo">
                                	<label>
										<input type="checkbox" class="ace" name="{$field.name}[]" value="{$key}"<in name="key" value="$data[$field['name']]" >checked="checked"</in> />
										<span class="lbl"> {$vo}&nbsp;</span>
									</label>
                                </volist>
                            </case>
                            <case value="editor">
                                <textarea name="{$field.name}">{$data[$field['name']]}</textarea>
                                {:hook('adminArticleEdit', array('name'=>$field['name'],'value'=>$data[$field['name']]))}
                            </case>
                            <case value="picture">
                                <div class="controls upload-wrap">
                                    <a href="javascript:" class="btn btn-sm btn-success pic-upload" name="{$field.name}" val="{$data[$field['name']]}" >
                                        <i class="icon-cloud-upload "></i>上传图片
                                    </a>
                                    <notempty name="data[$field['name']]">
                                        <div class="preview"><img src="<?=imageView2($data[$field['name']],120,120)?>" width="120"/></div>
                                    </notempty>
                                </div>
                            </case>
                            <case value="file">
                                <div class="controls upload-wrap">
                                    <a href="javascript:" class="btn btn-sm btn-success file-upload" name="{$field.name}" val="{$data[$field['name']]}" >
                                        <i class="icon-cloud-upload "></i>上传附件
                                    </a>
                                    <notempty name="data[$field['name']]">
                                        <div class="upload-pre-file"><span class="upload_icon_all"></span><span class="file-name">{$data[$field['name']]}</span></div>
                                    </notempty>
                                </div>
                            </case>
                            <case value="district">
                                <div id="city_{$field.name}"></div>
                                <script>
                                    <?php echo hook('H_XbDistrict', array('id'=>'city_'.$field['name'],'district'=>$field['name'],'selected'=>$data[$field['name']]));?>
                                </script>
                            </case>
                            <default/>
                            <input type="text" class="width-100" name="{$field.name}" value="{$data[$field['name']]}">
                        </switch>
                    </div>
                    <div class="help-block col-xs-12 col-sm-reset inline">
                        <notempty name="field['remark']">（{$field['remark']}）</notempty>
                    </div>
                </div>
                </if>
            </volist>
        </div>
		</volist>

        <div class="clearfix form-actions">
            <div class="col-xs-12 center">
                <input type="hidden" name="id" value="{$data.id}">
                <button type="submit" target-form="form-horizontal" class="btn btn-success ajax-post no-refresh" id="sub-btn">
                    <i class="icon-ok bigger-110"></i> 确认保存
                </button>
                <button type="reset" class="btn" id="reset-btn">
                    <i class="icon-undo bigger-110"></i> 重置
                </button>
                <a onclick="history.go(-1)" class="btn btn-info" href="javascript:;">
                   <i class="icon-reply"></i>返回上一页
                </a>
            </div>
        </div>
    </div>
    </form>
</div>
</block>

<block name="script">
<include file="Public/upload.js"/>
<include file="Public/upload.pic"/>
<include file="Public/upload.file"/>
<link href="__STATIC__/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
<link href="__STATIC__/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__STATIC__/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="__STATIC__/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">
$(function(){
	$('.time').datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });
    $('.date').datetimepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });
    showTab();
    <?php if(isset($active_menu)):?>
    //导航高亮
    highlight_subnav('<?=U($active_menu)?>');
    <?php else:?>
    highlight_subnav('{:U('Model/index')}');
    <?php endif;?>
});
</script>
</block>
