<?php

namespace PHuN\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PluginType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',        'text')
            ->add('containers',   'entity',
                array(
                  'class' => 'PHuNPlatformBundle:Container',
                  'property' => 'name',
                  'multiple' => true,

                )
              )
            /*
            ->add('name', 'collection',
                array(
                    'type'          =>  new PluginType(),
                    'allow_add'     => true,
                    'allow_delete'  => true,
                )
            )
            ->add('plugins', 'entity', array(
                  'class'    => 'PHuNPlatformBundle:Plugin',
                  'property' => 'name',
                  'expanded' => true,
                  'multiple' => true)
            )
            */
            //->add('save',   'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PHuN\PlatformBundle\Entity\Plugin'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'phun_platformbundle_plugin';
    }
}
