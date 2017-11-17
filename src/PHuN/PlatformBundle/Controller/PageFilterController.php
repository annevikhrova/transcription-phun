<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class PageFilterController extends Controller
{
    public function FilterByLatestTranscriptionAction($pageId)
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('PHuNPlatformBundle:Transcription')
        ;
                
        // Search transcription table by user
        $listTranscriptions = $repository->findBy(
                array('page_id' => $pageId),
                array('date' => 'DESC')
        );
        
        $latestTranscription = $listTranscriptions[0];

//        $uniqueListTranscriptions = array();
//
//        foreach ($listTranscriptions as $transcription) {
//
//            $transcription_page_id = $transcription->getPage()->getId();
//            $transcription_date    = $transcription->getDate();
//
//
//                $is_in_unique = 0;
//
//                for ($i = 0; $i < count($uniqueListTranscriptions); $i++)
//                {
//                        // unique transcription
//                        $unique_transcription = $uniqueListTranscriptions[$i];
//
//                        // unique transcription page id
//                        $unique_transcription_page_id = $unique_transcription->getPage()->getId();
//
//                        // Check if current transcription is in unique transcription list
//                        if ($unique_transcription_page_id == $transcription_page_id) {
//                                $is_in_unique++;
//                                // if multiple transcription exist for this page, add only the most recently dated transcription
//                                if ($transcription_date > $unique_transcription->getDate()) {
//                                    $uniqueListTranscriptions[$i] = $transcription;
//
//                                }
//
//
//                        }
//                }
//
//                // if no other transcriptions exist for this page, add this transcription
//                if ($is_in_unique == 0)
//                {
//                        $uniqueListTranscriptions[] = $transcription;
//                }
//
//        }
//
//        // Find the very last transcription linked to page transcription
//        for( $i = 0; $i < count($uniqueListTranscriptions); $i++ )
//        {
//            $userTranscription_page_id	= $uniqueListTranscriptions[$i]->getPage()->getId();
//            //$userTranscription_date     = $uniqueListTranscriptions[$i]->getDate();
//
//            // Find transcription with same Page Id
//                    $corresponding_transcriptions = $repository->findByPage($userTranscription_page_id);
//
//            // Find the last transcription made for this page
//            foreach( $corresponding_transcriptions as $t_to_test){
//                if ( $uniqueListTranscriptions[$i]->getDate() > $t_to_test->getDate()) {
//                    $uniqueListTranscriptions[$i] = $t_to_test;
//                }
//            }    
//        }  
        /* end of main filter */

    }            
}