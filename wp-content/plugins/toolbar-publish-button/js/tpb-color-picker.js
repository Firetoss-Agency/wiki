(function($) {
    
    $(document).ready( function() {
        
        var wpColorOptions = {
            
            palettes: ['#FFFFFF', '#0073AA', '#096484', '#C7A589', '#A3B745', '#E14D43', '#9EBAA0', '#DD823B'],

            // a callback to fire whenever the color changes to a valid color
            change: function( event, ui ) {

                $('#wpadminbar .wpuxss-tpb .ab-item').css( 'background-color', ui.color.toCSS() );
            },
            
            // a callback to fire when the input is emptied or an invalid color
            clear: function() {
                
                $('#wpadminbar .wpuxss-tpb .ab-item').css( 'background-color', '' );
            },
        };
        
        $('.wpuxss-tpb-button-color').wpColorPicker( wpColorOptions );
    });
    
})( jQuery );