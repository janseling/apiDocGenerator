<?php
require_once "Parser.php";
$config = include_once __DIR__ . '/config.php';
$files = array();
foreach ($config['php_files'] as $key => $value) {
	$dir = dirname($value);
	$dirArr = scandir($dir);
	foreach ($dirArr as $k => $v) {
		if ($v == '.' || $v == '..') {
			continue;
		}
		$res = preg_match('/' . basename($value) . '/', $v);
		if ($res) {
			$files[] = $dir . '/' . $v;
		}

	}

}
$parser = new Parser();
$docs =array();
foreach ($files as $file) {
    $docs_file=$parser->parse($file);
    $docs=array_merge($docs,$docs_file);
}

//按分类组装数组
$cate=array();
foreach ($docs as $doc) {
    if($doc['category']==''){
        $doc['category']='其他接口';
    }
    if(!isset( $cate[$doc['category']])){
        $cate[$doc['category']]=array();
    }
    $cate[$doc['category']][] = $doc;
}

function dd($arr){
    echo '<pre>';
    print_r($arr);die;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>api接口文档</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/bootstrap.min.css"  type="text/css" />
    <!-- Iconos -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="css/jquery.json-viewer.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="css/metismenu.min.css" />
</head>

<body>
    <a id="force-refresh" href="./clearCache.php">刷新缓存</a>
    <textarea id="headers" placeholder="自定义 headers, 一行一个属性" rows="3"></textarea>
    <ul id="accordion" class="accordion">
    <?php foreach ($cate as $key=> $value) { ?>
        <li>
        <a class="category" href="javascript:void(0)"> <i class="fa fa-globe"></i><?=trim($key)?><span class="fa fa-chevron-down glyphicon arrow"></span></a> 
        <ul>    
	<?php foreach ($value as $doc) {
		?>
        <li class="sub_li">
                <a class="link" href="javascript:void(0)"><i class="fa fa-link"></i><?=trim($doc['name'])?>&nbsp;&nbsp;(<?=trim($doc['url'])?>)<span class="fa fa-chevron-down glyphicon arrow"></span></a> 
                <ul>
                   <li>
                         <div class="submenu">
                            <p>
                                <label>请求地址</label> : <?=$doc['url']?>
                                </br>
                                <label>请求方式</label> : <?=$doc['method']?>
                                </br>
                                <label>接口说明</label> : <?=$doc['desc']?>
                                <button class="btn-test" data-url="<?=trim($doc['url'])?>" data-method="<?=$doc['method']?>">测试接口</button>
                            </p>
                            <table class="params">
                            <?php foreach ($doc['params'] as $param) {?>
                                <tr>
                                    <td width="160"><?=$param['name']?></td>
                                    <td width="80"><?=$param['class']?></td>
                                    <td width="80"><?=$param['needle']?></td>
                                    <td width="320"><?=$param['desc']?></td>
                                    <td width="400"><label>参数值 : <input type="text" name="<?=$param['name']?>"></label></td>
                                </tr>
                            <?php }?>
                            </table>

                            <p>返回参数说明:</p>
                            <table class="columns">
                                <tr>
                                <?php for ($i = 0; $i < count($doc['columns']); $i++) {?>
                                    <?php if ($i > 0 && $i % 2 == 0) {?>
                                    </tr><tr> <?php }?>
                                    <td width="200"><?=$doc['columns'][$i]['name']?></td>
                                    <td width="500"><?=$doc['columns'][$i]['desc']?></td>
                                <?php }?>
                                </tr>
                            </table>
                            <div class="api-return">
                                <button class="clear">清除</button>
                                <div class="result"></div>
                            </div>
                          </div>
                       </li>                       
                </ul>            

       </li>   
    <?php   }   ?>
      </ul>
     </li>
<?php } ?>
    </ul>
  <script src="js/jquery.js"></script>
  <script src="js/jquery.json-viewer.js"></script>
  <script src="js/metismenu.js"></script>
  <script src="js/index.js"></script>
</body>
</html>