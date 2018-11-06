<?php

namespace Railken\Amethyst\FtpActions;

use FtpClient\FtpClient;
use Railken\Amethyst\Contracts\FtpActionContract;
use Railken\Amethyst\Models\Ftp;
use Railken\Amethyst\Models\FtpAction;

class BaseAction implements FtpActionContract
{
    /**
     * @var \Railken\Amethyst\Models\Ftp
     */
    protected $ftp;

    /**
     * @var \Railken\Amethyst\Models\FtpAction
     */
    protected $ftpAction;

    /**
     * @param \Railken\Amethyst\Models\Ftp       $ftp
     * @param \Railken\Amethyst\Models\FtpAction $ftpAction
     */
    public function __construct(Ftp $ftp, FtpAction $ftpAction)
    {
        $this->ftp = $ftp;
        $this->ftpAction = $ftpAction;
    }

    /**
     * Create a new ftp client.
     *
     * @return mixed
     */
    public function newClient()
    {
        $client = new FtpClient();

        $client->connect($this->ftp->host, true, intval($this->ftp->port));
        $client->login($this->ftp->username, $this->ftp->password);
        $client->pasv();

        return $client;
    }
}
