<?php

namespace Amethyst\Fakers;

use Faker\Factory;
use Railken\Bag;
use Railken\Lem\Faker;

class FtpActionFaker extends Faker
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
        $bag->set('ftp', FtpFaker::make()->parameters()->toArray());
        $bag->set('data_builder', DataBuilderFaker::make()->parameters()->toArray());
        $bag->set('class_name', \Amethyst\Jobs\FtpActions\UploadSingleFileAction::class);
        $bag->set('data', [
            'id' => '{{ resource.id }}',
        ]);
        $bag->set('payload', [
            'files' => [
                [
                    'class_name'  => \Amethyst\FtpResolvers\FileGeneratorResolver::class,
                    'id'          => 1,
                    'destination' => '{{ id }}.txt',
                ],
            ],
        ]);

        return $bag;
    }
}
