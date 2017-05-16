<div style="padding-top: 40px;margin: 5px 0">
    <div id="chart" style="width:100%;height:500px;"></div>
</div>
<div>
    <table class="table table-hover" >
        <thead>
        <tr>
            <th>日期</th>
            <th>充值笔数</th>
            <th>充值金额</th>
            <th>退卡笔数</th>
            <th>退卡金额</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data2 as $val) { ?>
            <tr>
                <td><?php echo $val['day'] ?></td>
                <td><?php echo $val['chagenum'] ?></td>
                <td><?php echo $val['charge'] ?></td>
                <td><?php echo $val['tuikanum'] ?></td>
                <td><?php echo $val['tuika'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    $(function () {
        var myChart = echarts.init(document.getElementById('chart'));//初始化
        //图表
        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '充值款台'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: ['充值总额', '退卡总额']
            },
            calculable: true,
            yAxis: [
                {
                    type: 'value',
                    name: '金额(元)',
                    boundaryGap: false
                }
            ],
            xAxis: [
                {
                    type: 'category',
                    name: '日期',
                    boundaryGap: true,
                    data: <?php echo json_encode($data1['day']);?>
                }
            ],
            series: [
                {
                    name: '充值总额',
                    type: 'line',
                    data: <?php echo json_encode($data1['chage']);?>
                },
                {
                    name: '退卡总额',
                    type: 'line',
                    data: <?php echo json_encode($data1['tuika']);?>
                }
            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    })
</script>