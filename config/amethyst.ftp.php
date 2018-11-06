<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Data
    |--------------------------------------------------------------------------
    |
    | Here you can change the table name and the class components.
    |
    */
    'data' => [
        'ftp' => [
            'table'      => 'amethyst_ftp',
            'comment'    => 'Ftp',
            'model'      => Railken\Amethyst\Models\Ftp::class,
            'schema'     => Railken\Amethyst\Schemas\FtpSchema::class,
            'repository' => Railken\Amethyst\Repositories\FtpRepository::class,
            'serializer' => Railken\Amethyst\Serializers\FtpSerializer::class,
            'validator'  => Railken\Amethyst\Validators\FtpValidator::class,
            'authorizer' => Railken\Amethyst\Authorizers\FtpAuthorizer::class,
            'faker'      => Railken\Amethyst\Authorizers\FtpFaker::class,
            'manager'    => Railken\Amethyst\Authorizers\FtpManager::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Http configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the routes
    |
    */
    'http' => [
        'admin' => [
            'my-data' => [
                'enabled'     => true,
                'controller'  => Railken\Amethyst\Http\Controllers\Admin\FtpController::class,
                'router'      => [
                    'as'        => 'ftp.',
                    'prefix'    => '/ftps',
                ],
            ],
        ],
    ],
];
