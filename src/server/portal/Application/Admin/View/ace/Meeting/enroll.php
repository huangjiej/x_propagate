<extend name="Public/base"/>

<block name="body">
    <div class="table-responsive">
        <div class="dataTables_wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <form action="{:U('')}" class="search-form" method="get">
                        <label>会员名称或手机号码
                            <input type="text" class="search-input" name="search" value="{:I('search')}" placeholder="会员名称或手机号码">
                        </label>
                        <label for="form-field-select-3">
                            <select name="meeting" class="chosen-select" style="width: 200px;" data-placeholder="Choose a Country...">
                                <option value="">选择会议场次</option>
                                <volist name="meetings" id="vo">
                                    <option value="{$vo.id}">{$vo.title}</option>
                                </volist>
                            </select>
                        </label>
                        <label>
                            <select name="is_sign" id="is_sign" data-id="">
                                <option value="">是否签到</option>
                                <option value="YES">已签到</option>
                                <option value="NO#">未签到</option>
                            </select>
                        </label>
                        <label>
                            <select name="is_affirm" id="is_affirm" data-id="">
                                <option value="">是否确认</option>
                                <option value="YES">已确认</option>
                                <option value="NO#">未确认</option>
                            </select>
                        </label>
                        <label>
                            <button class="btn btn-sm btn-primary" type="button" id="search-btn" url="<?=U('meeting/enroll')?>">
                                <i class="icon-search"></i>搜索
                            </button>
                        </label>
                    </form>
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
                    <th class="">会议</th>
                    <th class="">公司名称</th>
                    <th class="">年龄</th>
                    <th class="">职位</th>
                    <th class="">推荐人</th>
                    <th class="">报名时间</th>
                    <th class="">是否确认</th>
                    <th class="">是否签到</th>
                    <th class="">签到时间</th>
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
                            <td>{$vo.name}</td>
                            <td>{$vo.mobile}</td>
                            <td>{$vo.title}</td>
                            <td>{$vo.company_name}</td>
                            <td>{$vo.age|get_age}</td>
                            <td>{$vo.position|get_position}</td>
                            <td><?= $vo['referee']==0?'无':$vo['referee']  ?></td>
                            <td>{$vo.create_time}</td>
                            <td>
                                <label>
                                    <span><?=$vo['is_affirm'] == 'YES' ? '是' : '否'?></span>
                                </label>
                            </td>
                            <td>
                                <label>
                                    <span><?=$vo['is_sign'] == 'YES' ? '是' : '否'?></span>
                                </label>
                            </td>
                            <td>{$vo.sign_time}</td>
                            <td>
                                <a title="完善信息" href="{:U('companyEdit?eid='.$vo['id'])}" class="">
                                    完善信息
                                </a>
                                <a title="删除报名信息" href="{:U('enrollDelete?id='.$vo['id'])}" class="confirm ajax-get">
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
                        <a class="btn btn-white" href="{:U('enrolladd')}">
                            新增
                        </a>
                    </label>
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

<block name="script">
    <link rel="stylesheet" href="__ACE__/css/chosen.css">
    <script src="__ACE__/js/chosen.jquery.min.js"></script>
    <script type="text/javascript">
        $(".chosen-select").chosen();
        $('#chosen-multiple-style').on('click', function(e){
            var target = $(e.target).find('input[type=radio]');
            var which = parseInt(target.val());
            if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
            else $('#form-field-select-4').removeClass('tag-input-style');
        });


        (function($){
            var meeting_id = <?=intval(I('meeting_id'));?>;
            if(meeting_id > 0){
                $('#meeting_id').val(meeting_id);
            }
        })(jQuery);
        //导航高亮
        highlight_subnav('{:U('member/index')}');
    </script>
</block>