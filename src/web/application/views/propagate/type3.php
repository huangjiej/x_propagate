
<!-- Fixed navbar -->
<div id="main" style="height: 600px;width:100%;"></div>

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<block name="script">
    <script src="http://echarts.baidu.com/build/dist/echarts-all.js"></script>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts图表
        var myChart = echarts.init(document.getElementById('main'));

        var option = {
            title: {
                text: 'STEP DAY：x传播',
                subtext: 'From:www.xpfengniao.info',
                x: 'right',
                y: 'bottom'
            },
            tooltip: {
                trigger: 'item',
                formatter: '{a} : {c}'
            },
            legend: {
                x: 'left',
                data: []
            },
            series: [
                {
                    type: 'force',
                    name: "阅读数",
                    categories: [
                        {
                            name: '阅读数',
                            itemStyle: {
                                normal: {
                                    color: '#ff7f50'
                                }
                            }
                        }
                    ],
                    itemStyle: {
                        normal: {
                            label: {
                                show: true,
                                textStyle: {
                                    color: '#800080'
                                }
                            },
                            nodeStyle: {
                                brushType: 'both',
                                strokeColor: 'rgba(255,215,0,0.4)',
                                lineWidth: 8
                            }
                        }
                    },
                    minRadius: 10,
                    maxRadius: 15,
                    density: 0.05,
                    large:true,
                    useWorker:true,
                    attractiveness: 1.0,
                    nodes: <?=$nodes?>,
                    links: <?=$links?>
                }
            ]
        };

        // 为echarts对象加载数据
        myChart.setOption(option);
    </script>
</block>
