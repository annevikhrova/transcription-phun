<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PHuN\PlatformBundle\Editor;

class EditorConfig 
{   
    /* Plugin list for a given corpus 
     * input variable
     */
    private $listPlugins;
    
    /* 
     * Stylesheet used by editor for a given corpus
     * input variable
     */
    private $stylesheet;
    
    /* List of button containers for a given corpus 
     * input variable
     */
    private $containerList;
    
    /* Editor Configuration for a given corpus, output in JSON format 
     * output variable
     */
    private $editorConfig;
    
    
    /* Constructor of service, initialization of variable $listPlugins */
    public function __construct($listPlugins, $stylesheet, $containerList)
    {
        $this->listPlugins = $listPlugins;
        $this->stylesheet = $stylesheet;
        $this->containerList = $containerList;
    }
    
 
    
    
    public function createEditorConfig() 
    {
        //Chargement de l'éditeur paramétré :
            		 	
        // Les plugins associés déjà au corpus
        //$this->listPlugins = $corpus->getPlugins();


        for( $i = 0; $i < count( $this->containerList ); $i ++ )
            $menuList[] = "";

        $configPluginsList   = "";
        $custom_elementList   = "";
        $valid_childrenList   = "";
        foreach ($this->listPlugins as $plugin)
        {
            $arrayContainers = $plugin->getContainers();

            foreach ($arrayContainers as $container)
            {
                $containerId = $container->getId();

                // Detect if container Id is == 1 => toolbar
                if ($containerId == 1)
                    $menuList[0] .= ' | ' . $plugin->getName();

                // Other cases
                else
                    $menuList[$containerId-1] .= ' ' . $plugin->getName();
            }

            $configPluginsList = $configPluginsList . ' ' . $plugin->getName();
            $custom_elementList = $custom_elementList . ',' . $plugin->getName();
            $valid_childrenList = $valid_childrenList . ',+p[' . $plugin->getName() . ']';
        }
        

        $this->editorConfig = "
        {{
            tinymce_init({
              'theme': {
                'advanced': {
                    'selector' : 'textarea',
                    'keep_styles' : false,
                    'custom_elements' : 'span" . $custom_elementList . "',
                    'extended_valid_elements' : '+span[class]" . $custom_elementList . "',
                    'valid_children' : '+span[p]" . $valid_childrenList . $custom_elementList . "',
                    'verify_html' : false,
                    'content_css' : \"asset[" . $this->stylesheet . "]\",
                            'menu' : {";
                            for( $i = 1; $i < count($menuList); $i++ )
                            {
                                $this->editorConfig .= "    
                                        'menu" . $i . "' : {
                                                'title' : '" . $this->containerList[$i]->getName() . "',
                                                'items' : '" . $menuList[$i] . "'
                                        },";
                            }        
                    $this->editorConfig .= "},
                    'menubar': 'file";
                    for ( $i = 1; $i < count($menuList); $i++ )
                    {
                            $this->editorConfig .= " menu" . $i;
                    }

                    $this->editorConfig .= "',
                    'entity_encoding': 'UTF-8',
                        'plugins': 'autoresize',
                    'plugins': '" . $configPluginsList . ", table, code',
                    'toolbar': '" . $menuList[0] . ", code',
                }
              }
            })
        }}";
        //Fin Paramétrage de l'éditeur
        
        return $this->editorConfig;
    }
    
}