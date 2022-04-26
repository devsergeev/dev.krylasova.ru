<?php

declare(strict_types=1);

namespace App\Seo\Entity\Template;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class RequiredType extends StringType
{
    public const NAME = 'seo_template_required_type';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Required ? $value->toJson() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Required
    {
        return !empty($value) ? Required::fromJson($value) : null;
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
