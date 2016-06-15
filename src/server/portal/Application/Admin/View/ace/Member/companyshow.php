<extend name="Public/base"/>

<block name="body">
    <div class="row-fluid">
        <div class="span12">
            <form id="company" action="{:U('')}" method="post" class="form-horizontal">
                <div class="widget-box">
                <div class="widget-header widget-header-blue widget-header-flat">
                    <h4 class="lighter">审核档案</h4>
                </div>
                <div class="widget-body" style="position: relative;">
                            <div class="step-content row-fluid position-relative" id="step-container">
                                <div class="step-pane active" id="step1">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            会员类型
                                        </label>
                                        <div class="col-xs-12 col-sm-6">
                                            <label>
                                                <input type="radio" <?= $item['group_id']==6 ? 'checked' : '' ?> class="ace" name="group_id" value="6">
                                                <span class="lbl">金种子&nbsp;</span></label>
                                            <label>
                                                <input type="radio" <?= $item['group_id']==5 ? 'checked' : '' ?> class="ace" name="group_id" value="5">
                                                <span class="lbl">银种子&nbsp;</span></label>
                                        </div>
                                        <span class="check-tips"></span>
                                    </div>
                                    <input type="hidden" name="uid" value="{$item.uid}">
                                    <hr>
                                    <div class="row-fluid">
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                企业全名
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="clearfix">
                                                    <input type="text" id="company_name" class="width-100" name="company_name"
                                                           value="{$item.company_name}">
                                                </div>
                                            </div>
                                            <span class="check-tips"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                企业法定代表人
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="clearfix">
                                                    <input id="corporation_name" type="text" name="corporation_name" class="width-100"
                                                           value="{$item.corporation_name}">
                                                </div>
                                            </div>
                                            <span class="check-tips"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                企业性质
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <select name="enterprise_nature" id="enterprise_nature" data-id="{$item.enterprise_nature}">
                                                    <option value="">选择企业</option>
                                                    <option value="GFZ">股份制企业</option>
                                                    <option value="SY#">私营企业</option>
                                                    <option value="GT#">个体企业</option>
                                                    <option value="WSD">外商独资企业</option>
                                                    <option value="ZWH">中外合资企业</option>
                                                    <option value="GY#">国营企业</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                企业注册资本
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="clearfix">
                                                    <input type="text" name="registered_capital" id="registered_capital" class="width-100"
                                                           value="{$item.registered_capital|number_format}">
                                                </div>
                                            </div>
                                            <span class="check-tips">（单位：元）</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                股东人数
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="clearfix">
                                                    <input type="text" name="shareholder_num" id="shareholder_num" class="width-100"
                                                           value="{$item.shareholder_num}">
                                                </div>
                                            </div>
                                            <span class="check-tips"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                在企业内任职情况
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea id="tenure_desc" name="tenure_desc" class="form-control">{$item.tenure_desc}</textarea>
                                            </div>
                                            <span class="col-xs-12 col-sm-reset inline">
                                                企业股东结构及在企业内任职情况
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">营业执照</label>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="upload-wrap">
                                                    <a href="javascript:" class="btn btn-sm btn-success pic-upload" name="business_licence_url"
                                                       val="{$item['business_licence_url']|default=''}" >
                                                        <i class="icon-cloud-upload "></i>上传图片
                                                    </a>
                                                    <notempty name="item['business_licence_url']">
                                                        <div class="preview"><img src="<?=imageView2($item['business_licence_url'],120,120)?>" width="120"/></div>
                                                    </notempty>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">税务登记证</label>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="upload-wrap">
                                                    <a href="javascript:" class="btn btn-sm btn-success pic-upload" name="tax_reg_cert_url"
                                                       val="{$item['tax_reg_cert_url']|default=''}" >
                                                        <i class="icon-cloud-upload "></i>上传图片
                                                    </a>
                                                    <notempty name="item['tax_reg_cert_url']">
                                                        <div class="preview"><img src="<?=imageView2($item['tax_reg_cert_url'],120,120)?>" width="120"/></div>
                                                    </notempty>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">结构代码证</label>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="upload-wrap">
                                                    <a href="javascript:" class="btn btn-sm btn-success pic-upload" name="organization_code_cert_url"
                                                       val="{$item['organization_code_cert_url']|default=''}" >
                                                        <i class="icon-cloud-upload "></i>上传图片
                                                    </a>
                                                    <notempty name="item['organization_code_cert_url']">
                                                        <div class="preview"><img src="<?=imageView2($item['organization_code_cert_url'],120,120)?>" width="120"/></div>
                                                    </notempty>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h3 class="center"> 企业财务状况</h3>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                是否有银行贷款
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <if condition="empty($item['has_bank_loan'])">
                                                    <label><input type="radio" checked class="ace" name="has_bank_loan" value="YES"><span class="lbl">是&nbsp;</span></label>
                                                    <label><input type="radio"  class="ace" name="has_bank_loan" value="NO#"><span class="lbl">否&nbsp;</span></label>
                                                    <else />
                                                    <label><input type="radio" <?= $item['has_bank_loan']=='YES' ? 'checked' : '' ?> class="ace" name="has_bank_loan" value="YES"><span class="lbl">是&nbsp;</span></label>
                                                    <label><input type="radio" <?= $item['has_bank_loan']=='NO#' ? 'checked' : '' ?> class="ace" name="has_bank_loan" value="NO#"><span class="lbl">否&nbsp;</span></label>
                                                </if>
                                            </div>
                                            <span class="check-tips"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                总资产周转率
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="clearfix">
                                                    <input type="text" name="total_asset_turnover" id="total_asset_turnover" class="width-100"
                                                           value="{$item.total_asset_turnover}">
                                                </div>
                                            </div>
                                            <span class="check-tips">%</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                应收帐款周转率
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="clearfix">
                                                    <input type="text" class="width-100" id="accounts_receivable_turnover" name="accounts_receivable_turnover"
                                                           value="{$item.accounts_receivable_turnover}">
                                                </div>
                                            </div>
                                            <span class="check-tips">%</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                毛利润率
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="clearfix">
                                                    <input type="text" name="gross_profit_margin" id="gross_profit_margin" class="width-100"
                                                           value="{$item.gross_profit_margin}">
                                                </div>
                                            </div>
                                            <span class="check-tips">%</span>
                                        </div>

                                    </div>
                                    <hr>
                                    <h3 class="center">企业人员情况</h3>
                                    <script id="rtpl" type="text/regular">
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                生产人员数量
                                            </label>
                                            <div class="col-xs-12 col-sm-2">
                                                <div class="clearfix">
                                                    <input type="text" r-model={production_people_count} name="production_people_count" id="production_people_count" class="width-100"
                                                           value="{$item.production_people_count}" placeholder="（单位：人）">
                                                </div>

                                            </div>
                                            <span class="check-tips"></span>
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                管理人员数量
                                            </label>
                                            <div class="col-xs-12 col-sm-2">
                                                <div class="clearfix">
                                                    <input type="text" r-model={manage_people_count} name="manage_people_count" id="manage_people_count" class="width-100"
                                                           value="{$item.manage_people_count}" placeholder="（单位：人）">
                                                </div>

                                            </div>
                                            <span class="check-tips"></span>
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                营销人员数量
                                            </label>
                                            <div class="col-xs-12 col-sm-2">
                                                <div class="clearfix">
                                                    <input type="text" r-model={marketing_people_count} name="marketing_people_count" id="marketing_people_count" class="width-100"
                                                           value="{$item.marketing_people_count}" placeholder="（单位：人）">
                                                </div>

                                            </div>
                                            <span class="check-tips"></span>
                                        </div>
                                        <div class="form-group">

                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                技术人员数量
                                            </label>
                                            <div class="col-xs-12 col-sm-2">
                                                <div class="clearfix">
                                                    <input type="text" r-model={technology_people_count} name="technology_people_count" id="technology_people_count" class="width-100"
                                                           value="{$item.technology_people_count}" placeholder="（单位：人）">
                                                </div>

                                            </div>
                                            <span class="check-tips"></span>
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                其他人员数量
                                            </label>
                                            <div class="col-xs-12 col-sm-2">
                                                <div class="clearfix">
                                                    <input type="text" r-model={other_people_count} name="other_people_count" id="other_people_count" class="width-100"
                                                           value="{$item.other_people_count}" placeholder="（单位：人）">
                                                </div>
                                            </div>
                                            <span class="check-tips"></span>
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                总人数
                                            </label>
                                            <div class="col-xs-12 col-sm-2">
                                                <div class="clearfix">
                                                    <input r-model="total_people_count" disabled="disabled" type="text" name="total_people_count" id="total_people_count" class="width-100"
                                                            value="{$item.total_people_count}" placeholder="（单位：人）">
                                                </div>
                                            </div>
                                            <span class="check-tips"></span>
                                        </div>
                                    </script>
                                    <div id="rapp">

                                    </div>


                                    <hr>
                                    <h3 class="center">员工年龄分布</h3>
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            20岁以下
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <div class="clearfix">
                                                <input type="text" name="people_age_count1" id="people_age_count1" class="width-100"
                                                       value="{$item.people_age_count1}" placeholder="（单位：人）">
                                            </div>
                                        </div>
                                        <span class="check-tips"></span>
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            20-25岁
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <div class="clearfix">
                                                <input type="text" name="people_age_count2" id="people_age_count2" class="width-100"
                                                       value="{$item.people_age_count2}" placeholder="（单位：人）">
                                            </div>
                                        </div>
                                        <span class="check-tips"></span>
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            25-30岁
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <div class="clearfix">
                                                <input type="text" name="people_age_count3" id="people_age_count3" class="width-100"
                                                       value="{$item.people_age_count3}" placeholder="（单位：人）">
                                            </div>

                                        </div>
                                        <span class="check-tips"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            30-35岁
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <div class="clearfix">
                                                <input type="text" name="people_age_count4" id="people_age_count4" class="width-100"
                                                       value="{$item.people_age_count4}" placeholder="（单位：人）">
                                            </div>
                                        </div>
                                        <span class="check-tips"></span>
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            35-40岁
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <div class="clearfix">
                                                <input type="text" name="people_age_count5" id="people_age_count5" class="width-100"
                                                       value="{$item.people_age_count5}" placeholder="（单位：人）">
                                            </div>
                                        </div>
                                        <span class="check-tips"></span>
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            40以上
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <div class="clearfix">
                                                <input type="text" name="people_age_count6" id="people_age_count6" class="width-100"
                                                       value="{$item.people_age_count6}" placeholder="（单位：人）">
                                            </div>
                                        </div>
                                        <span class="check-tips"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            公司管理层是否有亲戚在公司任职
                                        </label>
                                        <div class="col-xs-12 col-sm-6">
                                            <if condition="empty($item['has_family_manage'])">
                                                <label><input type="radio" checked  class="ace" name="has_family_manage" value="YES"><span class="lbl">是&nbsp;</span></label>
                                                <label><input type="radio"  class="ace" name="has_family_manage" value="NO#"><span class="lbl">否&nbsp;</span></label>
                                                <else />
                                                <label><input type="radio" <?= $item['has_family_manage']=='YES' ? 'checked' : '' ?> class="ace" name="has_family_manage" value="YES"><span class="lbl">是&nbsp;</span></label>
                                                <label><input type="radio" <?= $item['has_family_manage']=='NO#' ? 'checked' : '' ?> class="ace" name="has_family_manage" value="NO#"><span class="lbl">否&nbsp;</span></label>
                                            </if>
                                        </div>
                                        <span class="check-tips"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            员工流失率（上年度员工流失率）
                                        </label>
                                        <div class="col-xs-12 col-sm-2">
                                            <div class="clearfix">
                                                <input type="text" name="employee_turnover" id="employee_turnover" class="width-100"
                                                       value="{$item.employee_turnover}">
                                            </div>
                                        </div>
                                        <span class="check-tips">%</span>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                            目前企业阶段
                                        </label>
                                        <div class="col-xs-12 col-sm-6">
                                            <if condition="empty($item['enterprise_stage'])">
                                                <label>
                                                    <input type="radio" checked
                                                           class="ace" name="enterprise_stage" value="ZLJ">
                                                    <span class="lbl">资本积累阶段&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio"
                                                           class="ace" name="enterprise_stage" value="ZTZ">
                                                    <span class="lbl">战略调整阶段&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio"
                                                           class="ace" name="enterprise_stage" value="CWC">
                                                    <span class="lbl">成熟和维持阶段&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio"
                                                           class="ace" name="enterprise_stage" value="CTZ">
                                                    <span class="lbl">业务重新定位阶段&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio"
                                                           class="ace" name="enterprise_stage" value="OTH">
                                                    <span class="lbl">其他&nbsp;</span>
                                                </label>
                                                <else />
                                                <label>
                                                    <input type="radio" <?= $item['enterprise_stage']=='ZLJ' ? 'checked' : '' ?>
                                                           class="ace" name="enterprise_stage" value="ZLJ">
                                                    <span class="lbl">资本积累阶段&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['enterprise_stage']=='ZTZ' ? 'checked' : '' ?>
                                                           class="ace" name="enterprise_stage" value="ZTZ">
                                                    <span class="lbl">战略调整阶段&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['enterprise_stage']=='CWC' ? 'checked' : '' ?>
                                                           class="ace" name="enterprise_stage" value="CWC">
                                                    <span class="lbl">成熟和维持阶段&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['enterprise_stage']=='CTZ' ? 'checked' : '' ?>
                                                           class="ace" name="enterprise_stage" value="CTZ">
                                                    <span class="lbl">业务重新定位阶段&nbsp;</span>
                                                </label>
                                                <label>
                                                    <input type="radio" <?= $item['enterprise_stage']=='OTH' ? 'checked' : '' ?>
                                                           class="ace" name="enterprise_stage" value="OTH">
                                                    <span class="lbl">其他&nbsp;</span>
                                                </label>
                                            </if>
                                        </div>
                                        <span class="check-tips"></span>
                                    </div>
                                    <style>
                                        .my-tips{float: left;font-size: 14px;margin-left: 10px;height: 25px;line-height: 21px;padding-top: 4px;}
                                    </style>
                                    <?php $years = [3,2,1,0]; ?>
                                    <volist name="years" id="vo" key="k">
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                <?= intval(date('Y')) - $vo ?>年企业收入情况
                                            </label>
                                            <span class="check-tips my-tips">营业额：</span>
                                            <div class="col-xs-12 col-sm-2">
                                                <div class="clearfix">
                                                    <input type="text" name="turnover_year{$k}" id="turnover_year{$k}" class="width-100"
                                                           value="<?= number_format($item['turnover_year'.$k]) ?>"
                                                           placeholder="（单位：元）">
                                                </div>

                                            </div>
                                            <span class="check-tips my-tips">净利润：</span>
                                            <div class="col-xs-12 col-sm-2">
                                                <div class="clearfix">
                                                    <input type="text" name="net_margin_year{$k}" id="net_margin_year{$k}" class="width-100"
                                                           value="<?= number_format($item['net_margin_year'.$k]) ?>"
                                                           placeholder="（单位：元）" />
                                                </div>
                                            </div>
                                        </div>
                                    </volist>
                                    <div class="row-fluid">
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                国内营销区域
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="clearfix">
                                                    <input type="text" id="marketing_area_domestic" name="marketing_area_domestic" class="width-100"
                                                           value="{$item.marketing_area_domestic}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                国外营销区域
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="clearfix">
                                                    <input type="text" id="marketing_area_abroad" name="marketing_area_abroad" class="width-100"
                                                           value="{$item.marketing_area_abroad}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                销售模式
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <if condition="empty($item['sale_mode'])">
                                                    <label>
                                                        <input type="radio" checked
                                                               class="ace" name="sale_mode" value="ZD">
                                                        <span class="lbl">主动营销&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                               class="ace" name="sale_mode" value="ZR">
                                                        <span class="lbl">自然营销&nbsp;</span>
                                                    </label>
                                                    <else />
                                                    <label>
                                                        <input type="radio" <?= $item['sale_mode']=='ZD' ? 'checked' : '' ?>
                                                               class="ace" name="sale_mode" value="ZD">
                                                        <span class="lbl">主动营销&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?= $item['sale_mode']=='ZR' ? 'checked' : '' ?>
                                                               class="ace" name="sale_mode" value="ZR">
                                                        <span class="lbl">自然营销&nbsp;</span>
                                                    </label>
                                                </if>
                                            </div>
                                            <span class="check-tips"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                销售的技术要求
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <if condition="empty($item['sale_technical_requirements'])">
                                                    <label>
                                                        <input type="radio" checked
                                                               class="ace" name="sale_technical_requirements" value="JSX">
                                                        <span class="lbl">技术性销售&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                               class="ace" name="sale_technical_requirements" value="NJS">
                                                        <span class="lbl">无技术性销售&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                               class="ace" name="sale_technical_requirements" value="YBX">
                                                        <span class="lbl">一般技术性销售&nbsp;</span>
                                                    </label>
                                                    <else />
                                                    <label>
                                                        <input type="radio" <?= $item['sale_technical_requirements']=='JSX' ? 'checked' : '' ?>
                                                               class="ace" name="sale_technical_requirements" value="JSX">
                                                        <span class="lbl">技术性销售&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?= $item['sale_technical_requirements']=='NJS' ? 'checked' : '' ?>
                                                               class="ace" name="sale_technical_requirements" value="NJS">
                                                        <span class="lbl">无技术性销售&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?= $item['sale_technical_requirements']=='YBX' ? 'checked' : '' ?>
                                                               class="ace" name="sale_technical_requirements" value="YBX">
                                                        <span class="lbl">一般技术性销售&nbsp;</span>
                                                    </label>
                                                </if>

                                            </div>
                                            <span class="check-tips"></span>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                客户类型
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <if condition="empty($item['customer_type'])">
                                                    <label>
                                                        <input type="radio" checked
                                                               class="ace" name="customer_type" value="GR#">
                                                        <span class="lbl">个人消费者&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                               class="ace" name="customer_type" value="DLS">
                                                        <span class="lbl">代理商&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                               class="ace" name="customer_type" value="QY#">
                                                        <span class="lbl">企业&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                               class="ace" name="customer_type" value="PFS">
                                                        <span class="lbl">批发商&nbsp;</span>
                                                    </label>
                                                    <else />
                                                    <label>
                                                        <input type="radio" <?= $item['customer_type']=='GR#' ? 'checked' : '' ?>
                                                               class="ace" name="customer_type" value="GR#">
                                                        <span class="lbl">个人消费者&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?= $item['customer_type']=='DLS' ? 'checked' : '' ?>
                                                               class="ace" name="customer_type" value="DLS">
                                                        <span class="lbl">代理商&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?= $item['customer_type']=='QY#' ? 'checked' : '' ?>
                                                               class="ace" name="customer_type" value="QY#">
                                                        <span class="lbl">企业&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?= $item['customer_type']=='PFS' ? 'checked' : '' ?>
                                                               class="ace" name="customer_type" value="PFS">
                                                        <span class="lbl">批发商&nbsp;</span>
                                                    </label>
                                                </if>

                                            </div>
                                            <span class="check-tips"></span>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                营销流程说明
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea id="marketing_processes_desc" name="marketing_processes_desc" class="form-control">{$item.marketing_processes_desc}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                企业产品的简介（产品名称、性能、技术及价格、批发、零售、包装等，请罗列出产品的系列及详细的介绍）
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea style="height: 120px;" id="product_desc" name="product_desc" class="form-control">{$item.product_desc}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                企业现有的业务模式
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea id="business_model_desc" name="business_model_desc" class="form-control">{$item.business_model_desc}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                企业现有的运营模式
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea id="operating_model_desc" name="operating_model_desc" class="form-control">{$item.operating_model_desc}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                企业现有的盈利模式
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea id="profit_model_desc" name="profit_model_desc" class="form-control">{$item.profit_model_desc}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                您认为企业目前遇到的困难是什么？出现了哪些问题？（请举具体案例说明）
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea style="height: 120px;" id="enterprise_difficulty_desc" name="enterprise_difficulty_desc" class="form-control">{$item.enterprise_difficulty_desc}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                请写出并联系一个3分钟的自我介绍稿
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea id="self_introduction_desc" name="self_introduction_desc" class="form-control">{$item.self_introduction_desc}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                在资本运作上您的期望是什么
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea id="expectation_desc" name="expectation_desc" class="form-control">{$item.expectation_desc}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                您的企业最希望在哪一个模块需要得到支持？
                                            </label>
                                            <div class="col-xs-12 col-sm-6">
                                                <if condition="empty($item['need_support'])">
                                                    <label>
                                                        <input type="radio" checked
                                                               class="ace" name="need_support" value="顶层商业模型设计">
                                                        <span class="lbl">顶层商业模型设计&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                               class="ace" name="need_support" value="商业模式梳理">
                                                        <span class="lbl">商业模式梳理&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                               class="ace" name="need_support" value="股权投资">
                                                        <span class="lbl">股权投资&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                               class="ace" name="need_support" value="股权设计">
                                                        <span class="lbl">股权设计&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                               class="ace" name="need_support" value="招商融资">
                                                        <span class="lbl">招商融资&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                               class="ace" name="need_support" value="企业运营系统">
                                                        <span class="lbl">企业运营系统&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                               class="ace" name="need_support" value="渠道建设">
                                                        <span class="lbl">渠道建设&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                               class="ace" name="need_support" value="企业文化建设">
                                                        <span class="lbl">企业文化建设&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                               class="ace" name="need_support" value="人才管理及输送">
                                                        <span class="lbl">人才管理及输送&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                               class="ace" name="need_support" value="财务管理">
                                                        <span class="lbl">财务管理&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                               class="ace" name="need_support" value="企业VI系统">
                                                        <span class="lbl">企业VI系统&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                               class="ace" name="need_support" value="新三板新四板挂牌">
                                                        <span class="lbl">新三板新四板挂牌&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio"
                                                               class="ace" name="need_support" value="企业宣传片、微电影">
                                                        <span class="lbl">企业宣传片、微电影&nbsp;</span>
                                                    </label>
                                                    <else />
                                                    <label>
                                                        <input type="radio" <?= $item['need_support']=='顶层商业模型设计' ? 'checked' : '' ?>
                                                               class="ace" name="need_support" value="顶层商业模型设计">
                                                        <span class="lbl">顶层商业模型设计&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?= $item['need_support']=='商业模式梳理' ? 'checked' : '' ?>
                                                               class="ace" name="need_support" value="商业模式梳理">
                                                        <span class="lbl">商业模式梳理&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?= $item['need_support']=='股权投资' ? 'checked' : '' ?>
                                                               class="ace" name="need_support" value="股权投资">
                                                        <span class="lbl">股权投资&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?= $item['need_support']=='股权设计' ? 'checked' : '' ?>
                                                               class="ace" name="need_support" value="股权设计">
                                                        <span class="lbl">股权设计&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?= $item['need_support']=='招商融资' ? 'checked' : '' ?>
                                                               class="ace" name="need_support" value="招商融资">
                                                        <span class="lbl">招商融资&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?= $item['need_support']=='企业运营系统' ? 'checked' : '' ?>
                                                               class="ace" name="need_support" value="企业运营系统">
                                                        <span class="lbl">企业运营系统&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?= $item['need_support']=='渠道建设' ? 'checked' : '' ?>
                                                               class="ace" name="need_support" value="渠道建设">
                                                        <span class="lbl">渠道建设&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?= $item['need_support']=='企业文化建设' ? 'checked' : '' ?>
                                                               class="ace" name="need_support" value="企业文化建设">
                                                        <span class="lbl">企业文化建设&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?= $item['need_support']=='人才管理及输送' ? 'checked' : '' ?>
                                                               class="ace" name="need_support" value="人才管理及输送">
                                                        <span class="lbl">人才管理及输送&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?= $item['need_support']=='财务管理' ? 'checked' : '' ?>
                                                               class="ace" name="need_support" value="财务管理">
                                                        <span class="lbl">财务管理&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?= $item['need_support']=='企业VI系统' ? 'checked' : '' ?>
                                                               class="ace" name="need_support" value="企业VI系统">
                                                        <span class="lbl">企业VI系统&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?= $item['need_support']=='新三板新四板挂牌' ? 'checked' : '' ?>
                                                               class="ace" name="need_support" value="新三板新四板挂牌">
                                                        <span class="lbl">新三板新四板挂牌&nbsp;</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" <?= $item['need_support']=='企业宣传片、微电影' ? 'checked' : '' ?>
                                                               class="ace" name="need_support" value="企业宣传片、微电影">
                                                        <span class="lbl">企业宣传片、微电影&nbsp;</span>
                                                    </label>
                                                </if>

                                            </div>
                                            <span class="check-tips"></span>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 control-label no-padding-right">
                                                请列举出该模块内最希望解决的问题
                                            </label>
                                            <div class="col-xs-12 col-sm-7">
                                                <textarea style="height: 120px;" id="need_support_question" name="need_support_question" class="form-control">{$item.need_support_question}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="id" value="{$item.id}" >
                            <div class="clearfix form-actions">
                                <div class="col-xs-12">
                                    <a id="sub-btn"
                                       class="btn btn-sm btn-success no-border">
                                        通过审核并保存
                                    </a>
                                    <button id="hidebtn" class="btn hide btn-sm btn-success no-border ajax-post" target-form="form-horizontal" type="submit">
                                        确认保存
                                    </button>
                                    <a href="javascript:;" class="btn btn-white" onclick="history.go(-1)">
                                        返回
                                    </a>
                                </div>
                            </div>



                    </div><!-- /widget-main -->
                </div><!-- /widget-body -->
            </form>
        </div>
        </div>
    </div>
</block>

<block name="script">
    <include file="Public/upload.js"/>
    <include file="Public/upload.pic"/>
    <script src="__ACE__/js/fuelux/fuelux.wizard.min.js"></script>
    <script src="__ACE__/js/bootbox.min.js"></script>
    <script src="__ACE__/js/query.validate.min.js"></script>
    <script src="__ACE__/js/regular.js"></script>

    <script type="text/javascript">
        $.validator.addMethod( "integer", function( value, element ) {
            return this.optional( element ) || /^\d+,?\d/.test( value );
        }, "请输入正确的金额" );
        jQuery(function($) {
            function toThousands() {
                var regStrs = [
                    ['^0(\\d|.+)$', '$1'], //禁止录入整数部分两位以上，但首位为0
                    [/[^\d.]/g, ''], //禁止录入任何非数字和点
                    [/,/g, ''], //禁止录入任何非数字和点
                    ['\\.(\\d?)\\.+', '.$1'], //禁止录入两个以上的点
                    ['^(\\d+\\.\\d{2}).+', '$1'] //禁止录入小数点后两位以上
                ];
                for(i=0; i<regStrs.length; i++){
                    var reg = new RegExp(regStrs[i][0]);
                    this.value = this.value.replace(reg, regStrs[i][1]);
                }
                this.value = (this.value || '').replace(/(\d)(?=(?:\d{3})+$)/g, '$1,');
            }
            $(document).on('blur','#registered_capital',toThousands);
            $(document).on('blur','#turnover_year1',toThousands);
            $(document).on('blur','#net_margin_year1',toThousands);
            $(document).on('blur','#turnover_year2',toThousands);
            $(document).on('blur','#net_margin_year2',toThousands);
            $(document).on('blur','#turnover_year3',toThousands);
            $(document).on('blur','#net_margin_year3',toThousands);
            $(document).on('blur','#turnover_year3',toThousands);
            $(document).on('blur','#net_margin_year3',toThousands);
            $(document).on('blur','#turnover_year4',toThousands);
            $(document).on('blur','#net_margin_year4',toThousands);
            //企业性质
            var enterprise_nature = $('#enterprise_nature');
            var eid = enterprise_nature.data('id');
            if (!!eid)enterprise_nature.val(eid);

            //导航高亮
            highlight_subnav('{:U('member/companyindex')}');
            $('#sub-btn').click(function (event) {
                if(!$('#company').valid()) {
                    alert("表单填写有错误，请检查！");
                } else {
                    $('#hidebtn').click();
                }
            });
            function getInt(val) {
                return isNaN(parseInt(val)) ? 0 : parseInt(val);
            }
            //自动累加人员总数
            var Rapp = Regular.extend({
                template: '#rtpl',
                computed: {
                    total_people_count:{
                        get: function (data) {
                            return getInt(data.production_people_count) +
                                getInt(data.manage_people_count) +
                                getInt(data.marketing_people_count) +
                                getInt(data.technology_people_count) +
                                getInt(data.other_people_count);
                        }
                    }
                }
            });
            var rapp = new Rapp().$inject("#rapp");

            $('#company').validate({
                errorElement: 'div',
                errorClass: 'help-block',
                focusInvalid: false,
                rules:{
                    shareholder_num:{
                        required: true,
                        number: true
                    },
                    tenure_desc:{
                        required: true
                    },
                    business_licence_url: {
                        required: true
                    },
                    corporation_name:{
                        required: true
                    },
                    enterprise_nature: {
                        required: true
                    },
                    company_name: {
                        required: true
                    },
                    registered_capital: {
                        required: true,
                        integer: true
                    },
                    total_asset_turnover: {
                        required: true,
                        number: true,
                    },
                    accounts_receivable_turnover: {
                        required: true,
                        number: true,
                        max: 100
                    },
                    gross_profit_margin:{
                        required: true,
                        number: true,
                        max: 100
                    },
                    production_people_count:{
                        required: true,
                        number:true,
                    },
                    manage_people_count:{
                        required: true,
                        number:true,
                    },
                    marketing_people_count:{
                        required: true,
                        number:true,
                    },
                    technology_people_count:{
                        required: true,
                        number:true,
                    },
                    other_people_count:{
                        required: true,
                        number:true,
                    },
                    people_age_count1:{
                        required: true,
                        number:true,
                    },
                    people_age_count2:{
                        required: true,
                        number:true,
                    },
                    people_age_count3:{
                        required: true,
                        number:true,
                    },
                    people_age_count4:{
                        required: true,
                        number:true,
                    },
                    people_age_count5:{
                        required: true,
                        number:true,
                    },
                    people_age_count6:{
                        required: true,
                        number:true,
                    },
                    employee_turnover:{
                        required: true,
                        number:true,
                        max:100
                    },
                    turnover_year1:{
                        integer: true,
                        required: true,
                    },
                    net_margin_year1: {
                        integer: true,
                        required: true,
                    },
                    turnover_year2:{
                        integer: true,
                        required: true,
                    },
                    net_margin_year2: {
                        integer: true,
                        required: true,
                    },
                    turnover_year3:{
                        integer: true,
                        required: true,
                    },
                    net_margin_year3: {
                        integer: true,
                        required: true,
                    },
                    turnover_year4:{
                        integer: true,
                        required: true,
                    },
                    net_margin_year4: {
                        integer: true,
                        required: true,
                    },
                    marketing_area_domestic:{
                        required:true
                    },
                    marketing_area_abroad:{
                        required: true
                    },
                    marketing_processes_desc: {
                        required: true
                    },
                    product_desc: {
                        required: true
                    },
                    business_model_desc: {
                        required: true
                    },
                    operating_model_desc: {
                        required: true
                    },
                    profit_model_desc: {
                        required: true
                    },
                    enterprise_difficulty_desc: {
                        required: true
                    },
                    self_introduction_desc: {
                        required: true
                    },
                    expectation_desc: {
                        required: true
                    },
                    need_support_question: {
                        required: true
                    }
                },

                messages: {
                    gross_profit_margin:{
                        number:"请输入数字",
                        max: '最大值100%'
                    },
                    accounts_receivable_turnover:{
                        number: "请输入数字",
                        max: "最大值100%"
                    },
                    total_asset_turnover: {
                        number: "请输入数字"
                    },
                    registered_capital: {
                        number: "请输入数字"
                    },
                    shareholder_num: {
                        number: "请输入数字"
                    },
                    marketing_people_count:{
                        number:"请输入数字",
                    },
                    manage_people_count:{
                        number:"请输入数字",
                    },
                    turnover_year1:{
                        integer:"请输入数字",
                    },
                    net_margin_year1: {
                        integer:"请输入数字",
                    },
                    turnover_year2:{
                        integer:"请输入数字",
                    },
                    net_margin_year2: {
                        integer:"请输入数字",
                    },
                    turnover_year3:{
                        integer:"请输入数字",
                    },
                    net_margin_year3: {
                        integer:"请输入数字",
                    },
                    turnover_year4:{
                        integer:"请输入数字",
                    },
                    net_margin_year4: {
                        integer:"请输入数字",
                    },
                    employee_turnover: {
                        number:"请输入数字",
                        max: '最大值100%'
                    },
                    people_age_count1: {
                        number:"请输入数字",
                    },
                    people_age_count2: {
                        number:"请输入数字",
                    },
                    people_age_count3: {
                        number:"请输入数字",
                    },
                    people_age_count4: {
                        number:"请输入数字",
                    },
                    people_age_count5: {
                        number:"请输入数字",
                    },
                    people_age_count6: {
                        number:"请输入数字",
                    },

                    other_people_count:{
                        number:"请输入数字",
                    },
                    technology_people_count:{
                        number:"请输入数字",
                    },
                    production_people_count:{
                        number: "请输入数字"
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit
                    $('.alert-danger', $('.login-form')).show();
                },

                highlight: function (e) {
                    $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                },

                success: function (e) {
                    $(e).closest('.form-group').removeClass('has-error')
                    $(e).remove();
                },

                errorPlacement: function (error, element) {
                    if(element.is(':checkbox') || element.is(':radio')) {
                        var controls = element.closest('div[class*="col-"]');
                        if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                        else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                    }
                    else if(element.is('.select2')) {
                        error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                    }
                    else if(element.is('.chosen-select')) {
                        error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
                    }
                    else error.insertAfter(element.parent());
                },

                submitHandler: function (form) {
                },
                invalidHandler: function (form) {
                }
            });


        })
    </script>

</block>