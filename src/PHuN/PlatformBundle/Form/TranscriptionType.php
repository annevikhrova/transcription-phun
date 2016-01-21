<?php

namespace PHuN\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TranscriptionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content',    'textarea')
            //->add('date',       'date')
            //->add('page',       'integer')
            //->add('user',       'text')
            ->add('published',  'checkbox', array('required' => true))
            ->add('save',       'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PHuN\PlatformBundle\Entity\Transcription'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'phun_platformbundle_transcription';
    }
}
