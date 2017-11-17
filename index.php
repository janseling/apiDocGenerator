<?php
require_once "Parser.php";
$config = include_once(__DIR__.'/config.php');
$parser = new Parser();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>api接口文档</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Iconos -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
</head>

<body>
    <a id="force-refresh" href="./clearCache.php">强制刷新</a>
    <textarea id="headers" placeholder="自定义 headers, 一行一个属性" rows="3"></textarea>
    <ul id="accordion" class="accordion">
    <?php
    foreach ($config['php_files'] as $file) {
        $docs = $parser->parse($file);
        foreach ($docs as $doc) {
    ?>
        <li>
        <div class="link">
            <i class="fa fa-globe"></i><?= trim($doc['name']) ?>&nbsp;&nbsp;(<?= trim($doc['url']) ?>)<i class="fa fa-chevron-down"></i>
        </div>
        <div class="submenu">
            <p>
                <label>请求地址</label> : <?= $doc['url'] ?>
                </br>
                <label>请求方式</label> : <?= $doc['method'] ?>
                </br>
                <label>接口说明</label> : <?= $doc['desc'] ?>
                <button class="btn-test" data-url="<?= trim($doc['url']) ?>" data-method="<?= $doc['method'] ?>">测试接口</button>
            </p>
            <table class="params">
            <?php foreach ($doc['params'] as $param) { ?>
                <tr>
                    <td width="160"><?= $param['name'] ?></td>
                    <td width="80"><?= $param['class'] ?></td>
                    <td width="80"><?= $param['needle'] ?></td>
                    <td width="320"><?= $param['desc'] ?></td>
                    <td width="400"><label>参数值 : <input type="text" name="<?= $param['name'] ?>"></label></td>
                </tr>
            <?php } ?>
            </table>

            <p>返回参数说明:</p>
            <table class="columns">
                <tr>
                <?php for ($i = 0; $i < count($doc['columns']); $i++) { ?>
                    <?php if ($i > 0 && $i % 2 == 0) {  ?>
                    </tr><tr> <?php } ?>
                    <td width="200"><?= $doc['columns'][$i]['name'] ?></td>
                    <td width="500"><?= $doc['columns'][$i]['desc'] ?></td>
                <?php } ?>
                </tr>
            </table>
            <div class="api-return">
                <button class="clear">清除</button>
                <div class="result"></div>
            </div>
        </div>
        </li>
    <?php
        }
    }
    ?>
    </ul>
  <script src="js/jquery.js"></script>
  <script src="js/index.js"></script>
</body>
</html>