<?php

/*
 * @author: Katarzyna Kajzar <k.kajzar@gmail.com>
 * created 2015-07-02
 */

namespace Localization\Form;

use Zend\Form\Form;

class CommentForm extends Form
{

    public function __construct($name = null)
    {
        parent::__construct('comment');
        
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        
        $this->add(array(
            'name' => 'localization_id',
            'type' => 'Hidden',
        ));
        
        $this->add(array(
            'name' => 'text',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Comment',
                'required' => 'required',
                'maxlenght' => '300',
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'Text',
            'attributes' => array(
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'E-mail',
                'maxlenght' => '45',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Send',
            )
                )
        );
    }

}
