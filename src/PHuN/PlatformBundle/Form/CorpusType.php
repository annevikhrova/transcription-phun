<?php

namespace PHuN\PlatformBundle\Form;


use Symfony\Component\Form\AbstractType;
//use Symfony\Component\Form\ImageType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CorpusType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',       'text')
            ->add('description','text')
            ->add('pluginList', 'text')
            ->add('startDate',  'date')
            ->add('image',      new ImageType())
            ->add('category', 'entity', array(
                  'class'    => 'PHuNPlatformBundle:Category',
                  'property' => 'name',
                  'multiple' => false)
                 )
            ->add('plugins', 'entity', array(
                  'class'    => 'PHuNPlatformBundle:Plugin',
                  'property' => 'name',
                  'multiple' => true)
                 )
            ->add('pluginsMenu1', 'entity', array(
                  'class'    => 'PHuNPlatformBundle:Plugin',
                  'property' => 'name',
                  'multiple' => true)
                 )
            ->add('save',       'submit')
        ;
        $builder
            ->remove('pluginList', 'text');
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





class CorpusSetPluginsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pluginList', 'text')
            ->add('pluginsMenu1', 'entity', array(
                  'class'    => 'PHuNPlatformBundle:Plugin',
                  'property' => 'name',
                  'multiple' => true)
                 )
            ->add('save',       'submit')
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
