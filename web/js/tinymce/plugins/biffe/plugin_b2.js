tinymce.PluginManager.add('biffe', function(editor, url) {
   // Add a button that opens a window
  editor.addButton('biffe', {
       text: 'Biffe',
       icon: false,
       tooltip: 'Biffe',
       onclick: function() {
           editor.windowManager.open({
               title: 'Biffe',
               body: [
                   {type: 'textbox', name: 'title', label: 'Biffe'},
                   {type: 'textbox', name: 'scripteur_textbox', label: 'scripteur_textbox'},
                   {type: 'textbox', name: 'outil_ecriture', label: 'outil_ecriture'},
                    {type: 'listbox', name: 'scripteur', label: 'scripteur',
                        'values':[
                            {text: 'Stendhal', value: 'Stendhal'},
                            {text: 'Colomb', value: 'Colomb'},
                            {text: 'Crozet', value: 'Crozet'},
                            {text: 'Fougeol', value: 'Fougeol'},
                            {text: 'Delbono', value: 'Delbono'},
                            {text: 'Uralez', value: 'Uralez'},
                            {text: 'copiste_inconnu', value: 'copiste_inconnu'},
                            {text: 'commis', value: 'commis'},
                            {text: 'secretaire', value: 'secretaire'},
                            {text: 'non_identifie', value: 'non_identifie'},
                            {text: 'Monsieur_Azile', value: 'Monsieur_Azile'},
                            {text: 'Bonavie', value: 'Bonavie'},
                            {text: 'copiste_de_Rome', value: 'copiste_de_Rome'},
                            {text: 'Corbeau', value: 'Corbeau'},
                            {text: 'Vismara', value: 'Vismara'},
                            {text: 'Borsieri', value: 'Borsieri'},
                            {text: 'bibliothecaire', value: 'bibliothecaire'},
                            {text: 'Lambert', value: 'Lambert'},
                            {text: 'Felix_Faure', value: 'Felix_Faure'},
                            {text: 'Pauline_Beyle', value: 'Pauline_Beyle'},
                            {text: 'Arbelet', value: 'Arbelet'},
                            {text: 'Stryienski', value: 'Stryienski'},
                            {text: 'Dr_Lanthois', value: 'Dr_Lanthois'},
                            {text: 'Auguste_Cordier', value: 'Auguste_Cordier'},
                       ]
                   },


              ],
              onsubmit: function(e) {
                   
                  editor.insertContent('<span class="biffe" title="'+ e.data.scripteur+'">' + e.data.title+ '</span>'+' ');
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
