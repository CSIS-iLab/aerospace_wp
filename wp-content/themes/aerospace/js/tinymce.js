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
                        editor.insertContent( '[fullWidth width=' + e.data.maxWidth + '][/fullWidth]');
                    }
                });
            }
        });
        
	});
})();
