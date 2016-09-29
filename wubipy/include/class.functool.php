<?php
//判断是否是utf8
function is_utf8($string) {
   $encode =  mb_detect_encoding($string, array('ASCII','GB2312','GBK','UTF-8'));
   $isutf8 =  $encode=='UTF-8';
   if($isutf8)
    {
       return true;
    }
   return preg_match('%^(?:
         [\x09\x0A\x0D\x20-\x7E]            # ASCII
       | [\xC2-\xDF][\x80-\xBF]            # non-overlong 2-byte
       |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
       | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
       |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
       |  \xF0[\x90-\xBF][\x80-\xBF]{2}    # planes 1-3
       | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
       |  \xF4[\x80-\x8F][\x80-\xBF]{2}    # plane 16
   )*$%xs', $string);
}

//function is_gbk($str)
//{
//    if(!preg_match("/^[".chr(0xa1)."-".chr(0xff)."a-za-z0-9_]+$/",$str))
//    {
//        return false;
//    }
//    return true;
//}


/**
 * @brief 在任意编码方式中转换任意变量
 * @param &$var 要转换的变量
 * @param string s_enc 原编码方式
 * @param string t_enc 现编码方式
 */
function changeEncode(&$var, $s_enc, $t_enc)
{
    switch (gettype($var)) {
    case 'string':
        $arr=array('ASCII', 'GB2312', 'GBK', 'EUC-CN','UTF-8');
        $encoding = mb_detect_encoding($var, $arr, false);
        if(in_array($encoding,$arr)){
            $var = iconv($s_enc, $t_enc, $var);
        }else{
            if( $t_enc=='UTF-8'){
                $var=mb_convert_encoding($var, 'UTF-8' , $encoding);
            }else{
                 $var = iconv($s_enc, $t_enc, $var);
            }
        }
        break;
    case 'array':
        foreach($var as $k=>$v) {
            changeEncode($var[$k],$s_enc,$t_enc);
        }
        break;
    case 'object':
        $vars = get_object_vars($var);
        $keys=array_keys($vars);
        foreach($keys as $key=>$value){
            changeEncode($var->$value,$s_enc,$t_enc);
        }
        break;
    default:
        break;
    }
}
?>