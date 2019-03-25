<?php
class Parser {

    public function parse ($file) {
        if ($this->checkCache($file)) {
            return $this->cacheRead($file);
        }
        $doc = $this->fromFile($file);
        $this->cacheSave($file, $doc);
        return $doc;
    }

    public function fromFile ($file) {
        $content = file_get_contents($file);
        $comments = $this->getComments($content);
        $doc = [];
        foreach ($comments as $comment) {
            if (empty($comment) || preg_match("/\*\ \@api/", $comment) == 0) {
                continue;
            }
            $doc[] = [
                'params' => $this->getParams($comment),
                'columns' => $this->getColumns($comment),
                'url' => $this->getField($comment, 'url'),
                'name' => $this->getField($comment, 'name'),
                'category' => $this->getField($comment, 'category'),
                'desc' => $this->getField($comment, 'desc'),
                'method' => $this->getField($comment, 'method'),
            ];
        }
        return $doc;
    }

    public function getCacheDir () {
        return __DIR__.'/cache';
    }

    protected function getCachePath ($file) {
        if (strpos($file, '..') === 0) {
            $file = dirname(__DIR__).substr($file, 2);
        }
        $log = exec('cd '.dirname(__DIR__).' && git log -1 --oneline '.$file);
        $commitId = explode(' ', $log)[0];
        return $this->getCacheDir().'/'.$commitId.'-'.md5($file).'.json';
    }

    protected function checkCache ($file) {
        $path = $this->getCachePath($file);
        return file_exists($path);
    }

    protected function cacheRead ($file) {
        $path = $this->getCachePath($file);
        $doc = json_decode(file_get_contents($path), true);
        return $doc;
    }

    protected function cacheSave ($file, $data) {
        $cacheDir = $this->getCacheDir();
        if (!file_exists($cacheDir)) {
            mkdir($cacheDir);
        }
        $path = $this->getCachePath($file);
        file_put_contents($path, json_encode($data));
    }

    public function getComments ($str) {
        $matches = [];
        if (preg_match_all('/\/\*([^\*^\/]*|[\*^\/*]*|[^\**\/]*)*\*\//', $str, $matches)) {
            return $matches[0] ?: [];
        }
        return [];
    }

    public function getField ($str, $field) {
        $matches = [];
        if (preg_match("/\*\ \@{$field}\ (.*)/", $str, $matches)) {
            return $matches[1] ?: '';
        }
        return '';
    }

    public function getFields ($str, $field) {
        $matches = [];
        if (preg_match_all("/\*\ \@{$field}\ *(.*)/", $str, $matches)) {
            return $matches[1] ?: [];
        }
        return [];
    }

    public function getParams ($str) {
        $params = [];
        $matches = $this->getFields($str, 'param');
        foreach ($matches as $match) {
            $f = array_merge(array_filter(explode(' ', $match)));
            $params[] = [
                'name' => $f[0] ?: '',
                'class' => $f[1] ?: '',
                'needle' => $f[2] ?: '',
                'desc' => join(' ', array_slice($f, 3)),
            ];
        }
        return $params;
    }

    public function getColumns ($str) {
        $rets = [];
        $matches = $this->getFields($str, 'column');
        foreach ($matches as $match) {
            $f = array_merge(array_filter(explode(' ', $match)));
            $rets[] = [
                'name' => $f[0] ?: '',
                'desc' => join(' ', array_slice($f, 1)),
            ];
        }
        return $rets;
    }

}