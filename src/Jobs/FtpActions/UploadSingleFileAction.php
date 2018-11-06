<?php

namespace Railken\Amethyst\FtpActions;

use Railken\Amethyst\Managers\DataBuildermanager;
use Railken\Amethyst\Events;
use Railken\Template\Generators;

class UploadSingleFileAction extends BaseAction
{
    public function handle()
    {
        $client = $this->newClient();

        $dbm = new DataBuilderManager();

        $result = $dbm->build($this->ftpAction->data_builder, $this->data);

        if (!$result->ok()) {
            return event(new Events\FtpActionExecutionFailed($generator, $result->getErrors()[0], $this->agent));
        }

        $data = $result->getResource();

        $generator = new Generators\TextGenerator();

        $data = array_merge($data, (array) json_decode($generator->generateAndRender((string) json_encode($this->ftpAction->data), $data)));

        $client->put($this->getRemoteFile(), $this->getLocalFile(), FTP_BINARY);
    }

    public function getRemoteFile()
    {
        return '';
    }

    public function getLocalFile()
    {
        return '';
    }
}
