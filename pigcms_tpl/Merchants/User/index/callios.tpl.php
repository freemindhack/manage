<div style="padding-top: 40px;margin: 20px 0">
    <div id="chartEx" style="width:100%;height:500px;"></div>
</div>
<div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>交易日期</th>
            <th>餐卡笔数</th>
            <th>金额</th>
            <th>微信笔数</th>
            <th>金额</th>
            <th>支付宝笔数</th>
            <th>金额</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data2 as $val) { ?>
            <tr>
                <td><?php echo $val['day'] ?></td>
                <td><?php echo $val['cknum'] ?></td>
                <td><?php echo $val['ckto'] ?></td>
                <td><?php echo $val['wxnum'] ?></td>
                <td><?php echo $val['wxto'] ?></td>
                <td><?php echo $val['zfbnum'] ?></td>
                <td><?php echo $val['zfbto'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    $(function () {
        var myChart2 = echarts.init(document.getElementById('chartEx'));//初始化
        //图表
        // 指定图表的配置项和数据
        var option2 = {
            title: {
                text: '档口收款机',
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: ['交易笔数', '交易总额']
            },
            calculable: true,
            yAxis: [
                {
                    type: 'value',
                    name: '总量',
                    boundaryGap: false,
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
                    name: '交易笔数',
                    type: 'line',
                    data: <?php echo json_encode($data1['num']);?>,
                },
                {
                    name: '交易总额',
                    type: 'line',
                    data: <?php echo json_encode($data1['chage']);?>,
                }
            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart2.setOption(option2);
    })
</script>