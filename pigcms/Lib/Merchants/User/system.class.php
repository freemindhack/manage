<?php
bpBase::loadAppClass('common', 'User', 0);

class system_controller extends common_controller
{
    private $rolesDb;

    public function __construct()
    {
        parent::__construct();
        $this->authorityControl(array('rolesEdit', 'checkAccount', 'roleDel'));
        $this->rolesDb = M('cashier_roles');

    }

    public function roles()
    {
        $authority = $this->authorityList('Merchants/User');
        $roles = $this->rolesDb->select(array('mid' => $this->mid));
        include $this->showTpl();
    }

    public function rolesAdd()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);

            $data['mid'] = $this->mid;
            $data['authority'] = !empty($data['authority']) ? implode(',', $data['authority']) : '';
            $data['updatetime'] = time();

            if ($this->rolesDb->insert($data, 1)) {
                $this->successTip('添加角色成功！', $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                $this->errorTip('添加角色失败！', $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }

    public function checkAccount()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            if ($this->rolesDb->get_one(array('rolename' => $data['rolename']))) {
                echo json_encode(array('status' => 0, 'msg' => '角色已存在'));
            } else {
                echo json_encode(array('status' => 1, 'msg' => '验证成功'));
            }
        }
    }

    public function field()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
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

    public function roleDel()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            $return = $this->_del($this->rolesDb, $data['id']);
            exit(json_encode($return));
        }
    }

    public function rolesEdit()
    {
        if (IS_GET) {
            $data = $this->clear_html($_GET);
            $authority = $this->authorityList('Merchants/User');
            $roles = $this->rolesDb->get_one(array('id' => $data['id']));
            $roles['authority'] = explode(',', $roles['authority']);
            include $this->showTpl();
        }
    }

    public function rolesAppemd()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            $data['authority'] = !empty($data['authority']) ? implode(',', $data['authority']) : '';

            if ($this->_save($this->rolesDb, $data)) {
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
