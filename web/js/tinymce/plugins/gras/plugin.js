/**
 * plugin.js
 * 
 * creates dialog window allowing insertion of element names gras
 * 2015
*/  



tinymce.PluginManager.add('gras', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('gras', {
        text: 'Gras',
        icon: false,
        tooltip: 'Gras',
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Gras',
                body: [
                    {type: 'textbox', name: 'title', label: 'Gras'}
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('<b>' + e.data.title+ '</b>'+' ');
                }
            });
        }
    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('Gras', {
        text: 'Gras',
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