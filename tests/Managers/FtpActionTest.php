<?php

namespace Railken\Amethyst\Tests\Managers;

use Railken\Amethyst\Fakers\FtpActionFaker;
use Railken\Amethyst\Managers\FtpActionManager;
use Railken\Amethyst\Tests\BaseTest;
use Railken\Lem\Support\Testing\TestableBaseTrait;

class FtpActionTest extends BaseTest
{
    use TestableBaseTrait;

    /**
     * Manager class.
     *
     * @var string
     */
    protected $manager = FtpActionManager::class;

    /**
     * Faker class.
     *
     * @var string
     */
    protected $faker = FtpActionFaker::class;
}
