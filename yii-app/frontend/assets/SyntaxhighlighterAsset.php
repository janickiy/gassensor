<?php
/**
 * @since 2018-12-01 20:11
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class SyntaxhighlighterAsset extends AssetBundle
{
    public $basePath = '@documentroot';
    public $js = [
        'lib/hl/syntaxhighlighter.js'
    ];
    public $css = [
        'lib/hl/theme-rdark.css',
    ];
}

