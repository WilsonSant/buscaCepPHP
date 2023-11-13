<?php

require_once "../globals/address.php";

function queryCreateAddress(Address $address)
{
    $values = getAddressValues($address);
    $table = $GLOBALS["addressTable"];
    $columns = $GLOBALS["addressColumns"];
    $verifyAddress = queryAddressByCode($address);
    if (count($verifyAddress) == 0) {
        $insertSuccess = queryInsertIntoDatabase($table, $columns, $values);
        $getAddress = queryAddressByCode($address);
        $id = getId($getAddress);
        returnMessage($insertSuccess, true, $id);
    } else {
        failedMessage();
    }
}

function queryAddressByCode(Address $address)
{
    $cep = $address->cep;
    $userId = $address->userId;
    $table = $GLOBALS["addressTable"];
    return queryGetConditionFromDatabase($table, "cep", $cep, "userId", $userId);
}

function queryAddressByUser(Address $address) {
    $userId = $address->userId;
    $table = $GLOBALS["addressTable"];
    $data = queryGetFromDatabase($table, "userId", $userId);
    echo json_encode($data);
}