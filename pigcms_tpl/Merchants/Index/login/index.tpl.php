<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <meta name="format-detection" content="telephone=no">

    <title>smartERP</title>

    <link href="<?php echo $this->RlStaticResource; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $this->RlStaticResource; ?>font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo $this->RlStaticResource; ?>plugins/css/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css"
          rel="stylesheet">
    <link href="<?php echo PIGCMS_TPL_STATIC_PATH; ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo PIGCMS_TPL_STATIC_PATH; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo PIGCMS_TPL_STATIC_PATH; ?>css/login.css" rel="stylesheet">
    <style>
        .loginback2 {
            margin: 10px;
        }

        .addBg2 {
            width: 22%;
            height: 42%;
            border-radius: 25px;
            background-image: url(<?php echo PIGCMS_TPL_STATIC_PATH;?>images/login/dl.png);
            no-repeat;
            background-size: cover;
            position: fixed;
            margin: auto;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
        }
        .hehe {
            border-radius: 10px;
            text-align: center;
        }
    </style>
</head>

<body class="gray-bg"
      style="background-size: 100% 100%;background-image: url(<?php echo PIGCMS_TPL_STATIC_PATH; ?>images/login/beijin.png);">
<div class="addBg2">
    <!--    <div class="123">-->
    <!--        <img  src="--><?php //echo PIGCMS_TPL_STATIC_PATH;?><!--images/login/back.jpg">-->
    <!--    </div>-->
    <div class="loginback2">
        <div>
            <form class="m-t text-center" role="form" id="form" method="post" action="?m=Index&c=login&a=signin">
                <div class="form-group"><span style="font-size: 50px;" align="center">smart</span><strong
                            style="color: #f33112;font-size: 55px">ERP</strong></div>
                <div class="form-group" style="padding:5px  20px">
                    <input type="test" name="username" class="form-control hehe" placeholder="账号" required="">
                </div>
                <div class="form-group" style="padding:5px  20px">
                    <input type="password" name="password" class="form-control hehe" placeholder="密码" required="">
                </div>
                <!--				<div class="form-group">-->
                <!--                    <div class="radio radio-info radio-inline">-->
                <!--						<input type="radio" value="merchant" name="type" -->
                <?php //if(!($ltyp>0)){echo 'checked="checked"';}?><!-- id="inlineRadio1">-->
                <!--						<label for="inlineRadio1"> 登录</label>-->
                <!--					</div>-->
                <!--					<div class="radio radio-inline">-->
                <!--                        <input type="radio" value="employee" name="type" -->
                <?php //if($ltyp>0){echo 'checked="checked"';}?><!-- id="inlineRadio2">-->
                <!--                        <label for="inlineRadio2"> 员工登录</label>-->
                <!--                    </div>-->
                <!--                </div>-->

                <div class="form-group" style="padding:5px  20px"><button type="submit" class="btn btn-primary block full-width m-b hehe" style="background-color:#107997;opacity:0.75">登录</button></div>

        <!--<a href="#"><small>忘记密码?</small></a>
                <p class="text-muted text-center"><small>没有账号?</small></p>-->
            </form>
            <p class="m-t" style="text-align: center;font-size: 16px">
                <small>Copyright：<?php echo str_replace('http://', '', $_SERVER['HTTP_HOST']) ?>
                    &copy; <?php echo date('Y'); ?></small>
            </p>
        </div>
    </div>
</div>
<!-- Mainly scripts -->
<script src="<?php echo $this->RlStaticResource; ?>js/jquery-2.1.1.js"></script>
<script src="<?php echo $this->RlStaticResource; ?>bootstrap/js/bootstrap.min.js"></script>

<!-- Jquery Validate -->
<script src="<?php echo $this->RlStaticResource; ?>plugins/js/validate/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {
        $("#form").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 4
                },
                username: {
                    required: true,
                    minlength: 2
                }
            }
        });
    });
</script>
</body>

</html>
