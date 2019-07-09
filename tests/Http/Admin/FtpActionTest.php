<?php

namespace Amethyst\Tests\Http\Admin;

use Amethyst\Api\Support\Testing\TestableBaseTrait;
use Amethyst\Fakers\FtpActionFaker;
use Amethyst\Tests\BaseTest;

class FtpActionTest extends BaseTest
{
    use TestableBaseTrait;

    /**
     * Faker class.
     *
     * @var string
     */
    protected $faker = FtpActionFaker::class;

    /**
     * Router group resource.
     *
     * @var string
     */
    protected $group = 'admin';

    /**
     * Route name.
     *
     * @var string
     */
    protected $route = 'admin.ftp-action';
}
