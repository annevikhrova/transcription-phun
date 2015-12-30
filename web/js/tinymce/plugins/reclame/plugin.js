/**
 * plugin.js
 * 
 * creates dialog window allowing insertion of element names reclame
 * 2015
*/  


tinymce.PluginManager.add('reclame', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('reclame', {
        tooltip: 'Reclame',
        text: 'Reclame',
        icon: false,
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Reclame',
                body: [
                    {type: 'textbox', name: 'title', label: 'Reclame'}
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('<span class="reclame">' + e.data.title+ '</span>'+' ');
                }
            });
        }
    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('Reclame', {
        text: 'Reclame',
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