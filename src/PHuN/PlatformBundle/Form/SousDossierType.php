<?php

namespace PHuN\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

use PHuN\PlatformBundle\Entity\SousDossierRepository;

class SousDossierType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $sousdossier = $event->getData();
            $form       = $event->getForm();
            $dossier     = $sousdossier->getDossier();
            $dossier_id  = $dossier->getId();
            $form->add('name', 'entity', array(
                  'class'    => 'PHuNPlatformBundle:SousDossier',
                  'property' => 'name',
                  'multiple' => false,
                  'query_builder' => function(SousDossierRepository $repo) use($dossier_id) {
                        return $repo
                            ->createQueryBuilder('sousdossier')
                            ->where('sousdossier.dossier = :dossier')
                            ->setParameter('dossier', $dossier_id)
                        ;
                   }
                )
            )
            ->add('select', 'submit');
        });

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PHuN\PlatformBundle\Entity\SousDossier'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'phun_platformbundle_sousdossier';
    }
}
