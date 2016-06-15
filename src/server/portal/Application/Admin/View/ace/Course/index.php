<extend name="Public/base"/>

<block name="body">
    <div class="table-responsive">
        <div class="dataTables_wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="search-form">
                        <label>会员名称或手机号码
                            <input type="text" class="search-input" name="search" value="{:I('search')}" placeholder="会员名称或手机号码">
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="{:U('User/userReturn')}">
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
                    <th class="">公司名称</th>
                    <th class="">PPT名称</th>
                    <th class="">上传时间</th>
                    <th class="">下载</th>
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
                            <td>{$vo.mobile}</td>
                            <td>{$vo.company_name}</td>
                            <td>{$vo.title}</td>
                            <td>{$vo.insert_time}</td>
                            <td><a href="<?= get_qiniu_file_durl($vo['att_url']) ?>">下载</a></td>
                            <td>
                                <a title="点评" href="{:U('My/courseShow?id='.$vo['id'])}" class="">
                                        点评
                                </a>
                                <a title="删除报名信息" href="{:U('My/courseDelete?id='.$vo['id'])}" class="confirm ajax-get">
                                    删除
                                </a>
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
                        <button type="button" class="btn btn-white ajax-post" target-form="ids" url="{:U('enrollDelete')}">
                            删除
                        </button>
                    </label>
                </div>
                <div class="col-sm-8">
                    <include file="Public/page"/>
                </div>
            </div>
        </div>
    </div>
</block>