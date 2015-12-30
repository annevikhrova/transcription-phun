tinymce.PluginManager.add('sourire', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('sourire', {
        text: 'sourire',
        icon: false,
        tooltip: 'sourire',
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'sourire',
                body: [
                    {type: 'textbox', name: 'title', label: 'sourire'}
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('<span class=sourire>' + e.data.title+ '</span>'+' ');
                }
            });
        }
    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('sourire', {
        text: 'sourire',
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