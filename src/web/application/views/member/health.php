<div class="table health-top">
    <div class="table-cell">
        <p style="font-size: 1.37rem;"><?= $health['weight'] ?><span style="font-size: .68rem;position: relative;">
                <span style="position: absolute;top: -.4rem;
    width: 1rem;
    left: .1rem;
    text-align: left;
    font-size: .26rem;">公斤</span></span></p>
        <div style="width: 50%;margin: 0 auto;">
            <p style="font-size: .3rem;">BMI <?= $health['bmi'] ?> | <?= bmi_detail($health['bmi']) ?></p>
        </div>
    </div>
</div>

<div class="table health-center">
    <div class="table-cell">
        <a href="/member/report?wx_id=<?=$wx_id?>">
            <img src="/images/体重趋势a.png" alt="体重趋势">
            <p style="font-size: .31rem">健康报告</p>
        </a>
    </div>
    <div class="table-cell">
        <a href="/member/dare">
            <img src="/images/体重趋势b.png" alt="体重趋势">
            <p style="font-size: .31rem">健康挑战</p>
        </a>
    </div>
    <div class="table-cell">
        <a href="javascript:;">
            <img src="/images/体重趋势c.png" alt="体重趋势">
            <p style="font-size: .31rem">运动饮食</p>
        </a>
    </div>
</div>

<div class="new-split"></div>

<div class="table health-foot">
    <div class="table-cell">
        <p style="padding: .25rem 0;font-size: .3rem">健康TIPS</p>
        <div class="data-img">
            <div class="data-nums table">
                <span class="table-cell">18.5</span>
                <span class="data-cw-20 table-cell">24.0</span>
                <span class="data-cw-20 table-cell">28.0</span>
                <span class="data-cw-20 table-cell">35.0</span>
            </div>
            <div class="data-slide">
                <div class="data">
                    <div class="first data-cell c1 data-cw-20" >
                    </div>
                    <div class="data-cell c2 data-cw-20" >
                    </div>
                    <div class="data-cell c3 data-cw-20" >
                    </div>
                    <div class="data-cell c5 data-cw-20" >
                    </div>
                    <div class="last data-cell c6 data-cw-20" >
                    </div>

                    <div class="data-val-cur" style="left: <?= bmi_left($health['bmi']) ?>">
                        <img src="<?= bmi_is_ok($health['bmi']) ?>" alt="">
                    </div>
                </div>
            </div>
            <div class="data-val table">
                <span class="data-cw-20 table-cell">偏低</span>
                <span class="data-cw-20 table-cell">正常</span>
                <span class="data-cw-20 table-cell">偏胖</span>
                <span class="data-cw-20 table-cell">肥胖</span>
                <span class="data-cw-20 table-cell">极胖</span>
            </div>
        </div>
    </div>
</div>