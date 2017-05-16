<?php

bpBase::loadAppClass('common', 'PosPi', 0);
use JPush\Client as JPush;

class api_controller extends common_controller
{
    private $cashier;

    public function __construct()
    {
        parent::__construct();
        $this->cashier = M('cashier_coin');

    }

    final function SyncTime()
    {
        echo json_encode(date('Y-m-d H:i:s', time()));
    }

    final function SyncCashier()
    {
        echo json_encode($this->cashier->select(array('Isdel' => 'N')));
    }

    final function SyncOrder()
    {

        if (IS_POST) {
            //$data=$this->clear_html($_POST['value']);
            $data = str_replace(array("\\", "'"), array("", "\""), htmlspecialchars_decode($_POST['value']));
            file_put_contents('123.txt', $data);
            $data = json_decode($data, true);
            $valueStr = '';
            if (!is_array($data)) {
                echo '参数有问题！';
                return;
            }
            $map = array();
            foreach ($data as $key => $value) {
                if (M('card_record')->get_one(array('sid' => $value['Sid'], 'OrderNo' => $value['XPH'], 'cardNo' => $value['CardNo']))) {
                    unset($data[$key]);
                    continue;
                }
                if ($data) {
                    switch ($value['Type']) {
                        case 1:
                            $value['Type'] = 'C';
                            break;
                        case 0:
                            $value['Type'] = 'TK';
                            break;
                    }
                    //C:餐卡 X:现金，W:微信，Z:支付宝，Y:银行卡，L:礼品券，T:团购，R:人工修正，O:Other',
                    switch ($value['PayType']) {
                        case 0:
                            $value['PayType'] = 'X';
                            break;
                        case 1:
                            $value['PayType'] = 'W';
                            break;
                        case 2:
                            $value['PayType'] = 'Z';
                            break;
                        case 3:
                            $value['PayType'] = 'Y';
                            break;
                        case 4:
                            $value['PayType'] = 'L';
                            break;
                        case 5:
                            $value['PayType'] = 'T';
                            break;
                        case 6:
                            $value['PayType'] = 'R';
                            break;
                        default:
                            $value['PayType'] = 'O';
                            break;

                    }
                    $value['UpLoadTime_Time'] = date('Y-m-d H:i:s', time());
                    if ($value['Type'] == 'TK') {
                        $value['receivableAmount'] = $value['ShiShou'];
                    } else $value['receivableAmount'] = $value['ShiShou'] - $value['ZhaoLin'];


//                    $valueStr .= "(";
//                    foreach ($value as $v) {
//                        $valueStr .= "'" . $v . "'";
//                        $valueStr .= ',';
//                    }
//                    $valueStr = rtrim($valueStr, ',');
//                    $valueStr .= "),";
                }
                $map[] = array(
                    'sid' => $value['Sid'],
                    'cardNo' => $value['CardNo'],
                    'saleType' => $value['Type'],
                    'cardNowAmount' => $value['Amount'],
                    'cardOldAmount' => $value['LastAmount'],
                    'changeAmount' => $value['Change'],
                    'OrderTime_Time' => $value['CreateTime'],
                    'deviceNo' => $value['SYJ'],
                    'SYYId' => $value['SYY'],
                    'OrderNo' => $value['XPH'],
                    'cardMortgage' => $value['YJ'],
                    'flag' => $value['Status'],
                    'paidInAmount' => $value['ShiShou'],
                    'giveChangeAmount' => $value['ZhaoLin'],
                    'payType' => $value['PayType'],
                    'onlinePayInfo' => $value['onlinePayInfo'],
                    'cardUid' => $value['cardUid'],
                    'UpLoadTime_Time' => date('Y-m-d H:i:s', time()),
                    'receivableAmount' => $value['Change']
                );
            }
            if ($map) {
                //$insertSql = "INSERT into `pospi_card_record`(sid,cardNo,saleType,cardNowAmount,cardOldAmount,changeAmount,OrderTime_Time,deviceNo,SYYId,OrderNo,cardMortgage,flag,paidInAmount,giveChangeAmount,payType,onlinePayInfo,cardUid,UpLoadTime_Time,receivableAmount) values" . $valueStr;

                //$insertSql = rtrim($insertSql, ',');
                $flag = false;
                foreach ($map as $k => $v) {
                    if (!M('card_record')->insert($v)) $flag = true;
                }
                $this->handCardinfo($map);
                $this->handRechargeReport($map);
                //$res = $insert->selectBySql($insertSql);
                if ($flag) {
                    echo 0;
                }
            }
            echo 1;
        }
    }

    private function handCardinfo($data)
    {
        if ($data && is_array($data)) {
            foreach ($data as $k => $v) {
                $map = array(
                    'cardUid' => $v['cardUid'],
                    'cardType' => 0,
                    'shop' => '默认',
                    'cardStatus' => $v['saleType'] == "TK" ? "T" : "Y",
                    'lastChangeAmount' => $v['changeAmount'],
                    'lastChangeTime' => $v['OrderTime_Time'],
                    'enableTime' => $v['OrderTime_Time'],
                    'createTime' => date('Y-m-d H:i:s', time()),
                );
                $info = M('card_info')->get_one(array('cardNo' => $v['cardNo']));
                $CARDRESAVE = loadConfig('db');
                $yajin = $CARDRESAVE['default']['CARDRESAVE'];
                if ($info && $info['cardMortgageAmount_Sys'] == $yajin) {
                    $map['cardTotalAmount_Sys'] = $info['cardTotalAmount_Sys'] + $v['changeAmount'];
                    $map['cardAmount_Sys'] = $map['cardTotalAmount_Sys'] - $yajin;
                    $map['cardMortgageAmount_Sys'] = $yajin;
                    M('card_info')->update($map, 'cardNo=' . $v['cardNo']);
                } else if ($info && $info['cardMortgageAmount_Sys'] == 0) {
                    $map['cardTotalAmount_Sys'] = $v['changeAmount'];
                    $map['cardAmount_Sys'] = $map['cardTotalAmount_Sys'] - $yajin;
                    $map['cardMortgageAmount_Sys'] = $yajin;
                    M('card_info')->update($map, 'cardNo=' . $v['cardNo']);
                } else {
                    $map['cardNo'] = $v['cardNo'];
                    $map['cardTotalAmount_Sys'] = $v['changeAmount'];
                    $map['cardAmount_Sys'] = $map['cardTotalAmount_Sys'] - $yajin;
                    $map['cardMortgageAmount_Sys'] = $yajin;
                    M('card_info')->insert($map);
                }
            }
            return true;
        }
    }

    private function handRechargeReport($data)
    {
        if ($data && is_array($data)) {
            foreach ($data as $k => $v) {
                $date = substr($v['OrderTime_Time'], 0, 10);
                $hour = substr($v['OrderTime_Time'], 11, 13);
                switch ($v['saleType']) {
                    case 'C':
                        //日销售报表
                        $merchant_day = M('report_recharge_day')->get_one(array('date' => $date, 'posNo' => $v['deviceNo'], 'rechargeType' => 'C'));
                        $map = array(
                            'date' => $date,
                            'posNo' => $v['deviceNo'],
                            'rechargeType' => 'C',
                            'createTime' => date('Y-m-d H:i:s', time()),
                        );
                        $map['totalAmount'] = $merchant_day['totalAmount'] + $v['receivableAmount'];
                        switch ($v['payType']) {
                            case "C":
                                $map['cardAmount'] = $merchant_day['cardAmount'] + $v['receivableAmount'];
                                break;
                            case "X":
                                $map['cashAmount'] = $merchant_day['cashAmount'] + $v['receivableAmount'];
                                break;
                            case "W":
                                $map['weChatAmount'] = $merchant_day['weChatAmount'] + $v['receivableAmount'];
                                break;
                            case "Z":
                                $map['aliPayAmount'] = $merchant_day['aliPayAmount'] + $v['receivableAmount'];
                                break;
                            case "Y":
                                $map['bankCardAmount'] = $merchant_day['bankCardAmount'] + $v['receivableAmount'];
                                break;
                            case "L":
                                $map['giftAmount'] = $merchant_day['giftAmount'] + $v['receivableAmount'];
                                break;
                            case "T":
                                $map['tuanAmount'] = $merchant_day['tuanAmount'] + $v['receivableAmount'];
                                break;
                            default:
                            case "R":
                            case "O":
                                $map['otherAmount'] = $merchant_day['otherAmount'] + $v['receivableAmount'];
                                break;
                        }
                        if (isset($merchant_day['id'])) {
                            M('report_recharge_day')->update($map, "id={$merchant_day['id']}");
                        } else M('report_recharge_day')->insert($map);
                        //时报表
                        $merchant_hour = M('report_recharge_hour')->get_one(array('date' => $date, 'posNo' => $v['deviceNo'], 'hour' => $hour, 'rechargeType' => 'C'));
                        $map1 = array(
                            'date' => $date,
                            'hour' => $hour,
                            'posNo' => $v['deviceNo'],
                            'rechargeType' => 'C',
                            'createTime' => date('Y-m-d H:i:s', time()),
                        );
                        $map1['totalAmount'] = $merchant_hour['totalAmount'] + $v['receivableAmount'];
                        switch ($v['payType']) {
                            case "C":
                                $map1['cardAmount'] = $merchant_hour['cardAmount'] + $v['receivableAmount'];
                                break;
                            case "X":
                                $map1['cashAmount'] = $merchant_hour['cashAmount'] + $v['receivableAmount'];
                                break;
                            case "W":
                                $map1['weChatAmount'] = $merchant_hour['weChatAmount'] + $v['receivableAmount'];
                                break;
                            case "Z":
                                $map1['aliPayAmount'] = $merchant_hour['aliPayAmount'] + $v['receivableAmount'];
                                break;
                            case "Y":
                                $map1['bankCardAmount'] = $merchant_hour['bankCardAmount'] + $v['receivableAmount'];
                                break;
                            case "L":
                                $map1['giftAmount'] = $merchant_hour['giftAmount'] + $v['receivableAmount'];
                                break;
                            case "T":
                                $map1['tuanAmount'] = $merchant_hour['tuanAmount'] + $v['receivableAmount'];
                                break;
                            default:
                            case "R":
                            case "O":
                                $map1['otherAmount'] = $merchant_hour['otherAmount'] + $v['receivableAmount'];
                                break;
                        }
                        if (isset($merchant_hour['id'])) {
                            M('report_recharge_hour')->update($map1, "id={$merchant_hour['id']}");
                        } else M('report_recharge_hour')->insert($map1);
                        break;
                    case 'TK':
                        //日销售报表
                        $merchant_day = M('report_recharge_day')->get_one(array('date' => $date, 'posNo' => $v['deviceNo'], 'rechargeType' => 'C'));
                        $map = array(
                            'date' => $date,
                            'posNo' => $v['deviceNo'],
                            'rechargeType' => 'T',
                            'createTime' => date('Y-m-d H:i:s', time()),
                        );
                        $map['totalAmount'] = $merchant_day['totalAmount'] - $v['receivableAmount'];
                        switch ($v['payType']) {
                            case "C":
                                $map['cardAmount'] = $merchant_day['cardAmount'] - $v['receivableAmount'];
                                break;
                            case "X":
                                $map['cashAmount'] = $merchant_day['cashAmount'] - $v['receivableAmount'];
                                break;
                            case "W":
                                $map['weChatAmount'] = $merchant_day['weChatAmount'] - $v['receivableAmount'];
                                break;
                            case "Z":
                                $map['aliPayAmount'] = $merchant_day['aliPayAmount'] - $v['receivableAmount'];
                                break;
                            case "Y":
                                $map['bankCardAmount'] = $merchant_day['bankCardAmount'] - $v['receivableAmount'];
                                break;
                            case "L":
                                $map['giftAmount'] = $merchant_day['giftAmount'] - $v['receivableAmount'];
                                break;
                            case "T":
                                $map['tuanAmount'] = $merchant_day['tuanAmount'] - $v['receivableAmount'];
                                break;
                            default:
                            case "R":
                            case "O":
                                $map['otherAmount'] = $merchant_day['otherAmount'] - $v['receivableAmount'];
                                break;
                        }
                        if (isset($merchant_day['id'])) {
                            M('report_recharge_day')->update($map, "id={$merchant_day['id']}");
                        } else M('report_recharge_day')->insert($map);
                        //时报表
                        $merchant_hour = M('report_recharge_hour')->get_one(array('date' => $date, 'posNo' => $v['deviceNo'], 'hour' => $hour, 'rechargeType' => 'C'));
                        $map1 = array(
                            'date' => $date,
                            'hour' => $hour,
                            'posNo' => $v['deviceNo'],
                            'rechargeType' => 'T',
                            'createTime' => date('Y-m-d H:i:s', time()),
                        );
                        $map1['totalAmount'] = $merchant_hour['totalAmount'] - $v['receivableAmount'];
                        switch ($v['payType']) {
                            case "C":
                                $map1['cardAmount'] = $merchant_hour['cardAmount'] - $v['receivableAmount'];
                                break;
                            case "X":
                                $map1['cashAmount'] = $merchant_hour['cashAmount'] - $v['receivableAmount'];
                                break;
                            case "W":
                                $map1['weChatAmount'] = $merchant_hour['weChatAmount'] - $v['receivableAmount'];
                                break;
                            case "Z":
                                $map1['aliPayAmount'] = $merchant_hour['aliPayAmount'] - $v['receivableAmount'];
                                break;
                            case "Y":
                                $map1['bankCardAmount'] = $merchant_hour['bankCardAmount'] - $v['receivableAmount'];
                                break;
                            case "L":
                                $map1['giftAmount'] = $merchant_hour['giftAmount'] - $v['receivableAmount'];
                                break;
                            case "T":
                                $map1['tuanAmount'] = $merchant_hour['tuanAmount'] - $v['receivableAmount'];
                                break;
                            default:
                            case "R":
                            case "O":
                                $map1['otherAmount'] = $merchant_hour['otherAmount'] - $v['receivableAmount'];
                                break;
                        }
                        if (isset($merchant_hour['id'])) {
                            M('report_recharge_hour')->update($map1, "id={$merchant_hour['id']}");
                        } else M('report_recharge_hour')->insert($map1);
                        break;
                }
            }
            return true;
        }
    }

    final function FreezeCardUrl()
    {
        echo "http://192.168.1.10:8881/";
    }

    final function FreezeCardSea()
    {
        $cardNo = $this->clear_html($_POST);
        $cardNo['IsDel'] = 0;
        $res = M('card_freeze')->get_one($cardNo);
        if ($res) {
            echo 1;
        } else echo 0;
    }

    final function SendMail()
    {
        bpBase::loadOrg('phpmailer');
        $config = loadConfig('mail');
        $data = $_POST;
        try {
            $mail = new PHPMailer(true);
            $mail->IsSMTP();
            $mail->CharSet = 'UTF-8';   //设置字符集
            $mail->SMTPAuth = true;
            $mail->Port = 25;
            $mail->Host = "smtp.qq.com";     //指定smtp服务器
            //   $mail->Username   = "13667153286@163.com";    //你的smtp账号
            //  $mail->Password   = "yuyesu1990";    //你的smtp密码
            $mail->Username = $config['username'];    //你的smtp账号
            $mail->Password = $config['password']; //你的smtp密码

            $mail->From = $config['nickmail'];//自定义发送邮箱,接收者显示的发件邮箱
            $mail->FromName = $config['nickname'];      //自定义发送人,接收者显示的发件人

            $to = $data['to'];   //要发送的邮箱地址
            $mail->AddAddress($to);

            $mail->Subject = $data['subject'];
            $filename = time();
            barcode($data['no'], $filename);
            //$mail->AddEmbeddedImage(__FILE__.'/../123.jpg',$id,'attachment','base64','image/jpeg');
            $data['body'] .= '<br><img src="data:image/jpeg;base64,' . base64_encode(file_get_contents(ABS_PATH . 'pigcms_static/img/' . $filename . '.png')) . '" />';
            // $str=base64_encode(__FILE__.'/../123.jpg');debug($str);
//
//            $image_file = __FILE__.'/../123.jpg';
//            $image_info = getimagesize($image_file);
//            $base64_image_content = "data:".$image_info['mime'].";base64,".chunk_split(base64_encode(file_get_contents($image_file)));
//            $data['body'] .= '<img src="'.$base64_image_content.'"/>';

            $mail->Body = stripslashes(htmlspecialchars_decode(nl2br($data['body'])));
            // $mail->AddAttachment(__FILE__.'/../123.jpg');


            //stripslashes($data['body']);
            $mail->IsHTML(true);       //是否设置为html 可自己修改
            //$this->mail->AltBody ="text/html";
            //debug($mail);
            $mail->Send();
            ajaxReturn('ok', '发送成功:)', 1);
        } catch (phpmailerException $e) {
            echo $e->errorMessage();
            //ajaxReturn('fail','发送失败！',0);
        }
    }


    //极光推送接口

    final function jspush()
    {
        bpBase::loadOrg('jspush');
        $conf = loadConfig('jspush');
        $client = new JPush($conf['app_key'], $conf['master_secret']);

        //发送普通通知
        $push_payload = $client->push()
            ->setPlatform('all')
            ->addAllAudience()
            ->setNotificationAlert('Hi, JPush');
        try {
            $response = $push_payload->send();
            print_r($response);
        } catch (\JPush\Exceptions\APIConnectionException $e) {
            // try something here
            print $e;
        } catch (\JPush\Exceptions\APIRequestException $e) {
            // try something here
            print $e;
        }

        /*
                // 创建定时任务
                $payload = $client->push()
                    ->setPlatform("all")
                    ->addAllAudience()
                    ->setNotificationAlert("Hi, 这是一条定时发送的消息11")
                    ->build();
                try {
                    // $schedule->createSingleSchedule($name, $push_payload, $trigger)
                    //$schedule->createPeriodicalSchedule($name, $push_payload, $trigger)
                    //参数说明:
                    // name:String 定时任务的名称
                    //push_payload: PushPayload Push的构建对象，通过Push模块的build()方法获得
                    //trigger: Array 触发器对象
                    $response = $client->schedule()->createPeriodicalSchedule("123", $payload,
                        array(
                            "start" => "2016-08-29 17:00:00",
                            "end" => "2016-12-25 17:00:00",
                            "time" => "17:24:00", //发送时间
                            "time_unit" => "DAY",
                            "frequency" => 1
                        ));
                    $data = $client->schedule()->getSchedules();
                } catch (\JPush\Exceptions\APIConnectionException $e) {
                    // try something here
                    print $e;
                } catch (\JPush\Exceptions\APIRequestException $e) {
                    // try something here
                    print $e;
                }
        */

    }

    //
    final public function callPro()
    {
        $model = new model();
        $model->selectBySql('call StartProcCardAmount');
    }

}

?>