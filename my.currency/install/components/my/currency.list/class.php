<?php

use Bitrix\Main\Loader;
use Bitrix\Main\UI\PageNavigation;
use My\Currency\CurrencyTable;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class CurrencyListComponent extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams): array
    {
        $arParams["PAGE_COUNT"] = (int) ($arParams["PAGE_COUNT"] ?: 10);
        $arParams["FILTER_NAME"] = trim($arParams["FILTER_NAME"]) ?: 'arrFilter';

        if (empty($arParams["SELECT_FIELDS"])) {
            $arParams["SELECT_FIELDS"] = [
                'ID',
                'CODE',
                'DATE',
                'COURSE',
            ];
        }

        return $arParams;
    }

    public function executeComponent(): void
    {
        if (!Loader::includeModule("my.currency")) {
            ShowError("Модуль my.currency не установлен");
            return;
        }

        $nav = new PageNavigation("nav-currency");
        $nav->allowAllRecords(true)
            ->setPageSize($this->arParams["PAGE_COUNT"])
            ->initFromUri();

        $globalFilter = $GLOBALS[$this->arParams["FILTER_NAME"] ?: 'arrFilter'];
        $filter = is_array($globalFilter) ? $globalFilter : [];

        $dbRes = CurrencyTable::getList([
            'select' => $this->arParams["SELECT_FIELDS"],
            'filter' => $filter,
            'offset' => $nav->getOffset(),
            'limit' => $nav->getLimit(),
            'count_total' => true,
            'order' => ['DATE' => 'DESC'],
        ]);

        $nav->setRecordCount($dbRes->getCount());

        $this->arResult["ITEMS"] = $dbRes->fetchAll();
        $this->arResult["NAV"] = $nav;

        $this->includeComponentTemplate();
    }
}
