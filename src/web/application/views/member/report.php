<script src="http://cdn.bootcss.com/echarts/3.1.10/echarts.min.js"></script>

<div id="main" style="width:100%;height:280px;"></div>
<div class="report-title" style="background: #fff; position: relative;z-index: 99; margin-top: -38px;">
    <div class="table">
        <div class="table-cell" style="width: .4rem;text-align: center;">
            <p ><img style="height: .29rem;vertical-align:middle;" src="/images/报告详细.png" alt=""></p>
        </div>
        <div class="table-cell">
            <p>报告详细<span class="report-date">（<?= time_format(time(),'m-d') ?>）</span></p>
        </div>
    </div>
</div>

<ul class="report-info">
    <li>
        <img style="" src="/images/BMI（小）.png" alt="">
        <p class="report-data">BMI（<?= $health['bmi'] ?>）</p>
        <?= bmi_detail_btn($health['bmi'], $wx_id) ?>
    </li>
    <li>
        <img style="" src="/images/脂肪（小）.png" alt="">
        <p class="report-data">体脂率（<?= $health['fat'] ?>）</p>
        <?= fat_detail_btn($health['fat'], $wx_id) ?>
    </li>
    <li>
        <img style="" src="/images/肌肉（小）.png" alt="">
        <p class="report-data">肌肉（<?= $health['muscle'] ?>）</p>
        <?= muscle_detail_btn($health['muscle'], $wx_id) ?>
    </li>
    <li>
        <img style="" src="/images/水分（小）.png" alt="">
        <p class="report-data">水分（<?= $health['water'] ?>）</p>
        <?= water_detail_btn($health['water'], $wx_id) ?>
    </li>
    <li>
        <img style="" src="/images/蛋白质（小）.png" alt="">
        <p class="report-data">蛋白质（<?= $health['protein'] ?>）</p>
        <?= protein_detail_btn($health['protein'], $wx_id) ?>
    </li>
    <li>
        <img style="" src="/images/内脏脂肪（小）.png" alt="">
        <p class="report-data">内脏脂肪（<?= $health['visceralfat'] ?>）</p>
        <?= visceralfat_detail_btn($health['visceralfat'], $wx_id) ?>
    </li>
    <li>
        <img style="" src="/images/骨量（小）.png" alt="">
        <p class="report-data">骨量（<?= $health['bone'] ?>）</p>
        <a href="/member/info?tab=6&wx_id=<?= $wx_id ?>" class="weui_btn weui_btn_mini weui_btn_primary">正常</a>
    </li>
    <li>
        <img style="" src="/images/基础代谢（小）.png" alt="">
        <p class="report-data">基础代谢率（<?= $health['bmr'] ?>）</p>
        <a href="/member/info?tab=7&wx_id=<?= $wx_id ?>" class="weui_btn weui_btn_mini weui_btn_primary">正常</a>
    </li>
    <li>
        <img style="" src="/images/身体年龄（小）.png" alt="">
        <p class="report-data">身体年龄（<?= $health['bodyage'] ?>）</p>
        <a href="/member/info?tab=8&wx_id=<?= $wx_id ?>" class="weui_btn weui_btn_mini weui_btn_primary">正常</a>
    </li>
</ul>

<div class="report-title">
    <div class="table">
        <div class="table-cell" style="width: .4rem;text-align: center;">
            <p ><img style="height: .29rem;vertical-align:middle;" src="/images/体围详细.png" alt=""></p>
        </div>
        <div class="table-cell">
            <p>体围详细<span class="report-date">（<?= time_format(time(),'m-d') ?>）</span></p>
        </div>
    </div>
</div>
<style>

</style>
<ul class="report-info table">
    <li class="table-cell report-info-li">
        <p><span class="report-info-name">肩宽</span></p>
        <p class="report-info-data"><?= $health['shoulder'] ?></p>
    </li>
    <li class="table-cell report-info-li">
        <p><span class="report-info-name">胸围</span></p>
        <p class="report-info-data"><?= $health['chest'] ?></p>
    </li>
    <li class="table-cell report-info-li">
        <p><span class="report-info-name">腰围</span></p>
        <p class="report-info-data"><?= $health['waist'] ?></p>
    </li>
    <li class="table-cell report-info-li">
        <p><span class="report-info-name">臀围</span></p>
        <p class="report-info-data"><?= $health['hip'] ?></p>
    </li>
    <li class="table-cell report-info-li">
        <p><span class="report-info-name">臂围</span></p>
        <p class="report-info-data"><?= $health['bicep'] ?></p>
    </li>
    <li class="table-cell report-info-li">
        <p><span class="report-info-name">大腿围</span></p>
        <p class="report-info-data"><?= $health['thigh'] ?></p>
    </li>
    <li class="table-cell report-info-li">
        <p><span class="report-info-name">小腿围</span></p>
        <p class="report-info-data"><?= $health['calf'] ?></p>
    </li>
    <li class="table-cell report-info-li">

    </li>
    <li class="table-cell report-info-li">

    </li>
</ul>
<block name="script">
<script>
    //console.log(JSON.parse('<?=  $weights ?>'))
    var myChart = echarts.init(document.getElementById('main'));
    option = {
        backgroundColor:'#7acc2a',
        borderColor:'#fff',
        textStyle:{
            color:'#fff',
        },
        tooltip: {
            show: false,
        },
        grid:{
            top: '8%',
            right: '5%',
            left: '8%'
        },
        legend: {
        },
        xAxis:  {
            type: 'category',
            boundaryGap: false,
            data: JSON.parse('<?=  $dates ?>'),
            axisLine:{
                show:false
            },
            axisTick: {
                show: false
            },
            axisLabel: {
                formatter: '{value}',
                textStyle: {
                    color: '#fff',
                }
            },
            splitLine: {
                show: false
            }
        },
        yAxis: [
            {
                type: 'value',
                axisLine:{
                    show:true,
                    lineStyle:{
                        color:'#fff'
                    }
                },
                axisTick: {
                    show: false
                },
                axisLabel: {
                    formatter: '{value}',
                    textStyle: {
                        color: '#fff',
                    }
                },
                nameTextStyle: {
                    color: '#fff',
                    fontStyle: 'normal',
                    fontWeight: 'normal',
                    fontFamily: 'sans-serif',
                    fontSize: 12,
                },
                data: [{
                    value: '体重',
                    textStyle: {
                        color: '#fff',
                        fontStyle: 'normal',
                        fontWeight: 'normal',
                        fontFamily: 'sans-serif',
                        fontSize: 12,
                    },
                }],
                splitLine: {
                    lineStyle: {
                        color: ['#ccc'],
                        width: 1,
                        type: 'dashed'
                    }
                }
            },
            {
                max: 1,
                min: 0,
                position: 'right',
                gridIndex: 0,
                type: 'value',
                axisLine:{
                    show:false,
                    lineStyle:{
                        color:'#fff'
                    }
                },
                axisTick: {
                    show: false
                },
                axisLabel: {
                    show: false
                },
                nameTextStyle: {
                    color: '#fff',
                    fontStyle: 'normal',
                    fontWeight: 'normal',
                    fontFamily: 'sans-serif',
                    fontSize: 12,
                },
                data: [{
                    value: '体重',
                    textStyle: {
                        color: '#fff',
                        fontStyle: 'normal',
                        fontWeight: 'normal',
                        fontFamily: 'sans-serif',
                        fontSize: 12,
                    },
                }],
                splitLine: {
                    lineStyle: {
                        color: ['#ccc'],
                        width: 1,
                        type: 'dashed'
                    },
                }
            },
        ],
        dataZoom: [{
            type: 'inside',
            start: 100,
            end: 82,
            filterMode: 'empty'
        }],
        series: [
            {
                name:'体脂率',
                type:'line',
                itemStyle:{
                    normal:{
                        color:'#fff',
                        borderWidth:3
                    }
                },
                lineStyle:{
                    normal:{
                        color:'#fff'
                    }
                },
                yAxisIndex:1,
                data:JSON.parse('<?=  $fats ?>'),
                markPoint: {
                    data: [
//                        {type: 'max', name: '最大值'},
                    ]
                },
                label: {
                    normal: {
                        show: true,
                        position: 'top'
                    }
                }
            },
            {
                name:'体重',
                type:'line',
                itemStyle:{
                    normal:{
                        color:'#fff',
                        borderWidth:3
                    }
                },
                lineStyle:{
                    normal:{
                        color:'#fff'
                    }
                },
                data:JSON.parse('<?=  $weights ?>'),
                markPoint: {
                    itemStyle:{
                        normal:{
                            color:'#fff'
                        }
                    },
                    data: [
//                        {type: 'max', name: '最大值'},
                    ]
                },
                label: {
                    normal: {
                        show: true,
                        position: 'top'
                    }
                },
            }
        ]
    };
    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);

    myChart.on('click', function (params) {
        console.log(params);
    })
</script>
    </block>