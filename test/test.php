<?php
/**
 * @api
 * @name    测试接口
 * @category 接口分类1
 * @url     test/test.php
 * @method  GET
 * @desc    这是用来测试接口1的接口，会直接输出无意义的数据
 * @param   无      String  [可选]  其实并需要参数
 * @column  json    这是一个随机返回的无意义json
 */
/**
 * @api
 * @name    测试接口1
 * @category 接口分类
 * @url     test/test.php
 * @method  GET
 * @desc    这是用来测试接口1的接口，会直接输出无意义的数据
 * @param   无      String  [可选]  其实并需要参数
 * @column  json    这是一个随机返回的无意义json
 */
/**
 * @api
 * @name    测试接口
 * @category 接口分类2
 * @url     test/test.php
 * @method  GET
 * @desc    这是用来测试接口1的接口，会直接输出无意义的数据
 * @param   无      String  [可选]  其实并需要参数
 * @column  json    这是一个随机返回的无意义json
 */
/**
 * @api
 * @name    测试接口
 * @category 接口分类2
 * @url     test/test2.php
 * @method  GET
 * @desc    这是用来测试接口1的接口，会直接输出无意义的数据
 * @param   无      String  [可选]  其实并需要参数
 * @column  json    这是一个随机返回的无意义json
 */
function test () {
    $json = genJson();
    return json_encode($json);
}
echo test();

function genJson ($level = 0) {
    $num = rand(3, 10);
    $json = array();
    for ($i = 0; $i < $num; $i++) {
        if (rand(1, 100) > (25 / ($level + 1))) {
            $json[genStr(true)] = genStr();
            continue;
        }
        $json[genStr(true)] = genJson($level + 1);
    }
    return $json;
}

function genStr ($isName = false) {
    $src = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = rand(1, $isName ? 16 : 64);
    $str = '';
    for ($i = 0; $i < $num; $i++) {
        $chr = rand(1, 100) > 70 || $isName ? $src[rand(0, strlen($src) - 1)] : iconv('GB2312', 'UTF-8', chr(mt_rand(0xB0,0xD0)).chr(mt_rand(0xA1, 0xF0)));
        $str .= $chr;
    }
    return $str;
}