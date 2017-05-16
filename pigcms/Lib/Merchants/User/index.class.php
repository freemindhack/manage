<?php
bpBase::loadAppClass('common', 'User', 0);

class index_controller extends common_controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //商户数量
        $shopnum = M('user')->get_one(array('groupId'=>0,'IsDel'=>0), 'count(*) as num');
        //合同
        $contractnum = M('contract')->get_one(array('ht_status' => 'Y'), 'count(*) as num');
        //到期合同
        $time = time() - 30 * 24 * 60 * 60;
        $conendnum = M('contract')->get_one(array('ht_status' => 'Y', 'ht_endT' => array('egt', $time)), 'count(*) as num');
        //未处理交易
        $recordnum = M('card_record')->get_one(array('flag' => 0), 'count(*) as num');
        //卡数量
        $cardnum = M('card_info')->get_one('', 'count(*) as num');
        //使用中的,sum(cardAmount) as total
        $carsYnum = M('card_info')->get_one(array('cardStatus' => 'Y'), 'count(*) as num,sum(cardAmount)as total');
        $carsDnum = M('card_info')->get_one(array('cardStatus' => 'D'), 'count(*) as num,sum(cardAmount)as total');

        $data3 = $this->getCharge();
        $data1 = $data3[0];
        $data2 = $data3[1];

        include $this->showTpl();
    }

    public function ModifyPwd()
    {

        include $this->showTpl();
    }

    public function doModifyPwd()
    {
        $oldpwd = trim($_POST['oldpwd']);
        $newpwd = trim($_POST['newpwd']);
        $new2pwd = trim($_POST['new2pwd']);
        if (empty($oldpwd)) {
            $this->errorTip('旧密码不能为空！');
            exit;
        }
        if (empty($newpwd)) {
            $this->errorTip('新密码不能为空！');
            exit;
        }
        if ($newpwd != $new2pwd) {
            $this->errorTip('两次输入的密码不一致！');
            exit;
        }
        $oldpwd = md5($oldpwd);
        if ($oldpwd != $this->merchant['password']) {
            $this->errorTip('旧密码不对！');
            exit;
        }
        $newpwdstr = md5($newpwd);
        $flage = M('cashier_merchants')->update(array('password' => $newpwdstr, 'mfypwd' => 1), array('mid' => $this->merchant['mid']));
        if ($flage) {
            $this->successTip('修改成功，请重新登录！', '/merchants.php?m=User&c=index&a=logout');
            exit;
        } else {
            $this->errorTip('密码修改失败！');
            exit;
        }
    }

    public function logout()
    {
        $_SESSION['merchant'] = null;
        unset($_SESSION['merchant']);
        $_SESSION['employer'] = null;
        unset($_SESSION['employer']);
        $_SESSION['wxshoplist'] = null;
        unset($_SESSION['wxshoplist']);
        header('Location:?m=Index&c=login&a=index');
    }

    public function callhome()
    {
        $end = '';
        $ady = $_POST['day'] ? $_POST['day'] : 7;
        if ($_POST['bt'] && $_POST['et']) {
            $end = $_POST['et'];
            $ady = (strtotime($_POST['et']) - strtotime($_POST['bt'])) / (24 * 60 * 60) + 1;
        }
        $data3 = $this->getCharge($ady, $end);
        $data1 = $data3[0];
        $data2 = $data3[1];
        include $this->showTpl();
    }

    public function callios()
    {
        $end = '';
        $ady = $_POST['day'] ? $_POST['day'] : 7;
        if ($_POST['bt'] && $_POST['et']) {
            $end = $_POST['et'];
            $ady = (strtotime($_POST['et']) - strtotime($_POST['bt'])) / (24 * 60 * 60) + 1;
        }
        $data3 = $this->getTuika($ady, $end);
        $data1 = $data3[0];
        $data2 = $data3[1];
        include $this->showTpl();
    }

    public function show()
    {
        $this->getCharge();
        $this->showTpl();
    }

    public function getDays($days = 7, $end = '')
    {
        $arr = array();
        for ($i = $days - 1; $i >= 0; $i--) {
            $arr[] = date('Y-m-d', $end - $i * 24 * 60 * 60);
        }//for
        return $arr;
    }

    public function getCharge($day = 7, $end = '')
    {
        $end = $end ? strtotime($end) : time();
        $day = $this->getDays($day, $end);
        $data1 = array();
        $info3 = array();
        foreach ($day as $val) {
            //$data1['day'][] = substr($val, -2);
            $data1['day'][] = $val;
            $info = M('card_record')->get_one(array('saleType' => 'C', 'OrderTime_Time' => array('like', $val . '%')), 'count(*) as num,sum(receivableAmount)as total');
            $info2 = M('card_record')->get_one(array('saleType' => 'TK', 'OrderTime_Time' => array('like', $val . '%')), 'count(*) as num,sum(receivableAmount)as total');
            $data1['chage'][] = $info['total'] ? $info['total'] : 0;
            $data1['tuika'][] = $info2['total'] ? $info2['total'] : 0;
            $data1['num'][] = $info['num'];
            $data1['tknum'][] = $info2['num'];
            $info3[] = array(
                'day' => $val,
                'charge' => $info['total'] ? $info['total'] : 0,
                'chagenum' => $info['num'],
                'tuika' => $info2['total'] ? $info2['total'] : 0,
                'tuikanum' => $info2['num']
            );
        }
        $hehe = array($data1, $info3);
        return $hehe;
    }

    public function getTuika($day = 7, $end = '')
    {
        $end = $end ? strtotime($end) : time();
        $day = $this->getDays($day, $end);
        $data1 = array();
        $data2 = array();
        foreach ($day as $val) {
            //$data1['day'][] = substr($val, -2);
            $data1['day'][] = $val;
            $info = M('card_record')->get_one(array('saleType' => 'X', 'OrderTime_Time' => array('like', $val . '%')), 'count(*) as num,sum(receivableAmount)as total');
            $ck = M('card_record')->get_one(array('saleType' => 'X', 'payType' => 'C', 'OrderTime_Time' => array('like', $val . '%')), 'count(*) as num,sum(receivableAmount)as total');
            $wx = M('card_record')->get_one(array('saleType' => 'X', 'payType' => 'W', 'OrderTime_Time' => array('like', $val . '%')), 'count(*) as num,sum(receivableAmount)as total');
            $zfb = M('card_record')->get_one(array('saleType' => 'X', 'payType' => 'Z', 'OrderTime_Time' => array('like', $val . '%')), 'count(*) as num,sum(receivableAmount)as total');
            $data1['chage'][] = $info['total'] ? $info['total'] : 0;
            $data1['num'][] = $info['num'];
            $data2[] = array(
                'day' => $val,
                'cknum' => $ck['num'],
                'ckto' => $ck['total'] ? $ck['total'] : 0,
                'wxnum' => $wx['num'],
                'wxto' => $wx['total'] ? $wx['total'] : 0,
                'zfbnum' => $zfb['num'],
                'zfbto' => $zfb['total'] ? $zfb['total'] : 0,
            );
        }
        //dump($data1);
        $data = array($data1, $data2);
        return $data;
    }

    public function down1()
    {
        ajaxReturn('/download/Product.csv');
    }
}

?>
