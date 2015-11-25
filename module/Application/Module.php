<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter;


class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        \Zend\Db\TableGateway\Feature\GlobalAdapterFeature::setStaticAdapter(
        $e->getApplication()->getServiceManager()->get('Zend\Db\Adapter\Adapter'));
        
        // running access check
       /*  $eventManager->attach(MvcEvent::EVENT_ROUTE,
        		function  ($e)
        		{
        			$login = $e->getRouter()->assemble(array(), array('name' => 'login'));
        			$match = $e->getRouteMatch();
        			$name = $match->getMatchedRouteName();
        			if ('profile' == $name){
        				$auth   = $e->getApplication()
        				->getServiceManager()
        				->get('Zend\Authentication\AuthenticationService');
        				if(false === $auth->hasIdentity())
        				{
        					$response = $e->getResponse();
        					$response->getHeaders()
        					->addHeaderLine('Location', $login);
        					$response->setStatusCode(302);
        					return $response;
        				}
        			}
        		}, - 100);
         */
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getServiceConfig ()
    {
    	return array(
    			'factories' => array(
    					'Application\Service\Model' => function  ($sm)
    					{
    						return new \Application\Service\Model();
    					},
    					'Zend\Authentication\AuthenticationService' => function  ($sm)
    					{
    						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    						$authAdapter = new CredentialTreatmentAdapter(
    								$dbAdapter, 'admin', 'username', 'password',
    								'MD5(?)');
    
    						$authService = new AuthenticationService();
    						$authService->setAdapter($authAdapter);
    						return $authService;
    					}
    			)
    	);
    }
    
//     public function getServiceConfig()
//     {
//     	return array(
//     			'factories' => array(
//     					'Application\Service\Model'    => function($sm) {
//     						return new \Application\Service\Model();
//     					}
//     			),
//     	);
//     }
    
//     public function getServiceConfig()
//     {
//     	return array(
//     			'factories' => array(
//     					'Application\Model\ProfileTable' =>  function($sm) {
//     						try {
//     							$tableGateway = $sm->get('ProfileTableGateway');
//     							$table = new \Application\Model\ProfileTable($tableGateway);
//     							return $table;
//     						}
//     						catch (\Exeption $e){
//     							var_dump($e->getMessages());exit;
//     						}
//     					},
//     					'ProfileTableGateway' => function ($sm) {
//     						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
//     						$resultSetPrototype = new ResultSet();
//     						$resultSetPrototype->setArrayObjectPrototype(
//     								new \Application\Entity\Profile());
//     						return new TableGateway(
//     								'profiles', $dbAdapter, null, $resultSetPrototype);
//     					},
//     			),
//     	);
//     }
    
}
