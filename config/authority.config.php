<?php
/**
 * 2015-08-11 Brooke
 * 用户权限控制
 * @param 第一列为项目名称 大小写不限制，为了美观最好大写
 * @return Array
 */
return array(
    'Merchants' => array(
        'User' => array(
            'system' => array(
                'employers' => '角色管理',
                'Des' => '系统管理'
            ),
            'card' => array(
                'card_class' => '卡类别管理',
                'card_status' => '卡状态管理',
                'card_Onlinestatus' => '卡状态管理(在线)',
                'card_liushui' => '卡流水管理',
                'card_Onlineliushui' => '卡状态管理(在线)',
                'Des' => '卡管理'
            ),
            'shop' => array(
                'manageShop' => '商户管理',
                'Des' => '商户管理'
            ),
            'ht' => array(
                'ht' => '合同录入',
                'htmange' => '合同管理',
                'Des' => '商户管理'
            ),
            'Clearing' => array(
                'define' => '添加费用项目',
                'copy' => '费用录入',
                'modi' => '已录入费用修改',
                'Des' => '结算管理'
            ),
            'qita' => array(
                'qtlr' => '其他销售额管理',
                'Des' => '结算管理 '
            ),
            'print' => array(
                'shops' => '商家收银明细打印',
                'Onlineshops' => '商家收银(在线)明细打印',
                'wdg' => '商家水电燃气打印',
                'notice' => '结算单打印',
                'Des' => '报表'
            ),
            'report' => array(
                'report_qindan' => '交易清单查询',
                'report_tongji' => '商户日销售统计',
                'report_Onlinetongji' => '商户日销售统计（在线）',
                'report_congzhi' => '充值退卡日统计',
                'report_Onlinecongzhi' => '充值退卡日统计（在线）',
                'Des' => '报表'
            ),
//            'Cashier' => array(
//                'Index' => '收银台首页',
//                'PayRecord' => '收款记录',
//                'EwmRecord' => '二维码生成记录',
//                'Odetail' => '订单详情',
//                'DelOrderByid' => '订单删除',
//                'WxRefund' => '退款',
//                'payment' => '刷卡支付页',
//                'wxSmRefund' => '扫码退款处理',
//                'Des' => '收银台设置'
//            ),
            'Merchant' => array(
                'Employers' => '员工列表',
                'EmployersAdd' => '添加员工',
                'EmployersAppemd' => '编辑员工',
                'Field' => '修改员工登陆状态',
                'EmployersDel|EmployersDelAll' => '删除员工',
                'employersEdit' => '编辑',
                'Des' => '商家设置'
            ),
            'Des' => '用户界面操作',
        )
    )
);
?>