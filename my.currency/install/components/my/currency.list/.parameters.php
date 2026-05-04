<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentParameters = [
    "PARAMETERS" => [
        "SELECT_FIELDS" => [
            "PARENT" => "BASE",
            "NAME" => "Поля для вывода",
            "TYPE" => "LIST",
            "MULTIPLE" => "Y",
            "VALUES" => [
                "ID" => "ID",
                "CODE" => "Код валюты",
                "DATE" => "Дата",
                "COURSE" => "Курс",
            ],
            "DEFAULT" => ["CODE", "DATE", "COURSE"],
        ],
        "PAGE_COUNT" => [
            "PARENT" => "BASE",
            "NAME" => "Количество элементов на странице",
            "TYPE" => "STRING",
            "DEFAULT" => "20",
        ],
        "FILTER_NAME" => [
            "PARENT" => "BASE",
            "NAME" => "Имя массива фильтра",
            "TYPE" => "STRING",
            "DEFAULT" => "arrFilter",
        ],
    ],
];
