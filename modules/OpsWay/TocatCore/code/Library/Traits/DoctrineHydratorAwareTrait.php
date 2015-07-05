<?php

namespace OpsWay\TocatCore\Library\Traits;

use Zend\Stdlib\Hydrator\HydratorInterface;

trait DoctrineHydratorAwareTrait
{
    /**
     * @var HydratorInterface;
     */
    protected $hydrator;

    public function setHydrator(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * @return HydratorInterface
     * @throws \LogicException
     */
    public function getHydrator()
    {
        if (!$this->hydrator) {
            throw new \LogicException('Hydrator has not been injected!');
        }

        return $this->hydrator;
    }

}
