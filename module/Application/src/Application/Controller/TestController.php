<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

Class TestController extends AbstractActionController
{
    public function indexAction()   {
    	echo "test::index()";
    	exit;
    }

    public function testAction()    {

        $profile	= new \stdClass();
        $profile->name	= 'Hue'; // replace with your name
        $profile->org	= 'DHTL'; // again, replace
        return new ViewModel(array(
        		'profile'	=> $profile
        ));
    }
    public function listAction()
    {
    	$gateway	= $this->getServiceLocator()->get('Application\Model\ProfileTable');
    	$profiles	= $gateway->fetchAll();
    	return new ViewModel(array(
    			'profiles'=>$profiles
    	));
    }
    
}
