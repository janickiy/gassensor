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
        'css/old.css',
    ];
    public $js = [
        'js/old.js',
        //'js/scripts.js',
    ];

}
