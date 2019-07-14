<?php

namespace Amethyst\Managers;

use Amethyst\Common\ConfigurableManager;
use Railken\Lem\Manager;

/**
 * @method \Amethyst\Models\Ftp                 newEntity()
 * @method \Amethyst\Schemas\FtpSchema          getSchema()
 * @method \Amethyst\Repositories\FtpRepository getRepository()
 * @method \Amethyst\Serializers\FtpSerializer  getSerializer()
 * @method \Amethyst\Validators\FtpValidator    getValidator()
 * @method \Amethyst\Authorizers\FtpAuthorizer  getAuthorizer()
 */
class FtpManager extends Manager
{
    use ConfigurableManager;

    /**
     * @var string
     */
    protected $config = 'amethyst.ftp.data.ftp';
}
