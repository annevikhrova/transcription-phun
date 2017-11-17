tinymce.PluginManager.add('m***', function(editor, url) {
   // Add a button that opens a window for element m***
  editor.addButton('m***', {
       text: 'M***',
       icon: false,
       id: 'm***',
       tooltip: '*description*',
       onclick: function() {
       editor.selection.setContent('<mna***>' + editor.selection.getContent() + '</mna***>'+'&nbsp;');
//           editor.windowManager.open({
//               title: 'M***',
//                body: [
//                   {type: 'textbox', name: 'title', label: 'M***'},
//                ],
//              onsubmit: function(e) {
//                  editor.insertContent('<mna***>' + e.data.title+ '</mna***>'+'&nbsp;');
//               }
//           });
       }
   });
   // Adds a menu item to the tools menu
   editor.addMenuItem('m***', {
       text: 'M***',
       icon: false,
       id: 'm***',
       tooltip: '*description*',
       onclick: function() {
          editor.selection.setContent('<mna***>' + editor.selection.getContent() + '</mna***>'+'&nbsp;');
//           editor.windowManager.open({
//               title: 'M***',
//                body: [
//                   {type: 'textbox', name: 'title', label: 'M***'},
//                ],
//              onsubmit: function(e) {
//                  editor.insertContent('<mna***>' + e.data.title+ '</mna***>'+'&nbsp;');
//               }
//           });
       }
   });
});
