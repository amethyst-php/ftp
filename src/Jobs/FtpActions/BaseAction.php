<?php

namespace Railken\Amethyst\FtpActions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use FtpClient\FtpClient;
use Railken\Amethyst\Contracts\FtpActionContract;
use Railken\Amethyst\Models\Ftp;
use Railken\Amethyst\Models\FtpAction;
use Railken\Lem\Contracts\AgentContract;

abstract class BaseAction implements ShouldQueue, FtpActionContract
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \Railken\Amethyst\Models\FtpAction
     */
    protected $ftpAction;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var \Railken\Lem\Contracts\AgentContract|null
     */
    protected $agent;

    /**
     * @param \Railken\Amethyst\Models\FtpAction $ftpAction
     * @param array                                $data
     * @param \Railken\Lem\Contracts\AgentContract $agent
     */
    public function __construct(FtpAction $ftpAction, array $data = [], AgentContract $agent = null)
    {
        $this->ftpAction = $ftpAction;
        $this->data = $data;
        $this->agent = $agent;
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
