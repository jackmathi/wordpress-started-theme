<?php
add_action('admin_menu', 'mphb_room_type_options');

function mphb_room_type_options() {

/*Give your custom posttypes name*/

add_meta_box('mphb_room_type_options', 'Sub Content', 'mphb_room_type_options_design', 'news');

}

function mphb_room_type_options_design($post_id) {
global $post;
$showInHome = get_post_meta($post->ID, 'sub_content', true);
$Addcontent = get_post_meta($post->ID, 'add_content', true);

?>

<?php 
echo '<table>';
echo '<tr>';
echo '<td><label for="add_content"><strong>Add Title</strong></label></td>';
echo '<td>:</td>';
echo '<td><input type="text" id="add_content" name="add_content" value="' . esc_attr( $Addcontent) . '" style="width: 100%;" /></td>';
echo '</table>';

wp_editor( htmlspecialchars_decode($showInHome), 'sub_content', $showInHome = array('textarea_name'=>'sub_content') );
?>
<?php
}

add_action('save_post', 'save_mphb_room_type');

function save_mphb_room_type($post_id) {
global $post;
get_post_type($post_id);
// do not save if this is an auto save routine
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
return $post->ID;
update_post_meta($post_id, 'sub_content', $_REQUEST['sub_content']);
update_post_meta($post_id, 'add_content', $_REQUEST['add_content']);


}
?>
