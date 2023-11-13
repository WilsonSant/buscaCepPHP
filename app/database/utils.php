<?php

require_once "../utils.php";
require_once "../objects/Message.php";

function getUserValues(User $user)
{
    $userName = $user->userName;
    $password = $user->password;
    return "'$userName', '$password'";
}

function getAddressValues(Address $address)
{
    $cep = $address->cep;
    $logradouro = $address->logradouro;
    $complemento = $address->complemento;
    $bairro = $address->bairro;
    $localidade = $address->localidade;
    $uf = $address->uf;
    $ddd = $address->ddd;
    $userId = $address->userId;
    return "'$cep', '$logradouro', '$complemento', '$bairro', '$localidade','$uf', '$ddd','$userId'";
}

function returnQueryDatabase($result)
{
    $data = [];
    while ($items = $result->fetchArray(SQLITE3_ASSOC)) {
        array_push($data, $items);
    }
    return $data;
}

function getId($data)
{
    if (count($data) > 0) {
        $id = $data[0]['rowid'];
        return ['id' => $id];
    } else {
        return [];
    }
}

function returnMessage(bool $condition, bool $showData, $data)
{
    $message = new Message();
    if ($condition) {
        $message->success = true;
        if ($showData) {
            $message->data = $data;
        }
    } else {
        $message->success = false;
    }
    echoJsonMessage($message);
}

function failedMessage()
{
    $message = new Message();
    $message->success = false;
    echoJsonMessage($message);
}

function echoJsonMessage(Message $message)
{
    echo (json_encode($message));
}
