<?php

/*
 * @author: Katarzyna Kajzar <k.kajzar@gmail.com>
 * created 2015-07-01
 */

namespace Localization\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class CommentTable
{

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /*
     * @param int $localization_id
     * 
     */

    public function getByLocalization($localization_id)
    {
        // get comments to localization order by created_time
        (int) $localization_id;
        $sql = $this->tableGateway->getSql();
        $select = new Select();
        $select->from($this->tableGateway->getTable());
        $select->where("`localization_id` = $localization_id");
        $select->order('created_time DESC');
        return $this->tableGateway->selectWith($select);
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    /*
     * @param integer $id
     * 
     * @throw \Exception("Could not find row $id");
     */

    public function getComment($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveComment(Comment $comment)
    {
        $data = array(
            'id' => $comment->id,
            'localization_id' => $comment->localization_id,
            'text' => $comment->text,
            'email' => $comment->email,
            'created_time' => $comment->created_time,
        );

        $id = (int) $comment->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getComment($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Comment id does not exist');
            }
        }
    }

    public function deleteComment($id)
    {
        (int) $id;
        $this->tableGateway->delete(array('id' => $id));
    }

}
