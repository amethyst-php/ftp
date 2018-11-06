<?php

namespace Railken\Amethyst\FtpResolvers;

use Railken\Amethyst\Models\File;
use Railken\Amethyst\Managers\FileGeneratorManager;

class FileGeneratorResolver extends BaseResolver
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
		$this->manager = new FileGeneratorManager();
	}

	/**
	 * Generate a file based on file
	 * 
	 * @param mixed $file
	 * @param array $data
	 *
	 * @return File
	 */
	public function resolve($file, array $data)
	{
		$fileGenerator = $this->manager->getRepository()->findOneById($file->id);

		$job = new \Railken\Amethyst\Jobs\FileGenerator\GenerateFile($fileGenerator, $data);
		$result = $job->generate();

		if (!$result->ok()) {
			throw new \Exception(json_encode($result->getSimpleErrors()));
		}

		return $result->getResource();
	}
}