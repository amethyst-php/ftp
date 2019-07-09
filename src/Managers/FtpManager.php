<?php

namespace Amethyst\Managers;

use Amethyst\Common\ConfigurableManager;
use Railken\Lem\Manager;

class FtpManager extends Manager
{
    use ConfigurableManager;

    /**
     * @var string
     */
    protected $config = 'amethyst.ftp.data.ftp';
}
