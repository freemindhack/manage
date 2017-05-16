<?php
bpBase::loadAppClass('common', 'User', 0);

class shop_controller extends common_controller
{
    private $shopDb;

    public function __construct()
    {
        parent::__construct();
        $this->shopDb = M('user');
    }

    public function manageShop()
    {
        $shops = $this->shopDb->select(array('IsDel' => 0, 'IsActivate'=>1,'groupId'=>0));
        include $this->showTpl();
    }

    public function shopAdd()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            $data['CreateTime'] = time();
            $data['PassWord'] = md5($data['PassWord']);
            $data['Contacts'] = $data['UserName'];
            $data['status'] = 1;
            $id = $this->shopDb->insert($data,true);
            M('auth_group_access')->insert(array('uid'=>$id,'group_id'=>2));
            $idshop=M('shop')->insert(array('UId'=>$id,'Name'=>'默认店铺','CreateTime'=>date('Y-m-d H:i:s',time())),true);
            M('shop')->update(array('no'=>80000+$idshop),'id='.$idshop);
            $this->successTip('添加成功！', $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    public function check()
    {
        if (IS_POST) {
            $data = $this->clear_html($_GET);
            if ($this->shopDb->get_one(array('shopname' => $data['shopname'],'IsDel'=>0))) {
                echo json_encode(array('status' => 0, 'msg' => '商铺名称已存在！'));
            }elseif ($this->shopDb->get_one(array('UserName' => $data['UserName'],'IsDel'=>0))){
                echo json_encode(array('status' => 0, 'msg' => '用户名已存在！'));
            } else ajaxReturn('', '通过', 1);
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

    public function DelAll()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            $return = $this->_delAll($this->shopDb, $data['id']);

            if ($return['status'] == '1') {
                $this->successTip($return['msg'], $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                $this->errorTip($return['msg'], $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }

    public function shopDel()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            $data['IsDel'] = 1;
            $return = $this->_save($this->shopDb, $data);
            exit(json_encode($return));
        }
    }

    public function shopEdit()
    {
        if (IS_GET) {
            $data = $this->clear_html($_GET);
            $shop = $this->shopDb->get_one(array('id' => $data['id']));
            include $this->showTpl();
        }
    }

    public function shopAppemd()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);

            //debug($data);
            if ($this->_save($this->shopDb, $data)) {
                $this->successTip('修改成功！', $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                $this->errorTip('修改失败', $_SERVER['HTTP_REFERER']);
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
