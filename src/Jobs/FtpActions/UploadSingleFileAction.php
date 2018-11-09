<?php

namespace Railken\Amethyst\Jobs\FtpActions;

use Railken\Amethyst\Events;
use Railken\Amethyst\Managers\DataBuilderManager;
use Railken\Template\Generators;
use Railken\Amethyst\Models\File;

class UploadSingleFileAction extends BaseAction
{   
    /**
     * Handle Action
     */
    public function handle()
    {
        $client = $this->newClient();

        $dbm = new DataBuilderManager();

        $result = $dbm->build($this->ftpAction->data_builder, $this->data);

        if (!$result->ok()) {
            return event(new Events\FtpActionExecutionFailed($this->ftpAction, $result->getErrors()[0], $this->agent));
        }

        $data = $result->getResource();

        $data = array_merge(
            $this->data,
            $data, 
            (array) json_decode(
                $this->generateAndRender(
                    (string) json_encode($this->ftpAction->data), $data
                )
            )
        );

        foreach ($this->ftpAction->payload->files as $file) {

            $this->handleFile($client, $file, $data);
        }

        event(new Events\FtpActionExecuted($this->ftpAction, $this->agent));
    }

    /**
     * Handle single file
     *
     * @param mixed $client
     * @param object $file
     * @param array $data
     */
    public function handleFile($client, $file, array $data)
    {
        $resolver = $file->class_name;

        if (!class_exists($resolver)) {
            throw new \Exception(sprintf("Undefined class %s", $resolver));
        }

        $resolver = new $resolver;

        $destination = $this->generateAndRender($file->destination, $data);

        if(!$client->isDir(dirname($destination))) {
            $client->mkdir(dirname($destination), true);
        }

        $client->put($destination, $this->downloadFile($resolver->resolve($file, $data)), FTP_BINARY);
    }

    /**
     * Generate and render
     *
     * @param string $content
     * @param array $data
     *
     * @return string
     */
    public function generateAndRender(string $content, array $data): string
    {
        $generator = new Generators\TextGenerator();

        return $generator->generateAndRender($content, $data);
    }

    /**
     * Download the file in a temporary directory
     *
     * @param File $file
     *
     * @return string
     */
    public function downloadFile(File $file): string
    {
        $tmpFile = tempnam(sys_get_temp_dir(), 'Tux');


        $url = $file->media[0]->disk === 's3' ? $file->media[0]->getTemporaryUrl(new \DateTime('+1 hour')) : $file->media[0]->getPath();

        file_put_contents($tmpFile, file_get_contents($url));

        return $tmpFile;
    }
}
