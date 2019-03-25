# 接口文档&测试页面生成器

解析指定格式的注释块生成接口描述，并生成简单的接口测试页面，可通过 ajax 方式请求接口并显示返回结果

该测试页面可同时充当接口文档和解耦调用测试页面使用

## 如何使用?

1. 将次项目通过```git submodule```的方式添加到项目的根目录
2. 复制```config.php.example```一份并重命名为```config.php```
3. 编辑```config.php```，添加提供 api 接口的 php 文件路径
4. 按照规范给提供接口的方法添加注释
5. 访问 index.php 页面即可

### 注释规范

* 注释必须以 /* .... */ 这种的注释快的形式编写

|注释标识|是否必要|作用描述|例子|
|--------|--------|--------|----|
|@api|是|接口标识, 没有此标识的注释无法解析为接口文档||
|@name|是|接口的名称|@name 测试接口1|
|@category|是|接口所属分类|@category 用户模块|
|@desc|是|接口的功能简短描述|@desc 这是一段描述|
|@url|是|接口的地址|@url api/text|
|@method|是|接口的请求方式|@method POST|
|@param|否|接口的参数说明，多个参数时需要编写个。格式: @param 字段名 字段类型 [必填/可选] 描述|@param param1 string [必填] 这是一个字段的|
|@column|否|返回数据的字段说明。格式: @column 字段名 字段说明|@column column1 这是返回的字段|

### 一个完整的注释示例

```php
/**
 * @api
 * @name    测试接口1
 * @category  用户模块
 * @url     api/text1
 * @method  POST
 * @desc    这是用来测试接口1的接口，会直接输出无意义的数据
 * @param   param1      string  [必填]  param1的说明描述
 * @param   param2      string  [可选]  param2的说明描述
 * @column  field       返回结果中field的说明描述
 */
```

## 版权声明

本项目使用 [MIT](https://opensource.org/licenses/MIT) 许可证

```
Copyright (c) 2017 Max<janseling@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
```
