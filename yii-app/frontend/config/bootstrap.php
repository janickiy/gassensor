<?php


function dbg_p($value, $var = false) {
    $isdbg = defined('DBG_PROD');
    if (!$isdbg) {
        return;
    }
    if ($var) {
        ob_start();
        var_dump($value);
        $v = ob_get_clean();
    } else {
        $v = print_r($value, true);
    }
    echo "<pre>" . $v . "</pre>";
    exit;
}