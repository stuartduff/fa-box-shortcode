jQuery(document).ready(function($) {

    tinymce.create('tinymce.plugins.fabs_plugin', {
        init : function(editor, url) {
                // Register command for when button is clicked
                editor.addCommand('fabs_insert_shortcode', function() {

                  editor.windowManager.open(
                       //  Properties of the window.
                       {
                           title: "Font Awesome Box Shortcode",      //    The title of the dialog window.
                           file:  url + '/tinymce-dialog.html',      //    The HTML file with the dialog contents.
                           width: 380,                               //    The width of the dialog
                           height: 420,                              //    The height of the dialog
                           inline: 1                                 //    Whether to use modal dialog instead of separate browser window.
                       },

                       //  Parameters and arguments we want available to the window.
                       {
                           // This is a reference to the current editor. We'll need this to insert the shortcode we create.
                           editor: editor,

                           // If you want jQuery in the dialog, you must pass it here.
                           jquery: $,
                       }
                   );
                });

            // Register buttons - trigger above command when clicked
            editor.addButton('fabs_button', {
              title : 'Insert box',
              cmd : 'fabs_insert_shortcode',
              image: url + '/images/box.png' }
            );
        },
    });

    // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('fabs_button', tinymce.plugins.fabs_plugin);
});
