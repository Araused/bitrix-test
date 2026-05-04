<?php

use Bitrix\Main\Type\DateTime;
use Bitrix\Main\Localization\Loc;

/* @var CMain $APPLICATION */
/* @var array $arParams */
/* @var array $arResult */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

Loc::loadMessages(__FILE__);
?>

<div class="currency-list-wrapper">
    <?php if (!empty($arResult["ITEMS"])): ?>
        <table class="table-currency">
            <thead>
                <tr>
                    <?php foreach ($arParams["SELECT_FIELDS"] as $field): ?>
                        <th><?= Loc::getMessage("MY_CURRENCY_LIST_" . $field) ?: $field ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($arResult["ITEMS"] as $item): ?>
                    <tr>
                        <?php foreach ($arParams["SELECT_FIELDS"] as $field): ?>
                            <td>
                                <?php if ($item[$field] instanceof DateTime): ?>
                                    <?= $item[$field]->toString() ?>
                                <?php else: ?>
                                    <?= $item[$field] ?>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p><?= Loc::getMessage("MY_CURRENCY_LIST_NOT_FOUND") ?></p>
    <?php endif; ?>

    <br>

    <?php $APPLICATION->IncludeComponent(
        "bitrix:main.pagenavigation",
        "",
        [
            "NAV_OBJECT" => $arResult["NAV"],
            "SEF_MODE" => "N",
        ],
        false
    ); ?>
</div>
