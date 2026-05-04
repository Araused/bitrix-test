<?php
/* @var CMain $APPLICATION */
?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>

<?php $APPLICATION->IncludeComponent(
    "my:currency.filter",
    "",
    ["FILTER_NAME" => "arrFilter"]
); ?>

<?php $APPLICATION->IncludeComponent(
    "my:currency.list",
    "",
    [
        "SELECT_FIELDS" => ["CODE", "COURSE", "DATE"],
        "PAGE_COUNT" => "10"
    ]
); ?>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>