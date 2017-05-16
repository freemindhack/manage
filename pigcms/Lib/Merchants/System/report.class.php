<?php
bpBase::loadAppClass('common', 'User', 0);

class report_controller extends common_controller
{
    private $reportDb;

    public function __construct()
    {
        parent::__construct();
        //$this->authorityControl(array('rolesEdit', 'checkAccount','roleDel'));
        $db_config = loadConfig('db');
        $this->tablepre = $db_config['default']['tablepre'];
        $this->reportDb = M('report_merchant_day');
        $this->shopsDb = M('cashier_shops');

    }

    public function report_qindan()
    {
        $where = array('mid' => $this->mid);
        $shops = $this->shopsDb->select($where);
        include $this->showTpl();
    }

    public function report_tongji()
    {
        $where = array('mid' => $this->mid);
        $shops = $this->shopsDb->select($where);
        include $this->showTpl();

    }

    public function report_Sea()
    {
        $data = $this->clear_html($_GET);
        //C:餐卡 X:现金，W:微信，Z:支付宝，Y:银行卡,R:人工修正
        bpBase::loadOrg('common_page');
        unset($data['m'], $data['c'], $data['a']);
        $where1 = array('mid' => $this->mid);
        $shops = $this->shopsDb->select($where1);
        //dump($data);
        $sql = 'select * from ' . $this->tablepre . 'report_merchant_day where ';
        $where = '';
        foreach ($data as $k => $v) {
            if ($data[$k] == '') {
                unset($data[$k]);
            }
        }
        if (isset($data['uid'])) {
            $where .= ' and uid = ' . $data['uid'];
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

        $p = new Page($_count, 10);
        $pagebar = $p->show(2);
        $sql = $sql . $where;
        $sql = rtrim($sql, 'where ');
        $sql .= ' order by `date` desc limit ' . $p->firstRow . ',' . $p->listRows;
        @$result = $sqlObj->selectBySql($sql);

        include $this->showTpl('report_tongji');

    }

    public function report_qindanSea()
    {
        $data = $this->clear_html($_GET);
        //C:餐卡 X:现金，W:微信，Z:支付宝，Y:银行卡,R:人工修正
        bpBase::loadOrg('common_page');
        unset($data['m'], $data['c'], $data['a']);
        $where1 = array('mid' => $this->mid);
        $shops = $this->shopsDb->select($where1);
        //dump($data);
        $sql = 'select * from `Order`  where ';
        $sql2= 'select count(*) as num from `Order` where ';
        $where = '';
        foreach ($data as $k => $v) {
            if ($data[$k] == '') {
                unset($data[$k]);
            }
        }
        if (isset($data['uid'])) {
            $where .= ' and id = ' . $data['uid'];
        }
        if (isset($data['no'])) {
            $where .= ' and no = ' . $data['no'];
        }
        if (isset($data['cashNo'])) {
            $where .= ' and by = ' . $data['cashNo'];
        }
        if (isset($data['dtbegin'])) {
            $where .= " and startTime >='$data[dtbegin]'";
        }
        if (isset($data['dtend'])) {
            $where .= " and startTime <='$data[dtend]'";
        }


        $sqlObj = new model();
        if ($where =='') {
            $sql = rtrim($sql, 'where ');
            $sql2= rtrim($sql2, 'where ');
        }else{
            $where = ltrim($where, ' and');
        }
        //dump($where);
        $sql=$sql.$where;
        $sql2=$sql2.$where;
        $_count = $sqlObj->selectBySql($sql2);

        $p = new Page($_count['0']['num'], 10);
        $pagebar = $p->show(2);
        $sql .= ' order by startTime desc limit ' . $p->firstRow . ',' . $p->listRows;
        @$result = $sqlObj->selectBySql($sql);

        include $this->showTpl('report_qindan');

    }
    public function report_detail(){
        $sid=$this->clear_html($_GET['sid']);
      //  $da
    }

}

?>
