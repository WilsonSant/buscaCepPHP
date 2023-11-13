<?php

require_once "../utils.php";
require "../database/userQuery.php";
require "../globals/routes.php";


function handleUser()
{
    $method = $GLOBALS["method"];
    $createUser = function () {
        $user = (handleUserForm(null));
        return queryCreateUser($user);
    };

    $getUser = function () {
        $args = $GLOBALS["params"];
        $user =  handleUserForm($args);
        return queryUserLogin($user);
    };

    return mapRoute($method, $createUser, $getUser);
}
