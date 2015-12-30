/**
 * plugin.js
 * 
 * creates dialog window allowing insertion of element names italique
 * 2015
*/  


tinymce.PluginManager.add('italique', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('italique', {
        text: 'Italique',
        icon: false,
        tooltip: 'Italique',
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Italique',
                body: [
                    {type: 'textbox', name: 'title', label: 'Italique'}
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('<em>' + e.data.title+ '</em>'+' ');
                }
            });
        }
    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('Italique', {
        text: 'Italique',
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