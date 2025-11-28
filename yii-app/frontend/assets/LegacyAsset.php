<?php
/**
 *
 * @since 2021-11-26 14:34
 */
namespace frontend\assets;

use yii\web\AssetBundle;

class LegacyAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/old.css?v=1',
        'admin/css/font-awesome.min.css'
    ];
    public $js = [
        'js/old.js?v=1',
        //'js/scripts.js',
    ];

}
