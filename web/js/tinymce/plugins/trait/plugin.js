/**
 * plugin.js
 * 
 * creates dialog window allowing insertion of element names trait
 * 2015
*/  


tinymce.PluginManager.add('trait', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('trait', {
        text: 'Trait',
        icon: false,
        tooltip: 'Trait',
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Trait',
                body: [
                    {type: 'textbox', name: 'title', label: 'Trait'}
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('<span class="trait">' + e.data.title+ '</span>'+' ');
                }
            });
        }
    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('trait', {
        text: 'Trait',
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