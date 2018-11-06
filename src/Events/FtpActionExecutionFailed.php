<?php

namespace Railken\Amethyst\Events\FtpAction;

use Exception;
use Illuminate\Queue\SerializesModels;
use Railken\Amethyst\Models\FtpAction;
use Railken\Lem\Contracts\AgentContract;

class FtpActionExecutionFailed
{
    use SerializesModels;

    public $ftpAction;
    public $error;
    public $agent;

    /**
     * Create a new event instance.
     *
     * @param \Railken\Amethyst\Models\FtpAction   $ftpAction
     * @param \Exception                           $exception
     * @param \Railken\Lem\Contracts\AgentContract $agent
     */
    public function __construct(FtpAction $ftpAction, Exception $exception, AgentContract $agent = null)
    {
        $this->generator = $ftpAction;
        $this->error = (object) [
            'class'   => get_class($exception),
            'message' => $exception->getMessage(),
        ];

        $this->agent = $agent;
    }
}
