<?php

namespace App\Services;

/**
 * Class ServiceAbstract
 *
 * @package App\Services
 */
abstract class ServiceAbstract
{
    use ServiceLoggerTrait;

    /**
     * Service Type - (deliverable or support)
     *
     * @var string
     */
    protected $service_type;

    /**
     * Get Service Name
     *
     * @throws \Exception
     * @return mixed
     */
    public function getServiceName()
    {
        if (!isset($this->service_name)){
            throw new \Exception("Service Name not set in class:". get_called_class());
        }

        return strtolower($this->service_name);
    }

    /**
     * Set Service Name
     *
     * @param $name
     */
    public function setServiceName($name)
    {
        if (isset($this->service_name)) {
            $this->service_name = $name;
        }
    }

    /**
     * Get Service Type
     *
     * @return string
     * @throws \Exception
     */
    public function getServiceType()
    {
        return strtolower($this->service_type);
    }

    /**
     * Check if service type support
     *
     * @return string
     * @throws \Exception
     */
    public function isSupportService()
    {
        if ($this->getServiceType() != 'support') {
            return false;
        }

        return true;
    }

    /**
     * Check if service type support
     *
     * @return string
     * @throws \Exception
     */
    public function isDeliverableService()
    {
        if ($this->getServiceType() != 'deliverable') {
            return false;
        }

        return true;
    }
}