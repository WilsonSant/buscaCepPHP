<?php

require_once "../utils.php";
require_once "../globals/routes.php";
require "../database/addressQuery.php";

function handleAddress()
{
    $method = $GLOBALS["method"];

    $createAddress = function () {
        $address = handleAddressForm(null);

        return queryCreateAddress($address);
    };

    $getAddress = function () {
        $args = $GLOBALS["params"];
        $address = new Address();
        $address->userId = $args["userId"];
        return queryAddressByUser($address);
    };

    return mapRoute($method, $createAddress, $getAddress);
}
