<?php

namespace Amethyst\Jobs\FtpActions;

use Amethyst\Events;
use Amethyst\Managers\DataBuilderManager;
use Amethyst\Models\File;
use Railken\Template\Generators;
use Symfony\Component\Yaml\Yaml;

class UploadSingleFileAction extends BaseAction
{
    /**
     * Handle Action.
     */
    public function handle()
    {
        $dbm = new DataBuilderManager();

        $result = $dbm->build($this->ftpAction->data_builder, $this->data);

        if (!$result->ok()) {
            return event(new Events\FtpActionExecutionFailed($this->ftpAction, $result->getErrors()[0], $this->agent));
        }

        $data = $result->getResource();

        $data = array_merge(
            $this->data,
            $data,
            Yaml::parse(
                $this->generateAndRender(
                    $this->ftpAction->data, $data
                )
            )
        );

        $payload = json_decode(json_encode(Yaml::parse($this->ftpAction->payload)));

        foreach ($payload->files as $file) {
            $this->handleFile($file, $data);
        }

        event(new Events\FtpActionExecuted($this->ftpAction, $this->agent));
    }

    /**
     * Handle single file.
     *
     * @param object $file
     * @param array  $data
     */
    public function handleFile($file, array $data)
    {
        $resolver = $file->class_name;

        if (!class_exists($resolver)) {
            throw new \Exception(sprintf('Undefined class %s', $resolver));
        }

        $resolver = new $resolver();

        $destination = $this->generateAndRender($file->destination, $data);
        $source = $this->downloadFile($resolver->resolve($file, $data));

        $client = $this->newClient();

        if (!$client->isDir(dirname($destination))) {
            $client->mkdir(dirname($destination), true);
        }

        $client->put($destination, $source, FTP_BINARY);
        $client->close();
    }

    /**
     * Generate and render.
     *
     * @param string $content
     * @param array  $data
     *
     * @return string
     */
    public function generateAndRender(string $content, array $data): string
    {
        $generator = new Generators\TextGenerator();

        return $generator->generateAndRender($content, $data);
    }

    /**
     * Download the file in a temporary directory.
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
