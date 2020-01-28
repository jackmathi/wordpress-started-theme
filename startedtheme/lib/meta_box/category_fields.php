<?php

/**
 * Adding Image Field
 * @return void 
 */
function news_categories_add_details( $term ) {
    
    ?>
    <div class="form-field">
        <label for="details"><?php _e( 'Details', 'Started theme' ); ?></label>

        <input type="text" name="details" id="details" value="">


        <input type="file" name="img" id="details" value="">
    </div>
<?php
}
add_action( 'news_categories_add_form_fields', 'news_categories_add_details', 10, 2 );



/**
 * Edit Image Field
 * @return void 
 */
function news_categories_edit_details( $term ) {
    
    // put the term ID into a variable
    $t_id = $term->term_id;
    get_template_part('inc/upload-scripts');
 
    $term_image = get_term_meta( $t_id, 'details', true );
     $term_img = get_term_meta( $t_id, 'img', true ); 
    ?>
    <tr class="form-field">
        <th><label for="details"><?php _e( 'Details', 'Started theme' ); ?></label></th>
         
        <td>     
            <input type="text" name="details" id="details" value="<?php echo esc_attr( $term_image ) ? esc_attr( $term_image ) : ''; ?>">
        </td>

         <td>     
            <input type="file" name="img" id="details" value="<?php echo esc_attr( $term_img ) ? esc_attr( $term_img ) : ''; ?>">
            <img src="<?php echo esc_attr( $term_img ) ? esc_attr( $term_img ) : ''; ?>">
        </td>
    </tr>
<?php
}
add_action( 'news_categories_edit_form_fields', 'news_categories_edit_details', 10 );


/**
 * Saving Image
 */
function news_categories_save_details( $term_id ) {
    
    if ( isset( $_POST['details'] ) ) {
        $term_image = $_POST['details'];
         $term_img = $_POST['img'];
        if( $term_image ) {
             update_term_meta( $term_id, 'details', $term_image );
              update_term_meta( $term_id, 'img', $term_img );
        }

    } 
        
}  
add_action( 'edited_news_categories', 'news_categories_save_details' );  
add_action( 'create_news_categories', 'news_categories_save_details' );



