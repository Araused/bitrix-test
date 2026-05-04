<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;
use My\Currency\CurrencyTable;

if (!Loader::includeModule('my.currency')) {
    die('Модуль не установлен');
}

$currencies = ['USD', 'EUR', 'GBP', 'CNY'];
$count = 0;

for ($i = 0; $i < 10; $i++) {
    foreach ($currencies as $code) {
        $date = new DateTime();
        $date->add("-{$i} days");

        $result = CurrencyTable::add([
            'CODE' => $code,
            'COURSE' => rand(600000, 1000000) / 10000, // Случайный курс от 60 до 100
            'DATE' => $date,
        ]);

        if ($result->isSuccess()) {
            $count++;
        }
    }
}

echo "Успешно добавлено записей: {$count}";
