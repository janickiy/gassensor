<?php
/**
 *
 * @since 2019-04-26 15:35
 */

namespace common\helpers;

use Yii;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use SimpleXMLElement;
use yii\base\{Model, DynamicModel};
use yii\data\ArrayDataProvider;
use yii\helpers\{ArrayHelper, Json};


class Tools
{
    public static $months = [
        'январь',
        'февраль',
        'март',
        'апрель',
        'май',
        'июнь',
        'июль',
        'август',
        'сентябрь',
        'октябрь',
        'ноябрь',
        'декабрь',
    ];

    /**
     * @param $arr
     * @return string
     */
    public static function getWidgetColumnsFromArray($arr)
    {
        $model = new DynamicModel($arr);
        return self::getWidgetColumns($model);
    }

    /**
     * @param Model $model
     * @return string
     */
    public static function getWidgetColumns(Model $model)
    {
        //dump($model->attributes);

        $cols1 = [];
        $cols2 = [];
        $cols3 = [];
        $cols4 = [];
        foreach ($model->attributes as $attrName => $attrVal) {
            $cols1[] = "  '$attrName'";
            $cols2[] = "[\n  'label' => '$attrName',\n  'value' => '$attrName',\n]";
            $cols3[] = "[\n  'label' => '$attrName',\n  "
                . "'format' => 'raw',\n  "
                . "'value' => function(\$value) {\n    return \$value;\n  },\n]";
            $cols4[] = "[\n  'label' => '$attrName',\n  "
                . "'format' => 'raw',\n  "
                . "'value' => function(\$model) {\n    return \$model->$attrName;\n  },\n]";
        }

        $cols5 = [];
        foreach ($model->relatedRecords as $relName => $relModel) {
            if (!$relModel) {
                continue;
            }
            foreach ($relModel->attributes as $name => $val) {
                $cols5[] = "'$relName.$name'";
            }

        }

        $str = "<div class='row'>";

        $str .= "<div class='col col-md-3'><pre>\n";
        $str .= "[\n" . join(",\n", $cols1) . ",\n]";
        $str .= "\n[\n" . join(",\n", $cols5) . ",\n]";
        $str .= "\n</pre></div>";


        $str .= "<div class='col col-md-3'><pre>\n";
        $str .= join(",\n", $cols2) . ",\n";
        $str .= "\n</pre></div>";

        $str .= "<div class='col col-md-3'><pre>\n";
        $str .= join(",\n", $cols3) . ",\n";
        $str .= "\n</pre></div>";

        $str .= "<div class='col col-md-3'><pre>\n";
        $str .= join(",\n", $cols4) . ",\n";
        $str .= "\n</pre></div>";

        $str .= "</div>";

        return $str;
    }

    /**
     * @param SimpleXMLElement $sxe
     * @return \yii\data\ArrayDataProvider
     */
    public static function getDataProviderFromSxe(SimpleXMLElement $sxe)
    {
        $dp = new ArrayDataProvider();
        $models = [];

        foreach ($sxe as $v) {
            $row = array_map(function ($item) {
                return (string)$item;
            }, (array)$v);
            $models[] = $row;
        }

        $dp->setModels($models);

        return $dp;
    }

    /**
     * @param $arr
     * @return mixed
     */
    public static function arrayValsToScalar(array $arr)
    {
        foreach ($arr ?? [] as &$v) {
            if (null !== $v && !is_scalar($v)) {
                $v = Json::encode($v);
            }
        }

        return $arr;
    }

    /**
     * @param $str
     * @return array|string|string[]|null
     */
    public static function filterAlphaNum($str)
    {
        return preg_replace('/[^a-z0-9]+/i', '', $str);
    }

    /**
     * @param $str
     * @return array|string|string[]|null
     */
    public static function filterNum($str)
    {
        return preg_replace('/[^0-9]+/', '', $str);
    }

    /**
     * @param $str
     * @return array|string|string[]|null
     */
    public static function filterNumAndDash($str)
    {
        return preg_replace('/[^0-9-]+/', '', $str);
    }

    /**
     * https://www.php.net/manual/en/function.array-unshift.php#106570
     * @param array $arr
     * @param $key
     * @param $val
     */
    public static function array_unshift_assoc(&$arr, $key = '', $val = null)
    {
        $arr = array_reverse($arr, true);
        $arr[$key] = $val;
        return array_reverse($arr, true);
    }

    public static function jsonErrors()
    {
        return [
            JSON_ERROR_NONE => 'JSON_ERROR_NONE',
            JSON_ERROR_DEPTH => 'JSON_ERROR_DEPTH',
            JSON_ERROR_STATE_MISMATCH => 'JSON_ERROR_STATE_MISMATCH',
            JSON_ERROR_CTRL_CHAR => 'JSON_ERROR_CTRL_CHAR',
            JSON_ERROR_SYNTAX => 'JSON_ERROR_SYNTAX',
            JSON_ERROR_UTF8 => 'JSON_ERROR_UTF8',
            JSON_ERROR_RECURSION => 'JSON_ERROR_RECURSION',
            JSON_ERROR_INF_OR_NAN => 'JSON_ERROR_INF_OR_NAN',
            JSON_ERROR_UNSUPPORTED_TYPE => 'JSON_ERROR_UNSUPPORTED_TYPE',
            JSON_ERROR_INVALID_PROPERTY_NAME => 'JSON_ERROR_INVALID_PROPERTY_NAME',
            JSON_ERROR_UTF16 => 'JSON_ERROR_UTF16',
        ];
    }

    /**
     * @param $time
     * @return int|null
     */
    public static function getTimeH($time)
    {
        return $time ? (int)date('H', $time) : null;
    }

    /**
     * @param $time
     * @param $h
     * @param false $zerozero
     * @return false|int
     */
    public static function setTimeH($time, $h, $zerozero = false)
    {
        $newH = str_pad((int)$h, 2, '0', STR_PAD_LEFT);
        $format = $zerozero ? '00:00' : 'i:s';
        $newD = date("Y-m-d $newH:$format", $time);
        return strtotime($newD);
    }

    /**
     * @param int $time
     * @return number 1..7
     */
    public static function getTimeDayWeek($time)
    {
        return (int)date('N', $time);
    }

    /**
     * @param null $meta
     * @return array|mixed|null
     */
    public static function getSphinxMeta($meta = null)
    {
        $sphinx = Yii::$app->sphinx;

        if (!$meta) {
            $rows = $sphinx->createCommand("SHOW META")->queryAll();
            $meta = ArrayHelper::map($rows, 'Variable_name', 'Value');
        }

        $meta['keywords'] = [];

        foreach ($meta as $k => $v) {
            //$k = 'keyword[123]'; //test
            if (preg_match('%keyword\[(\d+)\]%', $k, $m)) {
                $meta['keywords'][(int)$m[1]] = $v;
            }
        }

        return $meta;
    }

    /**
     * @param $arr
     * @return mixed
     */
    public static function arrayFlattenJson($arr)
    {
        foreach ($arr as &$v) {
            if (!is_scalar($v)) {
                $v = Json::encode($v);
            }
        }

        return $arr;
    }

    /**
     * http://jeffreysambells.com/2012/10/25/human-readable-filesize-php
     * @param int $bytes
     * @param number $decimals
     * @return string
     */
    public static function human_filesize($bytes, $decimals = 2)
    {
        $size = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    /**
     * @param $route
     * @param $name
     * @param $value
     * @return array
     */
    public static function addParamToRoute($route, $name, $value)
    {
        $currentParams = Yii::$app->request->get();
        $currentParams[$name] = $value;
        return array_merge($route, $currentParams);
    }

    /**
     *
     * @param string $append
     * @param string $prepend example xdebug on: 'export XDEBUG_CONFIG="remote_host=192.168.0.20 idekey=*complex*" &&'
     * @return array
     */
    public static function cliYii($append = '', $prepend = '')
    {
        $parts = [
            $prepend,
            \Yii::getAlias('@yiiapp/yii'),
            $append,
            '2>&1',
        ];

        $cmd = join(' ', $parts);

        $handler = popen($cmd, 'r');
        $output = '';
        while (!feof($handler)) {
            $output .= fgets($handler);
        }
        $output = trim($output);
        $status = pclose($handler);

        return ['output' => $output, 'status' => $status];
    }

    /**
     * @param $attrname
     * @param array $editableOptions
     * @param null $label
     * @return array
     */
    public static function getEditableGridCol($attrname, $editableOptions = [], $label = null)
    {
        $editableOptionsInit = [
            'asPopover' => false,
            'closeOnBlur' => true,
            'options' => ['style' => 'width: 80px; font-size: 1em;', 'class' => 'form-control-sm'],
            'inlineSettings' => [
                //'templateAfter' => '{buttons}',
                'templateAfter' => '',
            ],
            'formOptions' => [
                'action' => ['update-cell'],
            ],
        ];

        $editableOptions = ArrayHelper::merge($editableOptionsInit, $editableOptions);

        return [
            'class' => 'kartik\grid\EditableColumn',
            'label' => $label,
            'attribute' => $attrname,
            'editableOptions' => $editableOptions,
        ];
    }

    public static function appInfo()
    {
        $str = 'php:' . phpversion();
        $filename = \Yii::getAlias('@root/REVISION');
        if (is_file($filename)) {
            $str .= ' | build:' . date('Ymd-His', filemtime($filename));
        }

        $str .= ' | ' . date('Y-m-d H:i:s');

        return $str;
    }

    /**
     * @param $path
     * @return false|int
     */
    public static function isPict($path)
    {
        return preg_match('%\.(png|jpg|webp|gif)$%', $path);
    }

    /**
     * @param $filename
     * @return mixed|string
     */
    public static function makeFilenameUnique($filename)
    {
        if (!is_file($filename)) {
            return $filename;
        }

        $info = pathinfo($filename);

        $prefix = "{$info['dirname']}/{$info['filename']}-";
        $suffix = $info['extension'];
        $suffix = '.' . str_replace(['jpeg'], ['jpg'], $suffix);

        $i = 0;

        do {
            $filename = $prefix . (++$i) . $suffix;
        } while (is_file($filename));

        return $filename;
    }

    /**
     * @param $arg
     * @return String
     */
    public static function sqlFormatting($arg)
    {
        $sql = $arg;//todo allow query obj
        return \SqlFormatter::format($sql);
    }

    /**
     * @param $url
     * @return string|void
     */
    public static function urlToPath($url)
    {
        if (null === $url) {
            return;
        }
        $url = preg_replace('%^http(s?)://[^/]+%', '', $url);

        $url = trim($url, ' /');

        return '/' . $url;
    }

    /**
     * @param \yii\db\Query $q
     * @param $filename
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     * @throws \yii\db\Exception
     */
    public static function queryToExcel(\yii\db\Query $q, $filename)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->getStyle("A:Z")
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

        $rows = $q->createCommand()->queryAll();

        if ($rows) {
            $i = 1;

            foreach ($sheet->getColumnDimensions() as $v) {
                $v->setWidth(40);
                //echo "\n $i";
                if ($i++ >= count($rows[0])) {
                    break;
                }
            }

        }

        $sheet->fromArray($rows);

        /* Here there will be some code where you create $spreadsheet */

        // redirect output to client browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="myfile.xlsx"');
        header('Cache-Control: max-age=0');

        //$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        //return $writer->save('php://output');


        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save($filename);
    }

    /**
     * @param string $value
     * @return string
     */
    public static function checkStringType(string $value): string
    {
        if (preg_match('/^-?\d+$/', $value)) {
            return "int";
        } elseif (preg_match('/^-?\d+\.\d+$/', $value)) {
            return "float";
        } elseif (preg_match('/^-?\.\d+$/', $value)) {
            return "float";
        } else {
            return "string";
        }
    }
}
