<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;  /////(2)
use Zend\View\Model\JsonModel;
use Application\Entity\Score;

class ApiController extends AbstractActionController
{


	public function getScoresAction ()
	{
		$gateway = $this->getScoreTable();
		$scores = $gateway->fetchAll();
		
		$labels = array(
				
		);
		$data1 = array();
		$data2 = array();
		$data3 = array();
		$data4 = array();
		
		$dataset1 = array();
		$dataset2 = array();
		$dataset3 = array();
		$dataset4 = array();
		
		foreach ($scores as $score){
			$labels[] = $score->name;
			$data1[] = $score->q1;
			$data2[] = $score->q2;
			$data3[] = $score->q3;
			$data4[] = $score->q4;
			
		}
		$dataset1['data'] = $data1;
		$dataset2['data'] = $data2;
		$dataset3['data'] = $data3;
		$dataset4['data'] = $data4;
		
		return new JsonModel(
				array(
						'labels' => $labels,
						'datasets' => [$dataset1,$dataset2,$dataset3,$dataset4]
				));
	}
	public function getScoreTable() ////3th
	{
		$modelService= $this->getServiceLocator()
		->get('Application\Service\Model');
		$ScoreTable=$modelService->get('Application\Model\ScoreTable');
		return $ScoreTable;
	}
}