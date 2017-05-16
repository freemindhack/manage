<?php
bpBase::loadAppClass('common', 'User', 0);
class shop_controller extends common_controller{
	private $shopDb;

	public function __construct(){
		parent::__construct();
		$this->authorityControl(array('rolesEdit', 'checkAccount','roleDel'));
		$this->shopDb = M('cashier_shops');
	}

	public function manageShop(){
		$shops = $this->shopDb->select(array('mid' => $this->mid));
		$this->assign('merInfo',$shops);
		$this->display();
	}

	public function shopAdd(){
		if (IS_POST) {
			$data = $this->clear_html($_POST);

			$data['mid'] = $this->mid;
			$data['eid'] = $this->eid;
			$data['add_time']=time();
			$data['update_time']=time();

			if ($this->shopDb->insert($data, 1)) {
				$this->successTip('添加成功！', $_SERVER['HTTP_REFERER']);
				exit();
			}else {
				$this->errorTip('添加失败！', $_SERVER['HTTP_REFERER']);
				exit();
			}
		}
	}

	public function check(){
		if (IS_POST) {
			$data = $this->clear_html($_GET);

			if ($this->shopDb->get_one(array('tel' => $data['tel']))) {

				echo json_encode(array('status' => 0, 'msg' => '手机号码已存在'));
			}
			else if ($this->shopDb->get_one(array('shopname' => $data['shopname']))){
				echo json_encode(array('status' => 0, 'msg' => '商铺名称已存在！'));
			}
			else ajaxReturn('','通过',1);
		}
	}

	public function field(){
		if (IS_POST) {
			$data = $this->clear_html($_POST);
			$return = $this->_setField($this->employeeDb, $data);
			echo json_encode($return);
			exit();
		}
	}

	public function employersDelAll(){
		if (IS_POST) {
			$data = $this->clear_html($_POST);
			$return = $this->_delAll($this->employeeDb, $data['id']);

			if ($return['status'] == '1') {
				$this->successTip($return['msg'], $_SERVER['HTTP_REFERER']);
				exit();
			}else {
				$this->errorTip($return['msg'], $_SERVER['HTTP_REFERER']);
				exit();
			}
		}
	}

	public function shopDel(){
		if (IS_POST) {
			$data = $this->clear_html($_POST);
			$return = $this->_del($this->shopDb, $data['id']);
			exit(json_encode($return));
		}
	}

	public function shopEdit(){
		if (IS_GET) {
			$data = $this->clear_html($_GET);
			$shop= $this->shopDb->get_one(array('id' => $data['id']));
			include $this->showTpl();
		}
	}

	public function shopAppemd(){
		if (IS_POST) {
			$data = $this->clear_html($_POST);

            //debug($data);
			if ($this->_save($this->shopDb, $data)) {
				$this->successTip('修改成功！', $_SERVER['HTTP_REFERER']);
				exit();
			}else {
				$this->errorTip('修改失败', $_SERVER['HTTP_REFERER']);
				exit();
			}
		}
	}

	private function authorityList($data = ''){
		$authority = loadConfig('authority');
		$info = explode('/', $data);
		$result = $this->dataOut($authority, $info);
		unset($result['Des']);
		return $result;
	}

	private function dataOut($data, $goal){
		foreach ($goal as $key => $val) {
			$data = $data[$goal[$key]];
		}

		return $data;
	}
}

?>
