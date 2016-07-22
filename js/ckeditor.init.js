//ckeditor init
if( CKEDITOR.env.ie && CKEDITOR.env.version < 9 )
  CKEDITOR.tools.enableHtml5Elements( document );

CKEDITOR.config.height = 220;
CKEDITOR.config.width = 'auto';

var initCkeditor = (function(){
  var wysiwygareaAvailable = isWysiwygareaAvailable(),
      isBBCodeBuiltIn = !!CKEDITOR.plugins.get( 'bbcode' );

  return function() {
    var editorElement = CKEDITOR.document.getById( 'cke_editor' );

    // :(((
    if ( isBBCodeBuiltIn ) {
      editorElement.setHtml(
          'Hello world!\n\n' +
          'I\'m an instance of [url=http://ckeditor.com]CKEditor[/url].'
      );
    }

    // Depending on the wysiwygare plugin availability initialize classic or inline editor.
    if ( wysiwygareaAvailable ) {
      CKEDITOR.replace( 'cke_editor' );
    } else {
      editorElement.setAttribute( 'contenteditable', 'true' );
      CKEDITOR.inline( 'editor' );

      // TODO we can consider displaying some info box that
      // without wysiwygarea the classic editor may not work.
    }
  };

  function isWysiwygareaAvailable() {
    if ( CKEDITOR.revision == ( '%RE' + 'V%' ) ) {
      return true;
    }

    return !!CKEDITOR.plugins.get( 'wysiwygarea' );
  }

})();