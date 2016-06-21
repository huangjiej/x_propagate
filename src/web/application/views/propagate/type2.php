
<!-- Fixed navbar -->
<div id="main" style="height: 600px;width:100%;"></div>

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<block name="script">
<script src="http://cdn.bootcss.com/echarts/3.1.10/echarts.min.js"></script>
    <script src="//cdn.bootcss.com/echarts/3.1.10/extension/dataTool.js"></script>
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('main'));
    myChart.showLoading();
    $.get('/data/les-miserables.gexf', function (xml) {
        console.info(xml)
        myChart.hideLoading();

        var graph = echarts.dataTool.gexf.parse(xml);
        var categories = [];
        for (var i = 0; i < 9; i++) {
            categories[i] = {
                name: '类目' + i
            };
        }
        graph.nodes.forEach(function (node) {
            node.itemStyle = null;
            node.symbolSize = 10;
            node.value = node.symbolSize;
            node.category = node.attributes.modularity_class;
            // Use random x, y
            node.x = node.y = null;
            node.draggable = true;
        });
        option = {
            title: {
                text: 'Les Miserables',
                subtext: 'Default layout',
                top: 'bottom',
                left: 'right'
            },
            tooltip: {},
            legend: [{
                // selectedMode: 'single',
                data: categories.map(function (a) {
                    return a.name;
                })
            }],
            animation: false,
            series : [
                {
                    name: 'Les Miserables',
                    type: 'graph',
                    layout: 'force',
                    data: graph.nodes,
                    links: graph.links,
                    categories: categories,
                    roam: true,
                    label: {
                        normal: {
                            position: 'right'
                        }
                    },
                    force: {
                        repulsion: 100
                    }
                }
            ]
        };

        myChart.setOption(option);
    }, 'xml');
</script>
</block>
