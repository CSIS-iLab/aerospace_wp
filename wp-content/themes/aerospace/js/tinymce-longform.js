(function() {
  tinymce.PluginManager.add('aerospace-longform', function(editor, url) {

    editor.addButton('lf-section-header', {
      text: 'LF Section Header',
      tooltip: 'Insert Section Header',
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert Section Header',
          body: [
            {
              type: 'textbox',
              multiline: false,
              name: 'title',
              label: 'Section Title',
              placeholder: 'Section Title'
            },
            {
                type: 'container',
                label: 'Background Image',
                name: 'background-image-container',
                items: [
                  {
                    type: 'container',
                    html: '<div id="background-image-preview">'
                  },
                  {
                    type: 'textbox',
                    hidden: true,
                    name: 'image',
                    id: 'background-image',
                    value: ''
                }
                ]
            },
            {
                type: 'button',
                name: 'select-image',
                label: 'Background Image',
                text: 'Search Media Library',
                onclick: function() {
                    window.mb = window.mb || {};

                    window.mb.frame = wp.media({
                        frame: 'post',
                        state: 'insert',
                        library : {
                            type : 'image'
                        },
                        multiple: false
                    });

                    window.mb.frame.on('insert', function() {
                        var json = window.mb.frame.state().get('selection').first().toJSON();

                        if (0 > $.trim(json.url.length)) {
                            return;
                        }

                        console.log(json)

                        $('#background-image').val(json.id);
                    });

                    window.mb.frame.open();
                }
            },
            {
              type: 'textbox',
              multiline: false,
              name: 'id',
              label: 'Element ID',
              placeholder: 'Optional'
            },
            {
              type: 'listbox',
              name: 'theme',
              label: 'Theme',
              'values': [
                {
                  text: 'Dark',
                  value: 'dark'
                },
                {
                  text: 'Light',
                  value: 'light'
                }
              ]
            },
            {
              type: 'textbox',
              multiline: true,
              name: 'content',
              label: 'Section Overview',
              placeholder: 'Section Overview',
              minWidth: 300,
              minHeight: 100
            },
          ],
          onsubmit: function(e) {
            var imageAttr = ''
            if ( e.data.image ) {
              imageAttr = ' image="' + e.data.image + '"'
            }
            editor.insertContent('[lf-section-header title="' + e.data.title + '"' + imageAttr + ']' + e.data.content + '[/lf-section-header]');
          }
        });
      }
    });

  });
})();