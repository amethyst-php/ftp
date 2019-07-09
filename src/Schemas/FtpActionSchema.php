<?php

namespace Amethyst\Schemas;

use Amethyst\Contracts\FtpActionContract;
use Amethyst\Managers\DataBuilderManager;
use Amethyst\Managers\FtpManager;
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
                ->setRelationManager(FtpManager::class)
                ->setRequired(true),
            Attributes\BelongsToAttribute::make('data_builder_id')
                ->setRelationName('data_builder')
                ->setRelationManager(DataBuilderManager::class)
                ->setRequired(true),
            Attributes\ClassNameAttribute::make('class_name', [FtpActionContract::class])
                ->setRequired(true),
            Attributes\YamlAttribute::make('data'),
            Attributes\YamlAttribute::make('payload'),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}
