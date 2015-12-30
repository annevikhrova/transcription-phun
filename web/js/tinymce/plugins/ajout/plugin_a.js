/**
 * plugin.js
 * 
 * creates dialog window allowing insertion of element names ajout
 * 2015
*/

//$.getScript('js/popup.js', function()
//{
    // script is now loaded and executed.
    // put your dependent JS here.


tinymce.PluginManager.add('ajout', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('ajout', {
        tooltip: 'Ajout',
        text: 'Ajout',
        icon: false,
        //data-toggle: "popover", 
        //data-placement: "bottom",
        //onmouseover: 'nhpup.popup('Ajout')',
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Ajout',
                body: [
                    {type: 'textbox', name: 'title', label: 'Ajout'}
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('<sup><font size="2">' + e.data.title+ '</font></sup>'+' ');
                    //event.stopPropagation();
                    //editor.insertContent('');
                    
                }
                
            });

        }    

    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('Ajout', {
        text: 'Ajout',
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


//}); //end of jQuery