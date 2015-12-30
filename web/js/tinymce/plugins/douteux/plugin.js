/**
 * plugin.js
 * 
 * creates dialog window allowing insertion of element names douteux
 * 2015
*/  


tinymce.PluginManager.add('douteux', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('douteux', {
        text: 'Douteux',
        icon: false,
        tooltip: 'Douteux',
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Douteux plugin',
                body: [
                    {type: 'textbox', name: 'title', label: 'Douteux'}
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('<font color= "red">[' + e.data.title+ ']</font>'+' ');
                }
            });
        }
    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('douteux', {
        text: 'Douteux plugin',
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
