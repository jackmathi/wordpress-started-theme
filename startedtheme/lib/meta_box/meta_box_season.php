<?php
add_action('admin_menu', 'rightnav_link_options');

function rightnav_link_options() {
    foreach (array('news') as $type) {   
add_meta_box('rightnav_link_options', 'Details', 'rightnav_link_options_design', $type);
}
}

function rightnav_link_options_design($post_id) {
    global $post;
    $rn_season = get_post_meta($post->ID, 'rn_season', true);   
    $rn_rate_def = get_post_meta($post->ID, 'rn_rate_def', true);
    $rn_start_date = get_post_meta($post->ID, 'rn_start_date', true);
    $rn_end_date = get_post_meta($post->ID, 'rn_end_date', true);
    ?>
   

    <div id="groundDiv" >       
        <table cellpadding="2" cellspacing="3" border="0" id='rgtlink_floor' class='fontsize10'   style='font-size: 11px;'>
           <!--  <tr>
            <td class="left"><label for="tax-order">Title</label></td>
            <td  class="right">
			<input type="textbox" name="link_heading" id="link_heading" value="<?php echo $link_heading; ?>" style="width: 100%;"></td>
        </tr> -->
    <?php for ($j = 0; $j < count($rn_season); $j++) { ?>
                <tr>       
                    <td><label for="tax-order">Seasons</label></td>
                    <td><input type="text" name="rn_season[]" value="<?php echo $rn_season[$j]; ?>" id="rn_season[]" style="width:170px;"/></td>
                    <td><label for="tax-order">Villa Rate</label></td>
                    <td><input type="text" name="rn_rate_def[]"  value="<?php echo $rn_rate_def[$j]; ?>" id="rn_rate_def[]" style="width:170px;"/></td>
                   
                    <td><label for="tax-order">Start Date</label></td>
                    <td><input type="date" name="rn_start_date[]"  value="<?php echo $rn_start_date[$j]; ?>" id="rn_start_date[]" style="width:170px;"/></td>
                   
                    <td><label for="tax-order">End Date</label></td>
                    <td><input type="date" name="rn_end_date[]"  value="<?php echo $rn_end_date[$j]; ?>" id="rn_end_date[]" style="width:170px;"/></td>
                   
                    <td align="right">
                        <?php if ($j == 0) { ?><span class='curpointer button' onclick="addRow_band('rgtlink_floor', 'rn')"><b> + </b></span>  <?php } else {
                ?><span class='curpointer button' onclick="deleteCurrentRow_band(this)"><b> - </b></span>          <?php } ?>
                    </td>
                </tr> 
    <?php } ?>
        </table>
    </div>   
    <?php
}

add_action('save_post', 'save_rightnav_link');

function save_rightnav_link($post_id) {
    global $post;

    get_post_type($post_id);

    //if (get_post_type($post_id) == 'project_post') {

        // do not save if this is an auto save routine
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return $post->ID;  

        for ($i = 0; $i < count($_REQUEST['rn_season']); $i++) {            
            update_post_meta($post_id, 'rn_season', $_REQUEST['rn_season']);
            update_post_meta($post_id, 'rn_rate_def', $_REQUEST['rn_rate_def']);
            update_post_meta($post_id, 'rn_start_date', $_REQUEST['rn_start_date']);
            update_post_meta($post_id, 'rn_end_date', $_REQUEST['rn_end_date']);
         }
        
    //}
}
?>