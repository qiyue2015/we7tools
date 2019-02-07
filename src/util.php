<?php
/**
 * Created by we7tools.
 * User: fengqiyue
 * Time: 2019/2/7 12:02 PM
 */

namespace LnApp;

class Util
{
    /**
     * API 返回正确信息
     * @param number $errno 错误编号
     * @param string $message 错误信息
     */
    public static function SendError($errno, $message = '')
    {
        @header('Content-type:application/json');
        if (is_array($errno) && array_key_exists('errno', $errno)) {
            $message = $errno['message'];
            $errno = $errno['errno'];
        }
        $obj = [];
        $obj['errno'] = intval($errno);
        $obj['message'] = $message;
        $obj = json_encode($obj, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        if ($_GET['callback']) {
            $obj = $_GET['callback'] . '(' . $obj . ')';
        }
        die($obj);
    }

    /**
     * API输出正确信息
     * @param array $data
     */
    public static function SendResult($data = array())
    {
        @header('Content-type:application/json');
        $obj['errno'] = 0;
        $obj['message'] = 'success';
        $obj['data'] = !empty($data) && is_array($data) ? (array)$data : (object)$data;
        $obj = json_encode($obj, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        if ($_GET['callback']) {
            $obj = $_GET['callback'] . '(' . $obj . ')';
        }
        die($obj);
    }
}