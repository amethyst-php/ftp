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
            'model'      => Amethyst\Models\Ftp::class,
            'schema'     => Amethyst\Schemas\FtpSchema::class,
            'repository' => Amethyst\Repositories\FtpRepository::class,
            'serializer' => Amethyst\Serializers\FtpSerializer::class,
            'validator'  => Amethyst\Validators\FtpValidator::class,
            'authorizer' => Amethyst\Authorizers\FtpAuthorizer::class,
            'faker'      => Amethyst\Fakers\FtpFaker::class,
            'manager'    => Amethyst\Managers\FtpManager::class,
        ],
        'ftp-action' => [
            'table'      => 'amethyst_ftp_actions',
            'comment'    => 'Ftp Actions',
            'model'      => Amethyst\Models\FtpAction::class,
            'schema'     => Amethyst\Schemas\FtpActionSchema::class,
            'repository' => Amethyst\Repositories\FtpActionRepository::class,
            'serializer' => Amethyst\Serializers\FtpActionSerializer::class,
            'validator'  => Amethyst\Validators\FtpActionValidator::class,
            'authorizer' => Amethyst\Authorizers\FtpActionAuthorizer::class,
            'faker'      => Amethyst\Fakers\FtpActionFaker::class,
            'manager'    => Amethyst\Managers\FtpActionManager::class,
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
                'enabled'    => true,
                'controller' => Amethyst\Http\Controllers\Admin\FtpController::class,
                'router'     => [
                    'as'     => 'ftp.',
                    'prefix' => '/ftp',
                ],
            ],
            'ftp-action' => [
                'enabled'    => true,
                'controller' => Amethyst\Http\Controllers\Admin\FtpActionsController::class,
                'router'     => [
                    'as'     => 'ftp-action.',
                    'prefix' => '/ftp-actions',
                ],
            ],
        ],
    ],
];
