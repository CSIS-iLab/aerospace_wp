( function( wp ) {

    const aircraftShortcode = function ( props ) {
        return wp.element.createElement(
            wp.editor.RichTextToolbarButton, {
                icon: 'editor-code',
                title: 'Aircraft Shortcode',
                onClick: function() {
                    props.onChange( wp.richText.toggleFormat(
                        props.value,
                        { type: 'aircraft-shortcode/sample-output' }
                    ));
                },
                isActive: props.isActive,
            }
        )
    }
    wp.richText.registerFormatType(
        'aircraft-shortcode/sample-output',{
            title: 'Aircraft Shortcode',
            tagName: 'img',
            className: 'img-aircraft',
            edit: aircraftShortcode
        }
    );
})( window.wp );