<?php

namespace PHuN\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdvertEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',       'date')
            ->add('title',      'text')
            ->add('author',     'text')
            ->add('content',    'textarea')
            ->add('published',  'checkbox',array('required' => false))
            ->add('image',      new ImageType())
              /*
               * Rappel :
               ** - 1er argument : nom du champ, ici « categories », car c'est le nom de l'attribut
               ** - 2e argument : type du champ, ici « collection » qui est une liste de quelque chose
               ** - 3e argument : tableau d'options du champ
               */
              /*
            ->add('categories', 'collection', array(
                'type'         => new CategoryType(),
                'allow_add'    => true,
                'allow_delete' => true
            ))
            */

            ->add('categories', 'entity', array(
              'class'    => 'PHuNPlatformBundle:Category',
              'property' => 'name',
              'multiple' => true,
              'expanded' => true,
            ))
            ->add('save',       'submit')
        ;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'phun_platformbundle_advertEdit';
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return '';
    }
}
