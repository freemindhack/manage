card_status.tpl.php<!DOCTYPE html>
<html>
<head>
	<title>卡管理 | 卡状态管理</title>
	{pg:include file="$tplHome/System/public/header.tpl.php"}
	<link href="<?php echo PIGCMS_TPL_STATIC_PATH;?>css/cashier.css" rel="stylesheet">
	<link href="<?php echo $this->RlStaticResource;?>plugins/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">
	<link href="<?php echo $this->RlStaticResource;?>plugins/css/iCheck/custom.css" rel="stylesheet">
	<link href="<?php echo  RL_PIGCMS_STATIC_PATH;?>plugins/css/footable/footable.core.css" rel="stylesheet">
	<style>
		.ibox-title h5 {
			margin: 10px 0 0px;
		}
		select.input-sm {
			height: 35px;
			line-height: 35px;
		}
		.float-e-margins .btn-info{
			margin-bottom:0px;
			padding:3px;
		}
		.fa-paste{
			margin-right:7px;
			padding: 0px;
		}
		.dz-preview{
			display:none;
		}
		.ibox-title ul{ list-style: outside none none !important; margin: 0; padding: 0;}
		.ibox-title li { float: left;width: 30%; }
		#commonpage {float: right;margin-bottom: 10px;}
		#table-list-body .btn-st{background-color: #337ab7;border-color: #2e6da4;cursor:auto;}
		#select_Cardtype .i-checks label{cursor: pointer;}
		#ewmPopDiv .modal-body{text-align: center;}
		.modal-footer {text-align: center;}
		.modal-footer .btn {padding: 7px 30px;}
	</style>
	<script src="<?php echo $this->RlStaticResource;?>plugins/js/footable/footable.all2.min.js"></script>
</head>

<body>
<div id="wrapper">
	{pg:include file="$tplHome/System/public/leftmenu.tpl.php"}
	<div id="page-wrapper" class="gray-bg">
		{pg:include file="$tplHome/System/public/top.tpl.php"}
		<div class="row wrapper border-bottom white-bg page-heading">
			<div class="col-lg-10">
				<h2>会员列表</h2>
			</div>
			<div class="col-lg-2">

			</div>
		</div>
		<div class="wrapper wrapper-content animated fadeInRight">
			<div class="row">
				<div class="col-lg-12">
					<div class="ibox-content">
						<label><span style="">卡状态查询:</span></label>
						<form class="form-search form-inline" action="?m=User&c=card&a=card_freeze" method="post">
							<input class="input-medium search-query" type="text" style="height:auto" placeholder="请输入卡号" name="cardNo"/>
							<button type="submit" class="btn search-query" style="margin-bottom: 20px">查找</button>
						</form>
					</div>
					<div class="ibox float-e-margins">
						<div class="ibox-content">
							<div class="app__content js-app-main page-cashier">
								<div>
									<!-- 实时交易信息展示区域 -->
									<div class="cashier-realtime">
										<div class="realtime-title-block clearfix">
											<h1 class="realtime-title">冻结信息</h1>
										</div>
									</div>
									<div class="js-real-time-region realtime-list-box loading">
										<div class="widget-list">
											<div class="js-list-filter-region clearfix ui-box" style="position: relative;">
												<div class="widget-list-filter"></div>
											</div>
											<div class="ui-box">
												<table class="ui-table ui-table-list" data-page-size="20" style="padding: 0px;">
													<thead class="js-list-header-region tableFloatingHeaderOriginal">
													<tr class="widget-list-header">
														<th data-hide="phone">卡号</th>
														<th data-hide="phone">冻结说明</th>
														<th data-hide="phone">冻结人员</th>
														<th data-hide="phone">冻结时间</th>
														<th data-hide="phone">操作</th>
													</tr>
													</thead>
													<tbody class="js-list-body-region" id="table-list-body">
													<?php if(!empty($data)){
														foreach($data as $rvv){
															?>
															<tr class="widget-list-item">
																<td><?php echo $rvv['CardNo'];?></td>
																<td><?php echo $rvv['Note'];?></td>
																<td><?php echo $rvv['bywho'];?></td>
																<td><?php echo $rvv['CreateTime'];?></td>
																<td class="footable-last-column">
																	<a href="?m=User&c=card&a=freeze&CardNo=<?php echo $rvv['CardNo'];?>"><button   class="btn btn-sm btn-primary"><strong>解冻</strong></button></a>
																</td>
															</tr>
														<?php }}else{?>
														<tr class="widget-list-item"><td colspan="12"></td></tr>
													<?php }?>
													</tbody>
												</table>
												<div class="js-list-empty-region"></div>
											</div>
											<div class="js-list-footer-region ui-box">
												<div class="widget-list-footer"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php echo $pagebar;?>
			</div>
		</div>
		{pg:include file="$tplHome/System/public/footer.tpl.php"}
	</div>
</div>
</body>
<!-- iCheck -->
<script src="<?php echo $this->RlStaticResource;?>plugins/js/iCheck/icheck.min.js"></script>
<!--<script>-->
<!--    $(document).ready(function(){-->
<!--        if ($(this).width() < 769) {-->
<!--            $('.float-e-margins .ibox-title').hide();-->
<!--        } else {-->
<!--            $('.float-e-margins .ibox-title').show();-->
<!---->
<!--        }-->
<!--        $('.ui-table-list').footable();-->
<!--        $('#select_Cardtype .i-checks').iCheck({-->
<!--            checkboxClass: 'icheckbox_square-green',-->
<!--            radioClass: 'iradio_square-green',-->
<!--        });-->
<!--        $("#pop_add_card").click(function(){-->
<!--            window.location.href="?m=User&c=wxCoupon&a=card";-->
<!--        });-->
<!--    });-->
<!---->
<!--    /*****删除处理******/-->
<!--    function deltheOrder(id){-->
<!--            $.ajax({-->
<!--                url: "?m=User&c=vip&a=vipedit",-->
<!--                type: "POST",-->
<!--                dataType: "json",-->
<!--                data:{cdid:id},-->
<!--                success: function(res){-->
<!--                    if(!res.error){-->
<!--                        swal({-->
<!--                            title: "删除成功",-->
<!--                            text: res.msg,-->
<!--                            type: "success"-->
<!--                        }, function () {-->
<!--                            $(dom).parent().parent('tr').remove();-->
<!--                        });-->
<!---->
<!--                    }else{-->
<!--                        swal({-->
<!--                            title: "删除失败",-->
<!--                            text: res.msg,-->
<!--                            type: "error"-->
<!--                        }, function () {-->
<!--                            //window.location.reload();-->
<!--                        });-->
<!--                    }-->
<!---->
<!--                    /*setTimeout(function(){-->
<!--                     window.location.reload();-->
<!--                     }, 1000);*/-->
<!--                }-->
<!--            });-->
<!---->
<!--    }-->
<!--</script>-->

</html>