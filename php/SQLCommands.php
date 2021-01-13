<?php


interface SQLCommands {
    function runQuery($SQLQuery, $params): bool;
    function count($SQLQuery, $params): int;
    function columnExist($SQLQuery, $params): bool;
    function returnTable($SQLQuery, $params): array;
}