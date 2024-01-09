<?php
/**
 * Adds a custom button to get the latest download.
 *
 * @package Panda3D
 */

/**
 *
 */
function panda3d_add_nav_menu_metabox() {
    add_meta_box('add-latest-download', 'Latest Download', 'panda3d_nav_menu_metabox', 'nav-menus', 'side', 'default');
}

add_action('admin_head-nav-menus.php', 'panda3d_add_nav_menu_metabox');

function panda3d_nav_menu_metabox($object) {
    global $nav_menu_selected_id;

    $latest_download = wp_get_recent_posts(array(
        'numberposts' => 1,
        'post_type' => 'download',
        'post_status' => 'publish'
    ), 'OBJECT')[0];

    class Item {
        public $db_id = 0;
        public $object = 'download';
        public $object_id = -1;
        public $menu_item_parent = 0;
        public $type = 'post_type';
        public $type_label = 'Latest Download';
        public $title = '<i class="fas fa-cloud-download"></i> Get the SDK';
        public $url = '';
        public $target = '';
        public $attr_title = '';
        public $classes = array('cta', 'cta--primary');
        public $xfn = '';
    };

    $items = [new Item()];
    $items[0]->object_id = $latest_download->ID;

    $walker = new Walker_Nav_Menu_Checklist(array());
    ?>
    <div id="latest-download">
        <div class="tabs-panel tabs-panel-view-all tabs-panel-active">
            <ul class="categorychecklist form-no-clear">
                <?php echo walk_nav_menu_tree(array_map('wp_setup_nav_menu_item', $items), 0, (object) array('walker' => $walker)); ?>
            </ul>
        </div>
        <p class="button-controls">
            <span class="add-to-menu">
                <input type="submit"<?php disabled($nav_menu_selected_id, 0); ?> class="button submit-add-to-menu right" value="<?php esc_attr_e('Add to Menu', 'panda3d'); ?>" name="add-latest-download-menu-item" id="submit-latest-download" />
                <span class="spinner"></span>
            </span>
        </p>
    </div>
    <?php
}

function panda3d_setup_nav_menu_item($item) {
    if ($item->object == 'download' && $item->title == '<i class="fas fa-cloud-download"></i> Get the SDK') {
        $latest_download = wp_get_recent_posts(array(
            'numberposts' => 1,
            'post_type' => 'download',
            'post_status' => 'publish'
        ), 'OBJECT')[0];
        $item->object_id = $latest_download->ID;
        $item->url = get_permalink($latest_download->ID);
        $item->attr_title = 'Download Panda3D ' . get_field('version_number', $latest_download->ID);
    }
    return $item;
}

add_filter('wp_setup_nav_menu_item', 'panda3d_setup_nav_menu_item');

?>
