<?php

namespace PHuN\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ElementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plugins', 'collection',
                array(
                    'type'          =>  new PluginType(),
                    'allow_add'     => true,
                    'allow_delete'  => true,
                )
            )
            ->add('save',   'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PHuN\PlatformBundle\Entity\Corpus'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'phun_platformbundle_corpus';
    }
}
