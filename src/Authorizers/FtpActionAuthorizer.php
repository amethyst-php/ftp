<?php

namespace Railken\Amethyst\Authorizers;

use Railken\Lem\Authorizer;
use Railken\Lem\Tokens;

class FtpActionAuthorizer extends Authorizer
{
    /**
     * List of all permissions.
     *
     * @var array
     */
    protected $permissions = [
        Tokens::PERMISSION_CREATE => 'ftp-action.create',
        Tokens::PERMISSION_UPDATE => 'ftp-action.update',
        Tokens::PERMISSION_SHOW   => 'ftp-action.show',
        Tokens::PERMISSION_REMOVE => 'ftp-action.remove',
    ];
}
