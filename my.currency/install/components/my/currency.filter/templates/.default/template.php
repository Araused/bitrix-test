<?php

use Bitrix\Main\Localization\Loc;

/* @var CMain $APPLICATION */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

Loc::loadMessages(__FILE__);
?>

<div class="currency-filter">
    <form method="get" action="<?= $APPLICATION->GetCurPage() ?>">
        <strong><?= Loc::getMessage("MY_CURRENCY_FILTER_NAME") ?></strong><br><br>

        <label><?= Loc::getMessage("MY_CURRENCY_FILTER_CODE") ?>:</label>
        <br>
        <input type="text" name="code" value="<?= htmlspecialcharsbx($_GET['code']) ?>">

        <br><br>

        <label><?= Loc::getMessage("MY_CURRENCY_COURSE") ?>:</label>
        <br>
        <?= Loc::getMessage("MY_CURRENCY_COURSE_FROM") ?>
        <input type="number" step="0.0001" name="course_from" value="<?= htmlspecialcharsbx($_GET['course_from']) ?>">
        <?= Loc::getMessage("MY_CURRENCY_COURSE_TO") ?>
        <input type="number" step="0.0001" name="course_to" value="<?= htmlspecialcharsbx($_GET['course_to']) ?>">

        <br><br>

        <label><?= Loc::getMessage("MY_CURRENCY_DATE") ?>:</label>
        <br>
        <?= Loc::getMessage("MY_CURRENCY_DATE_FROM") ?>
        <input type="date" name="date_from" value="<?= htmlspecialcharsbx($_GET['date_from']) ?>">
        <?= Loc::getMessage("MY_CURRENCY_DATE_TO") ?>
        <input type="date" name="date_to" value="<?= htmlspecialcharsbx($_GET['date_to']) ?>">

        <br><br>

        <input class="currency-filter-submit" type="submit" name="set_filter" value="<?= Loc::getMessage("MY_CURRENCY_SUBMIT_FORM") ?>">
        <a href="<?= $APPLICATION->GetCurPage() ?>" class="currency-filter-reset">
            <?= Loc::getMessage("MY_CURRENCY_CLEAR_FORM") ?>
        </a>
    </form>
</div>
