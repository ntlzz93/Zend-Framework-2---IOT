<?php
namespace Application\Entity;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Score implements InputFilterAwareInterface
{
    public $id;
    public $name;
    public $q1;
    public $q2;
    public $q3;
    public $q4;
    
    protected $inputFilter;
    
    public function exchangeArray($data)
    {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->q1 = (!empty($data['q1'])) ? $data['q1'] : null;
        $this->q2 = (!empty($data['q2'])) ? $data['q2'] : null;
        $this->q3 = (!empty($data['q3'])) ? $data['q3'] : null;
        $this->q4 = (!empty($data['q4'])) ? $data['q4'] : null;
    }

	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}
	
	public function getInputFilter()
	{
		if (!$this->inputFilter)
		{
			$inputFilter = new InputFilter();
	
			$inputFilter->add(array(
					'name'     => 'id',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			));
			$inputFilter->add(array(
					'name'     => 'name',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 100,
									),
							),
					),
			));
			$inputFilter->add(array(
					'q1'     => 'q1',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			));
			$inputFilter->add(array(
					'q2'     => 'q2',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			));
			$inputFilter->add(array(
					'q3'     => 'q3',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			));
			$inputFilter->add(array(
					'q4'     => 'q4',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			));
			$this->inputFilter = $inputFilter;
			}
			return $this->inputFilter;
			}
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}
				
		
				
}
