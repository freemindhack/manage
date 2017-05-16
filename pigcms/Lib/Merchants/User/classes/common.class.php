<?php
defined('IN_BACKGROUND') or exit('No permission');
bpBase::loadAppClass('base', '', 0);

class common_controller extends base_controller
{
    protected $merchant = array();
    protected $employer = array();
    protected $mid;

    public function __construct()
    {

        parent::__construct();

        $session_storage = getSessionStorageType();
        bpBase::loadSysClass($session_storage);
        $isLogin = 0;
        if (isset($_SESSION['merchant']['mid']) || !empty($_SESSION['merchant']['mid'])) {
            $isLogin = 1;
            $this->merchant = M('cashier_merchants')->get_one(array('mid' => $_SESSION['merchant']['mid']));
            $this->mid = $this->merchant['mid'];
            $auth = M('cashier_roles')->get_one(array('id' => $this->merchant['roleid']));
            $this->merchant['authority'] = $auth['authority'];
        }
        if ($isLogin == 0) {
            header('Location:merchants.php?m=Index&c=login&a=index');
            exit;
        } elseif (!$this->merchant && !$this->employer && $isLogin != 2) {
            $this->errorTip('账号异常，请重新登录！', '/merchants.php?m=Index&c=login&a=index');
            exit;
        }
        $this->authorityControl();
    }

    protected function authorityControl($data = array())
    {
        $eid = 0;
        isset($_SESSION['merchant']) && !empty($_SESSION['merchant']) && isset($_SESSION['merchant']['mid']) && !empty($_SESSION['merchant']['aid']) && $eid = intval($_SESSION['merchant']['aid']);
        if ($eid && !in_array(ROUTE_ACTION, $data) && ROUTE_CONTROL != 'index') {
            if (!$this->authority($this->merchant['authority'])) {
                if (isAjax()) {
                    exit(json_encode(array('status' => 0, 'error' => 1, 'msg' => '您没有权限访问！')));
                } else {
                    $this->errorTip('您没有权限访问！');
                }
            }
        }
        return true;
    }
}

?>