<?php

function check_verify($code, $id = '') {
	$verify = new \Think\Verify();
	return $verify->check($code, $id);
}

/**
 * 删除目录或者文件
 * @param  string  $path
 * @param  boolean $is_del_dir
 * @return fixed
 */
function del_dir_or_file($path, $is_del_dir = FALSE) {
    $handle = opendir($path);
    if ($handle) {
        // $path为目录路径
        while (false !== ($item = readdir($handle))) {
            // 除去..目录和.目录
            if ($item != '.' && $item != '..') {
                if (is_dir("$path/$item")) {
                    // 递归删除目录
                    del_dir_or_file("$path/$item", $is_del_dir);
                } else {
                    // 删除文件
                    unlink("$path/$item");
                }
            }
        }
        closedir($handle);
        if ($is_del_dir) {
            // 删除目录
            return rmdir($path);
        }
    }else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return false;
        }
    }
}

/**
 * 简单对称加密算法之加密
 * @param String $string 需要加密的字串
 * @param String $skey 加密EKY
 * @author Anyon Zou <zoujingli@qq.com>
 * @date 2013-08-13 19:30
 * @update 2014-10-10 10:10
 * @return String
 */
 function encode($string = '', $skey = 'cxphp') {
    $strArr = str_split(base64_encode($string));
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
        $key < $strCount && $strArr[$key].=$value;
    return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
 }
 /**
 * 简单对称加密算法之解密
 * @param String $string 需要解密的字串
 * @param String $skey 解密KEY
 * @author Anyon Zou <zoujingli@qq.com>
 * @date 2013-08-13 19:30
 * @update 2014-10-10 10:10
 * @return String
 */
 function decode($string = '', $skey = 'cxphp') {
    $strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
        $key <= $strCount  && isset($strArr[$key]) && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
    return base64_decode(join('', $strArr));
 }