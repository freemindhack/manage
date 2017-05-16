<?php /* Smarty version 2.6.18, created on 2016-07-23 11:45:48
         compiled from D:%5CphpStudy%5CWWW%5Cmanagecms%5C./pigcms_tpl/Merchants/System/system/roles.tpl.php */ ?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>系统管理 | 角色管理</title>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tplHome'])."/System/public/header.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


    <!-- FooTable -->
    <link href="<?php echo @RlStaticResource; ?>
plugins/css/footable/footable.core.css" rel="stylesheet">
	<link href="<?php echo @RlStaticResource; ?>
plugins/css/iCheck/custom.css" rel="stylesheet">
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
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tplHome'])."/System/public/leftmenu.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

        <div id="page-wrapper" class="gray-bg">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tplHome'])."/System/public/top.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>角色列表</h2>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
							<form action="?m=User&c=merchant&a=rolesDelAll" class="rolesDelAll" method="post">
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8" data-filter="#filter">
                                <thead>
                                <tr>
                                    <th data-sort-ignore="true" class="check-mail"><input type="checkbox" class="i-checks" id="check_box"></th>
                                    <th>编号</th>
                                    <th data-hide="phone">角色名称</th>
                                    <th data-sort-ignore="true">操作</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php if (! empty ( $this->_tpl_vars['roles'] )): ?>
								<?php unset($this->_sections['vv']);
$this->_sections['vv']['name'] = 'vv';
$this->_sections['vv']['loop'] = is_array($_loop=$this->_tpl_vars['roles']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['vv']['show'] = true;
$this->_sections['vv']['max'] = $this->_sections['vv']['loop'];
$this->_sections['vv']['step'] = 1;
$this->_sections['vv']['start'] = $this->_sections['vv']['step'] > 0 ? 0 : $this->_sections['vv']['loop']-1;
if ($this->_sections['vv']['show']) {
    $this->_sections['vv']['total'] = $this->_sections['vv']['loop'];
    if ($this->_sections['vv']['total'] == 0)
        $this->_sections['vv']['show'] = false;
} else
    $this->_sections['vv']['total'] = 0;
if ($this->_sections['vv']['show']):

            for ($this->_sections['vv']['index'] = $this->_sections['vv']['start'], $this->_sections['vv']['iteration'] = 1;
                 $this->_sections['vv']['iteration'] <= $this->_sections['vv']['total'];
                 $this->_sections['vv']['index'] += $this->_sections['vv']['step'], $this->_sections['vv']['iteration']++):
$this->_sections['vv']['rownum'] = $this->_sections['vv']['iteration'];
$this->_sections['vv']['index_prev'] = $this->_sections['vv']['index'] - $this->_sections['vv']['step'];
$this->_sections['vv']['index_next'] = $this->_sections['vv']['index'] + $this->_sections['vv']['step'];
$this->_sections['vv']['first']      = ($this->_sections['vv']['iteration'] == 1);
$this->_sections['vv']['last']       = ($this->_sections['vv']['iteration'] == $this->_sections['vv']['total']);
?>
                                <tr>
                                    <td class="check-mail"><input type="checkbox" class="i-checks" value="<?php echo $this->_tpl_vars['roles'][$this->_sections['vv']['index']]['id']; ?>
" name="id[]"></td>
                                    <td><?php echo $this->_tpl_vars['roles'][$this->_sections['vv']['index']]['id']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['roles'][$this->_sections['vv']['index']]['rolename']; ?>
</td>
                                    <td class="center">
										<div class="btn-group">
                                            <a href="javascript:void(0)" class="btn btn-white btn-sm rolesEdit" data-id="<?php echo $this->_tpl_vars['roles'][$this->_sections['vv']['index']]['id']; ?>
"><i class="fa fa-pencil"></i> 编辑</a>
                                            <a href="javascript:void(0)" class="btn btn-white btn-sm roleDel" data-id="<?php echo $this->_tpl_vars['roles'][$this->_sections['vv']['index']]['id']; ?>
"><i class="fa fa-times"></i> 删除</a>
                                        </div>
									</td>
                                </tr>
								<?php endfor; endif; ?>
								<?php else: ?>
								<tr><td colspan="3" style="text-align: center; font-size: 16px;">没有任何角色,请添加</td></tr>
								<?php endif; ?>
                                </tbody>
                            </table>
							</form>
							<div class="tooltip-demo">
								<button class="btn btn-white btn-sm" data-toggle="modal" data-target="#myModal5" data-toggle="tooltip" data-placement="left" title="" data-original-title="添加角色"><i class="fa fa-plus"></i> 添加</button>
								<button class="btn btn-white btn-sm info_del_all" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="删除角色"><i class="fa fa-trash-o"></i> </button>
								<ul class="pagination pull-right"></ul>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tplHome'])."/System/public/footer.tpl.php", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

     </div>
    </div>
	<div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg">
        	<div class="modal-content">
            	<div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">添加角色</h4>
                </div>
                <div class="modal-body clearfix">
					<form id="employersForm" class="form" action="?m=User&c=system&a=rolesAdd" method="post">
						<div class="col-lg-12">
							<div class="ibox">
                        		<div class="ibox-title">
                           			<h5>角色</h5>
                        		</div>
                        		<div class="ibox-content">
                            		<div class="form-group">
										<label><span class="mustInput">*</span>角色名称:<span class="f999">(20字以内)</span></label>
										<input type="text"  id="rolename" placeholder="请输入角色名称" name="rolename" class="form-control required" aria-required="true">
									</div>
                        		</div>
                    		</div>
						</div>
						<div class="col-lg-12">
							<div class="ibox">
                    	    	<div class="ibox-title">
                    	       		<h5>权限设置</h5>
                    	    	</div>
                    	    	<div class="ibox-content">
                    	        	<div id="permission_list">
										<?php unset($this->_sections['vv']);
$this->_sections['vv']['name'] = 'vv';
$this->_sections['vv']['loop'] = is_array($_loop=$this->_tpl_vars['authority']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['vv']['show'] = true;
$this->_sections['vv']['max'] = $this->_sections['vv']['loop'];
$this->_sections['vv']['step'] = 1;
$this->_sections['vv']['start'] = $this->_sections['vv']['step'] > 0 ? 0 : $this->_sections['vv']['loop']-1;
if ($this->_sections['vv']['show']) {
    $this->_sections['vv']['total'] = $this->_sections['vv']['loop'];
    if ($this->_sections['vv']['total'] == 0)
        $this->_sections['vv']['show'] = false;
} else
    $this->_sections['vv']['total'] = 0;
if ($this->_sections['vv']['show']):

            for ($this->_sections['vv']['index'] = $this->_sections['vv']['start'], $this->_sections['vv']['iteration'] = 1;
                 $this->_sections['vv']['iteration'] <= $this->_sections['vv']['total'];
                 $this->_sections['vv']['index'] += $this->_sections['vv']['step'], $this->_sections['vv']['iteration']++):
$this->_sections['vv']['rownum'] = $this->_sections['vv']['iteration'];
$this->_sections['vv']['index_prev'] = $this->_sections['vv']['index'] - $this->_sections['vv']['step'];
$this->_sections['vv']['index_next'] = $this->_sections['vv']['index'] + $this->_sections['vv']['step'];
$this->_sections['vv']['first']      = ($this->_sections['vv']['iteration'] == 1);
$this->_sections['vv']['last']       = ($this->_sections['vv']['iteration'] == $this->_sections['vv']['total']);
?>
											<div class="part_item">
												<div class="part_item_t">
													<p><b><input type="checkbox" class="checkAll"><?php echo $this->_tpl_vars['authority'][$this->_sections['vv']['index']]['Des']; ?>
</b></p>
												</div>
												<div class="part_item_b">
													<?php unset($this->_sections['kk']);
$this->_sections['kk']['name'] = 'kk';
$this->_sections['kk']['loop'] = is_array($_loop=$this->_tpl_vars['authority'][$this->_sections['vv']['index']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['kk']['show'] = true;
$this->_sections['kk']['max'] = $this->_sections['kk']['loop'];
$this->_sections['kk']['step'] = 1;
$this->_sections['kk']['start'] = $this->_sections['kk']['step'] > 0 ? 0 : $this->_sections['kk']['loop']-1;
if ($this->_sections['kk']['show']) {
    $this->_sections['kk']['total'] = $this->_sections['kk']['loop'];
    if ($this->_sections['kk']['total'] == 0)
        $this->_sections['kk']['show'] = false;
} else
    $this->_sections['kk']['total'] = 0;
if ($this->_sections['kk']['show']):

            for ($this->_sections['kk']['index'] = $this->_sections['kk']['start'], $this->_sections['kk']['iteration'] = 1;
                 $this->_sections['kk']['iteration'] <= $this->_sections['kk']['total'];
                 $this->_sections['kk']['index'] += $this->_sections['kk']['step'], $this->_sections['kk']['iteration']++):
$this->_sections['kk']['rownum'] = $this->_sections['kk']['iteration'];
$this->_sections['kk']['index_prev'] = $this->_sections['kk']['index'] - $this->_sections['kk']['step'];
$this->_sections['kk']['index_next'] = $this->_sections['kk']['index'] + $this->_sections['kk']['step'];
$this->_sections['kk']['first']      = ($this->_sections['kk']['iteration'] == 1);
$this->_sections['kk']['last']       = ($this->_sections['kk']['iteration'] == $this->_sections['kk']['total']);
?>
														<p><input type="checkbox" name="authority[]" value="'Merchants/User/<?php echo $this->_tpl_vars['vv']; ?>
/'.$kk"><?php echo $this->_tpl_vars['authority'][$this->_sections['vv']['index']][$this->_sections['kk']['index']]; ?>
</p>
													<?php endfor; endif; ?>
												</div>
											</div>
										<?php endfor; endif; ?>
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
                    <h4 class="modal-title">角色编辑</h4>
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
              <iframe width="425" height="349" src="?m=User&c=system&a=rolesEdit&id={($id)}" frameborder="0"></iframe>
        </figure>
	</script>

    <!-- FooTable -->
    <script src="<?php echo @RlStaticResource; ?>
plugins/js/footable/footable.all.min.js"></script>

	<!-- iCheck -->
    <script src="<?php echo @RlStaticResource; ?>
plugins/js/iCheck/icheck.min.js"></script>

	<!-- Jquery Validate -->
    <script src="<?php echo @RlStaticResource; ?>
plugins/js/validate/jquery.validate.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
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
					c.selectall('id[]','check_box');
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
				b('#employersForm').validate({
                    errorPlacement: function (error, element){
                            element.before(error);
                    },
                    rules: {
                        confirm: {
                            equalTo: "#password"
                        },
						account: {
							minlength: 4
						},
						password: {
							minlength: 4
						}
                    }
                });
				b('.formSubmit').click(function(){
					if(b('#account').val() != ''){
						$.post('?m=User&c=system&a=checkAccount',{rolename:b('#rolename').val()},function(re){
							if(re.status == 0){
								b('#rolename').addClass('error');
								swal("错误", re.msg+" :)", "error");
							}else if(re.status == 1){
								b('#employersForm').submit();
							}
						},'json');
					}else{
						b('#employersForm').submit();
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
				b('.roleDel').click(function(){
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
						$.post('?m=User&c=system&a=roleDel',{id:c.attr('data-id')},function(re){
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
				b('.rolesEdit').click(function(){
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
						swal("错误", "你至少需要选中一项 :)", "error");
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