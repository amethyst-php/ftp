<?php

namespace Amethyst\FtpResolvers;

use Amethyst\Managers\FileGeneratorManager;
use Amethyst\Models\File;

class FileGeneratorResolver extends BaseResolver
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
        $this->manager = new FileGeneratorManager();
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
        $fileGenerator = $this->manager->getRepository()->findOneById($file->id);

        $job = new \Amethyst\Jobs\FileGenerator\GenerateFile($fileGenerator, $data);
        $result = $job->generate();

        if (!$result->ok()) {
            throw new \Exception(json_encode($result->getSimpleErrors()));
        }

        return $result->getResource();
    }
}
