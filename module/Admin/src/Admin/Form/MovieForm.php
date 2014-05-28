<?php

namespace Admin\Form;

 use Zend\Form\Form;
 use Zend\InputFilter\InputFilterProviderInterface;
 use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
 use Doctrine\ORM\EntityManager;
use Zend\Validator\Regex as RegexValidator;
use Zend\Validator\ValidatorInterface;

 class MovieForm extends Form implements InputFilterProviderInterface
 {
    
    protected $entityManager;
    
    /**
    * @var ValidatorInterface
    */
    protected $validator;
    
    public function __construct(EntityManager $entityManager, $name = null)
    {
        parent::__construct($name);

        $hydrator = new DoctrineHydrator($entityManager, '\Movie\Entity\Movie');
        $this->setHydrator($hydrator);

        // ... set up elements here
 
         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'title',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Title',
             ),
         ));
         
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
     }
     
    public function getInputFilterSpecification()
    {
        return array(
            array(
                'name' => 'title',
                'required' => true,
                'filters' => array(
                     array('name' => 'Zend\Filter\StringTrim'),
                     array('name' => 'Zend\Filter\StringToLower'),
                 ),
                /*'validators' => array(
                    //array('name' => 'Special'),
                    $this->getValidator()
                ),*/
            ),
        );
        
        
        /*return array(
                'salary' => array(
                        'validators' => array(
                                new PayrollAccountingValidator($this)
                        )
                )
        );*/
    }
    
    /**
      * Get validator
      *
      * @return ValidatorInterface
      */
     protected function getValidator()
     {
         if (null === $this->validator) {
             $this->validator = new RegexValidator('/^#[0-9a-fA-F]{6}$/');
         }
         return $this->validator;
     }            
 }