<?php
bpBase::loadAppClass('common', 'User', 0);

/**
 * Created by PhpStorm.
 * User: 93018
 * Date: 2016/7/29
 * Time: 13:35
 */
class Clearing_controller extends common_controller
{
    private $fee;

    //构造
    public function __construct()
    {
        parent::__construct();
        $this->fee = M('fee_manage');
        $db_config = loadConfig('db');
        $this->tablepre = $db_config['default']['tablepre'];

    }

    //费用结算
    public function Settlement()
    {
        $shopSql = 'select Id,UserName,Email from `User`';
        $model = new model();
        $shops = $model->selectBySql($shopSql);
        $feelist = $this->fee->select();
        foreach ($shops as $k => $v) {
            $shop[$v['Id']] = $v['Email'];
        }
        $data = array('last_jiesuan' => date('Y-m', strtotime('-1 month')));
        $data = M('caccaca')->select($data);
        include $this->showTpl();
    }

    //结算费用定义
    public function definition()
    {
        $shopSql = 'select Id,UserName,Email from `User`';
        $model = new model();
        $shops = $model->selectBySql($shopSql);
        $feelist = $this->fee->select();
        foreach ($shops as $k => $v) {
            $shop[$v['Id']] = $v['Email'];
        }
        //		debug($shopSql);
        include $this->showTpl();

    }

    public function check()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            if (M('charge')->get_one($data)) {
                ajaxReturn('', '该商户已存在', 0);
            } else
                ajaxReturn('', '', 1);
        }
    }

    /**
     * @return bool|mixed
     */
    //添加
    public function add()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            $data['addtime'] = time();
            if (!$this->fee->get_one(array('shop_id' => $data['shop_id']))) {
                $res = $this->fee->insert($data);
                $this->successTip('添加成功', '/merchants.php?m=User&c=Clearing&a=definition');
            }

        }
    }

    //修改费用
    public function edit()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            if ($this->_save(M('charge'), $data)) {
                $this->successTip('修改成功');
            }
        }
        $res = M('charge')->get_one(array('id' => $_GET['id']));
        include $this->showTpl();
    }

    public function copy()
    {
        $fee = M('charge')->select(array('isdel' => 'N'));
        $ht = M('contract')->select(array('ht_status' => 'Y'));
        include $this->showTpl();
    }

    public function save()
    {
        if (IS_POST) {
            $temp = M('fee_manage_temp');
            $data = $this->clear_html($_POST);
            $shop_id = $this->fee->get_one(array('id' => $data['id']));
            unset($data['id']);
            $data['shop_id'] = $check['shop_id'] = $shop_id['shop_id'];
            if ($data['last_jiesuan']) {
                $check['last_jiesuan'] = $data['last_jiesuan'];
            } else {
                $data['last_jiesuan'] = $check['last_jiesuan'] = date('Y-m', strtotime('-1 month'));
            }
            $data['update_time'] = date('Y-m-d h:i:s', time());
            if ($temp->get_one($check)) {
                $temp->update($data, array('shop_id' => $check['shop_id'], 'last_jiesuan' => $data['last_jiesuan']));
                ajaxReturn('', '录入成功', 1);
            } else if ($temp->insert($data)) {
                ajaxReturn('', '录入成功', 1);
            }
        }
    }

    public function jiesuandan()
    {
        $date = date('Y-m', strtotime('-1 month'));
        $sql = 'SELECT
              *
            FROM
              `pospi_fee_manage` AS a
              LEFT JOIN
                (SELECT
                  SUM(totalAmount) AS total,
                  uid
                FROM
                  `pospi_report_merchant_day` where `date` LIKE "' . $date . '%"
                GROUP BY uid) AS b
                ON b.uid = a.`shop_id`
              LEFT JOIN
                (SELECT
                  water_fee,dian_fee,last_jiesuan,shop_id AS hehe
                FROM
                  `pospi_fee_manage_temp` where `last_jiesuan`="' . $date . '" )AS c ON a.`shop_id`=c.hehe GROUP BY a.`shop_id`';
        $search = new model();
        $shopSql = 'select Id,UserName,Email from `User`';
        $model = new model();
        $shops = $model->selectBySql($shopSql);
        foreach ($shops as $k => $v) {
            $shop[$v['Id']] = $v['Email'];
        }
        $data = $search->selectBySql($sql);
        include $this->showTpl();
    }

    public function cacaca()
    {
        if (intval($_POST['cacuact']) == 1) {
            $date = date('Y-m', strtotime('-1 month'));
            $sql = 'SELECT * FROM  `pospi_fee_manage` AS a LEFT JOIN
                (SELECT  SUM(totalAmount) AS total,
                SUM(cashAmount) AS xj,
                SUM(bankCardAmount) AS ba,
                SUM(weChatAmount) AS wa,
                SUM(aliPayAmount) AS aa,
                SUM(giftAmount) AS ga,
                SUM(tuanAmount) AS ta,
                SUM(otherAmount) AS qt,
                SUM(cardAmount) AS m1,uid FROM `pospi_report_merchant_day` where `date` LIKE "' . $date . '%"
                GROUP BY uid) AS b
                ON b.uid = a.`shop_id`
              LEFT JOIN
                (SELECT
                  water_fee,dian_fee,last_jiesuan,shop_id AS hehe
                FROM
                  `pospi_fee_manage_temp` where `last_jiesuan`="' . $date . '" )AS c ON a.`shop_id`=c.hehe GROUP BY a.`shop_id`';

            $model = new model();
            $data = $model->selectBySql($sql);
            $sumfee = array();
            foreach ($data as $key => $value) {

                $sumfee[$value['shop_id']]['total'] = $value['total'];
                $sumfee[$value['shop_id']]['xj'] = $value['xj'];
                $sumfee[$value['shop_id']]['ba'] = $value['ba'];
                $sumfee[$value['shop_id']]['wa'] = $value['wa'];
                $sumfee[$value['shop_id']]['aa'] = $value['aa'];
                $sumfee[$value['shop_id']]['ga'] = $value['ga'];
                $sumfee[$value['shop_id']]['ta'] = $value['ta'];
                $sumfee[$value['shop_id']]['qt'] = $value['qt'];
                $sumfee[$value['shop_id']]['m1'] = $value['m1'];
                $sumfee[$value['shop_id']]['lease_fee'] = $value['lease_fee'];
                $sumfee[$value['shop_id']]['health_fee'] = $value['health_fee'];
                $sumfee[$value['shop_id']]['split_fee'] = $value['split_fee'];
                $sumfee[$value['shop_id']]['baodi_fee'] = $value['baodi_fee'];
                $sumfee[$value['shop_id']]['custom_fee'] = $value['custom_fee'];
                $sumfee[$value['shop_id']]['water_fee'] = $value['water_fee'];
                $sumfee[$value['shop_id']]['dian_fee'] = $value['dian_fee'];
                $sumfee[$value['shop_id']]['last_jiesuan'] = $value['last_jiesuan'];
                $sumfee[$value['shop_id']]['shop_id'] = $value['shop_id'];

            }
            $tmp = M('caccaca');
            foreach ($sumfee as $k => $v) {

                $check['shop_id'] = $v['shop_id'];
                $check['last_jiesuan'] = $v['last_jiesuan'];
                $v['update_time'] = time();
                if ($tmp->get_one($check)) {
                    unset($v['shop_id'], $v['last_jiesuan']);
                    $tmp->update($v, $check);
                } else {
                    $tmp->insert($v);
                }
            }
            ajaxReturn('', '所有商户生成结算单完成', 1);
        }
    }

//excel 上传 导入
    public function up()
    {

        if (!empty ($_FILES ['file_stu'] ['name'])) {
            $tmp_file = $_FILES ['file_stu'] ['tmp_name'];
            $file_types = explode(".", $_FILES ['file_stu'] ['name']);
            $file_type = $file_types [count($file_types) - 1];
            //判别是不是.xls文件，判别是不是excel文件
            if (strtolower($file_type) != "xlsx") {
                $this->error('不是Excel文件，重新上传');
            }
            //设置上传路径

            $savePath = ABS_PATH . 'public\upfile\Excel';
            //debug($savePath);
            mkdir($savePath, 0777, TRUE);
            //以时间来命名上传的文件
            $str = date('Ymdhis');
            $file_name = $str . "." . $file_type;
            /*是否上传成功*/
            if (!copy($tmp_file, $savePath . $file_name)) {
                $this->error('上传失败');
            }
            /*
               *对上传的Excel数据进行处理生成编程数据,这个函数会在下面第三步的ExcelToArray类中
              注意：这里调用执行了第三步类里面的read函数，把Excel转化为数组并返回给$res,再进行数据库写入
            */
            $res = Service('ExcelToArray')->read($savePath . $file_name);
            /*
                 重要代码 解决Thinkphp M、D方法不能调用的问题
                 如果在thinkphp中遇到M 、D方法失效时就加入下面一句代码
             */
            //spl_autoload_register ( array ('Think', 'autoload' ) );
            /*对生成的数组进行数据库的写入*/
            foreach ($res as $k => $v) {
                if ($k != 0) {
                    $data ['uid'] = $v [0];
                    $data ['password'] = sha1('111111');
                    $data ['email'] = $v [1];
                    $data ['uname'] = $v [3];
                    $data ['institute'] = $v [4];
                    $result = M('user')->add($data);
                    if (!$result) {
                        $this->error('导入数据库失败');
                    }
                }
            }
        }
    }

    public function printSelect()
    {
        //debug($_POST['id']);
        if (IS_POST) {
            $ids = $this->clear_html($_POST['id']);
            $str = implode($ids, ',');
            $mod = new model();
            $date = date('Y-m', strtotime('-1 month'));
            $sql = 'select * from pospi_caccaca where id in(' . $str . ')';
            $da = $mod->selectBySql($sql);
            $shopSql = 'select Id,UserName,Email from `User`';
            $model = new model();
            $shops = $model->selectBySql($shopSql);
            foreach ($shops as $k => $v) {
                $shop[$v['Id']] = $v['Email'];
            }
            include $this->showTpl();
        }
    }

    public function printAll()
    {
        $mod = new model();
        $date = date('Y-m', strtotime('-1 month'));
        $sql = 'select * from pospi_caccaca where last_jiesuan="' . $date . '"';
        $da = $mod->selectBySql($sql);
        $shopSql = 'select Id,UserName,Email from `User`';
        $model = new model();
        $shops = $model->selectBySql($shopSql);
        foreach ($shops as $k => $v) {
            $shop[$v['Id']] = $v['Email'];
        }
        include $this->showTpl('printSelect');
    }

    public function define()
    {
        $data = M('charge')->select(array('isdel' => 'N'));
        include $this->showTpl();
    }

    public function addcharge()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            $data['addtime'] = time();
            if (!M('charge')->get_one(array('name' => $data['name']))) {
                $res = M('charge')->insert($data);
                $this->successTip('添加成功', '/merchants.php?m=User&c=Clearing&a=define');
            }

        }
    }

    public function Del()
    {
        if (IS_POST) {
            $data['id'] = $_POST['id'];
            if (M('charge')->update(array('isdel' => 'Y'), $data)) {
                ajaxReturn('', '删除成功!', 1);
            }
        }

    }

    public function copyin()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            $info = M('charge')->get_one(array('id' => $data['fee_no']));
            $info1 = M('contract')->get_one(array('ht_code' => $data['ht_no']));
            $data['fee_class'] = $info['class'];
            $data['fee_name'] = $info['name'];
            $data['shop_id'] = $info1['ht_venderID'];
            $data['shop_name'] = $info1['ht_venderName'];
            $data['js_no'] = md5('sadsa#$@' . time());
            $data['content'] = $data['content'] ? '备注:' . $data['content'] : '';
            if (M('vender_charge')->insert($data)) {
                $this->successTip('添加成功');
            }


        }
    }

    //已录入费用修改
    public function modi()
    {
        $info1 = M('charge')->select(array('isdel' => 'N'));//费用类型
        $info2 = M('contract')->select(array('ht_status' => 'Y'));//合同编号
        include $this->showTpl();
    }

    //查找
    public function modiSea()
    {
        $data = $this->clear_html($_GET);
        $data1['shop_id'] = $data['shop_id'];
        $data1['fee_no'] = $data['fee_no'];
        foreach ($data1 as $key => $value) {
            if (empty($value)) {
                unset($data1[$key]);
            }
        }
        $info = M('vender_charge')->select($data1);
        $info1 = M('charge')->select(array('isdel' => 'N'));//费用类型
        $info2 = M('contract')->select(array('ht_status' => 'Y'));//合同编号
        include $this->showTpl('modi');
    }

    //删除
    public function modiDel()
    {
        if (IS_POST) {
            $id = $this->clear_html($_POST);
            if (M('vender_charge')->delete($id)) {
                ajaxReturn('', '删除成功', 1);
            }
        }

    }

    public function Lrfix()
    {
        $fy = M('vender_charge')->get_one(array('id' => $_GET['id']));
        include $this->showTpl();
    }

    //修改保存
    public function fixsave()
    {
        if (IS_POST) {
            $data = $this->clear_html($_POST);
            if (M('vender_charge')->update($data, array('id' => $_GET['id']))) {
                $this->successTip('修改成功');
            }
        }
    }

    //审核
    public function checklr()
    {
        if (IS_POST) {
            if (M('vender_charge')->update(array('check' => "Y"), array('id' => $_POST['id']))) {
                ajaxReturn('', '审核成功', 1);
            }
        }
    }

    public function get_fee_name()
    {
        if (IS_POST) {
            $name = M('charge')->get_one(array('id' => $_POST['id']));
            ajaxReturn('1111', $name['base'], 1);
        }

    }

    public function allcheck()
    {
        if (IS_POST){
            $data = $this->clear_html($_POST);
            $return = $this->update_all(M('vender_charge'),array('check'=>'Y'), $data['id']);

            if ($return['status'] == '1') {
                ajaxReturn('','审核成功！',1);
                exit();
            }else {
                ajaxReturn('','审核失败(╥╯^╰╥)',0);
                exit();
            }
        }
    }
}
