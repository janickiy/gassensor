<?php
/**
 *
 * @since 2019-11-13 17:02
 */
namespace common\widgets;

use frontend\assets\SyntaxhighlighterAsset;
use yii\base\Widget;

class TraceViewer extends Widget
{
    /**
     * @var \Exception
     */
    public $exception;

    public function run()
    {
        SyntaxhighlighterAsset::register($this->view);

        $str = '';

        $trace = $this->exception->getTrace();

        array_unshift($trace, [
            'file' => $this->exception->getFile(),
            'line' => $this->exception->getLine(),
        ]);

        foreach ($trace as $k => $v) {
            $str .= $this->viewListing($k, $v);
        }
        return $str;
    }

    protected function viewListing($k, $v)
    {
        $linesCount = 20;

        if (empty($v['file'])) {

            unset($v['args']); //prevent 'circular references'
            return '<div class="trace-item">' . $k . ' | Unknown file: ' . var_export($v, 1) . '</div>';
        }

        $lines = file($v['file']);

        $startLine = $v['line'] - $linesCount / 2;
        if ($startLine < 0) {
            $startLine = 0;
        }
        $lines = array_slice($lines, $startLine-1, $linesCount);
        $lines = join('', $lines);

        $func = '';
        if (!empty($v['class'])) {
            $func = " | {$v['class']}{$v['type']}{$v['function']}";
        }

        $args = '';
        if (isset($v['args'])) {
            $args = [];
            foreach ($v['args'] as $vv) {
                switch (gettype($vv)) {
                    case 'object':
                        $args[] = get_class($vv);
                        break;
                    case 'string':
                        if (strlen($vv) > 100) {
                            $str = substr($vv, 0, 100) . '...';
                        } else {
                            $str = $vv;
                        }

                        $args[] =  "'$str'";
                        break;
                    default:
                        $args[] = gettype($vv);
                }

            }
            $args = '(' . join(', ', $args) . ');';
        }

        //$lines = str_replace('<' . '?php', $replace, $lines);
        $lines = htmlspecialchars($lines);

        $str =<<<EOD
<div class="trace-item">
    <div class="header">$k | {$v['file']} $func$args</div>
    <pre class='brush: php; highlight: {$v['line']}; first-line: $startLine;'>$lines</pre>
</div>
EOD;

        return $str;
    }

}
