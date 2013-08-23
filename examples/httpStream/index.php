<?php

include "../../IO.lib.php";

$is = new FileInputStream("text.txt");
$http_os = new HttpSingleOutputStream();

while ($is->available()) {
  $http_os->write($is->read(1024), 1024);
}
