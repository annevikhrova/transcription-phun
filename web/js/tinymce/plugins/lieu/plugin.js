/**
 * plugin.js
 * 
 * creates dialog window allowing insertion of element names lieu
 * 2015
*/  


tinymce.PluginManager.add('lieu', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('lieu', {
        text: 'Lieu',
        icon: false,
        tooltip: 'Lieu',
        //icon: './images/lieu-arrow.png',
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Lieu',
                body: [
                    {type: 'textbox', name: 'title', label: 'Lieu'}
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('<span span="lieu"><img src="tinymce/js/tinymce/plugins/images/lieu-arrow.png" width="8" height="8">' + e.data.title+ '</img></span>'+' ');
                }
            });
        }
    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('lieu', {
        text: 'Lieu',
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

