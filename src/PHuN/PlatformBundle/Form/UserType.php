<?php

namespace PHuN\PlatformBundle\Form;

use FOS\UserBundle\Model\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('selection', 'checkbox', array('required' => false))
            ->add('dueDate', DateType::class)
            ->add('delete', SubmitType::class, array('label' => 'Supprimer'))
            ->add('demote', SubmitType::class, array('label' => 'Retrograder'))
            ->add('suspend', SubmitType::class, array('label' => 'Suspendre'))
            ->add('promote', SubmitType::class, array('label' => 'Promoter'))
        ;
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FOS\UserBundle\Model\User'
        ));
    }
}
