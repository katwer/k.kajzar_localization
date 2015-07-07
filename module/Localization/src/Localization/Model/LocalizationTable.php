<?php

/*
 * @author: Katarzyna Kajzar <k.kajzar@gmail.com>
 * created 2015-07-01
 */

namespace Localization\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\Db\ResultSet\ResultSet;

class LocalizationTable
{

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll($paginated = false)
    {
        if ($paginated) {
            // create a new Select object for the table album
            $select = new Select('localization');
            // create a new result set based on the Localization entity
            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Localization());
            // create a new pagination adapter object
            $paginatorAdapter = new DbSelect(
                    // our configured select object
                    $select,
                    // the adapter to run it against
                    $this->tableGateway->getAdapter(),
                    // the result set to hydrate
                    $resultSetPrototype
            );
            $paginator = new Paginator($paginatorAdapter);
            return $paginator;
        }
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getLocalization($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveLocalization(Localization $localization)
    {
        $googleApi = \Lib\GoogleMapsApi::geocode($localization->address);

        if ($googleApi == false || $googleApi['status'] == 'ZERO_RESULTS') {
            throw new \Exception('Localization address is not recognized on google maps or we have no connect with Google API.');
        }
        $data = array(
            'id' => $localization->id,
            'name' => $localization->name,
            'description' => $localization->description,
            'email' => $localization->email,
            'date_from' => $localization->date_from,
            'date_to' => $localization->date_to,
        );
        $data = array_merge($data, $googleApi);
        unset($data['status']);

//  not use in this application, we haven't update action
//        $id = (int) $localization->id;
//        if ($id == 0) {
        $this->tableGateway->insert($data);
        return $this->tableGateway->lastInsertValue;
//        }
//        else {
//            if ($this->getLocalization($id)) {
//                $this->tableGateway->update($data, array('id' => $id));
//            } else {
//                throw new \Exception('Localization id does not exist');
//            }
//        }
    }

    /*
     * @param float $lat
     * @param float $lng
     * @param float $distance (in km)
     */

    public function getNearLocalizations($lat, $lng, $paginated = FALSE, $distance = 2)
    {
        // create a new Select object for the table album
        $select = new Select();
        $select->from($this->tableGateway->getTable());
        $select->columns(array(
            '*',
            "distance" => new \Zend\Db\Sql\Expression(
                    "(6371 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians(?) - radians(lng) ) + sin( radians(?) ) * sin( radians(lat) ) ))", array($lat, $lng, $lat)
            )
        ));
        $select->where("lat<>'' AND lng<>'' having distance < $distance");
        $select->order('distance DESC');

        if ($paginated) {
            // create a new result set based on the Album entity
            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new Localization());
            // create a new pagination adapter object
            $paginatorAdapter = new DbSelect(
                    // our configured select object
                    $select,
                    // the adapter to run it against
                    $this->tableGateway->getAdapter(),
                    // the result set to hydrate
                    $resultSetPrototype
            );
            $paginator = new Paginator($paginatorAdapter);
            return $paginator;
        }
        return $this->tableGateway->selectWith($select);
    }

//    public function getNearLocalizations($lat, $lng, $distance = 2)
//    {
//        $select = new Select();
//        $select->from($this->tableGateway->getTable());
//        $select->columns(array(
//            '*',
//            "distance" => new \Zend\Db\Sql\Expression(
//                    "(6371 * acos( cos( radians(?) ) * cos( radians( lat ) ) * cos( radians(?) - radians(lng) ) + sin( radians(?) ) * sin( radians(lat) ) ))", array($lat, $lng, $lat)
//            )
//        ));
//        $select->where("lat<>'' AND lng<>'' having distance < $distance");
//        $select->order('distance DESC');
//        return $this->tableGateway->selectWith($select);
//    }

    /* it's not use in application */
//     public function deleteLocalization($id)
//     {
//         $this->tableGateway->delete(array('id' => (int) $id));
//     }
}
