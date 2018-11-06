<?php

namespace Railken\Amethyst\Schemas;

use Railken\Amethyst\Contracts\FtpActionContract;
use Railken\Amethyst\Managers\DataBuilderManager;
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
            Attributes\BelongsToAttribute::make('data_builder_id')
                ->setRelationName('data_builder')
                ->setRelationManager(DataBuilderManager::class),
            Attributes\ClassNameAttribute::make('class_name', [FtpActionContract::class]),
            Attributes\ObjectAttribute::make('data'),
            Attributes\ObjectAttribute::make('payload'),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}
