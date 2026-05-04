<?php

use Bitrix\Main\ModuleManager;
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\IO\Directory;
use My\Currency\CurrencyTable;

class my_currency extends CModule
{
    public $MODULE_ID = 'my.currency';
    public $MODULE_VERSION = '1.0.0';
    public $MODULE_VERSION_DATE = '2026-04-30';
    public $MODULE_NAME = 'Курсы валют (Тестовое задание)';
    public $MODULE_DESCRIPTION = 'Модуль для управления курсами валют через ORM D7';

    public function DoInstall(): void
    {
        ModuleManager::registerModule($this->MODULE_ID);

        $this->InstallDB();
        $this->InstallFiles();
    }

    public function DoUninstall(): void
    {
        $this->UnInstallFiles();
        $this->UnInstallDB();

        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function InstallDB(): void
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            $entity = CurrencyTable::getEntity();
            $connection = Application::getConnection();

            if (!$connection->isTableExists($entity->getDBTableName())) {
                $entity->createDbTable();
            }
        }
    }

    public function UnInstallDB(): void
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            $entity = CurrencyTable::getEntity();
            $connection = Application::getConnection();

            if ($connection->isTableExists($entity->getDBTableName())) {
                $connection->dropTable($entity->getDBTableName());
            }
        }
    }

    public function InstallFiles(): void
    {
        CopyDirFiles(
            __DIR__ . "/components",
            Application::getDocumentRoot() . "/bitrix/components",
            true,
            true
        );
    }

    public function UnInstallFiles(): void
    {
        Directory::deleteDirectory(
            Application::getDocumentRoot() . "/bitrix/components/my/currency.list"
        );
        Directory::deleteDirectory(
            Application::getDocumentRoot() . "/bitrix/components/my/currency.filter"
        );
    }
}
