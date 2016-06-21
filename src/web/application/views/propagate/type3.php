
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
                text: 'STEP DAY：网站地图',
                subtext: 'From:www.stepday.com',
                x: 'right',
                y: 'bottom'
            },
            tooltip: {
                trigger: 'item',
                formatter: '{a} : {b}'
            },
            legend: {
                x: 'left',
                data: []
            },
            series: [
                {
                    type: 'force',
                    name: "点击访问",
                    categories: [
                        {
                            name: '点击访问',
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
                    minRadius: 5,
                    maxRadius: 15,
                    density: 0.05,
                    attractiveness: 1.2,
                    nodes: <?=$nodes?>,
                    links: <?=$links?>
                }
            ]
        };

        // 为echarts对象加载数据
        myChart.setOption(option);
    </script>
</block>
