<?php
bpBase::loadAppClass('common', 'User', 0);

class coin_controller extends common_controller
{
    public $coin;


    public function __construct()
    {
        parent::__construct();
        $this->coin = M('cashier_coin');
    }

    public function manage()
    {
        $data = $this->coin->select();
        include $this->showTpl();
    }

    public function Add()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            $data['IsDel'] = 'N';
            if ($this->coin->insert($data)) {
                $this->successTip('添加成功!', $_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function Edit()
    {
        $data['Sid'] = $this->clear_html($_GET['Sid']);
        $data = $this->coin->get_one($data);
        include $this->showTpl();

    }

    public function Appemd()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            if ($data['Pwd'] == '') {
                unset($data['Pwd']);
            }
            // debug($data);
            $data = $this->_save($this->coin, $data);
            if ($data['status'] == '1') {
                $this->successTip($data['msg'], $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                $this->errorTip($data['msg'], $_SERVER['HTTP_REFERER']);
                exit();
            }
        }


    }

    public function DelAll()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            $return = $this->_delAll($this->coin, $data['Sid']);

            if ($return['status'] == '1') {
                $this->successTip($return['msg'], $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                $this->errorTip($return['msg'], $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }

    /**
     * @return bool|mixed
     */
    public function check()
    {
        ajaxReturn('', '', 1);
    }


    public function field()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            $data['updatetime'] = time();
            $return = $this->_setField($this->coin, $data);
            echo json_encode($return);
            exit();
        }
    }

    public function Del()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            $data['IsDel'] = 'Y';
            $result = $this->_save($this->coin, $data);
            if ($result['status'] == 1) {
                ajaxReturn('', '删除成功', 1);
            } else {
                ajaxReturn('', '删除失败', 0);
            }
        }
    }
}

?>
