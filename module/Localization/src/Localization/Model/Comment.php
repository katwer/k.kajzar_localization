<?php

/*
 * @author: Katarzyna Kajzar <k.kajzar@gmail.com>
 * created 2015-07-01
 */

namespace Localization\Model;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use \Localization\Form\CommentFilter;

class Comment implements InputFilterAwareInterface
{

    public $id;
    public $localization_id;
    public $text;
    public $email;
    public $created_time;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->localization_id = (!empty($data['localization_id'])) ? $data['localization_id'] : null;
        $this->text = (!empty($data['text'])) ? $data['text'] : null;
        $this->email = (!empty($data['email'])) ? $data['email'] : null;
        $this->created_time = (!empty($data['created_time'])) ? $data['created_time'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        return new CommentFilter();
    }

}
