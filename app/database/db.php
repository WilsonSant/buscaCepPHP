<?php

function queryInsertIntoDatabase($table, $columns, $values)
{
    $sql = ("insert into $table ($columns) values($values)");
    return handleDB("exec", $sql);
}

function queryGetFromDatabase($table, $condition, $value) {
    $sql = ("select rowId,* from $table where $condition = '$value'");
    return handleDB("query", $sql);
}

function queryGetConditionFromDatabase($table, $firstCondition, $firstValue, $secondCondition, $secondValue)
{
    $sql = "select rowId,* from $table where $firstCondition = '$firstValue' AND $secondCondition = '$secondValue'";
     return handleDB("query", $sql);
}

function handleDB(string $dbMethod, string $sql)
{
    $db = new SQLite3("../database/database.db");
    switch ($dbMethod) {
        case "exec":
            return $db->exec($sql);
            break;
        case "query":
            $result = $db->query($sql);
            return returnQueryDatabase($result);
            break;
    }
}
