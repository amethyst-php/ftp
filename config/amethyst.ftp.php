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
            'faker'      => Railken\Amethyst\Fakers\FtpFaker::class,
            'manager'    => Railken\Amethyst\Managers\FtpManager::class,
        ],
        'ftp-action' => [
            'table'      => 'amethyst_ftp_actions',
            'comment'    => 'Ftp Actions',
            'model'      => Railken\Amethyst\Models\FtpAction::class,
            'schema'     => Railken\Amethyst\Schemas\FtpActionSchema::class,
            'repository' => Railken\Amethyst\Repositories\FtpActionRepository::class,
            'serializer' => Railken\Amethyst\Serializers\FtpActionSerializer::class,
            'validator'  => Railken\Amethyst\Validators\FtpActionValidator::class,
            'authorizer' => Railken\Amethyst\Authorizers\FtpActionAuthorizer::class,
            'faker'      => Railken\Amethyst\Fakers\FtpActionFaker::class,
            'manager'    => Railken\Amethyst\Managers\FtpActionManager::class,
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
            'ftp' => [
                'enabled'     => true,
                'controller'  => Railken\Amethyst\Http\Controllers\Admin\FtpController::class,
                'router'      => [
                    'as'        => 'ftp.',
                    'prefix'    => '/ftp',
                ],
            ],
            'ftp-action' => [
                'enabled'     => true,
                'controller'  => Railken\Amethyst\Http\Controllers\Admin\FtpActionsController::class,
                'router'      => [
                    'as'        => 'ftp-action.',
                    'prefix'    => '/ftp-actions',
                ],
            ],
        ],
    ],
];
