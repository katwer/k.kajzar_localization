<?php

/*
 * @author: Katarzyna Kajzar <k.kajzar@gmail.com>
 * created 2015-07-04
 */

namespace Localization\Form;

use Zend\Form\Form;

class SearchForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('search');
        
        $this->setAttribute('method', 'POST');

        $this->add(array(
            'name' => 'address',
            'type' => 'Text',
            'attributes' => array(
                'required' => 'required',
                'placeholder' => 'type address here',
            ),
            'options' => array(
                'maxlenght' => '50',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Search',
            )
                )
        );

    }

}
