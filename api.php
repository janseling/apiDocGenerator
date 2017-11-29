<?php

/**
 * @api
 * @name    测试接口1
 * @desc    这是用来测试接口1的接口，会直接输出无意义的数据
 * @url     test.php
 * @method  POST
 * @param   param1      string  [必填]  akldjlaksjdlsd
 * @param   param2      string  [必填]  akl djlaksjdlsd
 * @param   param3      string  [可选]  akld jlaksjdlsd
 * @param   param4      string  [可选]  akldjlaksjdlsd
 * @column  field1      slkdjskdjls
 * @column  field2      slkdjskdjls
 * @column  field3      slkdjskdjls
 * @column  field4      slkdjskdjls
 */
function test1 () {
    $param1 = 'dad';
    $param2 = 'dad';
    $param3 = 'dad';
    $param4 = 'dad';
    $field1 = rand().'-'.$param1;
    $field2 = rand().'-'.$param2;
    $field3 = rand().'-'.$param3;
    $field4 = rand().'-'.$param4;
    return json_encode(compact('field1', 'field2', 'field3', 'field4'));
}

/**
 * @api
 * @name    测试接口2
 * @desc    测试方法2
 * @url     api/test2
 * @method  POST
 * @param   param1      string  [必填]  akldjlaksjdlsd
 * @param   param2      string  [必填]  akl djlaksjdlsd
 * @param   param3      string  [可选]  akld jlaksjdlsd
 * @param   param4      string  [可选]  akldjlaksjdlsd
 * @column  field1      slkdjskdjls
 * @column  field2      slkdjskdjls
 * @column  field3      slkdjskdjls
 * @column  field4      slkdjskdjls
 */
function test2 () {
    $param1 = 'dad';
    $param2 = 'dad';
    $param3 = 'dad';
    $param4 = 'dad';
    $field1 = rand().'-'.$param1;
    $field2 = rand().'-'.$param2;
    $field3 = rand().'-'.$param3;
    $field4 = rand().'-'.$param4;
    return json_encode(compact('field1', 'field2', 'field3', 'field4'));
}

/**
 * @api
 * @name    测试接口2
 * @desc    测试方法3
 * @url     api/test3
 * @method  POST
 * @param   param1      string  [必填]  akldjlaksjdlsd
 * @param   param2      string  [必填]  akl djlaksjdlsd
 * @param   param3      string  [可选]  akld jlaksjdlsd
 * @param   param4      string  [可选]  akldjlaksjdlsd
 * @column  field1      slkdjskdjls
 * @column  field2      slkdjskdjls
 * @column  field3      slkdjskdjls
 * @column  field4      slkdjskdjls
 */
function test3 () {
    $param1 = 'dad';
    $param2 = 'dad';
    $param3 = 'dad';
    $param4 = 'dad';
    $field1 = rand().'-'.$param1;
    $field2 = rand().'-'.$param2;
    $field3 = rand().'-'.$param3;
    $field4 = rand().'-'.$param4;
    return json_encode(compact('field1', 'field2', 'field3', 'field4'));
}