<?php

namespace Amethyst\Fakers;

use Faker\Factory;
use Railken\Bag;
use Railken\Lem\Faker;

class FtpFaker extends Faker
{
    /**
     * @return \Railken\Bag
     */
    public function parameters()
    {
        $faker = Factory::create();

        $bag = new Bag();
        $bag->set('name', $faker->name);
        $bag->set('description', $faker->text);
        $bag->set('host', '127.0.0.1');
        $bag->set('ssl', false);
        $bag->set('passive', true);
        $bag->set('port', '21');
        $bag->set('username', 'root');
        $bag->set('password', 'root');

        return $bag;
    }
}
