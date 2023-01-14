<?php
/**
 *
 * @since 2021-08-22
 */
namespace frontend\assets;

use yii\web\AssetBundle;

class Bootstrap5Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/lib/bootstrap-5.1.3-dist/css/bootstrap.min.css',
    ];
    public $js = [
        //'/lib/popperjs-2.9.2/popper.min.js',
        '/lib/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

}
