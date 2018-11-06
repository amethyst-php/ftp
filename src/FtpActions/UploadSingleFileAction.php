<?php

namespace Railken\Amethyst\FtpActions;

class UploadSingleFileAction extends BaseAction
{
    public function handle()
    {
        $client = $this->newClient();
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
