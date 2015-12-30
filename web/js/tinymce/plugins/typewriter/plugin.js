/**
 * plugin.js
 * 
 * creates dialog window allowing insertion of element names typewriter
 * 2015
*/


tinymce.PluginManager.add('typewriter', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('typewriter', {
        text: 'Typewriter',
        icon: false,
        tooltip: 'Typewriter',
        //data-toggle: "popover", 
        //data-placement: "bottom",
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Typewriter',
                body: [
                    {type: 'textbox', name: 'title', label: 'Typewriter'}
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('<span style="font-family: American Typewriter; font-size: 12;">' + e.data.title+ '</span>'+' ');
                    //event.stopPropagation();
                    //editor.insertContent('');
                    
                }
                
            });

        }    

    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('Typewriter', {
        text: 'Typewriter',
        context: 'tools',
        onclick: function() {
            // Open window with a specific url
            editor.windowManager.open({
                title: 'TinyMCE site',
                url: 'http://www.tinymce.com',
                width: 800,
                height: 600,
                buttons: [{
                    text: 'Close',
                    onclick: 'close'
                }]
            });
        }

    });
});