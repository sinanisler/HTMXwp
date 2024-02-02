<?php 






// Menu Support
add_theme_support( 'menus' );
add_theme_support( 'title-tag' );






function custom_enqueue_scripts() {
    // Enqueue htmx script
    wp_enqueue_script(
        'htmx', // Handle for the script, should be unique.
        'https://unpkg.com/htmx.org@1.9.10', // URL to the script.
        array(), // Dependencies, an array of registered script handles this script depends on.
        '1.9.10', // Version number for the script, helps with cache busting.
        true // Whether to enqueue the script in the footer. `true` for footer, `false` for header.
    );

    // Enqueue htmx head-support extension
    wp_enqueue_script(
        'htmx-head-support',
        'https://unpkg.com/htmx.org/dist/ext/head-support.js',
        array('htmx'), // Making it dependent on htmx script.
        null, // No version needed, it will be fetched as the latest version.
        true
    );

}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');









// Custom Menu Attributes Support for HTMX.org
// Add custom fields to menu item
function htmx_attr_add_custom_fields( $item_id, $item, $depth, $args ) {
    ?>
    <p class="field-htmx-get description description-wide">
        <label for="edit-menu-item-htmx-get-<?php echo $item_id; ?>">
            <?php _e( 'hx-get' ); ?><br />
            <input type="text" id="edit-menu-item-htmx-get-<?php echo $item_id; ?>" class="widefat code edit-menu-item-custom" name="menu-item-htmx-get[<?php echo $item_id; ?>]" value="<?php echo esc_attr( get_post_meta( $item_id, '_menu_item_htmx_get', true ) ); ?>" />
        </label>
    </p>

    <p class="field-htmx-target description description-wide">
        <label for="edit-menu-item-htmx-target-<?php echo $item_id; ?>">
            <?php _e( 'hx-target' ); ?><br />
            <input type="text" id="edit-menu-item-htmx-target-<?php echo $item_id; ?>" class="widefat code edit-menu-item-custom" name="menu-item-htmx-target[<?php echo $item_id; ?>]" value="<?php echo esc_attr( get_post_meta( $item_id, '_menu_item_htmx_target', true ) ); ?>" />
        </label>
    </p>

    <p class="field-htmx-select description description-wide">
        <label for="edit-menu-item-htmx-select-<?php echo $item_id; ?>">
            <?php _e( 'hx-select' ); ?><br />
            <input type="text" id="edit-menu-item-htmx-select-<?php echo $item_id; ?>" class="widefat code edit-menu-item-custom" name="menu-item-htmx-select[<?php echo $item_id; ?>]" value="<?php echo esc_attr( get_post_meta( $item_id, '_menu_item_htmx_select', true ) ); ?>" />
        </label>
    </p>
    <?php
}

add_action( 'wp_nav_menu_item_custom_fields', 'htmx_attr_add_custom_fields', 10, 4 );

// Save custom field value
function htmx_attr_update_custom_fields( $menu_id, $menu_item_db_id, $args ) {
    update_post_meta( $menu_item_db_id, '_menu_item_htmx_get',      sanitize_text_field( $_POST['menu-item-htmx-get'][$menu_item_db_id] ) );
    update_post_meta( $menu_item_db_id, '_menu_item_htmx_target',   sanitize_text_field( $_POST['menu-item-htmx-target'][$menu_item_db_id] ) );
    update_post_meta( $menu_item_db_id, '_menu_item_htmx_select',   sanitize_text_field( $_POST['menu-item-htmx-select'][$menu_item_db_id] ) );
}

add_action( 'wp_update_nav_menu_item', 'htmx_attr_update_custom_fields', 10, 3 );

// Append custom attributes to menu items
function htmx_attr_setup_nav_menu_item( $menu_item ) {
    $menu_item->htmx_get    = get_post_meta( $menu_item->ID, '_menu_item_htmx_get', true );
    $menu_item->htmx_target = get_post_meta( $menu_item->ID, '_menu_item_htmx_target', true );
    $menu_item->htmx_select = get_post_meta( $menu_item->ID, '_menu_item_htmx_select', true );
    return $menu_item;
}

add_filter( 'wp_setup_nav_menu_item', 'htmx_attr_setup_nav_menu_item' );

function htmx_attr_nav_menu_start_el( $item_output, $item, $depth, $args ) {
    if ( !empty( $item->htmx_get ) ) {
        $item_output = preg_replace( '/(<a.*?)/', '$1 hx-get="' . esc_attr( $item->htmx_get ) . '"', $item_output );
    }
    if ( !empty( $item->htmx_target ) ) {
        $item_output = preg_replace( '/(<a.*?)/', '$1 hx-target="' . esc_attr( $item->htmx_target ) . '"', $item_output );
    }
    if ( !empty( $item->htmx_select ) ) {
        $item_output = preg_replace( '/(<a.*?)/', '$1 hx-select="' . esc_attr( $item->htmx_select ) . '"', $item_output );
    }
    return $item_output;
}

add_filter( 'walker_nav_menu_start_el', 'htmx_attr_nav_menu_start_el', 10, 4 );
