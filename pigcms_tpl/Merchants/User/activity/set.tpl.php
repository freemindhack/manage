
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>活动 | 活动管理</title>
	<?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/header.tpl.php';?>


    <!-- FooTable -->
    <link href="<?php echo  RL_PIGCMS_STATIC_PATH;?>plugins/css/footable/footable.core.css" rel="stylesheet">
	<link href="<?php echo $this->RlStaticResource;?>plugins/css/iCheck/custom.css" rel="stylesheet">
	<style>
		.ibox{
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
		.pagination{
			margin:0px;
		}
		.mustInput {
  			color: red;
  			margin-right: 5px;
		}
		@media (min-width: 768px){
			.form .part_item p {
				width: 37%;
			}
		}
		@media (min-width: 992px){
			.form .part_item p {
				width: 24%;
			}
		}
	.form-control, .single-line{width: 50%;}
	</style>
</head>

<body>

    <div id="wrapper">
	<?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/leftmenu.tpl.php';?>

        <div id="page-wrapper" class="gray-bg">
        <?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/top.tpl.php';?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>活动设置</h2>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
							<form action="?m=User&c=shop&a=DelAll" class="rolesDelAll" method="post">
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="12" data-filter="#filter">
                                <thead>
                                <tr>
<!--                                    <th data-sort-ignore="true" class="check-mail"><input type="checkbox" class="i-checks" id="check_box"></th>-->
                                   <th data-hide="phone">序号</th>
                                    <th data-hide="phone">活动名称</th>
                                    <th data-hide="phone">起始时间</th>
                                    <th data-hide="phone">结束时间</th>
                                    <th data-hide="phone">操作</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php if(!empty($ac)){

								 foreach($ac as $key=>$val){ ?>
                                <tr>
<!--                                    <td class="check-mail"><input type="checkbox" class="i-checks" value="--><?php //echo $val['id'];?><!--" name="id[]"></td>-->
                                    <td><?php echo $key+1;?></td>
                                    <td><?php echo $val['name'];?></td>
                                    <td><?php echo $val['acstart'];?></td>
                                    <td><?php echo $val['acend'];?></td>
                                    <td class="center">
										<div class="btn-group">
                                            <a href="javascript:void(0)" class="btn btn-white btn-sm shopEdit" data-id="<?php echo $val['id'];?>"><i class="fa fa-pencil"></i> 编辑</a>
<!--                                            <a href="javascript:void(0)" class="btn btn-white btn-sm shopDel" data-id="--><?php //echo $val['id'];?><!--"><i class="fa fa-times"></i> 删除</a>-->
                                        </div>
									</td>
                                </tr>
								<?php }}else{ ?>
								<tr><td colspan="4" style="text-align: center; font-size: 16px;">没有活动,请添加！</td></tr>
								<?php }?>
                                </tbody>
                            </table>
							</form>
							<div class="tooltip-demo">
								<button class="btn btn-white btn-sm" data-toggle="modal" data-target="#myModal5" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="添加角色"><i class="fa fa-plus"></i> 添加</button>
<!--								<button class="btn btn-white btn-sm info_del_all" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="删除"><i class="fa fa-trash-o"></i> </button>-->
								<ul class="pagination pull-right"></ul>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php include RL_PIGCMS_TPL_PATH.APP_NAME.'/'.ROUTE_MODEL.'/public/footer.tpl.php';?>

     </div>
    </div>
	<div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg">
        	<div class="modal-content">
            	<div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">添加活动</h4>
                </div>
                <div class="modal-body clearfix">
					<form id="shopForm" class="form" action="?m=User&c=activity&a=acadd" method="post">
						<div class="col-lg-12">
							<div class="ibox">
                        		<div class="ibox-title">
                           			<h5>活动</h5>
                        		</div>
                        		<div class="ibox-content">
                            		<div class="form-group">
										<label><span class="mustInput">*</span>活动名称:<span class="f999">(20字以内)</span></label>
										<input type="text"  id="shopname" placeholder="请输入活动名称" name="name" class="form-control required" aria-required="true">
									</div>
                                    <div class="form-group">
                                        <label><span class="mustInput">*</span>开始时间:</label>
                                        <input type="text"  id="datepicker1" placeholder="请输入开始时间" name="acstart" class="form-control required" aria-required="true">
                                    </div>
                                    <div class="form-group">
                                        <label><span class="mustInput">*</span>结束时间:</label>
                                        <input type="text"  id="datepicker2" placeholder="请输入结束时间" name="acend" class="form-control required" aria-required="true">
                                    </div>
                        		</div>
                    		</div>
						</div>
					</form>
               	</div>

                <div class="modal-footer">
                	<button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                	<button type="button" class="btn btn-primary formSubmit">保存</button>
                </div>
          	</div>
        </div>
    </div>
	<a href="javascript:void(0)" class="employersEditJump"  data-toggle="modal" data-target="#myModal6" data-toggle="tooltip" data-placement="left" title="" data-original-title="角色编辑" style="display: none;">角色编辑</a>
	<div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg">
        	<div class="modal-content">
            	<div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
                    <h4 class="modal-title">活动编辑</h4>
                </div>
                <div class="modal-body clearfix">
					<div class="col-lg-12">
					</div>
               	</div>
				<div class="modal-footer">
                	<button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                </div>
          	</div>
        </div>
     </div>
	<script type="text/html" id="employersEditTpl">
		<figure>
              <iframe width="425" height="349" src="?m=User&c=activity&a=acedit&id={($id)}" frameborder="0"></iframe>
        </figure>
	</script>

    <!-- FooTable -->
    <script src="<?php echo $this->RlStaticResource;?>plugins/js/footable/footable.all.min.js"></script>

	<!-- iCheck -->
    <script src="<?php echo $this->RlStaticResource;?>plugins/js/iCheck/icheck.min.js"></script>

	<!-- Jquery Validate -->
    <script src="<?php echo $this->RlStaticResource;?>plugins/js/validate/jquery.validate.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $("#datepicker1,#datepicker2").datetimepicker({
                language: 'zh-CN',
                format: 'yyyy-mm-dd hh:ii:ss',//格式化时间
                autoclose: true,
                forceParse: true
            });
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
                        $.post('?m=User&c=shop&a=shopDel',{id:c.attr('data-id')},function(re){
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
                    var checkItems = b('input[name="id[]"]'),c = false;

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