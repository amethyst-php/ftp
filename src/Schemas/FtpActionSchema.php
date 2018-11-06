<?php

namespace Railken\Amethyst\Schemas;

use Railken\Amethyst\Managers\FtpManager;
use Railken\Lem\Attributes;
use Railken\Lem\Schema;

class FtpActionSchema extends Schema
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
            Attributes\BelongsToAttribute::make('ftp_id')
                ->setRelationName('ftp')
                ->setRelationManager(FtpManager::class),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}
