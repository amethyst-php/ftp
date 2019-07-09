<?php

namespace Amethyst\FtpResolvers;

use Amethyst\Managers\ExporterManager;
use Amethyst\Models\File;

class ExporterResolver extends BaseResolver
{
    /**
     * @var \Amethyst\Managers\FileGeneratorManager
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
