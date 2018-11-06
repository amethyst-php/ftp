<?php

namespace Railken\Amethyst\Tests\Managers;

use Railken\Amethyst\Fakers\FtpFaker;
use Railken\Amethyst\Managers\FtpManager;
use Railken\Amethyst\Tests\BaseTest;
use Railken\Lem\Support\Testing\TestableBaseTrait;

class FtpTest extends BaseTest
{
    use TestableBaseTrait;

    /**
     * Manager class.
     *
     * @var string
     */
    protected $manager = FtpManager::class;

    /**
     * Faker class.
     *
     * @var string
     */
    protected $faker = FtpFaker::class;
}
