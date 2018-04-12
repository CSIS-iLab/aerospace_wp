(function() {
  tinymce.PluginManager.add('aerospace', function(editor, url) {
    editor.addButton('first', {
      text: 'First',
      tooltip: 'Insert First Sentence',
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert First Sentence',
          width: 400,
          height: 100,
          body: [{
            type: 'textbox',
            multiline: true,
            name: 'first',
            label: 'First Sentence',
            placeholder: 'This is your first sentence'
          }],
          onsubmit: function(e) {
            editor.insertContent('[first]' + e.data.first + '[/first]');
          }
        });
      }
    });

    editor.addButton('fullWidth', {
      text: 'FullWidth',
      tooltip: 'Insert Full Width',
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert Full Width',
          width: 400,
          height: 100,
          body: [{
            type: 'textbox',
            multiline: false,
            name: 'maxWidth',
            label: 'Max Width',
            placeholder: 'Insert Max Width'
          }],
          onsubmit: function(e) {
            editor.insertContent('[fullWidth width="' + e.data.maxWidth + '"][/fullWidth]');
          }
        });
      }
    });

    editor.addButton('interactive', {
      text: 'Interactive',
      tooltip: 'Insert Interactive Shortcode',
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert Full Width',
          width: 400,
          height: 100,
          body: [{
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
          ],
          onsubmit: function(e) {
            var align = '';
            if (e.data.align) {
              align = ' align="' + e.data.align + '"';
            }
            editor.insertContent('[data id="' + e.data.id + '"' + align + ']');
          }
        })
      }
    });

    editor.addButton('view', {
      text: 'View',
      tooltip: 'Insert View link',
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert View Link',
          width: 600,
          height: 125,
          body: [{
              type: 'textbox',
              multiline: false,
              name: 'title',
              label: 'Title',
              placeholder: 'Optional Title Attribute'
            },
            {
              type: 'listbox',
              name: 'id',
              label: 'Post',
              values: tinyMCE_posts
            },
            {
              type: 'checkbox',
              name: 'window',
              label: 'Open Link in New Window'
            }
          ],
          onsubmit: function(e) {
            var titleAttr = ''
            if ( e.data.title ) {
              titleAttr = ' title="' + e.data.title + '"'
            }
            var windowAttr = ''
            if ( e.data.window ) {
              windowAttr = ' window="' + e.data.window + '"'
            }
            editor.insertContent('[view id="' + e.data.id + '"' + titleAttr + windowAttr + ']');
          }
        });
      }
    });

    editor.addButton('explore', {
      text: 'Explore',
      tooltip: 'Insert Explore Link',
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert Explore Link',
          width: 400,
          height: 175,
          body: [{
              type: 'textbox',
              multiline: false,
              name: 'title',
              label: 'Title',
              placeholder: 'Title for link'
            },
            {
              type: 'textbox',
              multiline: false,
              name: 'url',
              label: 'URL',
              placeholder: 'URL to link to'
            },
            {
              type: 'textbox',
              multiline: false,
              name: 'verb',
              label: 'Verb Prefix',
              placeholder: 'Explore'
            },
            {
              type: 'checkbox',
              name: 'window',
              label: 'Open Link in New Window'
            }
          ],
          onsubmit: function(e) {
            var exploreAttr = ''
            if (e.data.verb) {
              exploreAttr = ' verb="' + e.data.verb + '"'
            }
            var windowAttr = ''
            if ( e.data.window ) {
              windowAttr = ' window="' + e.data.window + '"'
            }
            editor.insertContent('[explore url="' + e.data.url + '" title="' + e.data.title + '"' + exploreAttr + windowAttr + ']');
          }
        });
      }
    });

    editor.addButton('note', {
      text: 'Footnote',
      icon: null,
      tooltip: 'Insert Footnote',
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert Footnote Content',
          width: 400,
          height: 100,
          body: [{
            type: 'textbox',
            multiline: true,
            name: 'note'
          }],
          onsubmit: function(e) {
            editor.insertContent('[note]' + e.data.note + '[/note]');
          }
        });
      }
    });

    editor.addButton('publication', {
      text: 'External Publication',
      tooltip: 'Insert External Publication Link',
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert External Publication Link',
          width: 400,
          height: 100,
          body: [{
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
          onsubmit: function(e) {
            editor.insertContent('[publication title="' + e.data.title + '" url="' + e.data.url + '"]');
          }
        });
      }
    });

    editor.addButton('download', {
      text: 'Download',
      tooltip: 'Insert Download PDF Button',
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert Download PDF Button',
          width: 400,
          height: 100,
          body: [{
              type: 'textbox',
              multiline: false,
              name: 'label',
              label: 'Button Label',
              placeholder: 'Download PDF'
            },
            {
              type: 'textbox',
              multiline: false,
              name: 'url',
              label: 'PDF URL',
              placeholder: 'The URL to the PDF'
            }
          ],
          onsubmit: function(e) {
            var label = ''
            if (e.data.label) {
              label = ' label="' + e.data.label + '"'
            }
            editor.insertContent('[download' + label + ' url="' + e.data.url + '"]');
          }
        });
      }
    });

    editor.addButton('aside', {
      text: 'Aside',
      icon: null,
      tooltip: 'Insert Aside',
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert Aside Content',
          width: 400,
          height: 150,
          body: [
            {
              type: 'textbox',
              multiline: true,
              name: 'content'
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
                },
                {
                  text: 'Center',
                  value: 'center'
                }
              ]
            }
          ],
          onsubmit: function(e) {
            editor.insertContent('[aside align="' + e.data.align + '"]' + e.data.content + '[/aside]');
          }
        });
      }
    });

    editor.addButton('external-analysis', {
      text: 'External Analysis',
      icon: null,
      tooltip: 'Insert External Analysis',
      onclick: function() {
        editor.windowManager.open({
          title: 'Insert External Analysis Content',
          width: 400,
          height: 200,
          body: [
            {
              type: 'textbox',
              multiline: false,
              name: 'title',
              label: 'Link Title',
              placeholder: 'Title for the Link'
            },
            {
              type: 'textbox',
              multiline: false,
              name: 'url',
              label: 'URL',
              placeholder: 'External URL'
            },
            {
              type: 'textbox',
              multiline: false,
              name: 'organization',
              label: 'Organization',
              placeholder: 'Optionally include the Organization\'s Name'
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
                },
                {
                  text: 'Center',
                  value: 'center'
                }
              ]
            }
          ],
          onsubmit: function(e) {
            var organizationAttr = ''
            if (e.data.organization) {
              organizationAttr = ' organization="' + e.data.organization + '"'
            }
            editor.insertContent('[external-analysis title="' + e.data.title + '" url="' + e.data.url + '"' + organizationAttr + ' align="' + e.data.align + '"]');
          }
        });
      }
    });

  });
})();