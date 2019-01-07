<?php

namespace Railken\Amethyst\FtpResolvers;

use Railken\Amethyst\Managers\ExporterManager;
use Railken\Amethyst\Models\File;

class ExporterResolver extends BaseResolver
{
    /**
     * @var \Railken\Amethyst\Managers\FileGeneratorManager
     */
    protected $manager;

    /**
     * Create a new instance.
     */
    public function __construct()
    {
        $this->manager = new ExporterManager();
    }

    /**
     * Generate a file based on file.
     *
     * @param mixed $file
     * @param array $data
     *
     * @return File
     */
    public function resolve($file, array $data)
    {
        $exporter = $this->manager->getRepository()->findOneById($file->id);

        $className = $exporter->class_name;

        if (!class_exists($className)) {
            throw new \Exception();
        }

        $job = new $className($exporter, $data);

        $result = $job->generate();

        if (!$result->ok()) {
            throw new \Exception(json_encode($result->getSimpleErrors()));
        }

        return $result->getResource();
    }
}
