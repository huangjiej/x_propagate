<style>
    .col-xs-4 p,.col-xs-4 h2 {text-align: center;}
    .col-xs-4 p>a>i {
        display: inline-block;
        font-size: 42px;
        margin: 0 0 4px;
        height: 180px;
        min-width: 180px;
        padding: 0;
    }
    .col-xs-4 .course i { background: url("__ACE__/images/background/reg.png") no-repeat;}
    .col-xs-4 .company i { background: url("__ACE__/images/background/company.png") no-repeat;}
    .col-xs-4 .reg i { background: url("__ACE__/images/background/course.png") no-repeat;}

</style>
 <div class="row">
    <div class="col-sm-12">
    <?php if(isset($is_member)):?>
        <div class="col-xs-12">
            <div class="col-xs-4">
                <p>
                    <a href="<?=U('my/reg')?>" class="course">
                        <i></i>
                    </a>
                </p>
                <h2>
                    注册信息
                </h2>
            </div>

            <?php if(!empty($company_info) && $company_info['check_status'] == 'OK#'):?>
                <div class="col-xs-4">
                    <p>
                        <a href="<?=U('my/companyedit')?>" class="company">
                            <i></i>
                        </a>
                    </p>
                    <h2>
                        建档信息

                    </h2>
                </div>

                <div class="col-xs-4">
                    <p><a href="<?=U('my/courses')?>" class="reg">
                            <i></i>
                        </a></p>
                    <h2>
                        我的课程

                    </h2>
                </div>
            <?php endif;?>

            <?php if(empty($company_info)):?>
            <p>
                <div class="alert alert-danger">
                    您需要先完善了建档，才能进行课程相关的操作！
                </div>
                <a href="<?=U('my/companyadd')?>" class="btn btn-success">完善建档信息</a>
            </p>
            <?php elseif($company_info['check_status'] == 'WAT'):?>
            <div class="alert alert-info">
                您的建档信息正在审核，审核通过后，您将可以进行课程相关的操作！
            </div>
            <?php endif;?>
        </div>
    <?php else:?>
        <div class="infobox infobox-green">
            <div class="infobox-icon">
                <i class="icon-group"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number">{$info.user}</span>
                <div class="infobox-content">用户数</div>
            </div>
        </div>

        <div class="infobox infobox-blue">
            <div class="infobox-icon">
                <i class="icon-briefcase"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number">{$info.action}</span>
                <div class="infobox-content">用户行为</div>
            </div>

        </div>

        <div class="infobox infobox-pink">
            <div class="infobox-icon">
                <i class="icon-text-width"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number">{$info.document}</span>
                <div class="infobox-content">文档数</div>
            </div>
        </div>

        <div class="infobox infobox-red">
            <div class="infobox-icon">
                <i class="icon-beaker"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number">{$info.model}</span>
                <div class="infobox-content">文档模型</div>
            </div>
        </div>

        <div class="infobox  infobox-blue">
            <div class="infobox-icon">
                <i class="icon-list-alt"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number">{$info.category}</span>
                <div class="infobox-content">分类数</div>
            </div>
        </div>
        <div class="hr hr-dotted"></div>
        <a href="<?=U('config/asyncNews')?>" class="btn btn-app btn-success ajax-get">
            <i class="icon-refresh bigger-230"></i>
            同步素材
        </a>
    <?php endif;?>

    </div>
</div><!-- /row -->
<div class="hr hr32 hr-dotted"></div>