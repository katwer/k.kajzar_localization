<?php

/*
 * @author: Katarzyna Kajzar <k.kajzar@gmail.com>
 * created 2015-07-02
 */

namespace Localization\Form;

use Zend\InputFilter\InputFilter;

class CommentFilter extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'name' => 'email',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'EmailAddress',
                    'options' => array(
                        'domain' => true,
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name' => 'text',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 300,
                    ),
                ),
            ),
        ));
    }

}

?>