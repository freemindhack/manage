
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>商户管理 | 商户列表</title>

    <link href="<?php echo $this->RlStaticResource;?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $this->RlStaticResource;?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- FooTable -->
    <link href="<?php echo  RL_PIGCMS_STATIC_PATH;?>plugins/css/footable/footable.core.css" rel="stylesheet">
	<link href="<?php echo $this->RlStaticResource;?>plugins/css/iCheck/custom.css" rel="stylesheet">
	<!-- Sweet Alert -->
    <link href="<?php echo $this->RlStaticResource;?>plugins/css/sweetalert/sweetalert.css" rel="stylesheet">

    <link href="<?php echo PIGCMS_TPL_STATIC_PATH;?>css/animate.css" rel="stylesheet">
    <link href="<?php echo PIGCMS_TPL_STATIC_PATH;?>css/style.css" rel="stylesheet">
	<link href="<?php echo PIGCMS_TPL_STATIC_PATH;?>css/app.css" rel="stylesheet">
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
	</style>
</head>

<body>

    <div id="wrapper">
        <div class="gray-bg">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
				<form id="shopForm" class="form" action="?m=User&c=shop&a=shopAppemd" method="post">
				<input type="hidden" name="id" value="<?php echo $shop['id'];?>">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
							<div class="form-group">
								<label><span class="mustInput">*</span>商户名称:<span class="f999">(20字以内)</span></label>
								<input type="text" id="shopname" placeholder="请输入商户名称" name="shopname" value="<?php echo $shop['shopname'];?>" class="form-control required" aria-required="true">
							</div>
							<div class="form-group">
								<label><span class="mustInput">*</span>联系人:</label>
								<input type="text" id="Contacts" placeholder="请输入联系人" name="Contacts" value="<?php echo $shop['Contacts'];?>" class="form-control required" aria-required="true">
							</div>
							<div class="form-group">
								<label><span class="mustInput">*</span>联系电话:</label>
								<input type="text" id="tel" placeholder="请输入联系电话" name="tel" value="<?php echo $shop['tel'];?>" class="form-control required" aria-required="true">
							</div>
							<div class="form-group">
								<label><span class="mustInput">*</span>户名:</label>
								<input type="text" id="bank_account" placeholder="请输入户名" name="bank_account" value="<?php echo $shop['bank_account'];?>" class="form-control required" aria-required="true">
							</div>
							<div class="form-group">
								<label><span class="mustInput">*</span>开户行:</label>
								<input type="text" id="bank" placeholder="请输入开户行" name="bank" value="<?php echo $shop['bank'];?>" class="form-control required" aria-required="true">
							</div>
							<div class="form-group">
								<label><span class="mustInput">*</span>银行卡号:</label>
								<input type="text" id="card_num" placeholder="请输入银行卡号" name="card_num"  value="<?php echo $shop['card_num'];?>" class="form-control required" aria-required="true">
							</div>
                        </div>
                    </div>
                </div>
				<div class="col-lg-12">
               	 	<button type="submit" class="btn btn-primary pull-right">保存</button>
           		</div>
				</form>
            </div>
        </div>
     </div>
    </div>
    <!-- Mainly scripts -->
    <script src="<?php echo $this->RlStaticResource;?>js/jquery-2.1.1.js"></script>
    <script src="<?php echo $this->RlStaticResource;?>bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo $this->RlStaticResource;?>plugins/js/pace/pace.min.js"></script>

	<!-- iCheck -->
    <script src="<?php echo $this->RlStaticResource;?>plugins/js/iCheck/icheck.min.js"></script>

	<!-- Sweet alert -->
    <script src="<?php echo $this->RlStaticResource;?>plugins/js/sweetalert/sweetalert.min.js"></script>

	<!-- Jquery Validate -->
    <script src="<?php echo $this->RlStaticResource;?>plugins/js/validate/jquery.validate.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
			employers.init();
        });
		!function(a,b){
			var employers = employers || {};
			employers.init = function(){
				var c = employers;
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
						tel: {
							minlength: 11,
							maxlength: 11
						}
                    }
                });
			};
			a.employers = employers;
		}(window,jQuery);
    </script>
</body>
</html>