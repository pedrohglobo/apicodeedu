<?php

namespace CodeOrders\V1\Abstracts;

use ZF\Rest\AbstractResourceListener;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ResourceAbstract extends AbstractResourceListener implements ServiceLocatorAwareInterface {

    protected $serviceLocator;
    
    protected $usuarioLogado;

    protected function getUsuarioLogado()
    {
        $userRepository = $this->getServiceLocator()->get('CodeOrders\V1\Rest\Users\UsersRepository');
        return $userRepository->findByUsername($this->getIdentity()->getRoleId());
    }
    
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator() {
        return $this->serviceLocator;
    }

} 