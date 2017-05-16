<?php
bpBase::loadAppClass('common', 'User', 0);

/**
 * Created by PhpStorm.
 * User: 93018
 * Date: 2016/7/29
 * Time: 13:35
 */
class qita_controller extends common_controller
{
    private $fee;

    //构造
    public function __construct()
    {
        parent::__construct();
    }

    //其他费用
    public function qtlr()
    {
        $ht = M('contract')->select(array('ht_status' => 'Y'));
        $data = M('vender_check')->select();
        include $this->showTpl();
    }

    public function qitaEdit()
    {
        $id = $_GET['id'];
        $data = M('vender_check')->get_one(array('id' => $id));
        $name = M('vender')->get_one(array('Id' => $data['shop_id']));
        //debug($data);
        include $this->showTpl();
    }

    public function qitaEsave()
    {
        if (IS_POST) {
            $id['id'] = $_POST['id'];
            $data = $_POST;
            unset($data['id']);
            $data['hj'] = $data['sg_wx'] + $data['sg_zfb']+ $data['sg_zz']+ $data['sg_elm']+ $data['sg_dwb'] + $data['sg_ck'] + $data['sg_mt'] + $data['sg_dzdp'] + $data['sg_lm'] + $data['sg_dyqcz'] + $data['sg_xj'] + $data['sg_yhnk'] + $data['sg_yhwk'];
            M('vender_check')->update($data, $id);
            $this->successTip('修改成功!', '/merchants.php?m=User&c=qita&a=qtlr');
        }
    }

    public function copyin()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            $check['shop_id'] = $data['shop_id'];
            $check['check_date'] = $data['check_date'];
            $ht = M('contract')->get_one(array('ht_venderID' => $check['shop_id']));
            $data['shop_name'] = $ht['ht_venderName'];
            $data['lrsj'] = time();
            $data['hj'] = $data['sg_wx'] + $data['sg_zfb']+ $data['sg_zz']+ $data['sg_elm']+ $data['sg_dwb'] + $data['sg_ck'] + $data['sg_mt'] + $data['sg_dzdp'] + $data['sg_lm'] + $data['sg_dyqcz'] + $data['sg_xj'] + $data['sg_yhnk'] + $data['sg_yhwk'];
            $model = M('vender_check');
            if (!$model->get_one($check)) {
                $model->insert($data) ? $this->successTip('录入成功') : $this->errorTip('录入成功');
            } else $this->errorTip('已存在该商户当天记录!');

        }
    }

    public function del()
    {
        if (IS_POST) {
            if (M('vender_check')->delete($_POST)) {
                ajaxReturn('', '删除成功!', 1);
            }
        }
    }

    public function checklr()
    {
        if (IS_POST) {
            if (M('vender_check')->update(array('shbz' => "Y"), $_POST)) {
                ajaxReturn('', '审核成功!!', 1);
            }
        }
    }

    public function search()
    {

        $ht = M('contract')->select(array('ht_status' => 'Y'));
        $data['shop_id'] = $_GET['shop_id'];
        $data['check_date'] = $_GET['check_date'];
        foreach ($data as $key => $item) {
            if ($item == '') {
                unset($data[$key]);
            }
        }
//        bpBase::loadOrg('common_page');
//        $_count=M('vender_check')->count($data);
//        $p = new Page($_count, 1);dump($p);
//        $pagebar = $p->show(2);
        $data = M('vender_check')->select($data);
        include $this->showTpl('qtlr');
    }
}
