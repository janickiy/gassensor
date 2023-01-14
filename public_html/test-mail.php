<?php

exit;

$date = date('Y-m-d H:i:s');

$result = mail('rulon.rulon@gmail.com', "subj: $date", "msg: $date");

var_dump($result);