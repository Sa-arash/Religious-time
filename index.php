<?php
require_once realpath('vendor/autoload.php');
use SaArash\ReligiousTime\Religious\Religious;
$birjand = new Religious('مشهد');
echo($birjand->getReligious());