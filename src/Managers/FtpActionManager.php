<?php

namespace Amethyst\Managers;

use Amethyst\Common\ConfigurableManager;
use Amethyst\Models\FtpAction;
use Railken\Lem\Manager;

/**
 * @method \Amethyst\Models\FtpAction                 newEntity()
 * @method \Amethyst\Schemas\FtpActionSchema          getSchema()
 * @method \Amethyst\Repositories\FtpActionRepository getRepository()
 * @method \Amethyst\Serializers\FtpActionSerializer  getSerializer()
 * @method \Amethyst\Validators\FtpActionValidator    getValidator()
 * @method \Amethyst\Authorizers\FtpActionAuthorizer  getAuthorizer()
 */
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
     * @param FtpAction|int $ftpAction
     * @param array         $data
     *
     * @return \Railken\Lem\Contracts\ResultContract
     */
    public function execute($ftpAction, array $data = [])
    {
        $ftpAction = is_int($ftpAction) ? $this->getRepository()->findOneById($ftpAction) : $ftpAction;

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

    /**
     * Describe extra actions.
     *
     * @return array
     */
    public function getDescriptor()
    {
        return [
            'actions' => [
                'executor',
            ],
        ];
    }
}
