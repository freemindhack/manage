<?php
bpBase::loadAppClass('common', 'User', 0);

class report_controller extends common_controller
{
    private $reportDb;
    private $reportczDb;

    public function __construct()
    {
        parent::__construct();
        $shop = array();
        //$this->authorityControl(array('rolesEdit', 'checkAccount','roleDel'));
        $db_config = loadConfig('db');
        $this->tablepre = $db_config['default']['tablepre'];
        $this->reportDb = M('report_merchant_day');
        $this->reportczDb = M('report_recharge_day');
        $this->shopsDb = M('cashier_shops');


    }

    public function report_qindan()
    {
        if ($_GET['export'] == 1) ajaxReturn('', '请先查找后再导出！', 2);
        $shops = M('shop')->select(array('IsDel' => 0));
        foreach ($shops as $k => $v) {
            $shop[$v['id']] = $v['Name'] . "[{$v['no']}]";
        }

        include $this->showTpl();
    }

    public function report_congzhi()
    {
        include $this->showTpl();
    }

    public function report_Onlinecongzhi()
    {
        include $this->showTpl();
    }

    public function report_tongji()
    {
        /* $shops = M('shop')->select(array('IsDel'=>0));
         foreach ($shops as $k => $v) {
             $shop[$v['id']] = $v['Name']."[{$v['no']}]";
         }*/
        $shops = M('user')->select(array('IsDel' => 0, 'groupId' => 0));
        foreach ($shops as $k => $v) {
            $ddd = M('shop')->select(array('UId' => $v['id'], 'IsDel' => 0));
            $shop[$v['id']] = $ddd[0]['Name'];
        }

        include $this->showTpl();

    }

    //自定义统计
    public function report_sum()
    {
        $shops = M('user')->select(array('IsDel' => 0));
        foreach ($shops as $k => $v) {
            $d = M('shop')->get_one(array('UId' => $v['id']));
            $shop[$v['id']] = $d['Name'] . "[{$d['no']}]";
        }
        include $this->showTpl();
    }

    //自定义统计
    public function report_sumget()
    {
        $shops = M('user')->select(array('IsDel' => 0));
        foreach ($shops as $k => $v) {
            $d = M('shop')->get_one(array('UId' => $v['id']));
            $shop[$v['id']] = $d['Name'] . "[{$d['no']}]";
        }
        $data = $this->clear_html($_GET);
        //C:餐卡 X:现金，W:微信，Z:支付宝，Y:银行卡,R:人工修正
        bpBase::loadOrg('common_page');
        unset($data['m'], $data['c'], $data['a']);

        $shops = $this->shopsDb->select();
        //dump($data);
        $sql = ' SELECT	SUM(CASE WHEN payType=1 THEN price ELSE 0 END) cashAmount,
				SUM(CASE WHEN payType=6 THEN price ELSE 0 END) cardAmount,
				SUM(CASE WHEN payType=13 THEN price ELSE 0 END) weChatAmount,
				SUM(CASE WHEN payType=14 THEN price ELSE 0 END) aliPayAmount,
				SUM(price) totalAmount,
				Uid as uid FROM `' . $this->tablepre . 'order_paytype`   where ';
        // GROUP BY Uid ORDER BY Uid DESC
        $where = '';
        foreach ($data as $k => $v) {
            if ($data[$k] == '') {
                unset($data[$k]);
            }
        }
        if (isset($data['uid'])) {
            $where .= ' and uid = "' . $data['uid'] . '"';
        }
        if (isset($data['dtbegin'])) {
            $data[dtbegin] = $data[dtbegin] . ' 00:00:00';
            $where .= " and `UploadTime` >='$data[dtbegin]'";
        }
        if (isset($data['dtend'])) {
            $data[dtend] = $data[dtend] . ' 23:59:59';
            $where .= " and `UploadTime` <='$data[dtend]'";
        }

        $cardRecordDb = M('order_paytype');


        $sqlObj = new model();
        $where = ltrim($where, ' and ');
        /*    $_count = $cardRecordDb->count($where);

            $p = new Page($_count, 15);
            $pagebar = $p->show(2);*/
        $sql = $sql . $where;
        $sql = rtrim($sql, ' where ');
        $sql .= ' group BY Uid ORDER BY Uid DESC ';//limit ' . $p->firstRow . ',' . $p->listRows;
        @$result = $sqlObj->selectBySql($sql);//dump($result);
        if ($_GET['export'] == 1) {

            include RL_PIGCMS_CORE_PATH . 'libs' . DIRECTORY_SEPARATOR . 'org' . '/PHPExcel/Writer/Excel2007.php';
            include RL_PIGCMS_CORE_PATH . 'libs' . DIRECTORY_SEPARATOR . 'org' . '/PHPExcel.php';
            $objPHPExcel = new PHPExcel();
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
            header("Content-Type:application/force-download");
            header("Content-Type:application/vnd.ms-excel");
            header("Content-Type:application/octet-stream");
            //header("Content-Disposition:inline;filename='123.xls'");
            header('Content-Disposition:attachment;filename="商户时间段销售统计' . date("YmdHis", time()) . '.xlsx"');
            header("Content-Transfer-Encoding:binary");
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(17);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(17.5);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(17.5);
            $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setName('Microsoft Yahei');
            $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setSize(13);
            $objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
            $objPHPExcel->getActiveSheet()->mergeCells('B1:B2');
            $objPHPExcel->getActiveSheet()->mergeCells('C1:J1');
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '商户');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '总销售额');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '其中');
            $objPHPExcel->getActiveSheet()->setCellValue('C2', '现金');
            $objPHPExcel->getActiveSheet()->setCellValue('D2', '银行卡');
            $objPHPExcel->getActiveSheet()->setCellValue('E2', '微信');
            $objPHPExcel->getActiveSheet()->setCellValue('F2', '支付宝');
            $objPHPExcel->getActiveSheet()->setCellValue('G2', '礼品卷');
            $objPHPExcel->getActiveSheet()->setCellValue('H2', '团购');
            $objPHPExcel->getActiveSheet()->setCellValue('I2', '其他');
            $objPHPExcel->getActiveSheet()->setCellValue('J2', '乐享卡');
            foreach ($result as $key => $value) {
                $i = $key + 3;
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $shop[$value['uid']]);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $value['totalAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $value['cashAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $value['bankCardAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $value['weChatAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $value['aliPayAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $value['giftAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $value['tuanAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $value['otherAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $value['cardAmount']);
            }
            $objWriter->save('php://output');
            exit();
        }
        include $this->showTpl('report_sum');
    }

    public function report_Onlinetongji()
    {
        $shopSql = 'select * from `pospi_vender`';
        $model = new model();
        $shops = $model->selectBySql($shopSql);
        foreach ($shops as $k => $v) {
            $shop[$v['UId']] = $v['UserName'] . "[{$v['shopname']}]";
        }
        include $this->showTpl();

    }

    public function report_Sea()
    {
        $data = $this->clear_html($_GET);
        //C:餐卡 X:现金，W:微信，Z:支付宝，Y:银行卡,R:人工修正
        bpBase::loadOrg('common_page');
        unset($data['m'], $data['c'], $data['a']);

        //$shops = $this->shopsDb->select();
        //dump($data);
        $sql = 'select * from ' . $this->tablepre . 'report_merchant_day where ';
        $where = '';
        foreach ($data as $k => $v) {
            if ($data[$k] == '') {
                unset($data[$k]);
            }
        }
        if (isset($data['uid'])) {
            $where .= ' and uid = "' . $data['uid'] . '"';
        }
        if (isset($data['dtbegin'])) {
            $where .= " and `date` >='$data[dtbegin]'";
        }
        if (isset($data['dtend'])) {
            $where .= " and `date` <='$data[dtend]'";
        }

        $cardRecordDb = M('report_merchant_day');


        $sqlObj = new model();
        $where = ltrim($where, ' and ');
        $_count = $cardRecordDb->count($where);

        $p = new Page($_count, 15);
        $pagebar = $p->show(2);
        $sql = $sql . $where;
        $sql = rtrim($sql, 'where ');
        $sql .= ' order by `date` desc limit ' . $p->firstRow . ',' . $p->listRows;
        @$result = $sqlObj->selectBySql($sql);
        $shops = M('user')->select(array('IsDel' => 0, 'groupId' => 0));
        foreach ($shops as $k => $v) {
            $ddd = M('shop')->select(array('UId' => $v['id'], 'IsDel' => 0));
            $shop[$v['id']] = $ddd[0]['Name'];
        }
        /*$shops = M('shop')->select(array('IsDel'=>0));
            foreach ($shops as $k => $v) {
                $shop[$v['id']] = $v['Name']."[{$v['no']}]";
            }*/

        include $this->showTpl('report_tongji');

    }

    public function report_OnlineSea()
    {
        $data = $this->clear_html($_GET);
        //C:餐卡 X:现金，W:微信，Z:支付宝，Y:银行卡,R:人工修正
        bpBase::loadOrg('common_page');
        unset($data['m'], $data['c'], $data['a']);

        $shops = $this->shopsDb->select();
        //dump($data);
        $sql = 'select * from ' . $this->tablepre . 'onlinecard_report_merchant_day where ';
        $where = '';
        foreach ($data as $k => $v) {
            if ($data[$k] == '') {
                unset($data[$k]);
            }
        }
        if (isset($data['uid'])) {
            $where .= ' and uid = "' . $data['uid'] . '"';
        }
        if (isset($data['dtbegin'])) {
            $where .= " and `date` >='$data[dtbegin]'";
        }
        if (isset($data['dtend'])) {
            $where .= " and `date` <='$data[dtend]'";
        }

        $cardRecordDb = M('onlinecard_report_merchant_day');


        $sqlObj = new model();
        $where = ltrim($where, ' and ');
        $_count = $cardRecordDb->count($where);

        $p = new Page($_count, 15);
        $pagebar = $p->show(2);
        $sql = $sql . $where;
        $sql = rtrim($sql, 'where ');
        $sql .= ' order by `date` desc limit ' . $p->firstRow . ',' . $p->listRows;
        @$result = $sqlObj->selectBySql($sql);
        $shopSql = 'select * from `pospi_vender`';
        $model = new model();
        $shops = $model->selectBySql($shopSql);
        foreach ($shops as $k => $v) {
            $shop[$v['UId']] = $v['UserName'] . "[{$v['shopname']}]";;
        }
        include $this->showTpl('report_Onlinetongji');

    }

    public function report_czSea()
    {
        $data = $this->clear_html($_GET);
        //C:餐卡 X:现金，W:微信，Z:支付宝，Y:银行卡,R:人工修正
        bpBase::loadOrg('common_page');
        unset($data['m'], $data['c'], $data['a']);

        //dump($data);
        $sql = 'select * from ' . $this->tablepre . 'report_recharge_day where ';
        //$sql1='SELECT SUM(totalAmount)AS num1,SUM(cashAmount)AS num2,SUM(bankCardAmount)AS num3,SUM(weChatAmount)AS num4,SUM(aliPayAmount)AS num5,SUM(giftAmount)AS num6,SUM(tuanAmount)AS num7,SUM(otherAmount)AS num8 FROM pospi_report_recharge_day where ';
        $where = '';
        foreach ($data as $k => $v) {
            if ($data[$k] == '') {
                unset($data[$k]);
            }
        }
        if (isset($data['rechargeType'])) {
            $where .= " and `rechargeType` ='$data[rechargeType]'";
        }
        if (isset($data['posNo'])) {
            $where .= " and `posNo` ='$data[posNo]'";
        }
        if (isset($data['dtbegin'])) {
            $where .= " and `date` >='$data[dtbegin]'";
        }
        if (isset($data['dtend'])) {
            $where .= " and `date` <='$data[dtend]'";
        }

        $cardRecordDb = M('report_recharge_day');


        $sqlObj = new model();
        $where = ltrim($where, ' and ');
        $_count = $cardRecordDb->count($where);

        $p = new Page($_count, 15);
        $pagebar = $p->show(2);
        $sql = $sql . $where;
        //$sql1 = $sql1 . $where;
        $sql = rtrim($sql, 'where ');
        //$sql1 = rtrim($sql1, 'where ');
        @$result = $sqlObj->selectBySql($sql);
        // @$sum = $sqlObj->selectBySql($sql1);
        //$sum=$sum['0'];
        $sum = array();
        foreach ($result as $value) {
            $sum['num1'] += $value['totalAmount'];
            $sum['num2'] += $value['cashAmount'];
            $sum['num3'] += $value['bankCardAmount'];
            $sum['num4'] += $value['weChatAmount'];
            $sum['num5'] += $value['aliPayAmount'];
            $sum['num6'] += $value['giftAmount'];
            $sum['num7'] += $value['tuanAmount'];
            $sum['num8'] += $value['otherAmount'];
        }
        $rechargeType = array(
            "C" => '充值',
            //"c" => '充值',
            "T" => '退卡',
            //"t" => '退卡',
        );
//导出
        if ($_GET['export'] == 1) {

            include RL_PIGCMS_CORE_PATH . 'libs' . DIRECTORY_SEPARATOR . 'org' . '/PHPExcel/Writer/Excel2007.php';
            include RL_PIGCMS_CORE_PATH . 'libs' . DIRECTORY_SEPARATOR . 'org' . '/PHPExcel.php';
            $objPHPExcel = new PHPExcel();
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
            header("Content-Type:application/force-download");
            header("Content-Type:application/vnd.ms-excel");
            header("Content-Type:application/octet-stream");
            header("Content-Type:application/download");
            //header("Content-Disposition:inline;filename='123.xls'");
            header('Content-Disposition:attachment;filename="交易清单' . date("YmdHis", time()) . '.xlsx"');
            header("Content-Transfer-Encoding:binary");
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(11);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setName('Microsoft Yahei');
            $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setSize(13);
            $objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
            $objPHPExcel->getActiveSheet()->mergeCells('B1:B2');
            $objPHPExcel->getActiveSheet()->mergeCells('C1:C2');
            $objPHPExcel->getActiveSheet()->mergeCells('D1:D2');
            $objPHPExcel->getActiveSheet()->mergeCells('E1:K1');

            $objPHPExcel->getActiveSheet()->setCellValue('A1', '充值款台');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '充值类型');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '报表日期');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '合计');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '其中');
            $objPHPExcel->getActiveSheet()->setCellValue('E2', '现金');
            $objPHPExcel->getActiveSheet()->setCellValue('F2', '银行卡');
            $objPHPExcel->getActiveSheet()->setCellValue('G2', '微信');
            $objPHPExcel->getActiveSheet()->setCellValue('H2', '支付宝');
            $objPHPExcel->getActiveSheet()->setCellValue('I2', '礼品券');
            $objPHPExcel->getActiveSheet()->setCellValue('J2', '团购');
            $objPHPExcel->getActiveSheet()->setCellValue('K2', '其他');
            $objPHPExcel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $data = $sqlObj->selectBySql($sql . ' order by `date` desc');
            foreach ($data as $key => $value) {
                $i = $key + 3;
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $value['posNo']);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $rechargeType[strtoupper($value['rechargeType'])]);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $value['date']);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $value['totalAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $value['cashAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $value['bankCardAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $value['weChatAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $value['aliPayAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $value['giftAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $value['tuanAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $value['otherAmount']);
            }
            $objWriter->save('php://output');
            exit();
        }

        $sql .= ' order by `date` desc limit ' . $p->firstRow . ',' . $p->listRows;


        include $this->showTpl('report_congzhi');

    }

    public function report_OnlineczSea()
    {
        $data = $this->clear_html($_GET);
        //C:餐卡 X:现金，W:微信，Z:支付宝，Y:银行卡,R:人工修正
        bpBase::loadOrg('common_page');
        unset($data['m'], $data['c'], $data['a']);

        //dump($data);
        $sql = 'select * from ' . $this->tablepre . 'onlinecard_report_recharge_day where ';
        $where = '';
        foreach ($data as $k => $v) {
            if ($data[$k] == '') {
                unset($data[$k]);
            }
        }
        if (isset($data['rechargeType'])) {
            $where .= " and `rechargeType` ='$data[rechargeType]'";
        }
        if (isset($data['posNo'])) {
            $where .= " and `posNo` ='$data[posNo]'";
        }
        if (isset($data['dtbegin'])) {
            $where .= " and `date` >='$data[dtbegin]'";
        }
        if (isset($data['dtend'])) {
            $where .= " and `date` <='$data[dtend]'";
        }

        $cardRecordDb = M('onlinecard_report_recharge_day');


        $sqlObj = new model();
        $where = ltrim($where, ' and ');
        $_count = $cardRecordDb->count($where);

        $p = new Page($_count, 15);
        $pagebar = $p->show(2);
        $sql = $sql . $where;
        $sql = rtrim($sql, 'where ');
        $rechargeType = array(
            "C" => '充值',
            //"c" => '充值',
            "T" => '退卡',
            //"t" => '退卡',
        );
        if ($_GET['export'] == 1) {

            include RL_PIGCMS_CORE_PATH . 'libs' . DIRECTORY_SEPARATOR . 'org' . '/PHPExcel/Writer/Excel2007.php';
            include RL_PIGCMS_CORE_PATH . 'libs' . DIRECTORY_SEPARATOR . 'org' . '/PHPExcel.php';
            $objPHPExcel = new PHPExcel();
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
            header("Content-Type:application/force-download");
            header("Content-Type:application/vnd.ms-excel");
            header("Content-Type:application/octet-stream");
            header("Content-Type:application/download");
            //header("Content-Disposition:inline;filename='123.xls'");
            header('Content-Disposition:attachment;filename="日充值退卡' . date("YmdHis", time()) . '.xlsx"');
            header("Content-Transfer-Encoding:binary");
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(11);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setName('Microsoft Yahei');
            $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setSize(13);
            $objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
            $objPHPExcel->getActiveSheet()->mergeCells('B1:B2');
            $objPHPExcel->getActiveSheet()->mergeCells('C1:C2');
            $objPHPExcel->getActiveSheet()->mergeCells('D1:D2');
            $objPHPExcel->getActiveSheet()->mergeCells('E1:K1');

            $objPHPExcel->getActiveSheet()->setCellValue('A1', '充值款台');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '充值类型');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '报表日期');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '合计');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '其中');
            $objPHPExcel->getActiveSheet()->setCellValue('E2', '现金');
            $objPHPExcel->getActiveSheet()->setCellValue('F2', '银行卡');
            $objPHPExcel->getActiveSheet()->setCellValue('G2', '微信');
            $objPHPExcel->getActiveSheet()->setCellValue('H2', '支付宝');
            $objPHPExcel->getActiveSheet()->setCellValue('I2', '礼品券');
            $objPHPExcel->getActiveSheet()->setCellValue('J2', '团购');
            $objPHPExcel->getActiveSheet()->setCellValue('K2', '其他');
            $objPHPExcel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $data = $sqlObj->selectBySql($sql . ' order by `date` desc');
            foreach ($data as $key => $value) {
                $i = $key + 3;
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $value['posNo']);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $rechargeType[strtoupper($value['rechargeType'])]);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $value['date']);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $value['totalAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $value['cashAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $value['bankCardAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $value['weChatAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $value['aliPayAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $value['giftAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $value['tuanAmount']);
                $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $value['otherAmount']);
            }
            $objWriter->save('php://output');
            exit();
        }
        $sql .= ' order by `date` desc limit ' . $p->firstRow . ',' . $p->listRows;
        @$result = $sqlObj->selectBySql($sql);
        $rechargeType = array(
            "C" => '充值',
            //"c" => '充值',
            "T" => '退卡',
            //"t" => '退卡',
        );

        include $this->showTpl('report_Onlinecongzhi');

    }

    public function report_qindanSea()
    {
        $data = $this->clear_html($_GET);
        //C:餐卡 X:现金，W:微信，Z:支付宝，Y:银行卡,R:人工修正
        bpBase::loadOrg('common_page');
        unset($data['m'], $data['c'], $data['a']);
        // $where1 = array('mid' => $this->mid);
        $shops = $this->shopsDb->select();
        //dump($data);
        $sql = 'select * from `pospi_order`  where ';
        $sql2 = 'select count(*) as num from `pospi_order` where ';
        $where = '';
        foreach ($data as $k => $v) {
            if ($data[$k] == '') {
                unset($data[$k]);
            }
        }
        if (isset($data['uid'])) {
            $where .= ' and shopNo = "' . $data['uid'] . '"';
        }
        if (isset($data['no'])) {
            $where .= ' and `no` = "' . $data['no'] . '"';
        }
        if (isset($data['cashNo'])) {
            $where .= ' and `by` = "' . $data['cashNo'] . '"';
        }
        if (isset($data['dtbegin'])) {
            $where .= " and startTime >='$data[dtbegin]'";
        }
        if (isset($data['dtend'])) {
            $where .= " and startTime <='$data[dtend]'";
        }


        $sqlObj = new model();
        if ($where == '') {
            $sql = rtrim($sql, 'where ');
            $sql2 = rtrim($sql2, 'where ');
        } else {
            $where = ltrim($where, ' and');
        }
        //dump($where);
        $sql = $sql . $where;
        $sql2 = $sql2 . $where;
        $_count = $sqlObj->selectBySql($sql2);

        $p = new Page($_count['0']['num'], 15);
        $pagebar = $p->show(2);
        $shops = M('shop')->select(array('IsDel' => 0));
        foreach ($shops as $k => $v) {
            $shop[$v['id']] = $v['Name'] . "[{$v['no']}]";
        }
        if ($_GET['export'] == 1) {

            include RL_PIGCMS_CORE_PATH . 'libs' . DIRECTORY_SEPARATOR . 'org' . '/PHPExcel/Writer/Excel2007.php';
            include RL_PIGCMS_CORE_PATH . 'libs' . DIRECTORY_SEPARATOR . 'org' . '/PHPExcel.php';
            $objPHPExcel = new PHPExcel();
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
            header("Content-Type:application/force-download");
            header("Content-Type:application/vnd.ms-excel");
            header("Content-Type:application/octet-stream");
            header("Content-Type:application/download");
            //header("Content-Disposition:inline;filename='123.xls'");
            header('Content-Disposition:attachment;filename="交易清单' . date("YmdHis", time()) . '.xlsx"');
            header("Content-Transfer-Encoding:binary");
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(17);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(17.5);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(17.5);
            $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setName('Microsoft Yahei');
            $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setSize(13);
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '商户');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '小票号');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '应收');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '实收');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', '找零');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', '整单折扣');
            $objPHPExcel->getActiveSheet()->setCellValue('G1', '收银员');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', '开单时间');
            $objPHPExcel->getActiveSheet()->setCellValue('I1', '结账时间');
            $data = $sqlObj->selectBySql($sql . ' order by startTime desc');
            foreach ($data as $key => $value) {
                $i = $key + 2;
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $shop[$value['shopNo']]);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $value['no']);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $value['remoney']);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $value['acmoney']);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $value['cgmoney']);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $value['totalDiscount']);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, "'" . $value['by']);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $value['startTime']);
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $value['endTime']);
            }
            $objWriter->save('php://output');
            exit();
        }
        $sql .= ' order by startTime desc limit ' . $p->firstRow . ',' . $p->listRows;
        @$result = $sqlObj->selectBySql($sql);
        include $this->showTpl('report_qindan');

    }

    public function report_detail()
    {
        $sid = $this->clear_html($_GET['sid']);
        $mo = new model();
        $data = $mo->selectBySql('select * from `pospi_order` where `sid` = "' . $sid . '"');
        $data1 = $mo->selectBySql('select * from `pospi_order_menus` where `order_sid` = "' . $sid . '"');
        $data2 = $mo->selectBySql('select * from `pospi_order_paytype` where `order_sid` = "' . $sid . '"');

        include $this->showTpl();
        //  $da
    }

    public function report_czCard()
    {
        include $this->showTpl();
    }

    public function report_czCardsea()
    {
        $data = $this->clear_html($_GET);
        //C:餐卡 X:现金，W:微信，Z:支付宝，Y:银行卡,R:人工修正
        bpBase::loadOrg('common_page');
        unset($data['m'], $data['c'], $data['a']);
        $sql = "SELECT	posNo,`date`,obj1,
				SUM(CASE WHEN rechargetype='C' THEN totalAmount ELSE 0 END) czzje,
				SUM(CASE WHEN rechargetype='C' THEN cashAmount ELSE 0 END) czCash,
				SUM(CASE WHEN rechargetype='C' THEN bankCardAmount ELSE 0 END) czbank,
				SUM(CASE WHEN rechargetype='C' THEN weChatAmount ELSE 0 END) czweChat,
				SUM(CASE WHEN rechargetype='C' THEN aliPayAmount ELSE 0 END) czaliPay,
				SUM(CASE WHEN rechargetype='C' THEN giftAmount ELSE 0 END) czgift,
				SUM(CASE WHEN rechargetype='C' THEN tuanAmount ELSE 0 END) cztuan,
				SUM(CASE WHEN rechargetype='C' THEN otherAmount ELSE 0 END) czother,
				SUM(CASE WHEN rechargetype='T' THEN totalAmount ELSE 0 END) tkzje
FROM pospi_report_recharge_day where ";
        $sql1 = "SELECT  COUNT(*) AS num FROM (";

        $where = '';
        foreach ($data as $k => $v) {
            if ($data[$k] == '') {
                unset($data[$k]);
            }
        }
        if (isset($data['posNo'])) {
            $where .= " and `posNo` ='$data[posNo]'";
        }
        if (isset($data['dtbegin'])) {
            $where .= " and `date` >='$data[dtbegin]'";
        }
        if (isset($data['dtend'])) {
            $where .= " and `date` <='$data[dtend]'";
        }


        $sqlObj = new model();
        if ($where == '') {
            $sql = rtrim($sql, 'where ');
            $sql2 = rtrim($sql2, 'where ');
        } else {
            $where = ltrim($where, ' and');
        }
        //dump($where);
        $sum = $sqlObj->selectBySql($sql . $where);
        $sum = $sum['0'];
        $sql = $sql . $where . " group by	date,obj1,posNo";
        $sql1 .= $sql . ")as num";

        $_count = $sqlObj->selectBySql($sql1);

        $p = new Page($_count['0']['num'], 15);
        $pagebar = $p->show(2);
        if ($_GET['export'] == 1) {

            include RL_PIGCMS_CORE_PATH . 'libs' . DIRECTORY_SEPARATOR . 'org' . '/PHPExcel/Writer/Excel2007.php';
            include RL_PIGCMS_CORE_PATH . 'libs' . DIRECTORY_SEPARATOR . 'org' . '/PHPExcel.php';
            $objPHPExcel = new PHPExcel();
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
            header("Content-Type:application/force-download");
            header("Content-Type:application/vnd.ms-excel");
            header("Content-Type:application/octet-stream");
            header("Content-Type:application/download");
            //header("Content-Disposition:inline;filename='123.xls'");
            header('Content-Disposition:attachment;filename="充值台销售统计' . date("YmdHis", time()) . '.xlsx"');
            header("Content-Transfer-Encoding:binary");
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(11);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setName('Microsoft Yahei');
            $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setSize(13);
            $objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
            $objPHPExcel->getActiveSheet()->mergeCells('B1:B2');
            $objPHPExcel->getActiveSheet()->mergeCells('C1:C2');

            $objPHPExcel->getActiveSheet()->mergeCells('K1:K2');
            $objPHPExcel->getActiveSheet()->mergeCells('D1:J1');

            $objPHPExcel->getActiveSheet()->setCellValue('A1', '充值款台');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '报表日期');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '充值合计');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', '其中');
            $objPHPExcel->getActiveSheet()->setCellValue('D2', '现金');
            $objPHPExcel->getActiveSheet()->setCellValue('E2', '银行卡');
            $objPHPExcel->getActiveSheet()->setCellValue('F2', '微信');
            $objPHPExcel->getActiveSheet()->setCellValue('G2', '支付宝');
            $objPHPExcel->getActiveSheet()->setCellValue('H2', '礼品券');
            $objPHPExcel->getActiveSheet()->setCellValue('I2', '团购');
            $objPHPExcel->getActiveSheet()->setCellValue('J2', '其他');
            $objPHPExcel->getActiveSheet()->setCellValue('K1', '退卡合计');
            $objPHPExcel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $data = $sqlObj->selectBySql($sql . ' order by date DESC');
            foreach ($data as $key => $value) {
                $i = $key + 3;
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $value['posNo']);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $value['date']);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $value['czzje']);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $value['czCash']);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $value['czbank']);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $value['czweChat']);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $value['czaliPay']);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $value['czgift']);
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $value['cztuan']);
                $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $value['czother']);
                $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $value['tkzje']);
            }
            $objWriter->save('php://output');
            exit();
        }

        $sql .= ' order by date desc limit ' . $p->firstRow . ',' . $p->listRows;
        @$result = $sqlObj->selectBySql($sql);
        foreach ($result as $key => $value) {
            $nm = M('card_record')->get_one(array('saleType' => 'TK', 'UpLoadTime_Time' => array('like', $value['date'] . '%'), 'SYYId' => $value['obj1'], 'deviceNo' => $value['posNo']), 'count(*) as num');//,'SYYId'=>$value['obj1']
            $result[$key]['num'] = $nm['num'];
            $sum['num'] += $nm['num'];
        }
        $cashier = M('cashier')->select(array('Isdel' => 0));
        foreach ($cashier as $value) {
            $cashiers[$value['addid']] = $value['Name'] . "[{$value['Number']}]";
        }
        include $this->showTpl('report_czCard');
    }

    public function zsday()
    {
        include $this->showTpl();
    }

    public function zsdaysea()
    {
        $data = $this->clear_html($_GET);
        //C:餐卡 X:现金，W:微信，Z:支付宝，Y:银行卡,R:人工修正
        bpBase::loadOrg('common_page');
        unset($data['m'], $data['c'], $data['a']);

        $shops = $this->shopsDb->select();
        //dump($data);
        $sql = ' SELECT	deviceno,DATE_FORMAT(zstime,\'%Y-%m-%d\')AS t,SUM(zsje) total FROM `' . $this->tablepre . 'zsrecord`   where ';
        // GROUP BY Uid ORDER BY Uid DESC
        $where = '';
        foreach ($data as $k => $v) {
            if ($data[$k] == '') {
                unset($data[$k]);
            }
        }
        if (isset($data['deviceno'])) {
            $where[] = "deviceno={$data['deviceno']}";
        }
        if (isset($data['dtbegin'])) {
            $where[] = "zstime>='{$data['dtbegin']} 00:00:00'";
        }
        if (isset($data['dtend'])) {
            $where[] = "zstime<='{$data['dtend']} 23:59:59'";
        }
        $sqlObj = new model();
        $where = $where?implode(' and ', $where):'';

        $sql = $sql . $where;
        $sql = rtrim($sql, ' where ');
        $sql .= ' group BY deviceno,t DESC';//limit ' . $p->firstRow . ',' . $p->listRows;
        @$result = $sqlObj->selectBySql($sql);
        if ($_GET['export'] == 1) {

            include RL_PIGCMS_CORE_PATH . 'libs' . DIRECTORY_SEPARATOR . 'org' . '/PHPExcel/Writer/Excel2007.php';
            include RL_PIGCMS_CORE_PATH . 'libs' . DIRECTORY_SEPARATOR . 'org' . '/PHPExcel.php';
            $objPHPExcel = new PHPExcel();
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
            header("Content-Type:application/force-download");
            header("Content-Type:application/vnd.ms-excel");
            header("Content-Type:application/octet-stream");
            //header("Content-Disposition:inline;filename='123.xls'");
            header('Content-Disposition:attachment;filename="日充值赠送统计' . date("YmdHis", time()) . '.xlsx"');
            header("Content-Transfer-Encoding:binary");
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(17);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(17);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
            $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setName('Microsoft Yahei');
            $objPHPExcel->getActiveSheet()->getStyle('1')->getFont()->setSize(13);
            $objPHPExcel->getActiveSheet()->setCellValue('A1', '充值款台号');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', '日期');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', '赠送金额(元)');
            foreach ($result as $key => $value) {
                $i = $key + 2;
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $value['deviceno']);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $value['t']);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $value['total']);
            }
            $objWriter->save('php://output');
            exit();
        }
        include $this->showTpl('zsday');
    }

}

?>
