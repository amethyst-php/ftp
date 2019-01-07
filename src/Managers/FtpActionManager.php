<?php

namespace Railken\Amethyst\Managers;

use Railken\Amethyst\Common\ConfigurableManager;
use Railken\Amethyst\Models\FtpAction;
use Railken\Lem\Manager;

class FtpActionManager extends Manager
{
    use ConfigurableManager;

    /**
     * @var string
     */
    protected $config = 'amethyst.ftp.data.ftp-action';

    /**
     * Request a exporter.
     *
     * @param FtpAction $ftpAction
     * @param array     $data
     *
     * @return \Railken\Lem\Contracts\ResultContract
     */
    public function execute(FtpAction $ftpAction, array $data = [])
    {
        $result = (new DataBuilderManager())->validateRaw($ftpAction->data_builder, $data);

        if (!$result->ok()) {
            return $result;
        }

        // We assume this class exists.
        $className = $ftpAction->class_name;

        if (!class_exists($className)) {
            throw new \Exception();
        }

        dispatch(new $className($ftpAction, $data, $this->getAgent()));

        return $result;
    }
}
