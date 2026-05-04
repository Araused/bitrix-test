<?php

use Bitrix\Main\Application;
use Bitrix\Main\Type\DateTime;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class CurrencyFilterComponent extends \CBitrixComponent
{
    public function executeComponent()
    {
        $filterName = $this->arParams["FILTER_NAME"] ?: 'arrFilter';
        $request = Application::getInstance()->getContext()->getRequest();

        $filter = [];

        if ($request->get('set_filter') !== null) {
            if (!empty($_GET['code'])) {
                $filter['=CODE'] = trim($_GET['code']);
            }

            if (!empty($_GET['course_from'])) {
                $filter['>=COURSE'] = (float) $_GET['course_from'];
            }

            if (!empty($_GET['course_to'])) {
                $filter['<=COURSE'] = (float) $_GET['course_to'];
            }

            try {
                if (!empty($_GET['date_from'])) {
                    $filter['>=DATE'] = new DateTime(
                        $_GET['date_from'] . " 00:00:00",
                        "Y-m-d H:i:s"
                    );
                }

                if (!empty($_GET['date_to'])) {
                    $filter['<=DATE'] = new DateTime(
                        $_GET['date_to'] . " 23:59:59",
                        "Y-m-d H:i:s"
                    );
                }
            } catch (\Exception $e) {
                // Если дата введена некорректно - пропускаем их обработку
            }

            $GLOBALS[$filterName] = $filter;
        }

        $this->includeComponentTemplate();
    }
}
