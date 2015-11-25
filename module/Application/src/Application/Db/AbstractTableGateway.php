<?php
namespace Application\Db;
use Zend\Db\TableGateway\AbstractTableGateway as ZendAbstractTableGateway;

use Zend\Db\TableGateway\Feature;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\TableIdentifier;

abstract class AbstractTableGateway extends ZendAbstractTableGateway
{
    public function __construct(AdapterInterface $adapter = null, Sql $sql = null)
    {
        if (!isset($this->table))
        {
            throw new \Exception(
                    'Table name must be set as a property $table');
        }
        
        if (null === $adapter)
        {
            $this->featureSet = new Feature\FeatureSet();
            $this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
            $this->initialize();
        }
        else
        {
            $this->adapter    = $adapter;
        }
        
        $resultSetPrototype    = new ResultSet();
        if (isset($this->entity))
        {
            $resultClass    = $this->entity;
            $resultSetPrototype->setArrayObjectPrototype(new $resultClass);
        }
        $this->resultSetPrototype = $resultSetPrototype;
        $this->sql = ($sql) ?: new Sql($this->getAdapter(), $this->table);

        // check sql object bound to same table
        if ($this->sql->getTable() != $this->table)
        {
            throw new \Exception(
                    'The table inside the provided Sql object must match the table of this TableGateway');
        }
    }
}
