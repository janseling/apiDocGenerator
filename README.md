## 接口文档&测试页面生成器

### 如何使用?

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
|@desc|是|接口的功能简短描述|@desc 这是一段描述|
|@url|是|接口的地址|@url api/text|
|@method|是|接口的请求方式|@method POST|
|@param|否|接口的参数说明，多个参数时需要编写个。格式: @param 字段名 字段类型 [必填/可选] 描述|@param param1 string [必填] 这是一个字段的|
|@column|否|返回数据的字段说明。格式: @column 字段名 字段说明|@column column1 这是返回的字段|

### 一个完整的注释示例

```
/**
 * @api
 * @desc    测试方法1
 * @url     api/text1
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
```
