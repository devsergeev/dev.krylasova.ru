<?php

declare(strict_types=1);

namespace App\Seo\Entity\Tag;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use JetBrains\PhpStorm\Pure;

class TypeType extends StringType
{
    public const NAME = 'seo_tag_type';

    #[Pure]
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Type ? (string)$value : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Type
    {
        return !empty($value) ? new Type((string)$value) : null;
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
