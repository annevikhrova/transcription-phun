<?php

namespace PHuN\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

use PHuN\PlatformBundle\Entity\DossierRepository;

class DossierType extends AbstractType
{
    public function __construct($em) {
        $this->em = $em;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $dossier = $event->getData();
            $form    = $event->getForm();
            $catalogue     = $dossier->getCatalogue();
            $catalogue_id  = $catalogue->getId();

            // Case where an empty entity is loaded
            if(null === $dossier->getId()){
              $form->add('name', 'entity', array(
                    'class'    => 'PHuNPlatformBundle:Dossier',
                    'property' => 'name',
                    'multiple' => false,
                    'query_builder' => function(DossierRepository $repo) use($catalogue_id) {
                          return $repo
                              ->createQueryBuilder('dossier')
                              ->where('dossier.catalogue = :catalogue')
                              ->setParameter('catalogue', $catalogue_id)
                          ;
                     }
                  )
              );
            }


            // case where an entity has been loaded
            else{
              $form->add('name', 'entity', array(
                    'class'    => 'PHuNPlatformBundle:Dossier',
                    'property' => 'name',
                    'multiple' => false,
                    'query_builder' => function(DossierRepository $repo) use($catalogue_id) {
                          return $repo
                              ->createQueryBuilder('dossier')
                              ->where('dossier.catalogue = :catalogue')
                              ->setParameter('catalogue', $catalogue_id)
                          ;
                     },
                     'data' => $this->em->getReference("PHuNPlatformBundle:Dossier", $dossier->getId()),
                  )
              );
            }
        });
        $builder
            ->add('select', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PHuN\PlatformBundle\Entity\Dossier'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'phun_platformbundle_dossier';
    }
}
