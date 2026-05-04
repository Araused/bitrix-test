<?php

namespace My\Currency;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\FloatField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;

class CurrencyTable extends DataManager
{
    public static function getTableName(): string
    {
        return 'my_currency';
    }

    public static function getMap(): array
    {
        return [
            new IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),
            new StringField('CODE', [
                'required' => true,
                'validation' => function (): array {
                    return [new LengthValidator(3, 3)];
                },
            ]),
            new DatetimeField('DATE', [
                'required' => true,
            ]),
            new FloatField('COURSE', [
                'required' => true,
                'scale' => 4,
            ]),
        ];
    }
}
