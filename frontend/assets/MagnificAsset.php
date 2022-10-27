<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class MagnificAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'magnific/css/magnific-popup.css',
    ];
    public $js = [
        'magnific/js/jquery.magnific-popup.min.js',
    ];
    public $cssOptions = [
        'media' => 'screen',
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}