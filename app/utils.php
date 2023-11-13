<?php

require "objects/User.php";
require_once "objects/Message.php";
require "objects/Address.php";

function mapRoute($method, $postRequest, $getRequest)
{
    switch ($method) {
        case "POST":
            $postRequest();
            break;
        case "GET":
            $getRequest();
            break;
    }
}

function createHashPassword(string $password)
{
    return password_hash($password, PASSWORD_BCRYPT);
}

function addressPostForm(Address $address)
{
    $data = json_decode(file_get_contents("php://input"), true);
    $address->cep = $data["cep"];
    $address->logradouro = $data["logradouro"];
    $address->complemento = $data["complemento"];
    $address->bairro = $data["bairro"];
    $address->localidade = $data["localidade"];
    $address->uf = $data["uf"];
    $address->ddd = $data["ddd"];
    $address->userId = $data["userId"];
    return ($address);
}

function userPOSTForm(User $user)
{
    $data = json_decode(file_get_contents("php://input"), true);
    $user->userName = $data["userName"];
    $user->password = $data["password"];
    return ($user);
}

function userGETForm(User $user, $args)
{
    $user->userName = $args['userName'];
    $user->password = $args['password'];
    return ($user);
}

function handleUserForm($args)
{
    $method = $GLOBALS["method"];
    $user = new User();
    $user->id = 0;
    switch ($method) {
        case "POST":
            return userPOSTForm($user);
            break;
        case "GET":
            return userGETForm($user, $args);
            break;
    }
}

function handleAddressForm($args)
{
    $method = $GLOBALS["method"];
    $address = new Address();
    $address->id = 0;
    switch ($method) {
        case "POST":
            return addressPostForm($address);
            break;
        case "GET":
            // return userGETForm($user, $args);
            // break;
    }
}
