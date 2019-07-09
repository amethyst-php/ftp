<?php

namespace Amethyst\Tests\Managers;

use Amethyst\Fakers\FtpFaker;
use Amethyst\Managers\FtpManager;
use Amethyst\Tests\BaseTest;
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
