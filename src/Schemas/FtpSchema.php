<?php

namespace Amethyst\Schemas;

use Railken\Lem\Attributes;
use Railken\Lem\Schema;

class FtpSchema extends Schema
{
    /**
     * Get all the attributes.
     *
     * @var array
     */
    public function getAttributes()
    {
        return [
            Attributes\IdAttribute::make(),
            Attributes\TextAttribute::make('name')
                ->setRequired(true)
                ->setUnique(true),
            Attributes\LongTextAttribute::make('description'),
            Attributes\TextAttribute::make('host')
                ->setRequired(true),
            Attributes\BooleanAttribute::make('ssl'),
            Attributes\BooleanAttribute::make('passive'),
            Attributes\TextAttribute::make('port')
                ->setRequired(true),
            Attributes\TextAttribute::make('username')
                ->setRequired(true),
            Attributes\TextAttribute::make('password')
                ->setRequired(true),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}
