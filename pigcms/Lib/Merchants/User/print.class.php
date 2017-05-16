<?php
bpBase::loadAppClass('common', 'User', 0);

/**
 * Created by PhpStorm.
 * User: 93018
 * Date: 2016/7/29
 * Time: 13:35
 */
class print_controller extends common_controller
{
    private $shops;

    //构造
    public function __construct()
    {
        parent::__construct();
        $this->shops = M('vender');
    }

    //商家明细表打印显示
    public function shops()
    {
        $vender = M('contract')->select(array('ht_status' => "Y"));
        include $this->showTpl();
    }

    public function Onlineshops()
    {
        $vender = M('contract')->select(array('ht_status' => "Y"));
        include $this->showTpl();
    }

    public function printSelect()
    {
        //debug($_POST['id']);
        if (IS_POST) {
            $this->caca();
            $ids = $this->clear_html($_POST['id']);
            //$d=cal_days_in_month(CAL_GREGORIAN,$xx['1'],$xx['0']);
            $data = $this->pp($ids);
            $xx = explode('-', date('Y-m', strtotime('-1 month')));
            $d = cal_days_in_month(CAL_GREGORIAN, $xx['1'], $xx['0']);
            include $this->showTpl();
        }
    }

    public function printSelectOnline()
    {
        //debug($_POST['id']);
        if (IS_POST) {
            $this->caca_Online();
            $ids = $this->clear_html($_POST['id']);
            //$d=cal_days_in_month(CAL_GREGORIAN,$xx['1'],$xx['0']);
            $data = $this->pp_Online($ids);
            $xx = explode('-', date('Y-m', time()));
            $d = cal_days_in_month(CAL_GREGORIAN, $xx['1'], $xx['0']);
            include $this->showTpl();
        }
    }

    public function printall()
    {
        $this->caca();
        $data = M('contract')->select(array('ht_status' => "Y"), 'ht_venderID');
        foreach ($data as $key => $value) {
            $ids[] = $value['ht_venderID'];
        }
        $data = $this->pp($ids);
        $xx = explode('-', date('Y-m', strtotime('-1 month')));
        $d = cal_days_in_month(CAL_GREGORIAN, $xx['1'], $xx['0']);
        include $this->showTpl(printSelect);
    }

    public function printallOnline()
    {
        $this->caca_Online();
        $data = M('contract')->select(array('ht_status' => "Y"), 'ht_venderID');
        foreach ($data as $key => $value) {
            $ids[] = $value['ht_venderID'];
        }
        $data = $this->pp_Online($ids);
        $xx = explode('-', date('Y-m', time()));
        $d = cal_days_in_month(CAL_GREGORIAN, $xx['1'], $xx['0']);
        include $this->showTpl(printSelect);
    }

    public function caca()
    {
        $date = date('Y-m', strtotime('-1 month'));
        $ids = M('contract')->select(array('ht_status' => "Y"));
        $xx = explode('-', $date);
        $d = cal_days_in_month(CAL_GREGORIAN, $xx['1'], $xx['0']);
        $model = new model();
        $info = M('vender_check1');
        $sql = 'select totalAmount as sg_ck,uid as shop_id,date as check_date,totalAmount as sy_ck,weChatAmount as sy_wx,aliPayAmount as sy_zfb from pospi_report_merchant_day where `date` like "' . $date . '%" and uid="';
        $sql1 = 'select shop_id,check_date,`sg_wx`,`sg_ck`,`sg_zfb`,`sg_mt`,`sg_dzdp`,`sg_lm`,`sg_dyqcz`,`sg_xj`,`sg_yhnk`,`sg_yhwk` from pospi_vender_check where `check_date` like "' . $date . '%" and shop_id="';
        foreach ($ids as $value) {
            for ($i = 1; $i <= $d; $i++) {
                $da=date('Y-m-d',strtotime($date . '-' . $i));
                $ii = array('shop_id' => $value['ht_venderID'], 'shop_name' => $value['ht_venderName'], 'check_date' => $da, 'year_mon' => $date, 'sj' => strtotime($date . '-' . $i));
                $check = array('shop_id' => $value['ht_venderID'], 'check_date' => $da);
                if ($info->get_one($check)) {
                } else {
                    $info->insert($ii);
                }
            }
            $data = $model->selectBySql($sql . $value['ht_venderID'] . '"');
            foreach ($data as $k => $v) {
                $check = array('shop_id' => $v['shop_id'], 'check_date' => $v['check_date']);
                $v['shop_name'] = $value['ht_venderName'];
                $v['year_mon'] = $date;
                //$datainfo=array()
                if ($info->get_one($check)) {
                    $info->update($v, $check);
                } else {
                    $info->insert($v);
                }
            }
            $data1 = $model->selectBySql($sql1 . $value['ht_venderID'] . '"');
            foreach ($data1 as $k => $v) {
                $check = array('shop_id' => $v['shop_id'], 'check_date' => $v['check_date']);
                $v['shop_name'] = $value['ht_venderName'];
                $v['year_mon'] = $date;
                //$datainfo=array()
                if ($info->get_one($check)) {
                    $info->update($v, $check);
                } else {
                    $info->insert($v);
                }
            }
        }
    }

    public function caca_Online()
    {
        $date = date('Y-m', time());
        $ids = M('contract')->select(array('ht_status' => "Y"));
        $xx = explode('-', $date);
        $d = cal_days_in_month(CAL_GREGORIAN, $xx['1'], $xx['0']);
        $model = new model();
        $info = M('vender_check_online');
        $sql = 'select uid as shop_id,date as check_date,totalAmount as sy_ck,weChatAmount as sy_wx,aliPayAmount as sy_zfb from pospi_onlinecard_report_merchant_day where `date` like "' . $date . '%" and uid="';
        $sql1 = 'select shop_id,check_date,`sg_wx`,`sg_zfb`,`sg_mt`,`sg_dzdp`,`sg_lm`,`sg_dyqcz`,`sg_xj`,`sg_yhnk`,`sg_yhwk` from pospi_vender_check_online where `check_date` like "' . $date . '%" and shop_id="';
        foreach ($ids as $value) {
            for ($i = 1; $i <= $d; $i++) {
                $ii = array('shop_id' => $value['ht_venderID'], 'shop_name' => $value['ht_venderName'], 'check_date' => $date . '-' . $i, 'year_mon' => $date, 'sj' => strtotime($date . '-' . $i));
                $check = array('shop_id' => $value['ht_venderID'], 'check_date' => $date . '-' . $i);
                if ($info->get_one($check)) {
                } else {
                    $info->insert($ii);
                }
            }
            $data = $model->selectBySql($sql . $value['ht_venderID'] . '"');
            foreach ($data as $k => $v) {
                $check = array('shop_id' => $v['shop_id'], 'check_date' => $v['check_date']);
                $v['shop_name'] = $value['ht_venderName'];
                $v['year_mon'] = $date;
                //$datainfo=array()
                if ($info->get_one($check)) {
                    $info->update($v, $check);
                } else {
                    $info->insert($v);
                }
            }
            $data1 = $model->selectBySql($sql1 . $value['ht_venderID'] . '"');
            foreach ($data1 as $k => $v) {
                $check = array('shop_id' => $v['shop_id'], 'check_date' => $v['check_date']);
                $v['shop_name'] = $value['ht_venderName'];
                $v['year_mon'] = $date;
                //$datainfo=array()
                if ($info->get_one($check)) {
                    $info->update($v, $check);
                } else {
                    $info->insert($v);
                }
            }
        }
    }


    public function pp($ids = '')
    {
        $date = date('Y-m', strtotime('-1 month'));
        //$this->caca();
        foreach ($ids as $val) {
            $info = M('vender_check1')->select(array('shop_id' => $val, 'year_mon' => $date), '*', '', 'sj asc');
            $info1 = array();
            foreach ($info as $k => $v) {
                $info1['1'] += $v['sg_ck'];
                $info1['2'] += $v['sy_wx'];
                $info1['3'] += $v['sy_zfb'];
                $info1['4'] += $v['sg_wx'];
                $info1['5'] += $v['sg_zfb'];
                $info1['6'] += $v['sg_mt'];
                $info1['7'] += $v['sg_dzdp'];
                $info1['8'] += $v['sg_lm'];
                $info1['9'] += $v['sg_dyqcz'];
                $info1['10'] += $v['sg_xj'];
                $info1['11'] += $v['sg_yhnk'];
                $info1['12'] += $v['sg_yhwk'];
                $name = $v['shop_name'];
                $info[$k]['sum'] = $v['sy_ck'] +$v['sg_ck'] + $v['sy_wx'] + $v['sy_zfb'] + $v['sg_wx'] + $v['sg_zfb'] + $v['sg_mt'] + $v['sg_dzdp'] + $v['sg_lm'] + $v['sg_dyqcz'] + $v['sg_xj'] + $v['sg_yhnk'] + $v['sg_yhwk'];
                $info1['13'] += $info[$k]['sum'];
            }
            $data[] = array('name' => $name, 'data' => $info, 'sum' => $info1);
            unset($info1);
        }
        return $data;
    }

    public function pp_Online($ids = '')
    {
        $date = date('Y-m', time());
        //$this->caca();
        foreach ($ids as $val) {
            $info = M('vender_check_online')->select(array('shop_id' => $val, 'year_mon' => $date), '*', '', 'sj asc');
            $info1 = array();
            foreach ($info as $k => $v) {
                $info1['1'] += $v['sy_ck'];
                $info1['2'] += $v['sy_wx'];
                $info1['3'] += $v['sy_zfb'];
                $info1['4'] += $v['sg_wx'];
                $info1['5'] += $v['sg_zfb'];
                $info1['6'] += $v['sg_mt'];
                $info1['7'] += $v['sg_dzdp'];
                $info1['8'] += $v['sg_lm'];
                $info1['9'] += $v['sg_dyqcz'];
                $info1['10'] += $v['sg_xj'];
                $info1['11'] += $v['sg_yhnk'];
                $info1['12'] += $v['sg_yhwk'];
                $name = $v['shop_name'];
                $info[$k]['sum'] = $v['sy_ck'] + $v['sy_wx'] + $v['sy_zfb'] + $v['sg_wx'] + $v['sg_zfb'] + $v['sg_mt'] + $v['sg_dzdp'] + $v['sg_lm'] + $v['sg_dyqcz'] + $v['sg_xj'] + $v['sg_yhnk'] + $v['sg_yhwk'];
                $info1['13'] += $info[$k]['sum'];
            }

            $data[] = array('name' => $name, 'data' => $info, 'sum' => $info1);
            unset($info1);
        }
        return $data;
    }


    //水电
    public function wdg()
    {
        $vender = M('contract')->select(array('ht_status' => "Y"));
        include $this->showTpl('');
    }

    public function printSelectwdg()
    {
        if (IS_POST) {
            $ids = $this->clear_html($_POST['id']);
            $date = date('Y-m', strtotime('-1 month'));
            $xx = explode('-', $date);
            foreach ($ids as $v) {
                $data = M('vender_charge')->select(array('shop_id' => $v, 'js_date' => $date, 'fee_class' => '1'));
                if (!$data) continue;
                $name = M('contract')->get_one(array('ht_venderID' => $v));
                $name = $name['ht_venderName'];
                foreach ($data as $k => $v) {
                    $info1[] = $v;
                    $total += $v['fy_price'];
                }
                $datas[] = array('name' => $name, 'data' => $info1, 'total' => $total);
                unset($total, $info1);
            }
            // debug($datas);
            include $this->showTpl();
        }
    }

    public function printallwdg()
    {
        $data = M('contract')->select(array('ht_status' => "Y"), 'ht_venderID');
        foreach ($data as $key => $value) {
            $ids[] = $value['ht_venderID'];
        }
        $date = date('Y-m', strtotime('-1 month'));
        $xx = explode('-', $date);
        foreach ($ids as $v) {
            $data = M('vender_charge')->select(array('shop_id' => $v, 'js_date' => $date, 'fee_class' => '1'));
            if (!$data) continue;
            $name = M('contract')->get_one(array('ht_venderID' => $v));
            $name = $name['ht_venderName'];
            foreach ($data as $k => $v) {
                $info1[] = $v;
                $total += $v['fy_price'];
            }
            $datas[] = array('name' => $name, 'data' => $info1, 'total' => $total);
            unset($total, $info1);
        }
        include $this->showTpl('printSelectwdg');
    }


    //通知单打印
    public function notice()
    {
        $vender = M('contract')->select(array('ht_status' => "Y"));
        include $this->showTpl();
    }

    public function printSelectNotice()
    {
        $this->total();
        if (IS_POST) {
            $ids = $this->clear_html($_POST['id']);
            $date = date('Y-m', strtotime('-1 month'));
            foreach ($ids as $value) {
                $data = M('jiesuan')->get_one(array('shop_id' => $value, 'riqi' => $date));
                $fee1 = M('vender_charge')->get_one(array('shop_id' => $value, 'fee_class' => 1), 'SUM(fy_price) AS wdgtotal,fee_start,fee_end');
                $fee2 = M('vender_charge')->select(array('shop_id' => $value, 'fee_class' => 0));
                $datas[] = array('data' => $data, 'fee1' => $fee1, 'fee2' => $fee2);
            }
            include $this->showTpl();
        }
    }

    public function printallNotice()
    {
        $this->total();
        $data = M('contract')->select(array('ht_status' => "Y"), 'ht_venderID');
        foreach ($data as $key => $value) {
            $ids[] = $value['ht_venderID'];
        }
        $date = date('Y-m', strtotime('-1 month'));
        foreach ($ids as $value) {
            $data = M('jiesuan')->get_one(array('shop_id' => $value, 'riqi' => $date));
            $fee1 = M('vender_charge')->get_one(array('shop_id' => $value, 'fee_class' => 1), 'SUM(fy_price) AS wdgtotal,fee_start,fee_end');
            $fee2 = M('vender_charge')->select(array('shop_id' => $value, 'fee_class' => 0));
            $datas[] = array('data' => $data, 'fee1' => $fee1, 'fee2' => $fee2);
        }
        include $this->showTpl('printSelectNotice');

    }

    public function total()
    {
        $data = M('contract')->select(array('ht_status' => "Y"));
        $date = date('Y-m', strtotime('-1 month'));
        foreach ($data as $key => $value) {
            $total = M('report_merchant_day')->get_one(array('uid' => $value['ht_venderID'], '`date`' => array('like', $date . '%')), 'sum(totalAmount) as total');
            $tota2 = M('vender_check')->get_one(array('shop_id' => $value['ht_venderID'], '`check_date`' => array('like', $date . '%')), 'sum(hj) as hj1');
            $info = array(
                'xse' => $total['total']+$tota2['hj1'],
                'riqi' => $date,
                'shop_id' => $value['ht_venderID'],
                'shop_name' => $value['ht_venderName'],
                'ht_no' => $value['ht_code'],
                'ht_class' => $value['ht_business'],
                'ht_pwh' => $value['ht_puweiNo'],
                'ht_jypp' => $value['ht_pinpai'],
                'ht_square' => $value['ht_square'],
                'zj' => $value['ht_baodi'],
                'bdje' => $value['ht_baodi'],
                'kd' => $value['total'],
                'lrsj' => time()
            );
            $check = array('riqi' => $date, 'shop_id' => $value['ht_venderID']);
            if (M('jiesuan')->get_one($check)) {
                M('jiesuan')->update($info, $check);
            } else {
                M('jiesuan')->insert($info);
            }
        }
    }

}
