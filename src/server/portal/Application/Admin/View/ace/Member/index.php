<extend name="Public/base" />

<block name="body">
     <div class="table-responsive">
        <div class="dataTables_wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-form">
                        <label>用户昵称或者ID
                            <input type="text" class="search-input" name="nickname" value="{:I('nickname')}" placeholder="请输入用户昵称或者ID">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search" url="{:U('index')}">
                               <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- 数据列表 -->
            <table class="table table-striped table-bordered table-hover dataTable">
			    <thead>
			        <tr>
                        <th class="row-selected center">
                           <label>
                               <input class="ace check-all" type="checkbox"/>
                               <span class="lbl"></span>
                           </label>
                        </th>
                        <th class="">姓名</th>
                        <th class="">手机号码</th>
                        <th class="">职位</th>
                        <th class="">公司</th>
                        <th class="">报名时间</th>
                        <th class="">会员类型</th>
                        <th class="">操作</th>
					</tr>
			    </thead>
			    <tbody>
					<notempty name="_list">
					<volist name="_list" id="vo">
					<tr>
                        <td class="center">
                            <label>
                                <input class="ace ids" type="checkbox" name="id[]" value="{$vo.id}" />
                                <span class="lbl"></span>
                            </label>
                        </td>
						<td>{$vo.chairman_name}</td>
						<td>{$vo.username}</td>
						<td>{$vo.position}</td>
						<td><span>{$vo.company_name}</span></td>
						<td><span>{$vo.reg_time}</span></td>
						<td>
                            <?= $vo['group_id'] == 5 ? "银种子" : '金种子' ?>
                        </td>
                        <td>
<!--                            <a title="编辑" href="{:U('edit?uid='.$vo['id'])}" class="">-->
<!--                                编辑-->
<!--                            </a>-->
                            <a title="档案信息" href="{:U('companyShow?id='.$vo['c_id'])}" class="">
                                档案信息
                            </a>
                            <a title="注册信息" href="{:U('companyRegShow?id='.$vo['cr_id'])}" class="">
                                注册信息
                            </a>
<!--                            <a title="删除" href="{:U('User/changeStatus?method=deleteUser&id='.$vo['uid'])}" class="confirm ajax-get">-->
<!--                                删除-->
<!--                            </a>-->
                        </td>
					</tr>
					</volist>
					<else/>
					<td colspan="9" class="text-center"> aOh! 暂时还没有内容! </td>
					</notempty>
				</tbody>
            </table>

            <div class="row">
                <div class="col-sm-4">
                    <label>
                        <a class="btn btn-white" href="{:U('add')}">
                            新增
                        </a>
                    </label>
                </div>
                <div class="col-sm-8">
                    <include file="Public/page"/>
                </div>
            </div>
        </div>
    </div>
</block>

<block name="script">
	<script src="__STATIC__/thinkbox/jquery.thinkbox.js"></script>

	<script type="text/javascript">
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
    //导航高亮
    highlight_subnav('{:U('User/index')}');
	</script>
</block>
