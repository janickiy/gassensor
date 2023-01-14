<?php

namespace common\helpers;

use yii\web\Response;

class CustomResponse extends Response
{
    protected function sendHeaders()
    {
        if (headers_sent($file, $line)) {
            return;
        }

        foreach ($this->getHeaders() as $name => $values) {
            $name = str_replace(' ', '-', ucwords(str_replace('-', ' ', $name)));
            // set replace for first occurrence of header but false afterwards to allow multiple
            $replace = true;
            foreach ($values as $value) {
                header("$name: $value", $replace);
                $replace = false;
            }
        }

        $statusCode = $this->getStatusCode();
        header("HTTP/{$this->version} {$statusCode} {$this->statusText}");
        $this->sendCookies();

    }

    protected function __sendCookies()
    {
        if (headers_sent($file, $line)) {
            return;
        }

        parent::sendCookies();
    }


}