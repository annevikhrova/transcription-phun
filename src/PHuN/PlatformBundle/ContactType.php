<?php
# src/tuto/WelcomeBundle/Form/Type/ContactType.php

namespace PHuN\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('email', 'email')
                ->add('sujet', 'text')
                ->add('contenu', 'textarea')
                ->add('demande',  'checkbox', array('required' => false))
                ;
    }

    public function getName()
    {
        return 'phun_platform_contact';
    }
}
?>