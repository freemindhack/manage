<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>合同 | 合同录入</title>
    <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/header.tpl.php'; ?>


    <!-- FooTable -->
    <link href="<?php echo RL_PIGCMS_STATIC_PATH; ?>plugins/css/footable/footable.core.css" rel="stylesheet">
    <link href="<?php echo $this->RlStaticResource; ?>plugins/css/iCheck/custom.css" rel="stylesheet">
    <style>
        .ibox {
            border: 1px solid #e7eaec;
        }

        .part_item {
            background: none repeat scroll 0 0 #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding-bottom: 15px;
            margin-bottom: 10px;
        }

        .form .part_item p {
            display: inline-block;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 20px 0;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .part_item_b {
            border-top: 1px solid #ccc;
            margin-top: 10px;
        }

        .form .part_item p.active {
            color: #f87b00;
        }

        .part_item input {
            font-size: 14px;
            margin-bottom: 2px;
            margin-right: 5px;
        }

        .pagination {
            margin: 0px;
        }

        .mustInput {
            color: red;
            margin-right: 5px;
        }

        @media (min-width: 768px) {
            .form .part_item p {
                width: 37%;
            }
        }

        @media (min-width: 992px) {
            .form .part_item p {
                width: 24%;
            }
        }

        .form-control, .single-line {
            width: 50%;
        }
    </style>
</head>

<body>

<div id="wrapper">
    <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/leftmenu.tpl.php'; ?>

    <div id="page-wrapper" class="gray-bg">
        <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/top.tpl.php'; ?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>合同录入</h2>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div id="wrapper">
                <div class="gray-bg">
                    <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="row">
                            <form id="shopForm" class="form" action="?m=User&c=ht&a=htRecord" method="post">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-content">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label><span class="mustInput">*</span>合同编码:</label>
                                                    <input type="text" id="ht_sourceNO" placeholder="请输入合同编码"
                                                           name="ht_sourceNO" class="form-control required" aria-required="true">
                                                </div>
                                                <label><span class="mustInput">*</span>商户名称:<span
                                                        class="f999">(请选择)</span></label>
                                                <select type="text" id="ht_venderID" name="ht_venderID"
                                                        class="form-control required" aria-required="true">
                                                    <option selected>请选择商户</option>
                                                    <?php foreach ($shop as $k => $v) {
                                                        echo '<option value="' . $k . '">' . $v . '</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label><span class="mustInput">*</span>合同经营方式:</label>
                                                <select type="text" id="ht_business" placeholder="" name="ht_business"
                                                        class="form-control required" aria-required="true">
                                                    <option selected>请选择经营方式</option>
                                                    <option value="1">租赁</option>
                                                    <option value="2">联营</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label><span class="mustInput">*</span>合同开始日期:</label>
                                                <input type="text" id="datepicker1" placeholder="请输入合同开始日期"
                                                       name="ht_startT" class="form-control required"
                                                       aria-required="true">
                                            </div>
                                            <div class="form-group">
                                                <label><span class="mustInput">*</span>合同结束日期:</label>
                                                <input type="text" id="datepicker2" placeholder="请输入合同结束日期"
                                                       name="ht_endT" class="form-control required"
                                                       aria-required="true">
                                            </div>
                                            <div class="form-group">
                                                <label><span class="mustInput">*</span>保底:</label>
                                                <input type="text" id="ht_baodi" placeholder="请输入保底" name="ht_baodi"
                                                       class="form-control required" aria-required="true">
                                            </div>
                                            <div class="form-group">
                                                <label><span class="mustInput">*</span>扣率(请输入0-1之间小数):</label>
                                                <input type="text" id="ht_koulv" placeholder="请输入扣率" name="ht_koulv"
                                                       class="form-control required">
                                            </div>
                                            <div class="form-group">
                                                <label><span class="mustInput">*</span>保证金:</label>
                                                <input type="text" id="ht_sure" placeholder="请输保证金" name="ht_sure"
                                                       class="form-control required">
                                            </div>
                                            <div class="form-group">
                                                <label>经营品牌:</label>
                                                <input type="text" id="ht_pinpai" placeholder="请输入经营品牌" name="ht_pinpai"
                                                       class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>面积(单位:平米):</label>
                                                <input type="text" id="ht_square" placeholder="请输入面积" name="ht_square"
                                                       class="form-control ">
                                            </div>
                                            <div class="form-group">
                                                <label>铺位号:</label>
                                                <input type="text" id="ht_puweiNo" placeholder="请输入铺位号"
                                                       name="ht_puweiNo" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>业务员:</label>
                                                <input type="text" id="ht_yewuyuan" placeholder="请输入业务员"
                                                       name="ht_yewuyuan" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>备注:</label>
                                                <input type="text" id="ht_content" placeholder="请输入备注" name="ht_content"
                                                       class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary pull-left" onclick="return check()">
                                        保存
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include RL_PIGCMS_TPL_PATH . APP_NAME . '/' . ROUTE_MODEL . '/public/footer.tpl.php'; ?>

    </div>
</div>
<script type="text/html" id="employersEditTpl">
    <figure>
        <iframe width="425" height="349" src="?m=User&c=shop&a=shopEdit&id={($id)}" frameborder="0"></iframe>
    </figure>
</script>

<!-- FooTable -->
<script src="<?php echo $this->RlStaticResource; ?>plugins/js/footable/footable.all.min.js"></script>

<!-- iCheck -->
<script src="<?php echo $this->RlStaticResource; ?>plugins/js/iCheck/icheck.min.js"></script>

<!-- Jquery Validate -->
<script src="<?php echo $this->RlStaticResource; ?>plugins/js/validate/jquery.validate.min.js"></script>

<!-- Page-Level Scripts -->
<script>
    $(function () {
        $("#datepicker1,#datepicker2").datetimepicker({
            language: 'zh-CN',
            minView: "month",
            format: 'yyyy-mm-dd',//格式化时间
            autoclose: true,
            forceParse: true
        });
    });
    function check() {
        if ($('#ht_venderID').val() == '请选择商户') {
            swal('请选择商户');
            return false
        }
        if ($('#ht_business').val() == '请选择经营方式') {
            swal('请选择经营方式');
            return false
        }
        var t1 = $('#datepicker1').val();
        var t2 = $('#datepicker2').val();
        if (t1 != '' && t2 != '' && t1 > t2) {
            swal('合同开始日期必须小于结束日期!');
            return false;
        }
    }
    $(document).ready(function() {
        employers.init();
    });
    !function(a,b){
        var employers = employers || {};
        employers.init = function(){
            var c = employers;
            b('.footable').footable();
            b('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
            b('#check_box').on('ifChanged', function(){
                c.selectall('Id[]','check_box');
            });
            b('.info_del_all').click(function(){
                c.delAll();
            });
            b('.part_item .checkAll').click(function(){
                var checkItems = b(this).parents('.part_item_t').siblings('.part_item_b').find('p').find('input[name="authority[]"]');
                if (b(this).is(':checked') == false) {
                    checkItems.each(function(ke,el){
                        $(el).iCheck('uncheck');
                    });
                }else{
                    checkItems.each(function(ke,el){
                        $(el).iCheck('check');
                    });
                }
            });
            jQuery.extend(jQuery.validator.messages, {
                required: "必填字段",
                remote: "请修正该字段",
                email: "请输入正确格式的电子邮件",
                equalTo: "请再次输入相同的值",
                maxlength: jQuery.validator.format("请输入一个长度最多是 {0} 的字符串"),
                minlength: jQuery.validator.format("请输入一个长度最少是 {0} 的字符串"),
            });
            b('#shopForm').validate({
                errorPlacement: function (error, element){
                    element.before(error);
                },
                rules: {
                    tel:{
                        minlength:11,
                        maxlength:11
                    }
                }
            });
            b('.formSubmit').click(function(){
                if(b('#shopname').val() != ''){
                    $.post('?m=User&c=shop&a=check&'+$("form").serialize(),function(re){
                        if(re.status == 0){
                            b('#tel').addClass('error');
                            swal("错误", re.msg+" :)", "error");
                        }else if(re.status == 1){
                            b('#shopForm').submit();
                        }
                    },'json');
                }else{
                    b('#shopForm').submit();
                }
            });
            b('.status-checkbox').change(function(){
                var i = b(this).attr('data-id'),s = b(this).is(':checked') ? 1 : 0;
                $.post('?m=User&c=system&a=field',{eid:i,status:s},function(re){
                    if(re.status == 0){
                        swal("错误", re.msg+" :)", "error");
                    }
                },'json');
            });
            b('.shopDel').click(function(){
                var c = b(this);
                swal({
                    title: "是否删除这条数据?",
                    text: "删除数据后将无法恢复，确认要删除吗！",
                    type: "warning",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "删除",
                    cancelButtonText: "取消",
                    closeOnConfirm: false,
                    showCancelButton: true,
                }, function (){
                    $.post('?m=User&c=shop&a=shopDel',{Id:c.attr('data-id')},function(re){
                        if(re.status == 0){
                            swal("错误", re.msg+" :)", "error");
                        }else{
                            swal("成功", re.msg+" :)", "success");
                            c.parents('tr').remove();
                            b('.footable').footable();
                        }
                    },'json');
                });
            });
            b('.shopEdit').click(function(){
                c.edit(b(this).attr('data-id'));
            });
        };
        employers.selectall = function(name,id){
            var checkItems = b('input[name="'+name+'"]');
            if ($("#"+id).is(':checked') == false) {
                checkItems.each(function(ke,el){
                    $(el).iCheck('uncheck');
                });
            }else{
                checkItems.each(function(ke,el){
                    $(el).iCheck('check');
                });
            }
        }
        employers.delAll = function(){
            swal({
                title: "是否删除选中?",
                text: "删除数据后将无法恢复，确认要删除吗！",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "删除",
                cancelButtonText: "取消",
                closeOnConfirm: false,
                showCancelButton: true,
            }, function (){
                var checkItems = b('input[name="Id[]"]'),c = false;

                checkItems.each(function(ke,el){
                    if($(el).is(':checked') == true){
                        c = true;
                    }
                });
                if(c == false){
                    swal("错误", "你至少需要选中一项:)", "error");
                    return false;
                }
                $('.rolesDelAll').submit();
            });
        }
        employers.edit = function(data){
            var $data = b('#employersEditTpl').html().replace('{($id)}',data);
            b('#myModal6').find('.modal-content .modal-body').find('.col-lg-12').html($data);
            b('.employersEditJump').click();
            employers.iframeRresponsible();
            var index = window.setTimeout(function(){
                $(window).resize();
            },200);
        }
        employers.iframeRresponsible = function(){
            var $allObjects = $("iframe, object, embed"),
                $fluidEl = $("figure");

            $allObjects.each(function() {
                $(this)
                // jQuery .data does not work on object/embed elements
                    .attr('data-aspectRatio', this.height / this.width)
                    .removeAttr('height')
                    .removeAttr('width');
            });
            $(window).resize(function() {
                var newWidth = $fluidEl.width();
                $allObjects.each(function() {
                    var $el = $(this);
                    $el
                        .width(newWidth)
                        .height(newWidth * $el.attr('data-aspectRatio'));
                });
            }).resize();
        }
        a.employers = employers;
    }(window,jQuery);
</script>
</body>
</html>