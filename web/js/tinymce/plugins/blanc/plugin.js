/**
 * plugin.js
 * 
 * creates dialog window allowing insertion of element names blanc
 * 2015
*/  


tinymce.PluginManager.add('blanc', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('blanc', {
        text: 'Blanc',
        icon: false,
        tooltip: 'Blanc',
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Blanc',
                body: [
                    {type: 'textbox', name: 'title', label: 'Blanc'}
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('<span id="blanc"><pre' + e.data.title+ '</pre></span>'+' ');
                }
            });
        }
    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('blanc', {
        text: 'Blanc',
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


