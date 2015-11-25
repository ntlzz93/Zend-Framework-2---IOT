<?php
namespace Application\Model;
use Application\Entity\Score;

class ScoreTable extends ModelTable
{
    protected $tableGatewayClass = '\Application\Db\ScoreTableGateway';
    
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }   
    public function get($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }
}