<?php
bpBase::loadAppClass('common', 'User', 0);

class activity_controller extends common_controller
{

    public function set()
    {
        $ac = M('zsactiv')->select(array('isdel' => 0));
        include $this->showTpl();
    }

    public function acedit()
    {
        $edit=M('zsactiv')->get_one(array('id'=>$_GET['id']));
        include $this->showTpl();
    }

    public function acsave()
    {
        $edit=M('zsactiv')->update($_POST,array('id'=>$_POST['id']));
        $this->successTip('修改成功！', $_SERVER['HTTP_REFERER']);
    }

    public function acadd(){
        $edit=M('zsactiv')->insert($_POST);
        $this->successTip('添加成功！', $_SERVER['HTTP_REFERER']);
    }
}

?>
