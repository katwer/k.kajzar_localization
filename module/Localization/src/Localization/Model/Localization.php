<?php

/*
 * @author: Katarzyna Kajzar <k.kajzar@gmail.com>
 * created 2015-07-01
 */

namespace Localization\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\Callback;
 
class Localization implements InputFilterAwareInterface
{

    public $id;
    public $name;
    public $description;
    public $address;
    public $email;
    public $date_from;
    public $date_to;
    public $lat;
    public $lng;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->description = (!empty($data['description'])) ? $data['description'] : null;
        $this->address = (!empty($data['address'])) ? $data['address'] : null;
        $this->email = (!empty($data['email'])) ? $data['email'] : null;
        $this->date_from = (!empty($data['date_from'])) ? $data['date_from'] : null;
        $this->date_to = (!empty($data['date_to'])) ? $data['date_to'] : null;
        $this->lat = (!empty($data['lat'])) ? $data['lat'] : null;
        $this->lng = (!empty($data['lng'])) ? $data['lng'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name' => 'id',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'name',
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
                            'max' => 50,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'description',
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

            $inputFilter->add(array(
                'name' => 'address',
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
                            'max' => 50,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'email',
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
                            'max' => 50,
                        ),
                    ),
                    array(
                        'name' => 'EmailAddress',
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'date_from',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'Date',
                    ),
                    array(
                        'name' => 'Callback',
                        'options' => array(
                            'message' => array(
                                Callback::INVALID_VALUE => 'Date should not be earlier than 7 days from today\'s day',
                            ),
                            // date must be earlier than 7 days from today
                            'callback' => function($value) {
                                            $today = new \DateTime();
                                            $today->modify('+6 days');
                                            $dateF = \DateTime::createFromFormat("Y-m-d", $value);
                                            return $dateF->getTimestamp() > $today->getTimestamp();
                                        },
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'date_to',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'Date',
                    ),
                    array(
                        'name' => 'Callback',
                        'options' => array(
                            'message' => array(
                                Callback::INVALID_VALUE => 'Invalid period is given.',
                            ),
                                // date to must be at least one day later date to
                            'callback' => function($value, $context = array()) {
                                $dFrom = \DateTime::createFromFormat("Y-m-d", $context['date_from']);
                                $dTo = \DateTime::createFromFormat("Y-m-d", $value);
                                return $dFrom->getTimestamp() < $dTo->getTimestamp();
                    },
                        ),
                    ),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
