<?php

namespace Railken\Amethyst\Events;

use Illuminate\Queue\SerializesModels;
use Railken\Amethyst\Models\FtpAction;
use Railken\Lem\Contracts\AgentContract;

class FtpActionExecuted
{
    use SerializesModels;

    public $ftpAction;
    public $agent;

    /**
     * Create a new event instance.
     *
     * @param \Railken\Amethyst\Models\FtpAction   $ftpAction
     * @param \Railken\Lem\Contracts\AgentContract $agent
     */
    public function __construct(FtpAction $ftpAction, AgentContract $agent = null)
    {
        $this->generator = $ftpAction;
        $this->agent = $agent;
    }
}
