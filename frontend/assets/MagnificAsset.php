<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class MagnificAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'swiper/css/opencart.css',
        'swiper/css/swiper.css',
    ];
    public $js = [
        'swiper/js/swiper.jquery.js',
        'swiper/js/swiper.jquery.umd.js',
        'swiper/js/swiper.js',
    ];
    public $cssOptions = [
        'media' => 'screen',
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}