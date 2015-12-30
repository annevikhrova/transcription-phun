/**
 * plugin.js
 * 
 * creates dialog window allowing insertion of element names interligne
 * 2015
*/  


tinymce.PluginManager.add('interligne', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('interligne', {
        text: 'Interligne',
        icon: false,
        tooltip: 'Interligne',
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Interligne',
                body: [
                    {type: 'textbox', name: 'title', label: 'Interligne'}
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('<font size="2"><sup>' + e.data.title+ '</sup></font>'+' ');
                }
            });
        }
    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('Interligne', {
        text: 'Interligne',
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