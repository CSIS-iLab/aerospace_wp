(function() {
    tinymce.PluginManager.add('aerospace', function( editor, url ) {
       editor.addButton('first', {
          text: 'First',
          tooltip: 'Insert First Sentence',
          onclick: function() {
             editor.windowManager.open( {
                title: 'Insert First Sentence',
                width: 400,
                height: 100,
                body: [
                {
                  type: 'textbox',
                  multiline: true,
                  name: 'first',
                  label: 'First Sentence',
                  placeholder: 'This is your first sentence'
              }
              ],
              onsubmit: function( e ) {
               editor.insertContent( '[first]' + e.data.first + '[/first]');
           }
       });
         }
     });

       editor.addButton('fullWidth', {
        text: 'FullWidth',
        tooltip: 'Insert Full Width',
        onclick: function() {
            editor.windowManager.open( {
                title: 'Insert Full Width',
                width: 400,
                height: 100,
                body: [
                {
                    type: 'textbox',
                    multiline: false,
                    name: 'maxWidth',
                    label: 'Max Width',
                    placeholder: 'Insert Max Width'
                }
                ],
                onsubmit: function( e ) {
                    editor.insertContent( '[fullWidth width="' + e.data.maxWidth + '"][/fullWidth]');
                }
            });
        }
    });

       editor.addButton('interactive', {
        text: 'Interactive',
        tooltip: 'Insert Interactive Shortcode',
        onclick: function() {
         editor.windowManager.open( {
            title: 'Insert Full Width',
            width: 400,
            height: 100,
            body: [
            {
                type: 'textbox',
                multiline: false,
                name: 'id',
                label: 'Interactive ID',
                placeholder: 'Insert Interactive ID'
            },
            {
                type: 'listbox',
                name: 'align',
                label: 'Alignment',
                'values': [
                {text: 'None', value: null },
                {text: 'Left', value: 'left' },
                {text: 'Right', value: 'right' }
                ]
            },
            ],
            onsubmit: function( e ) {
                var align = '';
                if ( e.data.align ) {
                    align = ' align="' + e.data.align + '"';
                }
                editor.insertContent( '[data id="' + e.data.id + '"' + align + ']');
            }
        })
     }
 });

       editor.addButton('view', {
        text: 'View',
        tooltip: 'Insert View link',
        onclick: function() {
            editor.windowManager.open( {
                title: 'Insert View Link',
                width: 400,
                height: 100,
                body: [
                {
                    type: 'textbox',
                    multiline: false,
                    name: 'title',
                    label: 'Title',
                    placeholder: 'Optional Title Attribute'
                },
                {
                  type: 'textbox',
                  multiline: false,
                  name: 'id',
                  label: 'Post ID',
                  placeholder: 'Insert Post ID'
              }
              ],
              onsubmit: function( e ) {
                if (e.data.title == '') {
                    editor.insertContent( '[view id="' + e.data.id + '"]');
                } else {
                    editor.insertContent( '[view id="' + e.data.id + '" title="' + e.data.title + '"]');
                }
            }
        });
        }
    });

       editor.addButton('note', {
        text: 'Footnote',
        icon: null,
        tooltip: 'Insert Footnote',
        onclick: function() {
           editor.windowManager.open( {
              title: 'Insert Footnote Content',
              width: 400,
              height: 100,
              body: [
              {
                type: 'textbox',
                multiline: true,
                name: 'note'
            }
            ],
            onsubmit: function( e ) {
             editor.insertContent( '[note]' + e.data.note + '[/note]');
         }
     });
       }
   });
       editor.addButton('publication', {
        text: 'External Publication',
        tooltip: 'Insert External Publication Link',
        onclick: function() {
            editor.windowManager.open( {
                title: 'Insert External Publication Link',
                width: 400,
                height: 100,
                body: [
                {
                    type: 'textbox',
                    multiline: false,
                    name: 'title',
                    label: 'Publication Title',
                    placeholder: 'The name of the original publication'
                },
                {
                    type: 'textbox',
                    multiline: false,
                    name: 'url',
                    label: 'Publication URL',
                    placeholder: 'The URL to the original publication'
                }
                ],
                onsubmit: function( e ) {
                    editor.insertContent( '[publication title="' + e.data.title + '" url="' + e.data.url + '"]');
                }
            });
        }
    });
   });
})();
