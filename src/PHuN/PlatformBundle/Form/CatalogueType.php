<?php

namespace PHuN\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

use PHuN\PlatformBundle\Entity\CatalogueRepository;

class CatalogueType extends AbstractType
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
            //$em = $this->getDoctrine()->getEntityManager();
            $catalogues = $event->getData();
            $form       = $event->getForm();
            $corpus     = $catalogues->getCorpus();
            $corpus_id  = $corpus->getId();

            // Case where an empty entity is loaded
            if(null === $catalogues->getId()){
              $form->add('name', 'entity', array(
                    'class'    => 'PHuNPlatformBundle:Catalogue',
                    'property' => 'name',
                    'multiple' => false,
                    'query_builder' => function(CatalogueRepository $repo) use($corpus_id) {
                          return $repo
                              ->createQueryBuilder('catalogue')
                              ->where('catalogue.corpus = :corpus')
                              ->setParameter('corpus', $corpus_id)
                          ;
                     },
                  )
                )
                ->add('select', 'submit');
              }

              // case where an entity has been loaded
            else{
              $form->add('name', 'entity', array(
                    'class'    => 'PHuNPlatformBundle:Catalogue',
                    'property' => 'name',
                    'multiple' => false,
                    'query_builder' => function(CatalogueRepository $repo) use($corpus_id) {
                          return $repo
                              ->createQueryBuilder('catalogue')
                              ->where('catalogue.corpus = :corpus')
                              ->setParameter('corpus', $corpus_id)
                          ;
                     },
                    'data' => $this->em->getReference("PHuNPlatformBundle:Catalogue", $catalogues->getId()),
                  )
                )
                ->add('select', 'submit');
              }
        });
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PHuN\PlatformBundle\Entity\Catalogue'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'phun_platformbundle_catalogue';
    }
}




// class CatalogueType extends AbstractType
// {
//     /**
//      * @param FormBuilderInterface $builder
//      * @param array $options
//      */
//     public function buildForm(FormBuilderInterface $builder, array $options)
//     {
//         $builder
//             ->add('corpus', 'entity', array(
//                 'class'     => 'PHuNPlatformBundle:Corpus',
//                 'property'  => 'name',
//                 'label'     => 'Corpus',
//                 'required'  => true,
//                 'mapped'    => false,
//                 'invalid_message' => 'Choississez un corpus',
//                 'placeholder'     => 'Faite votre choix1',
//             ))
//         ;

//         $addCatalogueForm = function (FormInterface $form, $corpus_id) {
//             $form->add('catalogue', 'entity', array(
//                 'class'     => 'PHuNPlatformBundle:Catalogue',
//                 'property'  => 'name',
//                 'label'     => 'Catalogue',
//                 'required'  => true,
//                 'mapped'    => false,
//                 'invalid_message' => 'Choississez un catalogue',
//                 'placeholder'   => null === $corpus_id ? 'Merci de choisir un catalogue' : 'Faite votre choix2',
//                 'query_builder' => function (CatalogueRepository $repository) use ($corpus_id) {
//                     // this does the trick to get the right options
//                     return $repository->createQueryBuilder('catalogue')
//                         ->innerJoin('catalogue.corpus', 'corpus')
//                         ->where('corpus.id = :corpus')
//                         ->setParameter('corpus', $corpus_id)
//                     ;
//                 }
//             ));
//         };
//         $builder->addEventListener(
//             FormEvents::PRE_SET_DATA,
//             function (FormEvent $event) use ($addCatalogueForm) {
//                 $corpus = $event->getData()->getCorpus();
//                 $corpus_id = $corpus ? $corpus->getId() : null;
//                 $addCatalogueForm($event->getForm(), $corpus_id);
//             }
//         );
//         $builder->addEventListener(
//             FormEvents::PRE_SUBMIT,
//             function (FormEvent $event) use ($addCatalogueForm) {
//                 $data = $event->getData();
//                 $corpus_id = array_key_exists('corpus', $data) ? $data['corpus'] : null;
//                 $addCatalogueForm($event->getForm(), $corpus_id);
//             }
//         );



//         // $addDossierForm = function (FormInterface $form, $catalogue_id) {
//         //     $form->add('dossier', 'entity', array(
//         //         'class'     => 'PHuNPlatformBundle:Dossier',
//         //         'property'  => 'name',
//         //         'label'     => 'Dossier', 
//         //         'mapped'    => false,
//         //         'required' => true,
//         //         'invalid_message' => 'Choississez un dossier',
//         //         'placeholder' => null === $catalogue_id ? 'Veuillez choisir un dossier' : 'Merci de choisir',
//         //         'query_builder' => function (DossierRepository $repository) use ($catalogue_id) {
//         //             // a bit more complicated, that's how this model works
//         //             return $repository->createQueryBuilder('dossier')
//         //                 ->innerJoin('dossier.catalogue', 'catalogue')
//         //                 //->innerJoin('PHuNPlatformBundle:Catalogue', 'catalogue', 'WITH', 'catalogue.dossierType = dst.id')
//         //                 ->where('catalogue.id = :catalogue_id')
//         //                 ->setParameter('catalogue_id', $catalogue_id)
//         //             ;
//         //         }
//         //     ));
//         // };
//         // $builder->addEventListener(
//         //     FormEvents::PRE_SET_DATA,
//         //     function (FormEvent $event) use ($addDossierForm) {
//         //         $catalogues = $event->getData();
//         //         foreach($catalogues->getCatalogue() as $catalogue){
//         //             $catalogue_id = $catalogue ? $catalogue->getId() : null;
//         //             $addDossierForm($event->getForm(), $catalogue_id);
//         //         }
//         //     }
//         // );
//         // $builder->addEventListener(
//         //     FormEvents::PRE_SUBMIT,
//         //     function (FormEvent $event) use ($addDossierForm) {
//         //         $data = $event->getData();
//         //         $catalogue_id = array_key_exists('catalogue', $data) ? $data['catalogue'] : null;
//         //         $addDossierForm($event->getForm(), $catalogue_id);
//         //     }
//         // );

//     }
    
//     /**
//      * @param OptionsResolverInterface $resolver
//      */
//     public function setDefaultOptions(OptionsResolverInterface $resolver)
//     {
//         $resolver->setDefaults(array(
//             'data_class' => 'PHuN\PlatformBundle\Entity\Page'
//         ));
//     }

//     /**
//      * @return string
//      */
//     public function getName()
//     {
//         return 'phun_platformbundle_selectPage';
//     }

// }








// class CatalogueType extends AbstractType
// {
//     /**
//      * @param FormBuilderInterface $builder
//      * @param array $options
//      */
//     public function buildForm(FormBuilderInterface $builder, array $options)
//     {
//         $builder
//             //->add('name', 'checkbox', array('required' => false))
//             ->add('name', 'entity', array(
//                   'class'    => 'PHuNPlatformBundle:Catalogue',
//                   'property' => 'name',
//                   'multiple' => true)
//                  )
//             //->add('dossier',      new DossierType())
//             //->add('sous_dossier', new SousDossierType())
//             //->add('corpus')
//             ->add('save',   'submit')
//         ;
//     }
    
//     /**
//      * @param OptionsResolverInterface $resolver
//      */
//     public function setDefaultOptions(OptionsResolverInterface $resolver)
//     {
//         $resolver->setDefaults(array(
//             'data_class' => 'PHuN\PlatformBundle\Entity\Catalogue'
//         ));
//     }

//     /**
//      * @return string
//      */
//     public function getName()
//     {
//         return 'phun_platformbundle_catalogue';
//     }
// }
