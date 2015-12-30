/**
 * plugin.js
 * 
 * creates dialog window allowing insertion of element names biffe
 * 2015
*/  


tinymce.PluginManager.add('biffe', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('biffe', {
        text: 'Biffe',
        icon: false,
        tooltip: 'Biffe',
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Biffe',
                body: [
                    {type: 'textbox', name: 'title', label: 'Biffe'},
                    {type: 'textbox', name: 'scripteur_textbox', label: 'scripteur_textbox'},
                    {type: 'textbox', name: 'outil_ecriture', label: 'outil_ecriture'},
                    {type: 'listbox', name: 'scripteur', label: 'scripteur',
                        'values':[
                            {text: 'Stendhal', value: 'Stendhal'},
                            {text: 'Crozet', value: 'Crozet'},
                            {text: 'copiste_inconnu', value: 'copiste_inconnu'},
                            {text: 'secretaire', value: 'secretaire'},
                        ]
                    },


                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('<span class="biffe" scripteur="'+ e.data.scripteur+'">' + e.data.title+ '</span>'+' ');
                }
            });
        }
    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('biffe', {
        text: 'Biffe',
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