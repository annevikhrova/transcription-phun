/**
 * plugin.js
 * 
 * creates dialog window allowing insertion of element names ajout
 * 2015
*/  


tinymce.PluginManager.add('souligne', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('souligne', {
        text: 'Souligne',
        icon: false,
        tooltip: 'Souligne',
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Souligne',
                body: [
                    {type: 'textbox', name: 'title', label: 'Souligne'}
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('<u>' + e.data.title+ '</u>'+' ');
                }
            });
        }
    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('Souligne', {
        text: 'Souligne',
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