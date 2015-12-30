/**
 * plugin.js
 * 
 * creates dialog window allowing insertion of element names averifier
 * 2015
*/  


tinymce.PluginManager.add('averifier', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('averifier', {
        text: 'Averifier',
        icon: false,
        tooltip: 'Averifier',
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Averifier',
                body: [
                    {type: 'textbox', name: 'title', label: 'Averifier', },
                    {type: 'listbox', name: 'verifie', label: 'verifie',
                        'values':[
                            {text: 'oui', value: 'oui'},
                            {text: 'non', value: 'non'},
                        ]
                    },
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('<span class="averifier" verifie="'+ e.data.verifie+'">' + e.data.title+ '</span>'+' ');
                }
            });
        }
    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('averifier', {
        text: 'Averifier',
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