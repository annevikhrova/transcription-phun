<?php

namespace PHuN\PlatformBundle\Controller;

use PHuN\PlatformBundle\Entity\Comment;
use PHuN\PlatformBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommentController extends Controller
{
    private $em;
    /**
     * 
     * @param EntityManager $em
     */
    public function __construct($em)
       {
           $this->em = $em;
       }
    
    
    /**
     * Recovery of individual comment, used by viewComments function
     * @param integer $idComment
     * @return twig show_comment
     */   
    public function showCommentAction($idComment) {
        
        $comment = $this->em
            ->getRepository('PHuNPlatformBundle:Comment')
            ->findOneById($idComment)    
	;
        
        $user_id = $comment->getUser()->getId();
        
        $profile = $this->em
            ->getRepository('PHuNPlatformBundle:Avatar')
            ->findOneByUser($user_id)    
	;
        
        return $this->render('PHuNPlatformBundle:Comment:show_comment.html.twig', 
            array(
                'comment' =>$comment,
                'profile' => $profile
            
            )
        );
    }
    

    public function showModalAction($listComments) {
        return $this->render('PHuNPlatformBundle:Comment:modal_comment.html.twig', 
            array(
                'listComments' => $listComments
            
            )
        );
    }
    
    /**
     * Recovery of all existing comments related to current page
     * @param integer $pageId
     * @param User $user
     * @param FormBuilder $formFactory
     * @param Request $request
     * @return twig of modal containing all comments related to current page
     */
    public function viewCommentsAction($pageId, $user, $formFactory, $request) {
     
    $repository = $this->em->getRepository('PHuNPlatformBundle:Comment');

    $listComments = $repository->findBy(array('page' => $pageId), 
        array('datetime' => 'desc')); 
    
    // On récupére l'utilisateur qui écrit le commentaire
    $user_id = $user->getId();
    
    // Form creation for comment
    $comment = new Comment();
    
    // récupération d'image de profil
    $profile = $this->em
        ->getRepository('PHuNPlatformBundle:Avatar')
        ->findByUser($user_id);

    $form_comment = $formFactory->create(new CommentType(), $comment);

        if ( $form_comment->handleRequest($request)->isValid() )
        {

            $comment->setUser($user);
            $comment->setPage($page);
            $comment->setDateTime(new \Datetime());

            $this->em->persist($comment);
            $this->em->flush();


            // Form creation for comment
            $comment = new Comment();
            $form_comment = $this->get('form.factory')->create(new CommentType(), $comment);
            $listComments = $repository->findBy(array('page' => $pageId), // Critere
            array('datetime' => 'desc'));  

            return $this->render('PHuNPlatformBundle:Page:edit.html.twig',
                array('page' => $page,
                    'corpus' => $corpus,
                    'form' => $form->createView(),
                    'tiny_conf' => $tiny_conf,
                    'listComments' => $listComments,
                    'form_comment' => $form_comment->createView(),
                    'stylesheet' => $stylesheet
                    ));

        }   
        return array(
            'listComments' => $listComments,
            'form_comment' => $form_comment
            ) ;
    }
    
    /**
     * Recovery of questionnaire
     * @param Corpus $corpus
     * @param User $user
     * @return twig questionnaire
     */ 
    public function viewQuestionnaireAction($corpus, $user) {
        $questionnaire = new Questionnaire();
        $formQ = $this->get('form.factory')->create(new QuestionnaireType(), $questionnaire);
        $formQ->handleRequest($request);

        if ($formQ->get('save_submit')->isClicked()) {
            $data = $formQ->getData();

            return new Response(var_dump($data));
        }

        return $this->render('PHuNPlatformBundle:Comment:questionnaire.html.twig', array(
                'user' => $user,
                'avatar' => $avatar,
                'form' => $formQ->createView(),
                'corpus' => $corpus
                ));
    }


}
