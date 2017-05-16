<?php
bpBase::loadAppClass('common', 'User', 0);

class merchant_controller extends common_controller
{
    private $employeeDb;
    private $rolesDb;

    public function __construct()
    {
        parent::__construct();
        $this->employeeDb = M('cashier_merchants');
        $this->rolesDb = M('cashier_roles');
    }

    public function employers()
    {
        $authority = $this->authorityList('Merchants/User');
        $employees = $this->employeeDb->select(array('aid' => $this->mid));
        $roles = $this->rolesDb->select(array('mid' => $this->mid));
        foreach ($employees as $k=>$v){
            foreach ($roles as $key=>$value){
                if ($v['roleid']==$value['id']){
                    $employees[$k]['rolename']=$value['rolename'];
                }
            }
        }
        //debug($employees);
        include $this->showTpl();
    }

    public function employersAdd()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
           // debug($data);
            if ($data['password'] != $data['confirm']) {
                $this->errorTip('两次输入密码不一致！', $_SERVER['HTTP_REFERER']);
                exit();
            }
            $data['aid'] = $this->mid;
            $data['salt'] = mt_rand(111111, 999999);
            $data['password'] = md5($data['password']);
            $data['regTime']=time();
            unset($data['confirm']);

            if ($this->employeeDb->insert($data, 1)) {
                $this->successTip('添加员工账号成功！', $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                $this->errorTip('添加员工账号失败！', $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }

    public function checkAccount()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);

            if ($this->employeeDb->get_one(array('username' => $data['account']), 'aid,username')) {
                echo json_encode(array('status' => 0, 'msg' => '登录账号已存在'));
            } else {
                echo json_encode(array('status' => 1, 'msg' => '验证成功'));
            }
        }
    }

    public function field()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            $data['updatetime']=time();
            $return = $this->_setField($this->employeeDb, $data);
            echo json_encode($return);
            exit();
        }
    }

    public function employersDelAll()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            $return = $this->_delAll($this->employeeDb, $data['id']);

            if ($return['status'] == '1') {
                $this->successTip($return['msg'], $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                $this->errorTip($return['msg'], $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }

    public function employersDel()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            $return = $this->_del($this->employeeDb, $data['eid']);
            exit(json_encode($return));
        }
    }

    public function employersEdit()
    {
        if (IS_GET) {
            $data = $this->clear_html($_GET);
            $authority = $this->authorityList('Merchants/User');
            $employee = $this->employeeDb->get_one(array('mid' => $data['eid']));
            $employee['authority'] = explode(',', $employee['authority']);
            $roles=M('cashier_roles')->select(array('mid'=>$this->mid));
            include $this->showTpl();
        }
    }

    public function employersAppemd()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            $employee = $this->employeeDb->get_one(array('mid' => $data['eid']), 'mid,username,salt');


            if ($data['password'] == '') {
                unset($data['password']);
            } else if ($data['password'] != $data['confirm']) {
                $this->errorTip('两次输入密码不一致！', $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                $data['password'] = md5($data['password']);
            }

            unset($data['confirm']);
            if ($this->_save($this->employeeDb, $data)) {
                $this->successTip('修改员工账号成功！', $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                $this->errorTip('修改员工账号失败！', $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }

    private function authorityList($data = '')
    {
        $authority = loadConfig('authority');
        $info = explode('/', $data);
        $result = $this->dataOut($authority, $info);
        unset($result['Des']);
        return $result;
    }

    private function dataOut($data, $goal)
    {
        foreach ($goal as $key => $val) {
            $data = $data[$goal[$key]];
        }

        return $data;
    }
}

?>
