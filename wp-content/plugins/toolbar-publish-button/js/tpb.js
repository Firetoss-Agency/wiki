( function( $ ) {

    var button_bg = '' !== tpb_l10n.button_bg ? ' style="background-color: ' + tpb_l10n.button_bg + '"' : '';



    $.fn.extend({

        duplicateButton: function ( bclass )
        {
            var bclass = ' ' + bclass || '';

            if ( $(this).length ) {

                var val;


                if ( this.is('input') ) {
                    val = $(this).val();
                }
                else if ( this.is('a') ) {
                    val = $(this).html();
                }


                var id = $(this).attr( 'id' ),
                    content = '<li id="wp-admin-bar-wpuxss-tpb-' + id + '"  class="wpuxss-tpb' + bclass + '"><a class="ab-item" href="#" id="top-toolbar-submit" for="' + id + '"' + button_bg + '><span class="ab-icon"></span><span class="ab-label">' + val + '</span></a></li>';


                if ( $('.ab-top-menu .wpuxss-tpb').length )
                    $('.ab-top-menu .wpuxss-tpb').last().after( content );
                else if ( $('#wp-admin-bar-new-content').length )
                    $('#wp-admin-bar-new-content').after( content );
                else
                    $('.ab-top-menu').append( content );


                return true;
            }
            return false;
        }

    });



    // input[type="button"] was excluded since v1.6
    // because it's causing issues to some jquery plugins
    var button = $('#wpbody-content .wrap input[type="submit"].button-primary').not('.find-box input, .widget-control-save, #screen-options-wrap input, #bulk_edit');


    if ( ! button.attr( 'id' ) )
        button.first().attr( 'id','tpb_publish' );
    button.first().duplicateButton( 'wpuxss-tpb-publish' );



    if ( tpb_l10n.draft_button ) {

        var draft_button = $('#wpbody-content .wrap input[type="submit"]#save-post:visible').not('.find-box input');


        draft_button.first().duplicateButton( 'wpuxss-tpb-save-post' );

        $('.save-post-status').on('click', function() {
            setTimeout( function() {
                $('.wpuxss-tpb-save-post .ab-item .ab-label').html( draft_button.val() );
            }, 15 );

        });
    }



    if ( tpb_l10n.preview_button ) {

        var preview_button = $('#wpbody-content .wrap a#post-preview');


        preview_button.first().duplicateButton( 'wpuxss-tpb-post-preview' );
    }



    $('#wpadminbar .wpuxss-tpb a').click(function(e)
    {
        e.preventDefault();
        $('#'+$(this).attr('for')).click();
    });

})( jQuery );
