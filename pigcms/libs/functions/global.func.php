<?php

function isMobile($p)
{
    if (preg_match("/^1[0-9]{2}[0-9]{8}$/", $p)) {
        return true;
    } else {
        return false;
    }
}

// 检测QQ
function isQQ($qq)
{
    if (preg_match('/^[1-9][0-9]{4,20}$/', $qq)) {
        return true;
    } else {
        return false;
    }
}

function isIP($ip)
{
    if (preg_match('/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/', $ip)) {
        return true;
    } else {
        return false;
    }
}

function isDomain($domain)
{
    if (preg_match('/^[a-z0-9.\-]{1,50}$/', trim($domain))) {
        return true;
    }
    return false;
}

function isAjax()
{
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        if ('xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH']))
            return true;
    }
    return false;
}

function convertToMobile($str)
{
    $str = str_replace(array('width="', 'height="', '<a', '</a>', '.jpg" style="'), array('owidth="', '"', '<span', '</span>', '.jpg" ostyle="'), $str);
    return $str;
}

function toCacheClearUrl($parms)
{
    if ($parms) {
        $parmStr = '?';
        $comma = '';
        foreach ($parms as $k => $v) {
            $parmStr .= $comma . $k . '=' . $v;
            $comma = '&';
        }
    }
    header('Location:cachesAction.php' . $parmStr);
}

function format_bracket($text)
{
    $text = str_replace('<', '&lt;', $text);
    $text = str_replace('>', '&gt;', $text);
    return $text;
}

/**
 * 对字段两边加反引号，以保证数据库安全
 * @param $value 数组值
 */
function add_special_char(&$value)
{
    if ('*' == $value || false !== strpos($value, '(') || false !== strpos($value, '.') || false !== strpos($value, '`')) {
        //不处理包含* 或者 使用了sql方法。
    } else {
        $value = '`' . trim($value) . '`';
    }
    return $value;
}

/**
 * 对字段值两边加引号，以保证数据库安全
 * @param $value 数组值
 * @param $key 数组key
 * @param $quotation
 */
function escape_string(&$value, $key = '', $quotation = 1)
{
    if ($quotation) {
        $q = '\'';
    } else {
        $q = '';
    }
    $value = $q . $value . $q;
    return $value;
}

function uploadPhotoErrors()
{
    return array(-1 => '你上传的不是图片', -2 => '文件不能超过2M', -3 => '图片地址不正确');
}

function escape($str)
{
    preg_match_all("/[\x80-\xff].|[\x01-\x7f]+/", $str, $r);
    $ar = $r[0];
    foreach ($ar as $k => $v) {
        if (ord($v[0]) < 128)
            $ar[$k] = rawurlencode($v);
        else
            $ar[$k] = "%u" . bin2hex(iconv("GB2312", "UCS-2", $v));
    }
    return join("", $ar);
}

function loadExtension($functionName, $parms = '')
{
    $extensionClassName = 'extension_' . SUB_SKIN;
    $extension = bpBase::loadAppClass($extensionClassName, ROUTE_MODEL);
    if ($extension) {
        $extension->$functionName($parms);
    } else {
        return false;
    }
}

function isMp($mobile)
{
    return preg_match('/^13[0-9]{9}$|^15[0-9]{9}$|^18[0-9]{9}$/', $mobile);
}

function clearHtmlTagA(&$body, $allow_urls = array())
{
    $host_rule = join('|', $allow_urls);
    $host_rule = preg_replace("#[\n\r]#", '', $host_rule);
    $host_rule = str_replace('.', "\\.", $host_rule);
    $host_rule = str_replace('/', "\\/", $host_rule);
    $arr = '';
    preg_match_all("#<a([^>]*)>(.*)<\/a>#iU", $body, $arr);
    if (is_array($arr[0])) {
        $rparr = array();
        $tgarr = array();
        foreach ($arr[0] as $i => $v) {
            if ($host_rule != '' && preg_match('#' . $host_rule . '#i', $arr[1][$i])) {
                continue;
            } else {
                $rparr[] = $v;
                $tgarr[] = $arr[2][$i];
            }
        }
        if (!empty($rparr)) {
            $body = str_replace($rparr, $tgarr, $body);
        }
    }
    $arr = $rparr = $tgarr = '';
    return $body;
}

function createUploadFolders($time, $sitedir = '')
{
    $year = date('Y', $time);
    $month = date('m', $time);
    $day = date('d', $time);
    if (!strlen($sitedir)) {
        $siteAbsPath = ABS_PATH;
    } else {
        $siteAbsPath = ABS_PATH . $sitedir;
        if (!file_exists($siteAbsPath) && !is_dir($siteAbsPath)) {
            mkdir($siteAbsPath, 0777);
        }
    }
    $yearFolder = $siteAbsPath . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $year;
    $monthFolder = $siteAbsPath . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR . $month;
    $dayFolder = $siteAbsPath . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR . $month . DIRECTORY_SEPARATOR . $day;
    if (!file_exists($siteAbsPath . DIRECTORY_SEPARATOR . 'upload') && !is_dir($siteAbsPath . DIRECTORY_SEPARATOR . 'upload')) {
        mkdir($siteAbsPath . DIRECTORY_SEPARATOR . 'upload', 0777);
    }
    if (!file_exists($siteAbsPath . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'images') && !is_dir($siteAbsPath . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'images')) {
        mkdir($siteAbsPath . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'images', 0777);
    }
    if (!file_exists($yearFolder) && !is_dir($yearFolder)) {
        mkdir($yearFolder, 0777);
    }
    if (!file_exists($monthFolder) && !is_dir($monthFolder)) {
        mkdir($monthFolder, 0777);
    }
    if (!file_exists($dayFolder) && !is_dir($dayFolder)) {
        mkdir($dayFolder, 0777);
    }
    return $dayFolder;
}

/**
 * 语言文件
 *
 * @param    string $language 标示符
 * @param    array $pars 转义的数组,二维数组 ,'key1'=>'value1','key2'=>'value2',
 */
function L($language = 'no_language', $pars = array(), $modules = '')
{
    static $LANG = array();
    static $LANG_MODULES = array();
    static $lang = 'zh-cn';
    if (!$LANG) {
        require_once ABS_PATH . MANAGE_DIR . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR . 'system.lang.php';
        if (file_exists(ABS_PATH . MANAGE_DIR . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR . ROUTE_M . '.lang.php'))
            require ABS_PATH . MANAGE_DIR . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR . ROUTE_M . '.lang.php';
    }
    if (!empty($modules)) {
        $modules = explode(',', $modules);
        foreach ($modules AS $m) {
            if (!isset($LANG_MODULES[$m]))
                require ABS_PATH . MANAGE_DIR . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR . $m . '.lang.php';
        }
    }
    if (!array_key_exists($language, $LANG)) {
        return $language;
    } else {
        $language = $LANG[$language];
        if ($pars) {
            foreach ($pars AS $_k => $_v) {
                $language = str_replace('{' . $_k . '}', $_v, $language);
            }
        }
        return $language;
    }
}

/**
 *  global.func.php 公共函数库
 */

/**
 * 将二维数组转换为对象数组
 *
 * @param unknown_type $array
 */
function array2Objects($array)
{
    $objs = array();
    if ($array) {
        $i = 0;
        foreach ($array as $a) {
            foreach ($a as $k => $v) {
                $objs[$i]->$k = $v;
            }
            $i++;
        }
    }
    return $objs;
}

/**
 * addslashes
 * @param $string
 * @return mixed
 */
function bpAddslashes($string, $type = '')
{
    if (!is_array($string)) {
        if ($type == 'get') {
            $string = str_replace(array("'", '"', '<', '>', '(', ')', '?'), "", $string);
        }
        return htmlspecialchars(addslashes($string));
    }
    foreach ($string as $key => $val)
        $string[$key] = bpAddslashes($val, $type);
    return $string;
}

/**
 * stripslashes
 * @param $string
 * @return mixed
 */
function bpStripslashes($string)
{
    if (!is_array($string))
        return stripslashes($string);
    foreach ($string as $key => $val)
        $string[$key] = bpStripslashes($val);
    return $string;
}

function toPassword($pw, $salt)
{
    $password = md5($pw);
    $password = md5($password . $salt);
    return $password;
}

/**
 * htmlspecialchars
 * @param $obj
 * @return mixed
 */
function bpHtmlSpecialChars($string)
{
    if (!is_array($string))
        return htmlspecialchars($string, ENT_COMPAT, 'GB2312');
    foreach ($string as $key => $val)
        $string[$key] = bpHtmlSpecialChars($val);
    return $string;
}

/**
 * 安全过滤
 *
 * @param $string
 * @return string
 */
function bpSafeReplace($string)
{
    $string = str_replace('%20', '', $string);
    $string = str_replace('%27', '', $string);
    $string = str_replace('%2527', '', $string);
    $string = str_replace('*', '', $string);
    $string = str_replace('"', '&quot;', $string);
    $string = str_replace("'", '', $string);
    $string = str_replace('"', '', $string);
    $string = str_replace(';', '', $string);
    $string = str_replace('<', '&lt;', $string);
    $string = str_replace('>', '&gt;', $string);
    $string = str_replace("{", '', $string);
    $string = str_replace('}', '', $string);
    $string = str_replace('\\', '', $string);
    return $string;
}

/**
 * 格式化textarea内容
 *
 * @param $string textarea内容
 * @return string
 */
function formatTextarea($string)
{
    $string = nl2br(str_replace(' ', '&nbsp;', $string));
    return $string;
}

/**
 * 将文本格式成适合js输出的string
 * @param string $string
 * @param intval $isj
 * @return string
 */
function formatJs($string, $isjs = 1)
{
    $string = addslashes(str_replace(array("\r", "\n", "\t"), array('', '', ''), $string));
    return $isjs ? 'document.write("' . $string . '");' : $string;
}

/**
 * 获取请求ip
 *
 * @return ip地址
 */
function ip()
{
    if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $ip = getenv('REMOTE_ADDR');
    } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $ip = preg_match('/[\d\.]{7,15}/', $ip, $matches) ? $matches [0] : '';
    if (strExists($ip, '192.168.')) {
        $ip = get_real_ip();
    }
    return $ip;
}

function get_real_ip()
{
    $ip = false;
    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
        if ($ip) {
            array_unshift($ips, $ip);
            $ip = FALSE;
        }
        for ($i = 0; $i < count($ips); $i++) {
            if (!eregi("^(10|172\.16|192\.168)\.", $ips[$i])) {
                $ip = $ips[$i];
                break;
            }
        }
    }
    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}

function getCostTime()
{
    $microtime = microtime(TRUE);
    return $microtime - SYS_START_TIME;
}

/**
 * 程序执行时间
 *
 * @return    int    单位毫秒
 */
function executeTime()
{
    $stime = explode(' ', SYS_START_TIME);
    $etime = explode(' ', microtime());
    return number_format(($etime [1] + $etime [0] - $stime [1] - $stime [0]), 6);
}

/**
 * 查询string是否存在于某字符串
 *
 * @param $haystack
 * @param $needle
 * @return bool
 */
function strExists($haystack, $needle)
{
    return !(strpos($haystack, $needle) === FALSE);
}

/**
 * get文件扩展
 *
 * @param $filename 文件名
 * @return 扩展名
 */
function fileExt($filename)
{
    return strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
}

/**
 * 判断email格式是否正确
 * @param $email
 */
function isEmail($email)
{
    return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}

/**
 * iconv 编辑转换
 */
if (!function_exists('iconv')) {

    function iconv($in_charset, $out_charset, $str)
    {
        $in_charset = strtoupper($in_charset);
        $out_charset = strtoupper($out_charset);
        if (function_exists('mb_convert_encoding')) {
            return mb_convert_encoding($str, $out_charset, $in_charset);
        } else {
            bpBase::loadSysFunc('iconv');
            $in_charset = strtoupper($in_charset);
            $out_charset = strtoupper($out_charset);
            if ($in_charset == 'UTF-8' && ($out_charset == 'GBK' || $out_charset == 'GB2312')) {
                return utf8_to_gbk($str);
            }
            if (($in_charset == 'GBK' || $in_charset == 'GB2312') && $out_charset == 'UTF-8') {
                return gbk_to_utf8($str);
            }
            return $str;
        }
    }

}

/**
 * 是否是IE
 */
function isIe()
{
    $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
    if ((strpos($useragent, 'opera') !== false) || (strpos($useragent, 'konqueror') !== false))
        return false;
    if (strpos($useragent, 'msie ') !== false)
        return true;
    return false;
}

/**
 * 生成随机字符串
 * @param string $lenth 长度
 * @return string 字符串
 */
function createRandomstr($lenth = 6)
{
    $str = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
    $return = '';
    for ($i = 1; $i <= 6; $i++) {
        $num = mt_rand(0, 58);
        $return .= $str[$num];
    }
    return $return;
}

function getmicrotime()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

/**
 *
 * 获取远程内容
 * @param $url 接口url地址
 * @param $timeout 超时时间
 */
function bpFileGetContents($url, $timeout = 30)
{
    $stream = stream_context_create(array('http' => array('timeout' => $timeout)));
    return @file_get_contents($url, 0, $stream);
}

/**
 * 生成sql语句，如果传入$in_cloumn 生成格式为 IN('a', 'b', 'c')
 * @param $data 条件数组或者字符串
 * @param $front 连接符
 * @param $in_column 字段名称
 * @return string
 */
function to_sqls($data, $front = ' AND ', $in_column = false)
{
    if ($in_column && is_array($data)) {
        $ids = '\'' . implode('\',\'', $data) . '\'';
        $sql = "$in_column IN ($ids)";
        return $sql;
    } else {
        if ($front == '') {
            $front = ' AND ';
        }
        if (is_array($data) && count($data) > 0) {
            $sql = '';
            foreach ($data as $key => $val) {
                $sql .= $sql ? " $front `$key` = '$val' " : " `$key` = '$val' ";
            }
            return $sql;
        } else {
            return $data;
        }
    }
}

/**
 * 加载配置文件
 * @param string $file 配置文件
 * @param string $key 要获取的配置荐
 * @param string $default 默认配置。当获取配置项目失败时该值发生作用。
 * @param boolean $reload 强制重新加载。
 */
function loadConfig($file, $key = '', $default = '', $reload = false)
{
    static $configs = array();
    if (!$reload && isset($configs[$file])) {
        if (empty($key)) {
            return $configs[$file];
        } elseif (isset($configs[$file][$key])) {
            return $configs[$file][$key];
        } else {
            return $default;
        }
    }
    $path = ABS_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . $file . '.config.php';
    if (file_exists($path)) {
        $configs[$file] = include $path;
    }
    if (empty($key)) {
        return $configs[$file];
    } elseif (isset($configs[$file][$key])) {
        return $configs[$file][$key];
    } else {
        return $default;
    }
}

/*
 *  public functions which may be used by expes classes
 */

function to_safe($string)
{
    $string = trim($string);
    $string = str_replace(chr(10), '', $string);
    $string = str_replace(chr(13), '', $string);
    return $string;
}

function validEmail($email)
{
    $regex = '/^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+[a-zA-Z]{2,7}$/i';
    if (!preg_match($regex, $email)) {
        return false;
    } else {
        //list($username,$domain)=split("@",$email);
        //if (function_exists('getmxrr')&&getmxrr($domain,$mxhosts)){
        //return true;
        //}elseif (@fsockopen($domain,25,$errno,$errstr,5)){
        //return true;
        //}else {
        return true;
        //}
    }
}

function format_to_html($text)
{
    $text = str_replace('t', '\n', $text);
    $text = str_replace('\r', '', $text);
    $text = str_replace('\t', '', $text);
    $text = str_replace('\0', '', $text);
    $text = str_replace('\x0B', '', $text);
    $text = str_replace(' ', '&nbsp;', $text);
    return $text;
}

function getFirstSecondOfTheDay($timeStamp)
{
    $timeStamp = intval($timeStamp);
    $month = date('m', $timeStamp);
    $day = date('d', $timeStamp);
    $year = date('Y', $timeStamp);
    return mktime(0, 0, 0, $month, $day, $year);
}

function remove_html_tag($str)
{  //清除HTML代码、空格、回车换行符
    //trim 去掉字串两端的空格
    //strip_tags 删除HTML元素
    $str = trim($str);
    $str = @preg_replace('/<script[^>]*?>(.*?)<\/script>/si', '', $str);
    $str = @preg_replace('/<style[^>]*?>(.*?)<\/style>/si', '', $str);
    $str = @strip_tags($str, "");
    $str = @ereg_replace("\t", "", $str);
    $str = @ereg_replace("\r\n", "", $str);
    $str = @ereg_replace("\r", "", $str);
    $str = @ereg_replace("\n", "", $str);
    $str = @ereg_replace(" ", "", $str);
    $str = @ereg_replace("&nbsp;", "", $str);

    return trim($str);
}

function remove_h_tag($text)
{
    $p[0] = '/(<\/h([0-9]+)>)/i';
    $p[1] = '/(<h([0-9]+)>)/i';
    $r[0] = '';
    $r[1] = '';
    $text = preg_replace($p, $r, $text);
    return $text;
}

function deldir($dir)
{
    $dh = opendir($dir);
    while ($file = readdir($dh)) {
        if ($file != "." && $file != "..") {
            $fullpath = $dir . "/" . $file;
            if (!is_dir($fullpath)) {
                unlink($fullpath);
            } else {
                deldir($fullpath);
            }
        }
    }
    closedir($dh);
    if (rmdir($dir)) {
        return true;
    } else {
        return false;
    }
}

function array2sort($a, $sort, $d = '')
{
    $num = count($a);
    if (!$d) {
        for ($i = 0; $i < $num; $i++) {
            for ($j = 0; $j < $num - 1; $j++) {
                if ($a[$j][$sort] > $a[$j + 1][$sort]) {
                    foreach ($a[$j] as $key => $temp) {
                        $t = $a[$j + 1][$key];
                        $a[$j + 1][$key] = $a[$j][$key];
                        $a[$j][$key] = $t;
                    }
                }
            }
        }
    } else {
        for ($i = 0; $i < $num; $i++) {
            for ($j = 0; $j < $num - 1; $j++) {
                if ($a[$j][$sort] < $a[$j + 1][$sort]) {
                    foreach ($a[$j] as $key => $temp) {
                        $t = $a[$j + 1][$key];
                        $a[$j + 1][$key] = $a[$j][$key];
                        $a[$j][$key] = $t;
                    }
                }
            }
        }
    }
    return $a;
}

function sortObjects($a, $keyName, $d = '')
{
    $num = count($a);
    if (!$d) {
        for ($i = 0; $i < $num; $i++) {
            for ($j = 0; $j < $num - 1; $j++) {
                if ($a[$j]->$keyName > $a[$j + 1]->$keyName) {
                    $t = $a[$j + 1];
                    $a[$j + 1] = $a[$j];
                    $a[$j] = $t;
                }
            }
        }
    } else {
        for ($i = 0; $i < $num; $i++) {
            for ($j = 0; $j < $num - 1; $j++) {
                if ($a[$j]->$keyName < $a[$j + 1]->$keyName) {
                    $t = $a[$j + 1];
                    $a[$j + 1] = $a[$j];
                    $a[$j] = $t;
                }
            }
        }
    }
    return $a;
}

function sort2DArray($ArrayData, $KeyName1, $SortOrder1 = "SORT_ASC", $SortType1 = "SORT_REGULAR")
{
    if (!is_array($ArrayData)) {
        return $ArrayData;
    }

    // Get args number.
    $ArgCount = func_num_args();

    // Get keys to sort by and put them to SortRule array.
    for ($I = 1; $I < $ArgCount; $I++) {
        $Arg = func_get_arg($I);
        if (!@eregi("SORT", $Arg)) {
            $KeyNameList[] = $Arg;
            $SortRule[] = '$' . $Arg;
        } else {
            $SortRule[] = $Arg;
        }
    }

    // Get the values according to the keys and put them to array.
    foreach ($ArrayData AS $Key => $Info) {
        foreach ($KeyNameList AS $KeyName) {
            ${$KeyName}[$Key] = $Info[$KeyName];
        }
    }

    // Create the eval string and eval it.
    $EvalString = 'array_multisort(' . join(",", $SortRule) . ',$ArrayData);';
    eval($EvalString);
    return $ArrayData;
}

if (!function_exists('randStr')) {

    function randStr($randLength, $hasnum = false)
    {
        $randLength = intval($randLength);
        $chars = 'ABCDEFGHJKLMNPQRTUVWXYZabcdefghjkmnpqrstuvwxyz';
        if ($hasnum) $chars = $chars . '0123456789A';
        $len = strlen($chars);
        $randStr = '';
        for ($i = 0; $i < $randLength; $i++) {
            $randStr .= $chars[rand(0, $len - 1)];
        }
        return $randStr;
    }

}

class runtime
{

    var $StartTime = 0;
    var $StopTime = 0;

    function get_microtime()
    {
        list($usec, $sec) = explode(' ', microtime());
        return ((float)$usec + (float)$sec);
    }

    function start()
    {
        $this->StartTime = $this->get_microtime();
    }

    function stop()
    {
        $this->StopTime = $this->get_microtime();
    }

    function spent()
    {
        return round(($this->StopTime - $this->StartTime) * 1000, 1);
    }

}

function createFolderByPath($path)
{
    //create directory
    $folders = explode(DIRECTORY_SEPARATOR, $path);
    $foldersCount = count($folders);
    $relatePath = ABS_PATH;
    for ($i = 1; $i < $foldersCount; $i++) {
        $relatePath .= DIRECTORY_SEPARATOR . $folders[$i];
        if (!file_exists($relatePath) && !is_dir($relatePath)) {
            mkdir($relatePath, 0777);
        }
    }
}

function getPageCount($total, $pageSize)
{
    if ($pageSize) {
        return intval($total / $pageSize) + 1;
    } else {
        return 1;
    }
}

function httpCopy($url, $file = "", $timeout = 15)
{
    $getMethod = loadConfig('system', 'fileGetMethod');
    $getMethod = $getMethod ? $getMethod : 'file_get_contents';
    $file = empty($file) ? pathinfo($url, PATHINFO_BASENAME) : $file;
    $dir = pathinfo($file, PATHINFO_DIRNAME);
    !is_dir($dir) && @mkdir($dir, 0755, true);
    $url = str_replace(" ", "%20", $url);

    if ($getMethod == 'curl' && function_exists('curl_init') && !is_null(curl_init())) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $url); //伪装
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $temp = curl_exec($ch);
        if (@file_put_contents($file, $temp) && !curl_error($ch)) {
            return $file;
        } else {
            return false;
        }
    } else {
        if ($getMethod == 'file_get_contents') {
            //伪装
            $urlInfo = parse_url($url);
            $option = array(
                'http' => array(
                    'header' => "referer:" . $urlInfo['scheme'] . "://" . $urlInfo['host'])
            );
            $context = stream_context_create($option);
            //
            $get_file = file_get_contents($url, false, $context);
            $fp = @fopen($file, "w");
            @fwrite($fp, $get_file);
            fclose($fp); //完工
        } else {
            getImg($url, $file);
        }
    }
}

/*
 * @ 完整的图片地址
 * @ 要存储的文件名
 */

function getImg($url = "", $filename = "")
{
    if (is_dir(basename($filename))) {
        echo "The Dir was not exits";
        Return false;
    }
    //去除URL连接上面可能的引号
    $url = preg_replace('/(?:^[\'"]+|[\'"\/]+$)/', '', $url);
    if (!extension_loaded('sockets'))
        return false;
    //获取url各相关信息
    preg_match('/http:\/\/([^\/\:]+(\:\d{1,5})?)(.*)/i', $url, $matches);
    if (!$matches)
        return false;
    $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if (!@socket_connect($sock, $matches[1], $matches[2] ? substr($matches[2], 1) : 80)) {
        return false;
    }
    //图片的相对地址
    $msg = 'GET ' . $matches[3] . " HTTP/1.1\r\n";
    //主机名称
    $msg .= 'Host: ' . $matches[1] . "\r\n";
    $msg .= 'Connection: Close' . "\r\n\r\n";
    socket_write($sock, $msg);
    $bin = '';
    while ($tmp = socket_read($sock, 10)) {
        $bin .= $tmp;
        $tmp = '';
    }
    $bin = explode("\r\n\r\n", $bin);
    $img = $bin[1];
    $h = fopen($filename, 'wb');
    $res = fwrite($h, $img) === false ? false : true;
    @socket_close($sock);
    Return $res;
}

function upFileFolders($time, $type = 'images', $sitedir = '')
{
    $year = date('Y', $time);
    $month = date('m', $time);
    $day = date('d', $time);
    if (!strlen($sitedir)) {
        $siteAbsPath = ABS_PATH;
    } else {
        $siteAbsPath = ABS_PATH . $sitedir . DIRECTORY_SEPARATOR;
        if (!file_exists($siteAbsPath) && !is_dir($siteAbsPath)) {
            mkdir($siteAbsPath, 0777);
        }
    }
    $yearFolder = $siteAbsPath . 'upload' . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $year;
    $monthFolder = $yearFolder . DIRECTORY_SEPARATOR . $month;
    $dayFolder = $monthFolder . DIRECTORY_SEPARATOR . $day;
    if (!file_exists($siteAbsPath . 'upload') && !is_dir($siteAbsPath . 'upload')) {
        mkdir($siteAbsPath . 'upload', 0777);
    }
    if (!file_exists($siteAbsPath . 'upload' . DIRECTORY_SEPARATOR . $type) && !is_dir($siteAbsPath . 'upload' . DIRECTORY_SEPARATOR . $type)) {
        mkdir($siteAbsPath . 'upload' . DIRECTORY_SEPARATOR . $type, 0777);
    }
    if (!file_exists($yearFolder) && !is_dir($yearFolder)) {
        mkdir($yearFolder, 0777);
    }
    if (!file_exists($monthFolder) && !is_dir($monthFolder)) {
        mkdir($monthFolder, 0777);
    }
    if (!file_exists($dayFolder) && !is_dir($dayFolder)) {
        mkdir($dayFolder, 0777);
    }
    return array('path' => $dayFolder . DIRECTORY_SEPARATOR, 'url' => '/upload/' . $type . '/' . $year . '/' . $month . '/' . $day . '/');
}

function getSessionStorageType()
{
    $loadSessionStorageType = loadConfig('system', 'session_storage');
    $sessionStorageType = $loadSessionStorageType;
    $session_storage = 'session_' . $sessionStorageType;
    return $session_storage;
}

/**
 * 获取timestamp
 *
 * @param unknown_type $date 2011-02-08
 * @param unknown_type $last 是否获取该天的最后一秒
 * @return unknown
 */
function getTimeStamp($date, $last = 0)
{
    $dates = explode('-', $date);
    if ($last) {
        return mktime(23, 59, 59, intval($dates[1]), intval($dates[2]), intval($dates[0]));
    } else {
        return mktime(0, 0, 0, intval($dates[1]), intval($dates[2]), intval($dates[0]));
    }
}

//正值表达式比对解析$_SERVER['HTTP_USER_AGENT']中的字符串 获取访问用户的浏览器的信息
function getBrowser($Agent)
{
    $browseragent = "";   //浏览器
    $browserversion = ""; //浏览器的版本
    if (@ereg('MSIE ([0-9].[0-9]{1,2})', $Agent, $version)) {
        $browserversion = $version[1];
        $browseragent = "Internet Explorer";
    } else if (@ereg('Opera/([0-9]{1,2}.[0-9]{1,2})', $Agent, $version)) {
        $browserversion = $version[1];
        $browseragent = "Opera";
    } else if (@ereg('Firefox/([0-9.]{1,5})', $Agent, $version)) {
        $browserversion = $version[1];
        $browseragent = "Firefox";
    } else if (@ereg('Chrome/([0-9.]{1,3})', $Agent, $version)) {
        $browserversion = $version[1];
        $browseragent = "Chrome";
    } else if (@ereg('Safari/([0-9.]{1,3})', $Agent, $version)) {
        $browseragent = "Safari";
        $browserversion = "";
    } else {
        $browserversion = "";
        $browseragent = "Unknown";
    }
    return $browseragent . " " . $browserversion;
}

// 同理获取访问用户的浏览器的信息
function getPlatform($Agent)
{
    $browserplatform = '';
    if (@eregi('win', $Agent) && strpos($Agent, '95')) {
        $browserplatform = "Windows 95";
    } elseif (@eregi('win 9x', $Agent) && strpos($Agent, '4.90')) {
        $browserplatform = "Windows ME";
    } elseif (@eregi('win', $Agent) && @ereg('98', $Agent)) {
        $browserplatform = "Windows 98";
    } elseif (@eregi('win', $Agent) && @eregi('nt 5.0', $Agent)) {
        $browserplatform = "Windows 2000";
    } elseif (@eregi('win', $Agent) && @eregi('nt 5.1', $Agent)) {
        $browserplatform = "Windows XP";
    } elseif (@eregi('win', $Agent) && @eregi('nt 6.0', $Agent)) {
        $browserplatform = "Windows Vista";
    } elseif (@eregi('win', $Agent) && @eregi('nt 6.1', $Agent)) {
        $browserplatform = "Windows 7";
    } elseif (@eregi('win', $Agent) && @ereg('32', $Agent)) {
        $browserplatform = "Windows 32";
    } elseif (@eregi('win', $Agent) && @eregi('nt', $Agent)) {
        $browserplatform = "Windows NT";
    } elseif (@eregi('Mac OS', $Agent)) {
        $browserplatform = "Mac OS";
    } elseif (@eregi('linux', $Agent)) {
        $browserplatform = "Linux";
    } elseif (@eregi('unix', $Agent)) {
        $browserplatform = "Unix";
    } elseif (@eregi('sun', $Agent) && @eregi('os', $Agent)) {
        $browserplatform = "SunOS";
    } elseif (@eregi('ibm', $Agent) && @eregi('os', $Agent)) {
        $browserplatform = "IBM OS/2";
    } elseif (@eregi('Mac', $Agent) && @eregi('PC', $Agent)) {
        $browserplatform = "Macintosh";
    } elseif (@eregi('PowerPC', $Agent)) {
        $browserplatform = "PowerPC";
    } elseif (@eregi('AIX', $Agent)) {
        $browserplatform = "AIX";
    } elseif (@eregi('HPUX', $Agent)) {
        $browserplatform = "HPUX";
    } elseif (@eregi('NetBSD', $Agent)) {
        $browserplatform = "NetBSD";
    } elseif (@eregi('BSD', $Agent)) {
        $browserplatform = "BSD";
    } elseif (@ereg('OSF1', $Agent)) {
        $browserplatform = "OSF1";
    } elseif (@ereg('IRIX', $Agent)) {
        $browserplatform = "IRIX";
    } elseif (@eregi('FreeBSD', $Agent)) {
        $browserplatform = "FreeBSD";
    }
    if ($browserplatform == '') {
        $browserplatform = "Unknown";
    }
    return $browserplatform;
}

/**
 * 写入缓存，默认为文件缓存，不加载缓存配置。
 * @param $name 缓存名称
 * @param $data 缓存数据
 * @param $filepath 数据路径（模块名称） caches/cache_$filepath/
 * @param $type 缓存类型[file,memcache,apc]
 * @param $config 配置名称
 * @param $timeout 过期时间
 */
function setCache($name, $data, $filepath = '', $timeout = 0)
{
    bpBase::loadSysClass('cache_factory', '', 0);
    $cacheconfig = loadConfig('cache');
    $cache = cache_factory::get_instance($cacheconfig)->load($cacheconfig['type']);
    return $cache->set($name, $data, $timeout, '', $filepath);
}

/**
 * 写入缓存，默认为文件缓存，不加载缓存配置。
 * @param $name 缓存名称
 * @param $data 缓存数据
 * @param $filepath 数据路径（模块名称） caches/cache_$filepath/
 * @param $type 缓存类型[file,memcache,apc]
 * @param $config 配置名称
 * @param $timeout 过期时间
 */
function setZendCache($data, $name, $filepath = '', $timeout = 0)
{
    bpBase::loadSysClass('cache_factory', '', 0);
    $cacheconfig = loadConfig('cache');
    $cache = cache_factory::get_instance($cacheconfig)->load($cacheconfig['type']);
    return $cache->set($name, $data, $timeout, '', $filepath);
}

/**
 * 读取缓存，默认为文件缓存，不加载缓存配置。
 * @param string $name 缓存名称
 * @param $filepath 数据路径（模块名称） caches/cache_$filepath/
 * @param string $config 配置名称
 */
function getCache($name, $filepath = '')
{
    bpBase::loadSysClass('cache_factory', '', 0);
    $cacheconfig = loadConfig('cache');
    $cache = cache_factory::get_instance($cacheconfig)->load($cacheconfig['type']);
    return $cache->get($name, '', '', $filepath);
}

/**
 * 删除缓存，默认为文件缓存，不加载缓存配置。
 * @param $name 缓存名称
 * @param $filepath 数据路径（模块名称） caches/cache_$filepath/
 * @param $type 缓存类型[file,memcache,apc]
 * @param $config 配置名称
 */
function delCache($name, $filepath = '')
{
    bpBase::loadSysClass('cache_factory', '', 0);
    $cacheconfig = loadConfig('cache');
    $cache = cache_factory::get_instance($cacheconfig)->load($cacheconfig['type']);
    return $cache->delete($name, '', '', $filepath);
}

function delCacheByMid($mid = 0)
{
    bpBase::loadSysClass('cache_factory', '', 0);
    $cacheconfig = loadConfig('cache');
    $cache = cache_factory::get_instance($cacheconfig)->load($cacheconfig['type']);
    $name = array('wx_' . $mid . '_user', 'configData_' . $mid, 'Cache_access_token_' . $mid);
    return $cache->delete($name, '', '', '');
}

/**
 * 读取缓存，默认为文件缓存，不加载缓存配置。
 * @param string $name 缓存名称
 * @param $filepath 数据路径（模块名称） caches/cache_$filepath/
 * @param string $config 配置名称
 */
function getCacheInfo($name, $filepath = '')
{
    bpBase::loadSysClass('cache_factory', '', 0);
    $cacheconfig = loadConfig('cache');
    $cache = cache_factory::get_instance($cacheconfig)->load($cacheconfig['type']);
    return $cache->cacheinfo($name, '', '', $filepath);
}

/**
 * 返回经addslashes处理过的字符串或数组
 * @param $string 需要处理的字符串或数组
 * @return mixed
 */
function new_addslashes($string)
{
    if (!is_array($string))
        return addslashes($string);
    foreach ($string as $key => $val)
        $string[$key] = new_addslashes($val);
    return $string;
}

/**
 * 将对象数组转为按照指定key的数组
 *
 * @param objects $objects
 * @param string $key
 * @return array
 */
function objectsToArrByKey($objects, $key = 'id')
{
    $arr = array();
    if ($objects) {
        foreach ($objects as $o) {
            foreach ($o as $k => $v) {
                $arr[$o->$key][$k] = $v;
            }
        }
    }
    return $arr;
}

/**
 * 将数组转为按照指定key的数组
 *
 * @param objects $objects
 * @param string $key
 * @return array
 */
function arrToArrByKey($array, $key = 'id')
{
    $arr = array();
    if ($array) {
        foreach ($array as $o) {
            $arr[$o[$key]] = $o;
        }
    }
    return $arr;
}

function recurse_copy($src, $dst)
{  // 原目录，复制到的目录
    $dir = opendir($src);
    @mkdir($dst);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                recurse_copy($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}

/**
 * 加密和解密函数
 *
 * <code>
 * // 加密用户ID和用户名
 * $auth = authcode("{$uid}\t{$username}", 'ENCODE');
 * // 解密用户ID和用户名
 * list($uid, $username) = explode("\t", authcode($auth, 'DECODE'));
 * </code>
 *
 * @access public
 * @param  string $string 需要加密或解密的字符串
 * @param  string $operation 默认是DECODE即解密 ENCODE是加密
 * @param  string $key 加密或解密的密钥 参数为空的情况下取全局配置encryption_key
 * @param  integer $expiry 加密的有效期(秒)0是永久有效 注意这个参数不需要传时间戳
 * @return string
 */
function Encryptioncode($string, $operation = 'DECODE', $key = '', $expiry = 0)
{
    $ckey_length = 4;
    $key = md5($key != '' ? $key : 'lhs_simple_encryption_code_87063');
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';

    $cryptkey = $keya . md5($keya . $keyc);
    $key_length = strlen($cryptkey);

    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
    $string_length = strlen($string);

    $result = '';
    $box = range(0, 255);

    $rndkey = array();
    for ($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }

    for ($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }

    for ($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }

    if ($operation == 'DECODE') {
        if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        return $keyc . str_replace('=', '', base64_encode($result));
    }
}

function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true)
{
    if (function_exists("mb_substr")) {
        $slice = mb_substr($str, $start, $length, $charset);
    } elseif (function_exists('iconv_substr')) {
        $slice = iconv_substr($str, $start, $length, $charset);
    } else {
        $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("", array_slice($match[0], $start, $length));
    }
    return $suffix ? $slice . '...' : $slice;
}

function array_restructure($array, $field)
{
    $return = array(); //数组容器
    foreach ($array as $key => $val) {
        $return[$val[$field]] = $val;
    }
    return $return;
}

function GetIpLookup($ip = '', $field = '')
{
    if (empty($ip)) {
        $ip = ip();
    }
    $cache_name = md5($ip . '_pigcms');
    $json = getCache($cache_name);
    if (!$json) {
        $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);
        if (empty($res)) {
            return false;
        }
        $jsonMatches = array();
        preg_match('#\{.+?\}#', $res, $jsonMatches);
        if (!isset($jsonMatches[0])) {
            return false;
        }
        $json = json_decode($jsonMatches[0], true);
        if (isset($json['ret']) && $json['ret'] == 1) {
            $json['ip'] = $ip;
            unset($json['ret']);
        } else {
            return false;
        }
        setCache($cache_name, serialize($json));
    } else {
        $json = unserialize($json);
    }
    if ($field != '') {
        $return = '';
        $arr = explode(',', $field);
        foreach ($arr as $key => $val) {
            $return .= $json[$val];
        }
        return $return;
    } else {
        return $json;
    }
    return $json;
}

//数组以某某值做键  请传入二维数组
function array_swap($array, $field = '')
{
    $field = $field == '' ? 'id' : $field;
    $new_array = array();
    foreach ($array as $key => $val) {
        $new_array[$val[$field]] = $val;
    }
    return $new_array;
}

//输出调试
function dump($var, $echo = true, $label = null, $strict = true)
{
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace("/\]\=\>\n(\s+)/m", '] => ', $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    } else
        return $output;
}

//debug调试
function debug($var, $type = 1)
{
    echo '<pre style="font-size: 22px">';
    if ($type) {
        var_dump($var);
    } else {
        print_r($var);
    }

    exit();
}

//生成条形码
function UPCAbarcode($code)
{
    $trans_code = $code;
    $lw = 4.2;
    $hi = 80;
    $Lencode = array('0001101', '0011001', '0010011', '0111101', '0100011',
        '0110001', '0101111', '0111011', '0110111', '0001011');
    $Rencode = array('1110010', '1100110', '1101100', '1000010', '1011100',
        '1001110', '1010000', '1000100', '1001000', '1110100');
    $ends = '101';
    $center = '01010';
    /* Compute the EAN-13 Checksum digit */
    $ncode = '0' . $code;
    $even = 0;
    $odd = 0;
    for ($x = 0; $x < 12; $x++) {
        if ($x % 2) {
            $odd += $ncode[$x];
        } else {
            $even += $ncode[$x];
        }
    }
    $code .= (10 - (($odd * 3 + $even) % 10)) % 10;
    /* Create the bar encoding using a binary string */
    $bars = $ends;
    $bars .= $Lencode[$code[0]];

    for ($x = 1; $x < 6; $x++) {
        $bars .= $Lencode[$code[$x]];
    }
    $bars .= $center;
    for ($x = 6; $x < 12; $x++) {
        $bars .= $Rencode[$code[$x]];
    }
    $bars .= $ends;
    /* Generate the Barcode Image */
    $img = ImageCreate($lw * 75 + 30, $hi - 3);   // 95
    $fg = ImageColorAllocate($img, 0, 0, 0);
    $bg = ImageColorAllocate($img, 255, 255, 255);
    ImageFilledRectangle($img, 0, 0, $lw * 75 + 30, $hi + 30, $bg);
    $shift = 10;
    for ($x = 0; $x < strlen($bars); $x++) {
        if (($x < 0) || ($x >= 45 && $x < 46) || ($x >= 85)) {
            $sh = 10;
        } else {
            $sh = 0;
        }
        if ($bars[$x] == '1') {
            $color = $fg;
        } else {
            $color = $bg;
        }
        ImageFilledRectangle($img, ($x * $lw) + 15, 5, ($x + 1) * $lw + 14, $hi + 5 + $sh, $color);
    }
    /* Add the Human Readable Label */
    ImageString($img, 4, 5, $hi - 5, $code[0], $fg);
    for ($x = 0; $x < 5; $x++) {
        ImageString($img, 5, $lw * (13 + $x * 6) + 15, $hi + 5, $code[$x + 1], $fg);
        ImageString($img, 5, $lw * (53 + $x * 6) + 15, $hi + 5, $code[$x + 6], $fg);
    }
    ImageString($img, 4, $lw * 95 - 7, $hi, $code[11], $fg);
    /* Output the Header and Content. */
    header("Content-Type: image/png");

    ImagePNG($img, ABS_PATH . '123.png');
}

//ajax数据返回
function ajaxReturn($data, $info = '', $status = 0, $type = 'json')
{
    switch (strtoupper($type)) {
        case 'JSON':
            // 返回JSON数据格式到客户端 包含状态信息
            header('Content-Type:application/json; charset=utf-8');
            exit(json_encode(array('status' => $status, 'info' => $info, 'data' => $data)));
        case 'XML'  :
            // 返回xml格式数据
            header('Content-Type:text/xml; charset=utf-8');
            exit(xml_encode($data, $info, $status));
        case 'JSONP':
            // 返回JSON数据格式到客户端 包含状态信息
            header('Content-Type:application/json; charset=utf-8');
            $handler = isset($_GET[C('VAR_JSONP_HANDLER')]) ? $_GET[C('VAR_JSONP_HANDLER')] : C('DEFAULT_JSONP_HANDLER');
            exit($handler . '(' . json_encode($data, $info, $status) . ');');
        case 'EVAL' :
            // 返回可执行的js脚本
            header('Content-Type:text/html; charset=utf-8');
            exit($data);
        default     :
            // 用于扩展其他返回格式数据
    }
}

function barcode($data,$filename)
{
    bpBase::loadOrg('BCGFontFile');
    //bpBase::loadOrg('BCGColor');
    bpBase::loadOrg('BCGDrawing');
// Including the barcode technology
    bpBase::loadOrg('BCGcode128');

// Loading Font
   $font = new BCGFontFile(bpBase::loadfont('Arial'), 12);


// The arguments are R, G, B for color.
    $color_black = new BCGColor(0, 0, 0);
    $color_white = new BCGColor(255, 255, 255);

    $drawException = null;
    try {
        $code = new BCGcode128();//实例化对应的编码格式
        $code->setScale(2); // Resolution
        $code->setThickness(23); // Thickness
        $code->setForegroundColor($color_black); // Color of bars
        $code->setBackgroundColor($color_white); // Color of spaces
        $code->setFont($font); // Font (or 0)
        $text = $data; //条形码将要数据的内容
        $code->parse($text);
    } catch (Exception $exception) {
        $drawException = $exception;
    }

    /* Here is the list of the arguments
    1 - Filename (empty : display on screen)
    2 - Background color */
    $drawing = new BCGDrawing('', $color_white);
    if ($drawException) {
        $drawing->drawException($drawException);
    } else {
        $drawing->setBarcode($code);
        $drawing->draw();
    }

// Header that says it is an image (remove it if you save the barcode to a file)
    header('Content-Type: image/png');

// Draw (or save) the image into PNG format.
    $drawing->setFilename(ABS_PATH .'pigcms_static/img/'.$filename.'.png');
    $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
}


?>