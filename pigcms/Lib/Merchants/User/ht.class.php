<?php
bpBase::loadAppClass('common', 'User', 0);

/**
 * Created by PhpStorm.
 * User: 93018
 * Date: 2016/7/29
 * Time: 13:35
 */
class ht_controller extends common_controller
{
    private $fee;

    //构造
    public function __construct()
    {
        parent::__construct();
        $this->fee = M('contract');
        $db_config = loadConfig('db');
        $this->tablepre = $db_config['default']['tablepre'];

    }

    //费用结算
    public function ht()
    {
        $shopSql = 'select * from `pospi_vender`';
        $model = new model();
        $shops = $model->selectBySql($shopSql);
        $feelist = $this->fee->select();
        foreach ($shops as $k => $v) {
            $shop[$v['Id']] = $v['UserName']."[{$v['shopname']}]";
        }

        include $this->showTpl();
    }

    public function htRecord()
    {
        $data = $this->clear_html($_POST);
        $shops = M('vender')->select();
        foreach ($shops as $k => $v) {
            $shop[$v['Id']] = $v['UserName']."[{$v['shopname']}]";
        }
        $data['ht_venderName'] = $shop[$data['ht_venderID']];
        $data['ht_code'] = '101' . date('ymd', time()) . substr(md5(time()), 0, 10);
        $data['ht_luruTime'] = date('Y-m-d H:i:s', time());
        $name = $this->eid?M('cashier_employee')->get_var(array('eid'=>$this->eid)):array('name'=>'管理员');
        $data['ht_lururen'] = $name['name'];
        if ($this->fee->get_one(array('ht_venderID' => $data['ht_venderID'], 'ht_endT' => array('egt', $data['ht_startT'])))) {
            $this->fee->update(array('ht_status' => 'N'), array('ht_venderID' => $data['ht_venderID']));
        }
        if ($this->fee->insert($data)) {
            $this->successTip('添加成功');
        }
    }

    //合同管理
    public function htmange()
    {
        $shops = M('contract')->select(array('ht_status' => 'Y'));
        foreach ($shops as $k => $v) {
            $shop[$v['ht_venderID']] = $v['ht_venderName'];
        }
        include $this->showTpl();
    }

    public function htsear()
    {
        $shops = M('contract')->select(array('ht_status' => 'Y'));
        foreach ($shops as $k => $v) {
            $shop[$v['ht_venderID']] = $v['ht_venderName'];
        }
        $id = $_GET['ht_venderID'] ? $_GET['ht_venderID'] : '';
        if ($id != '') {
            $data = M('contract')->select(array('ht_venderID' => $id, 'ht_status' => 'Y'));

        } else {
            $data = M('contract')->select(array('ht_status' => 'Y'));
        }
        include $this->showTpl('htmange');
    }

    public function htDel()
    {
        if (IS_POST) {
            $id = $this->clear_html($_POST);
            if (M('contract')->delete($id)) {
                ajaxReturn('', '删除成功', 1);
            }
        }

    }

    public function htfix()
    {
        $fy = M('contract')->get_one(array('id' => $_GET['id']));
        include $this->showTpl();
    }


    public function checkht()
    {
        if (IS_POST) {
            $name = $this->eid?M('cashier_employee')->get_var(array('eid'=>$this->eid)):array('name'=>'管理员');
            $data=array('ht_check' => "Y",
                'ht_shenheTime'=>date('Y-m-d H:i:s', time()),
                'ht_shenheren'=>$name['name']
                );
            if (M('contract')->update($data, array('id' => $_POST['id']))) {
                ajaxReturn('', '审核成功', 1);
            }
        }

    }

    public function htsave()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            if (M('contract')->update($data, array('id' => $_GET['id']))) {
                $this->successTip('修改成功');
            }
        }
    }

}
