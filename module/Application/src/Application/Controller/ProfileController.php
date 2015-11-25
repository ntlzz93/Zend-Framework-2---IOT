<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Form;
use Zend\Form\Element;
use Application\Entity\Profile;
use Application\Form\User;

Class ProfileController extends AbstractActionController
{
	public  function scoresAction()
	{
		
	}
    public function indexAction()   {
    	$gateway	=$this-> getProfileTable();
    	$profiles	= $gateway->fetchAll();
    	return new ViewModel(array(
    			'profiles'=>$profiles
    	));
    }
    public function addAction()
    {
    	$form    = new User();
    	$request    = $this->getRequest();
    	if ($request->isPost())
    	{
    		$entity    = new Profile();
    		$form->setInputFilter($entity->getInputFilter());
    	
    		$form->setData($request->getPost());
    		if ($form->isValid())
    		{
    			$entity->exchangeArray($form->getData());
    			$table    = $this->getProfileTable()
    			->save($entity);
    			return $this->redirect()->toRoute('profile');
    		}
    	}
    	
    	return new ViewModel(array(
    			'form'    => $form
    	));
    }
    	 
    public function editAction()
    {
    	$id = (int) $this->params('id', 0);
    	if (!$id)
    	{
    		return $this->redirect()->toRoute('profile', array(
    				'action' => 'add'
    		));
    	}
    
    	$table    =$this-> getProfileTable();
    	try
    	{
    		$profile    = $table->get($id);
    	}
    	catch (\Exception $ex)
    	{
    		return $this->redirect()->toRoute('profile');
    	}
    
    	$form  = new \Application\Form\User();
    	$form->bind($profile);
    
    	$request = $this->getRequest();
    	if ($request->isPost())
    	{
    		$form->setInputFilter($profile->getInputFilter());
    		$form->setData($request->getPost());
    
    		if ($form->isValid())
    		{
    			$table->save($profile);
    			return $this->redirect()->toRoute('profile');
    		}
    	}
    
    	return new ViewModel(array(
    			'id' => $id,
    			'form' => $form,
    	));
    }

    public function deleteAction()
    {
    	$id = (int) $this->params('id', 0);
    	if (!$id)
    	{
    		return $this->redirect()->toRoute('profile');
    	}
    	 
    	$table    =$this-> getProfileTable();
    	$profile = $table->get($id);
    
    	$request = $this->getRequest();
    	if ($request->isPost())
    	{
    		if ('Yes' == $request->getPost('confirm', 'No'))
    		{
    			$id = (int) $request->getPost('id');
    			$table->delete($id);
    		}
    		return $this->redirect()->toRoute('profile');
    	}
    
    	return new ViewModel(array(
    			'profile' => $profile
    	));
    }
    protected function getProfileTable()
    {
    	return $this->getServiceLocator()
            ->get('Application\Service\Model')
            ->get('Application\Model\ProfileTable');
    	
    }
    
    
}
