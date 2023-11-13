<?php

require "user.php";
require "address.php";
require "../globals/routes.php";

$routes = ["users", "address"];

function handleRoute()
{
    $route = $GLOBALS["filterRoute"];

    if ($route === "users") {
        return handleUser();
    }

    if ($route == "address") {
        return handleAddress();
    }
    
}

if (!in_array($filterRoute, $routes)) {
    http_response_code(404);
    return  exit;
} else {
    return handleRoute();
}
