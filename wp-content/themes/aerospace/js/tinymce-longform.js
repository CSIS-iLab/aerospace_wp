(function() {

  function insertImgID () {
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

        $('#background-image').val(json.id);
        $('#background-image-preview').html('<img src="' + json.url + '" style="width: 150px; height: auto;" />');
    });

    window.mb.frame.open();
  }

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
              minHeight: 150,
              items: [
                {
                  type: 'container',
                  html: '<div id="background-image-preview"></div>'
                },
                {
                  type: 'textbox',
                  hidden: true,
                  name: 'image',
                  id: 'background-image',
                  value: ''
                },
                {
                  type: 'button',
                  name: 'select-image',
                  label: 'Background Image',
                  text: 'Search Media Library',
                  onclick: function() {
                    insertImgID()
                  }
                },
              ]
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
            var idAttr = ''
            if ( e.data.id ) {
              idAttr = ' id="' + e.data.id + '"'
            }
            var themeAttr = ''
            if ( e.data.theme ) {
              themeAttr = ' theme="' + e.data.theme + '"'
            }
            editor.insertContent('[lf-section-header title="' + e.data.title + '"' + imageAttr + idAttr + themeAttr + ']<br />' + e.data.content + '<br />[/lf-section-header]');
          }
        });
      }
    });

    editor.addButton('lf-section-explainer', {
      text: 'LF Section Explainer',
      tooltip: 'Insert Section Explainer',
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert Section Explainer',
          body: [
            {
              type: 'textbox',
              multiline: false,
              name: 'title',
              label: 'Explainer Title',
              placeholder: 'Explainer Title'
            },
            {
              type: 'container',
              label: 'Image',
              name: 'background-image-container',
              minHeight: 150,
              items: [
                {
                  type: 'container',
                  html: '<div id="background-image-preview"></div>'
                },
                {
                  type: 'textbox',
                  hidden: true,
                  name: 'image',
                  id: 'background-image',
                  value: ''
                },
                {
                  type: 'button',
                  name: 'select-image',
                  label: 'Image',
                  text: 'Search Media Library',
                  onclick: function() {
                    insertImgID()
                  }
                }
              ]
            },
            {
              type: 'textbox',
              multiline: false,
              name: 'imageClasses',
              label: 'Image Classes',
              placeholder: 'Optional'
            },
            {
              type: 'textbox',
              multiline: true,
              name: 'source',
              label: 'Data Source',
              placeholder: 'Optional. Source/Citation info.'
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
              type: 'listbox',
              name: 'align',
              label: 'Image Alignment',
              'values': [{
                  text: 'None',
                  value: null
                },
                {
                  text: 'Left',
                  value: 'left'
                },
                {
                  text: 'Right',
                  value: 'right'
                }
              ]
            },
            {
              type: 'textbox',
              multiline: true,
              name: 'content',
              label: 'Explainer Content',
              placeholder: 'Explainer Content',
              minWidth: 300,
              minHeight: 100
            },
          ],
          onsubmit: function(e) {
            var imageAttr = ''
            if ( e.data.image ) {
              imageAttr = ' image="' + e.data.image + '"'
            }
            var imageClassesAttr = ''
            if ( e.data.imageClasses ) {
              imageClassesAttr = ' image_classes="' + e.data.imageClasses + '"'
            }
            var idAttr = ''
            if ( e.data.id ) {
              idAttr = ' id="' + e.data.id + '"'
            }
            var themeAttr = ''
            if ( e.data.theme ) {
              themeAttr = ' theme="' + e.data.theme + '"'
            }
            var alignAttr = ''
            if ( e.data.align ) {
              alignAttr = ' align="' + e.data.align + '"'
            }
            var sourceAttr = ''
            if ( e.data.source ) {
              sourceAttr = ' source=\'' + e.data.source + '\''
            }
            editor.insertContent('[lf-section-explainer title="' + e.data.title + '"' + imageAttr + imageClassesAttr + idAttr + themeAttr + alignAttr + sourceAttr + ']<br />' + e.data.content + '<br />[/lf-section-explainer]');
          }
        });
      }
    });

    editor.addButton('lf-text-overlay', {
      text: 'LF Text Overlay',
      tooltip: 'Insert Text Overlay',
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert Text Overlay',
          body: [
            {
              type: 'container',
              label: 'Image',
              name: 'background-image-container',
              minHeight: 150,
              items: [
                {
                  type: 'container',
                  html: '<div id="background-image-preview"></div>'
                },
                {
                  type: 'textbox',
                  hidden: true,
                  name: 'image',
                  id: 'background-image',
                  value: ''
                },
                {
                  type: 'button',
                  name: 'select-image',
                  label: 'Image',
                  text: 'Search Media Library',
                  onclick: function() {
                    insertImgID()
                  }
                }
              ]
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
              type: 'listbox',
              name: 'align',
              label: 'Alignment',
              'values': [
                {
                  text: 'Left',
                  value: 'left'
                },
                {
                  text: 'Right',
                  value: 'right'
                }
              ]
            },
            {
              type: 'textbox',
              multiline: true,
              name: 'content',
              label: 'Explainer Content',
              placeholder: 'Explainer Content',
              minWidth: 300,
              minHeight: 100
            },
          ],
          onsubmit: function(e) {
            var imageAttr = ''
            if ( e.data.image ) {
              imageAttr = ' image="' + e.data.image + '"'
            }
            var idAttr = ''
            if ( e.data.id ) {
              idAttr = ' id="' + e.data.id + '"'
            }
            var themeAttr = ''
            if ( e.data.theme ) {
              themeAttr = ' theme="' + e.data.theme + '"'
            }
            var alignAttr = ''
            if ( e.data.align ) {
              alignAttr = ' align="' + e.data.align + '"'
            }
            editor.insertContent('[lf-text-overlay' + imageAttr + idAttr + themeAttr + alignAttr + ']<br />' + e.data.content + '<br />[/lf-text-overlay]');
          }
        });
      }
    });

    editor.addButton('lf-toc', {
      text: 'LF ToC',
      tooltip: 'Insert Table of Contents for Longform',
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert Table of Contents for Longform',
          body: [
            {
              type: 'listbox',
              name: 'main',
              label: 'Main Post in Series',
              values: tinyMCE_posts
            },
            {
              type: 'textbox',
              name: 'chapters',
              label: 'Chapters in Series',
              placeholder: 'Comma separated list of post IDs'
            }
          ],
          onsubmit: function(e) {
            var mainAttr = '';
            if ( mainAttr ) {
              mainAttr = ' main="' + e.data.main + '"';
            }

            var chaptersAttr = '';
            if ( chaptersAttr ) {
              chaptersAttr = ' chapters="' + e.data.chapters + '"';
            }
            editor.insertContent('[lf-toc' + mainAttr + chaptersAttr + ']');
          }
        });
      }
    });

  });
})();