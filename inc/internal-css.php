<?php
    /*-----------------------------------------------------------------*/
    /* Imperfect custom internal css add */
    /*-----------------------------------------------------------------*/
    function imperfect_internal_css_add() {

        if ( current_theme_supports( 'custom-header', 'header-text' ) ) {
    ?> 
        <style>
            #intro > header h2, #intro > header p {
                <?php if ( !display_header_text() ) { echo 'display: none !important;'; } ?>
                color: #<?php echo get_header_textcolor(); ?>
            }
        </style>
    <?php
        }

    }
    add_action( 'wp_head', 'imperfect_internal_css_add' );

?>