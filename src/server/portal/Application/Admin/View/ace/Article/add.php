<extend name="Public/base" />

<!-- 子导航 -->
<block name="sidebar">
    <include file="sidemenu" />
</block>

<block name="body">
	<div class="page-header">
		<h1>
			编辑{$info.model_id|get_document_model='title'} 
			<small>
				<i class="icon-double-angle-right"></i>
				[
			<volist name="rightNav" id="nav">
			<a href="{:U('article/index','cate_id='.$nav['id'])}">{$nav.title}</a>
			<if condition="count($rightNav) gt $i"><i class="ca"></i></if>
			</volist>
			<present name="article">：<a href="{:U('article/index','cate_id='.$data['category_id'].'&pid='.$article['id'])}">{$article.title}</a></present>
			]
			</small>
		</h1>
	</div>
	<!-- 标签页导航 -->
<div class="tabbable">
    <ul class="nav nav-tabs padding-18">
        <volist name=":parse_config_attr($model['field_group'])" id="group">
			<li <eq name="key" value="1">class="active"</eq>>
			<a data-toggle="tab" href="#tab{$key}">{$group}</a>
			</li>
		</volist>
    </ul>
	<!-- 表单 -->
	<form id="form" action="{:U('update')}" method="post" class="form-horizontal">
    <div class="tab-content no-border padding-24">
		<!-- 基础文档模型 -->
		<volist name=":parse_config_attr($model['field_group'])" id="group">
        <div id="tab{$key}" class="tab-pane <eq name="key" value="1">active</eq> tab{$key}">
            <volist name="fields[$key]" id="field">
                <if condition="$field['is_show'] == 1 || $field['is_show'] == 2">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 control-label no-padding-right">{$field['title']}</label>
                    <div class="col-xs-12 col-sm-6">
                        <switch name="field.type">
                            <case value="num">
                                <input type="text" class="width-100" name="{$field.name}" value="{$field.value}">
                            </case>
                            <case value="string">
                                <input type="text" class="width-100" name="{$field.name}" value="{$field.value}">
                            </case>
                            <case value="textarea">
                                <textarea name="{$field.name}" class="form-control">{$field.value}</textarea>
                            </case>
                            <case value="date">
                                <input type="text" name="{$field.name}" class="width-100 date" value="" placeholder="请选择日期" />
                            </case>
                            <case value="datetime">
                                <input type="text" name="{$field.name}" class="width-100 time" value="" placeholder="请选择时间" />
                            </case>
                            <case value="bool">
                                <select name="{$field.name}">
                                    <volist name=":parse_field_attr($field['extra'])" id="vo">
                                        <option value="{$key}" <eq name="field.value" value="$key">selected</eq>>{$vo}</option>
                                    </volist>
                                </select>
                            </case>
                            <case value="select">
                                <select name="{$field.name}">
                                    <volist name=":parse_field_attr($field['extra'])" id="vo">
                                        <option value="{$key}" <eq name="field.value" value="$key">selected</eq>>{$vo}</option>
                                    </volist>
                                </select>
                            </case>
                            <case value="radio">
                                <volist name=":parse_field_attr($field['extra'])" id="vo">
                                	<label>
                                        <input type="radio" class="ace" value="{$key}" <eq name="field.value" value="$key">checked</eq> name="{$field.name}">
                                        <span class="lbl">{$vo}&nbsp;</span>
                                	</label>
                                </volist>
                            </case>
                            <case value="checkbox">
                                <volist name=":parse_field_attr($field['extra'])" id="vo">
                                	<label>
                                        <input type="checkbox" class="ace" value="{$key}" name="{$field.name}[]" <eq name="field.value" value="$key">checked</eq>>
                                        <span class="lbl">{$vo}&nbsp;</span>
                                	</label>
                                </volist>
                            </case>
                            <case value="editor">
                                <textarea name="{$field.name}">{$field.value}</textarea>
                                {:hook('adminArticleEdit', array('name'=>$field['name'],'value'=>$field['value']))}
                            </case>
                            <case value="picture">
                                <div class="upload-wrap">
                                    <a href="javascript:" class="btn btn-sm btn-success pic-upload" name="{$field.name}" val="{$data[$field['name']]}" >
                                        <i class="icon-cloud-upload "></i>上传图片
                                    </a>
                                </div>
                            </case>
                            <case value="file">
                                <div class="upload-wrap">
                                    <a href="javascript:" class="btn btn-sm btn-success file-upload" name="{$field.name}" val="{$data[$field['name']]}" >
                                        <i class="icon-cloud-upload "></i>上传附件
                                    </a>
                                </div>
                            </case>
                            <default/>
                            <input type="text" class="width-100" name="{$field.name}" value="{$field.value}">
                        </switch>
                    </div>
                    <span class="help-block col-xs-12 col-sm-reset inline"><notempty name="field['remark']">（{$field['remark']}）</notempty></span>
                </div>
                </if>
            </volist>
        </div>
		</volist>

		<div class="clearfix form-actions">
            <div class="col-xs-12 center">
                <input type="hidden" name="id" value="{$info.id|default=''}"/>
    			<input type="hidden" name="pid" value="{$info.pid|default=''}"/>
    			<input type="hidden" name="model_id" value="{$info.model_id|default=''}"/>
    			<input type="hidden" name="group_id" value="{$info.group_id|default=''}"/>
    			<input type="hidden" name="category_id" value="{$info.category_id|default=''}">
                <button type="submit" target-form="form-horizontal" class="btn btn-success ajax-post no-refresh" id="sub-btn">
                    <i class="icon-ok bigger-110"></i> 确认保存
                </button> 
                <a class="btn btn-info" href="{$Think.cookie.__forward__}">
                   <i class="icon-reply"></i>返回上一页
                </a>  
                <if condition="C('OPEN_DRAFTBOX') and (ACTION_NAME eq 'add' or $data['status'] eq 3)">
    			<button class="btn btn-success save-btn" url="{:U('article/autoSave')}" target-form="form-horizontal" id="autoSave">
    				存草稿
    			</button>
    			</if>
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
<php>if(C('COLOR_STYLE')=='blue_color') echo '<link href="__STATIC__/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" type="text/css">';</php>
<link href="__STATIC__/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__STATIC__/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="__STATIC__/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">

$('#submit').click(function(){
	$('#form').submit();
});

$(function(){
    $('.date').datetimepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });
    $('.time').datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });
    showTab();

	<if condition="C('OPEN_DRAFTBOX') and (ACTION_NAME eq 'add' or $info['status'] eq 3)">
	//保存草稿
	var interval;
	$('#autoSave').click(function(){
        var target_form = $(this).attr('target-form');
        var target = $(this).attr('url')
        var form = $('.'+target_form);
        var query = form.serialize();
        var that = this;

        $(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
        $.post(target,query).success(function(data){
            if (data.status==1) {
                updateAlert(data.info ,'alert-success');
                $('input[name=id]').val(data.data.id);
            }else{
                updateAlert(data.info);
            }
            setTimeout(function(){
                $('#top-alert').find('button').click();
                $(that).removeClass('disabled').prop('disabled',false);
            },1500);
        })

        //重新开始定时器
        clearInterval(interval);
        autoSaveDraft();
        return false;
    });

	//Ctrl+S保存草稿
	$('body').keydown(function(e){
		if(e.ctrlKey && e.which == 83){
			$('#autoSave').click();
			return false;
		}
	});

	//每隔一段时间保存草稿
	function autoSaveDraft(){
		interval = setInterval(function(){
			//只有基础信息填写了，才会触发
			var title = $('input[name=title]').val();
			var name = $('input[name=name]').val();
			var des = $('textarea[name=description]').val();
			if(title != '' || name != '' || des != ''){
				$('#autoSave').click();
			}
		}, 1000*parseInt({:C('DRAFT_AOTOSAVE_INTERVAL')}));
	}
	autoSaveDraft();

	</if>

});
</script>
</block>
