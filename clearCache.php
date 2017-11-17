<?php

require_once 'Parser.php';

$parser = new Parser();
if ($dir = opendir($parser->getCacheDir())) {
    while ($file = readdir($dir)) {
        if (strpos($file, '.json') !== false) {
            unlink($parser->getCacheDir().'/'.$file);
        }
    }
}

header('Location:./');