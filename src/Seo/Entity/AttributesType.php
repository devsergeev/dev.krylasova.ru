<?php

declare(strict_types=1);

namespace App\Seo\Entity;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class AttributesType extends StringType
{
    public const NAME = 'seo_attributes_type';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Attributes ? $value->toJson() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Attributes
    {
        return !empty($value) ? Attributes::fromJson($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
