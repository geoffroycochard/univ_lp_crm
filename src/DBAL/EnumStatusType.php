<?php
namespace App\DBAL;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;
use Doctrine\DBAL\Platforms\SqlitePlatform;
use Doctrine\DBAL\Platforms\SQLServerPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * Created by PhpStorm.
 * User: geoffroycochard
 * Date: 03/02/2020
 * Time: 12:45
 */

class EnumStatusType extends Type
{

    const ENUM_STATUS = 'enumstatus';

    const STATUS_OPEN = 'open';
    const STATUS_IN_PROGRESS = 'inprogress';
    const STATUS_WON = 'won';
    const STATUS_LOST = 'lost';

    /**
     * Gets the SQL declaration snippet for a field of this type.
     *
     * @param mixed[] $fieldDeclaration The field declaration.
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform The currently used database platform.
     *
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $values = \implode(
            ', ',
            \array_map(
                static function (string $value) {
                    return "'{$value}'";
                },
                static::getValues()
            )
        );

        switch (true) {
            case $platform instanceof SqlitePlatform:
                $sqlDeclaration = \sprintf('TEXT CHECK(%s IN (%s))', $fieldDeclaration['name'], $values);

                break;
            case $platform instanceof PostgreSqlPlatform:
            case $platform instanceof SQLServerPlatform:
                $sqlDeclaration = \sprintf('VARCHAR(255) CHECK(%s IN (%s))', $fieldDeclaration['name'], $values);

                break;
            default:
                $sqlDeclaration = \sprintf('ENUM(%s)', $values);
        }

        return $sqlDeclaration;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!in_array($value, array(self::STATUS_OPEN, self::STATUS_IN_PROGRESS, self::STATUS_WON, self::STATUS_LOST))) {
            throw new \InvalidArgumentException("Invalid status");
        }
        return $value;
    }

    /**
     * Get values for the ENUM field.
     *
     * @static
     *
     * @return string[] Values for the ENUM field
     */
    public static function getValues(): array
    {
        return [self::STATUS_OPEN, self::STATUS_IN_PROGRESS, self::STATUS_WON, self::STATUS_LOST ];
    }

    public static function getValuesForm()
    {
        return [
            'Ouvert' => self::STATUS_OPEN,
            'En cours' => self::STATUS_IN_PROGRESS,
            'Gagné' => self::STATUS_WON,
            'Perdu' => self::STATUS_LOST
        ];
    }

    /**
     * Gets the name of this type.
     *
     * @return string
     *
     * @todo Needed?
     */
    public function getName()
    {
        return self::ENUM_STATUS;
    }
}