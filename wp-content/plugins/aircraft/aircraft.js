( function( wp ) {

    const aircraftShortcode = function ( props ) {
        return wp.element.createElement(
            wp.editor.RichTextToolbarButton, {
                icon: 'editor-code',
                title: 'Aircraft Shortcode',
                onClick: function() {
                    props.onChange( wp.richText.insert(
                        props.value,
                        valueToInsert = '[aircraft]',
                        startIndex = props.value.start,
                        endIndex = props.value.end
                    ));
                },
            }
        )
    }
    wp.richText.registerFormatType(
        'aircraft-shortcode/sample-output',{
            title: 'Aircraft Shortcode',
            tagName: 'samp',
            className: null,
            edit: aircraftShortcode
        }
    );
})( window.wp );