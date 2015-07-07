<?php

/*
* @author: Katarzyna Kajzar <k.kajzar@gmail.com>
* created 2015-07-01
*/

namespace Localization\Form;

 use Zend\Form\Form;

 class LocalizationForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('localization');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         
         $this->add(array(
             'name' => 'name',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Name',
                 'maxlenght' => '50',
             ),
         ));
         
         $this->add(array(
             'name' => 'description',
             'type' => 'Textarea',
             'options' => array(
                 'label' => 'Description',
                 'maxlenght' => '300',
             ),
         ));

         $this->add(array(
             'name' => 'address',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Address',
                 'maxlenght' => '50',
             ),
         ));

         $this->add(array(
             'name' => 'email',
             'type' => 'Email',
             'options' => array(
                 'label' => 'Email',
             ),
         ));

         $date = new \DateTime();
         $date = $date->modify('+7 days');
         $this->add(array(
             'name' => 'date_from',
             'type' => 'Date',
             'options' => array(
                 'label' => 'From',
             ),
             'attributes' => array(
                 'min' => $date->format('Y-m-d'),
                 'step' => '1',
             ),
         ));

         $date = $date->modify('+1 days');
         $this->add(array(
             'name' => 'date_to',
             'type' => 'Date',
             'options' => array(
                 'label' => 'To',
             ),
             'attributes' => array(
                 'min' => $date->format('Y-m-d'),
                 'step' => '1',
             ),
         ));
         
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Add',
                 'id' => 'submitbutton',
             ),
         ));

     }
 }