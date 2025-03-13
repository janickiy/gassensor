<?php

$date = date('Y-m-d H:i:s');

$result = mail('janickiy@mail.ru', "subj: $date", "msg: $date");

var_dump($result);