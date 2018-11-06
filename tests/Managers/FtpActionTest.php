<?php

namespace Railken\Amethyst\Tests\Managers;

use Railken\Amethyst\Fakers\DataBuilderFaker;
use Railken\Amethyst\Fakers\ExporterFaker;
use Railken\Amethyst\Fakers\FileGeneratorFaker;
use Railken\Amethyst\Fakers\FtpActionFaker;
use Railken\Amethyst\Managers\DataBuilderManager;
use Railken\Amethyst\Managers\ExporterManager;
use Railken\Amethyst\Managers\FileGeneratorManager;
use Railken\Amethyst\Managers\FtpActionManager;
use Railken\Amethyst\Tests\BaseTest;
use Railken\Amethyst\Tests\DataBuilders\UserDataBuilder;
use Railken\Lem\Support\Testing\TestableBaseTrait;
use Railken\Amethyst\Fakers\UserFaker;
use Railken\Amethyst\Managers\UserManager;

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

    // Upload a custom file .html and custom export .xlsx
    public function testUploadFile()
    {
        $um = new UserManager();
        $um->createOrFail(UserFaker::make()->parameters());

        $dbm = new DataBuilderManager();

        $dataBuilder = $dbm->createOrFail(
            DataBuilderFaker::make()->parameters()
                ->set('class_name', UserDataBuilder::class)
                ->set('filter', 'id eq {{ id }}')
                ->set('data', [
                    'id' => [
                        'type'       => 'int',
                        'validation' => 'integer',
                    ],
                ])
        )->getResource();

        $fgm = new FileGeneratorManager();

        $fileGenerator = $fgm->createOrFail(
            FileGeneratorFaker::make()->parameters()
                ->remove('data_builder')->set('data_builder_id', $dataBuilder->id)
                ->set('body', '{{ users[0].id }}')
                ->set('filename', 'users.html')
                ->set('filetype', 'text/plain')
        )->getResource();

        $em = new ExporterManager();

        $exporter = $em->createOrFail(
            ExporterFaker::make()->parameters()
                ->remove('data_builder')->set('data_builder_id', $dataBuilder->id)
                ->set('body', [
                    'id' => '{{ user.id }}',
                ])
                ->set('class_name', \Railken\Amethyst\Jobs\GenerateExportXls::class)
        )->getResource();

        $ftpAction = $this->getManager()->createOrFail(
            $this->faker::make()->parameters()
            ->set('ftp.host', env('TEST_FTP_HOST', '127.0.0.1'))
            ->set('ftp.port', env('TEST_FTP_PORT', '21'))
            ->set('ftp.username', env('TEST_FTP_USERNAME', 'test'))
            ->set('ftp.password', env('TEST_FTP_PASSWORD', 'test'))
            ->set('data', [
                'id' => '{{ users[0].id }}'
            ])
            ->remove('data_builder')->set('data_builder_id', $dataBuilder->id)
            ->set('payload', [
                'files' => [
                    [
                        'class_name'  => \Railken\Amethyst\FtpResolvers\FileGeneratorResolver::class,
                        'id'          => $fileGenerator->id,
                        'destination' => '{{ "now"|date("d-m-Y") }}/{{ id }}.html',
                    ],
                    [
                        'class_name'  => \Railken\Amethyst\FtpResolvers\ExporterResolver::class,
                        'id'          => $exporter->id,
                        'destination' => '{{ "now"|date("d-m-Y") }}/{{ id }}.xlsx',
                    ],
                ],
            ])
        )->getResource();

        $this->getManager()->execute($ftpAction, ['id' => '1']);
    }
}
