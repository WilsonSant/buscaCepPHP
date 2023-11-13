<?php

header("Access-Control-Allow-Origin:http://localhost:3000");
header("Access-Control-Allow-Headers: Content-Type");

$urlParts = explode("/", $_SERVER["REQUEST_URI"]);

$filterRoute = parse_url($urlParts[1], PHP_URL_PATH);

$argumentsString = parse_url($urlParts[1], PHP_URL_QUERY);

if ($argumentsString != null) {
    parse_str($argumentsString, $params);
}
$method = $_SERVER["REQUEST_METHOD"];