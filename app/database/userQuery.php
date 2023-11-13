<?php

require "db.php";
require_once "utils.php";
require_once "../objects/Message.php";
require_once "../globals/user.php";
require_once "../globals/routes.php";

function queryCreateUser(User $user)
{
    $values = getUserValues($user);
    $table = $GLOBALS["userTable"];
    $columns = $GLOBALS["userColumns"];
    $verifyUser = queryUserByName($user);
    if (count($verifyUser) == 0) {
        $insertSuccess = queryInsertIntoDatabase($table, $columns, $values);
        $getUser = queryUserByName($user);
        $id = getId($getUser);
        returnMessage($insertSuccess, true, $id);
    } else {
        failedMessage();
    }
}

function queryUserByName(User $user)
{

    $userName = $user->userName;
    $table = $GLOBALS["userTable"];
    return queryGetFromDatabase($table, "userName", $userName);
}


function queryUserLogin(User $user)
{
    $firstCondition = "userName";
    $firstValue = $user->userName;
    $secondCondition = "password";
    $secondValue = $user->password;
    $table = $GLOBALS["userTable"];
    $data = (queryGetConditionFromDatabase($table, $firstCondition, $firstValue, $secondCondition, $secondValue));
    $id = getId($data);
    $onlyOneUserFound = count($data) == 1;
    returnMessage($onlyOneUserFound, true, $id);
}
