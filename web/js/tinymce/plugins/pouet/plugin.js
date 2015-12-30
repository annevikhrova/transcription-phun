tinymce.PluginManager.add('pouet', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('pouet', {
        text: 'pouet',
        icon: false,
        tooltip: 'pouet',
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'pouet',
                body: [
                    {type: 'textbox', name: 'title', label: 'pouet'}
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('<span class=pouet>' + e.data.title+ '</span>'+' ');
                }
            });
        }
    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('pouet', {
        text: 'pouet',
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