/**
 * plugin.js
 * 
 * creates dialog window allowing insertion of element names illisible
 * 2015
*/  


tinymce.PluginManager.add('illisible', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('illisible', {
        text: 'Illisible',
        icon: false,
        tooltip: 'Illisible',
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Illisible',
                body: [
                    {type: 'textbox', name: 'title', label: 'Illisible'}
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('<span class="illisible" style="color: gray; Filter: Blur(Add = 2, Direction = 50, Strength = 7)">' + e.data.title+ '</span>'+' ');
                }
            });
        }
    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('illisible', {
        text: 'Illisible',
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