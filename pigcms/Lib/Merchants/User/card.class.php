<?php
bpBase::loadAppClass('common', 'User', 0);

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
        include $this->showTpl();
    }

    //赠送金额查询
    public function zssearch()
    {
        $zs=array();
        if ($_POST['cardno']) {
            $zs=M('cardgive')->get_one(array('cardno'=>$_POST['cardno']));
        }
        include $this->showTpl();
    }

    public function card_liushui()
    {
        //C:餐卡 X:现金，W:微信，Z:支付宝，Y:银行卡,R:人工修正
        $payType = array(
            'C' => '餐卡',
            'X' => '现金',
            'W' => '微信',
            'Z' => '支付宝',
            'Y' => '银行卡',
            'L' => '礼品卷',
            'T' => '团购',
            'R' => '人工修正',
            'O' => '其他',
        );
        //C:充值 TK:退卡 X:消费 TH:退货
        $saleType = array(
            'C' => '充值',
            'TK' => '退卡',
            'X' => '消费',
            'TH' => '退货',

        );
        $vender = M('shop')->select(array('IsDel' => 0));
        foreach ($vender as $value) {
            $shop[$value['id']] = $value['Name'] . "[{$value['no']}]";
        }
        include $this->showTpl();
    }

    public function card_liushuiSea()
    {

        $data = $this->clear_html($_GET);
        //debug($data);
        //C:餐卡 X:现金，W:微信，Z:支付宝，Y:银行卡,R:人工修正
        $payType = array(
            'C' => '餐卡',
            'X' => '现金',
            'W' => '微信',
            'Z' => '支付宝',
            'Y' => '银行卡',
            'L' => '礼品卷',
            'T' => '团购',
            'R' => '人工修正',
            'O' => '其他',
        );
        //C:充值 TK:退卡 X:消费 TH:退货
        $saleType = array(
            'C' => '充值',
            'TK' => '退卡',
            'X' => '消费',
            'TH' => '退货',

        );
        //0未处理 1已处理 2处理出错
        $proState = array('未处理', '已处理', '处理出错');
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
        if (isset($data['vender'])) {
            $where .= ' and shopId = "' . $data['vender'] . '"';
        }
        if (isset($data['cardNo'])) {
            $where .= ' and cardNo = ' . $data['cardNo'];
        }
        if (isset($data['payType'])) {
            $where .= ' and payType = "' . $data['payType'] . '"';
        }
        if (isset($data['saleType'])) {
            $where .= ' and saleType = "' . $data['saleType'] . '"';
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

        $p = new Page($_count, 15);
        $pagebar = $p->show(2);
        $sql = $sql . $where;
        $sql = rtrim($sql, 'where ');
        $sql .= ' order by OrderTime_Time desc limit ' . $p->firstRow . ',' . $p->listRows;
        @$result = $sqlObj->selectBySql($sql);
        $sql2 = 'SELECT addid AS Sid,`Name` FROM `pospi_cashier` UNION ALL SELECT Number,`Name` FROM `pospi_cashier_coin`';
        $name = $sqlObj->selectBySql($sql2);
        $names = array();
        foreach ($name as $k => $v) {
            $names[$v['Sid']] = $v['Name'];
        }
//        $shopSql = 'select Id,UId,UserName,Email,shopname from `pospi_vender` where IsActivate=1 and IsDel=0';
//        $model = new model();
        $shops = M('shop')->select(array('IsDel' => 0));
        foreach ($shops as $k => $v) {
            $shop[$v['id']] = $v['Name'] . '[' . $v['no'] . ']';
        }
        include $this->showTpl('card_liushui');
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
        if (isset($data['cardStatus'])) {
            $where .= ' and cardStatus = "' . $data['cardStatus'] . '"';
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

        $p = new Page($_count, 15);
        $pagebar = $p->show(2);
        $sql = $sql . $where;
        $sql = rtrim($sql, 'where ');

        $sql2 = "select sum(cardAmount) AS total1,sum(cardMortgageAmount)AS total2,sum(cardTotalAmount) AS total3,sum(cardAmount_Sys)AS total4,sum(cardMortgageAmount_Sys)AS total5,sum(cardTotalAmount_Sys)AS total6 from " . $this->tablepre . 'card_info where ';
        $sql2 .= $where;
        $sql2 = rtrim($sql2, 'where ');
        $sum = $sqlObj->selectBySql($sql2);
        $sql .= ' order by createTime desc limit ' . $p->firstRow . ',' . $p->listRows;
        @$data = $sqlObj->selectBySql($sql);
        //卡状态 D：冻结 Y：已使用 N：未使用 T：退卡
        $cardStatus = array(
            'D' => '冻结',
            'Y' => '已使用',
            'N' => '未使用',
            'T' => '退卡',
        );
        include $this->showTpl('card_status');
    }

    //解冻
    public function freeze()
    {
        $data = $this->clear_html($_POST);

        $data['CreateTime'] = date('Y-m-d H:i:s', time());
        if ($this->cardfreezeDb->get_one(array('cardNo' => $data['CardNo'], 'IsDel' => 0))) {
            ajaxReturn('', '该账号已经冻结了', 0);
        }
        $data['shop'] = $this->mid;
        $data['bywho'] = $this->eid;
        if ($this->cardDb->update(array('cardStatus' => 'D', 'note' => $data['Note']), array('cardNo' => $data['CardNo']))) {
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
        if ($this->cardDb->update(array('cardStatus' => 'Y', 'note' => ''), array('cardNo' => $data['CardNo']))) {
            if ($this->cardfreezeDb->update($data, 'cardNo = ' . $data['CardNo'])) {
                ajaxReturn('', '解冻成功!', 1);
                exit();
            }
        }
        ajaxReturn('', '解冻失败!', 1);
    }

    public function card_Onlinestatus()
    {
        include $this->showTpl();
    }


    public function card_Onlininfoma()
    {
        if (IS_POST) {
            $data = $this->clear_html($_GET);
            bpBase::loadOrg('common_page');
            unset($data['m'], $data['c'], $data['a']);

            $sql = 'select * from ' . $this->tablepre . 'onlinecard_info where ';
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
            $where = ltrim($where, ' and ');
            $_count = $cardRecordDb->count($where);

            $p = new Page($_count, 15);
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
            include $this->showTpl('card_Onlinestatus');
        }
    }

    public function card_Onlineliushui()
    {
        include $this->showTpl();
    }

    public function card_OnlineliushuiSea()
    {
        $data = $this->clear_html($_GET);
        //debug($data);
        //C:餐卡 X:现金，W:微信，Z:支付宝，Y:银行卡,R:人工修正
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
        bpBase::loadOrg('common_page');
        unset($data['m'], $data['c'], $data['a']);
        //dump($data);
        $sql = 'select * from ' . $this->tablepre . 'onlinecard_record where ';
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

        $cardRecordDb = M('onlinecard_record');


        $sqlObj = new model();
        $where = ltrim($where, ' and ');
        $_count = $cardRecordDb->count($where);

        $p = new Page($_count, 15);
        $pagebar = $p->show(2);
        $sql = $sql . $where;
        $sql = rtrim($sql, 'where ');
        $sql .= ' order by OrderTime_Time desc limit ' . $p->firstRow . ',' . $p->listRows;
        @$result = $sqlObj->selectBySql($sql);
        $sql2 = 'SELECT UId AS Sid,`Name` FROM `Cashier` UNION ALL SELECT Number,`Name` FROM `pospi_cashier_coin`';
        $name = $sqlObj->selectBySql($sql2);
        $names = array();
        foreach ($name as $k => $v) {
            $names[$v['Sid']] = $v['Name'];
        }
        include $this->showTpl('card_Onlineliushui');

    }

    public function card_class()
    {
        $action = array('充值', '退卡', '消费', '退货');
        $data = M('onlinecard_type')->select();
        include $this->showTpl();
    }

    public function card_class_add()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            if (M('onlinecard_type')->select(array('typeNote' => $data['typeNote']))) $this->errorTip('已经存在该类型的权限记录');
            $data['action'] .= $data['CZ'] ? '1,' : '0,';
            $data['action'] .= $data['TK'] ? '1,' : '0,';
            $data['action'] .= $data['XF'] ? '1,' : '0,';
            $data['action'] .= $data['TH'] ? '1' : '0';
            $data['createTime'] = date('Y-m-d H:i:s', time());
            unset($data['CZ'], $data['TK'], $data['XF'], $data['TH']);
            if (M('onlinecard_type')->insert($data)) {
                $this->successTip('添加成功!');
            }
        }
    }


    public function card_claDel()
    {
        if (IS_POST) {
            if (M('onlinecard_type')->delete($_POST)) {
                ajaxReturn('', '删除成功 ^ _ ^ ', 1);
            } else ajaxReturn('', '删除失败( ⊙ _ ⊙ )', 0);
        }
    }

    public function card_claDelall()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            $return = $this->_delAll(M('onlinecard_type'), $data['id']);

            if ($return['status'] == '1') {
                $this->successTip($return['msg'], $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                $this->errorTip($return['msg'], $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }


}

?>
