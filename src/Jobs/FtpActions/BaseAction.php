<?php

namespace Railken\Amethyst\Jobs\FtpActions;

use FtpClient\FtpClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Railken\Amethyst\Contracts\FtpActionContract;
use Railken\Amethyst\Models\Ftp;
use Railken\Amethyst\Models\FtpAction;
use Railken\Lem\Contracts\AgentContract;

abstract class BaseAction implements ShouldQueue, FtpActionContract
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

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
     * @param \Railken\Amethyst\Models\FtpAction   $ftpAction
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
        $ftp = $this->ftpAction->ftp;

        $client = new FtpClient();

        $client->connect($ftp->host, (bool) $ftp->ssl, intval($ftp->port));
        $client->login($ftp->username, $ftp->password);

        if ($ftp->passive) {
            $client->pasv(true);
        }

        return $client;
    }
}
