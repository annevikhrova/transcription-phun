/**
 * plugin.js
 * 
 * creates dialog window allowing insertion of element names comment
 * 2015
*/  


tinymce.PluginManager.add('comment', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('comment', {
        text: 'Comment',
        icon: false,
        tooltip: 'Comment',
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Comment',
                body: [
                    {type: 'textbox', name: 'title', label: 'Comment'}
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('<span class="mot_comment"><font color= "blue">[' + e.data.title+ ']</font></span>'+' ');
                }
            });
        }
    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('comment', {
        text: 'Comment',
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