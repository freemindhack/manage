<?php
bpBase::loadAppClass('common', 'System', 0);

class card_controller extends common_controller
{
    private $cardDb;
    private $cardfreezeDb;

    public function __construct()
    {
        parent::__construct();
        //$this->authorityControl(array('rolesEdit', 'checkAccount','roleDel'));
        $db_config = loadConfig('db');
        $this->tablepre = $db_config['default']['tablepre'];
        $this->cardDb = M('card_info');
        $this->cardfreezeDb = M('card_freeze');
    }

    public function card_status()
    {
        $this->display();
    }

    public function card_liushui()
    {

        $this->display();

    }

    public function card_liushuiSea()
    {
        $data = $this->clear_html($_GET);
        //debug($data);
        //C:餐卡 X:现金，W:微信，Z:支付宝，Y:银行卡,R:人工修正

        bpBase::loadOrg('common_page');
        unset($data['m'], $data['c'], $data['a']);
        //dump($data);
        $sql = 'select * from ' . $this->tablepre . 'card_record where ';
        $where = '';
        foreach ($data as $k => $v) {
            if ($data[$k] == '') {
                unset($data[$k]);
            }
        }
        if (isset($data['cardNo'])) {
            $where .= ' and cardNo = ' . $data['cardNo'];
        }
        if (isset($data['dtbegin'])) {
            $where .= " and OrderTime_Time >'$data[dtbegin]'";
        }
        if (isset($data['dtend'])) {
            $where .= " and OrderTime_Time <'$data[dtend]'";
        }

        $cardRecordDb = M('card_record');


        $sqlObj = new model();
        $where = ltrim($where, ' and');
        $_count = $cardRecordDb->count($where);

        $p = new Page($_count,10);
        $pagebar = $p->show(2);
        $sql = $sql . $where;
        $sql = rtrim($sql, 'where ');
        $sql .= ' order by OrderTime_Time desc limit ' . $p->firstRow . ',' . $p->listRows;
        @$result = $sqlObj->selectBySql($sql);
        $payType = array(
            'C' => '餐卡',
            'X' => '现金',
            'W' => '微信',
            'Z' => '支付宝',
            'Y' => '银行卡',
            'R' => '人工修正',
        );
        //C:充值 TK:退卡 X:消费 TH:退货
        $saleType = array(
            'C' => '充值',
            'TK' => '退卡',
            'X' => '消费',
            'TH' => '退货',

        );
        foreach ($result as $k=>$v){
            $result[$k][payTyped]=$saleType[$v['payType']];
            $result[$k][saleTyped]=$saleType[$v['saleType']];
        }

        $this->assign('data', $result);
        $this->assign('pagebar', $pagebar);
        $this->display('card_liushui');

    }


    public function card_money()
    {
        include $this->showTpl();
    }

//根据卡号账号信息
    public function card_infoma()
    {

            $data = $this->clear_html($_GET);
            bpBase::loadOrg('common_page');
            unset($data['m'], $data['c'], $data['a']);

            $sql = 'select * from ' . $this->tablepre . 'card_info where ';
            $where = '';
            foreach ($data as $k => $v) {
                if ($data[$k] == '') {
                    unset($data[$k]);
                }
            }
            if (isset($data['cardNo'])) {
                $where .= ' and cardNo = ' . $data['cardNo'];
            }
            if (isset($data['down'])) {
                $where .= " and cardAmount >='$data[down]'";
            }
            if (isset($data['up'])) {
                $where .= " and cardAmount <='$data[up]'";
            }

            $cardRecordDb = M('card_info');


            $sqlObj = new model();
            $where = ltrim($where, ' and');
            $_count = $cardRecordDb->count($where);

            $p = new Page($_count, 10);
            $pagebar = $p->show(2);
            $sql = $sql . $where;
            $sql = rtrim($sql, 'where ');
            $sql .= ' order by createTime desc limit ' . $p->firstRow . ',' . $p->listRows;
            @$data = $sqlObj->selectBySql($sql);
            //卡状态 D：冻结 Y：已使用 N：未使用 T：退卡
            $cardStatus = array(
                'D' => '冻结',
                'Y' => '已使用',
                'N' => '未使用',
                'T' => '退卡',
            );
            foreach ($data as $k => $v) {
                $data[$k][Status]=$cardStatus[$v['cardStatus']];
            }
            $this->assign('data', $data);
            $this->assign('pagebar', $pagebar);
            $this->display('card_status');

    }

    //解冻
    public function freeze()
    {
        $data = $this->clear_html($_POST);

        $data['CreateTime'] = date('Y-m-d H:i:s', time());
        if ($this->cardfreezeDb->get_one(array('cardNo' => $data['CardNo'], 'IsDel' => 0))) {
            ajaxReturn('', '该账号已经冻结了', 0);
            exit();
        }
        $data['shop'] = $this->mid;
        $data['bywho'] = $this->eid;
        if ($this->cardDb->update(array('cardStatus' => 'D'), array('cardNo' => $data['CardNo']))) {
            if ($this->cardfreezeDb->insert($data)) {
                ajaxReturn('', '冻结成功', 1);
                exit();
            }
        }
        ajaxReturn('', '冻结失败', 1);
    }

    public function card_unfreeze()
    {
        $data = $this->clear_html($_POST);

        $data['CreateTime'] = date('Y-m-d H:i:s', time());
        $data['shop'] = $this->mid;
        $data['bywho'] = $this->eid;
        $data['IsDel'] = 1;
        if ($this->cardDb->update(array('cardStatus' => 'Y'), array('cardNo' => $data['CardNo']))) {
            if ($this->cardfreezeDb->update($data, 'cardNo=' . $data['CardNo'])) {
                ajaxReturn('', '解冻成功!', 1);
                exit();
            }

        }
        ajaxReturn('', '解冻失败!', 1);
    }
}

?>
