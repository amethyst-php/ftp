<?php

namespace Railken\Amethyst\Authorizers;

use Railken\Lem\Authorizer;
use Railken\Lem\Tokens;

class FtpAuthorizer extends Authorizer
{
    /**
     * List of all permissions.
     *
     * @var array
     */
    protected $permissions = [
        Tokens::PERMISSION_CREATE => 'ftp.create',
        Tokens::PERMISSION_UPDATE => 'ftp.update',
        Tokens::PERMISSION_SHOW   => 'ftp.show',
        Tokens::PERMISSION_REMOVE => 'ftp.remove',
    ];
}
