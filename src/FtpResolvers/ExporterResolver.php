<?php

namespace Railken\Amethyst\FtpResolvers;

use Railken\Amethyst\Models\File;

class ExporterResolver extends BaseResolver
{	
	/**
	 * Generate an export based on file
	 * 
	 * @param mixed $file
	 *
	 * @return File
	 */
	public function resolve($file)
	{
		print_r($file);
	}
}