<?php
if (!function_exists('kopa_save_general_setting')) {

    function kopa_save_general_setting() {
        if (!wp_verify_nonce($_POST['wpnonce_save_theme_options'], 'save_general_setting'))
            exit();
        $data = $_POST;
        foreach ($data as $key => $value) {
            if (strpos($key, 'kopa_theme_options_') === 0) {
                update_option($key, $value);
            }
        }
        exit();
    }

    add_action('wp_ajax_kopa_save_general_setting', 'kopa_save_general_setting');
}
/* ==============================================================================
 * Remove Sidebar
  =============================================================================== */
if (!function_exists('kopa_remove_sidebar')) {

    function kopa_remove_sidebar() {
        if (!wp_verify_nonce($_POST['wpnonce'], 'save_sidebar_setting'))
            exit();

        if (!empty($_POST['removed_sidebar_id'])) {
            $removed_sidebar_id = ($_POST['removed_sidebar_id']);
            if ($removed_sidebar_id === 'sidebar_hide') {
                echo json_encode(array("is_exist" => true, "error_message" => "You can not remove this sidebar!"));
            } else {
                global $KOPA_SIDEBAR;
                $found_sidebar = false;
                foreach ($KOPA_SIDEBAR as $e_sidebar_id => $e_sidebar_name) {
                    if ($removed_sidebar_id == $e_sidebar_id) {
                        $found_sidebar = true;
                    }
                }
                if ($found_sidebar) {
                    global $KOPA_SETTING;
                    $found_setting = false;
                    foreach ($KOPA_SETTING as $kopa_setting_key => $kopa_setting_value) {
                        foreach ($kopa_setting_value['sidebars'] as $key => $value) {
                            if ($removed_sidebar_id == $value) {
                                $found_setting = true;
                                $layout_id = $kopa_setting_key;
                            }
                        }
                    }
                    if ($found_setting) {
                        global $KOPA_TEMPLATE_HIERARCHY;
                        echo json_encode(array("is_exist" => true, "error_message" => "You can not remove this sidebar. It is in used for " . $KOPA_TEMPLATE_HIERARCHY[$layout_id]['title'] . ' page'));
                    } else {
                        unset($KOPA_SIDEBAR[$removed_sidebar_id]);
                        update_option("kopa_sidebar", $KOPA_SIDEBAR);
                        echo json_encode(array("is_exist" => false, "error_message" => "successfull"));
                    }
                }
            }
        }
        exit();
    }

    add_action('wp_ajax_kopa_remove_sidebar', 'kopa_remove_sidebar');
}
////////////////////////////////////////////////////////
if (!function_exists('kopa_add_sidebar')) {

    function kopa_add_sidebar() {
        if (!wp_verify_nonce($_POST['wpnonce'], 'save_sidebar_setting'))
            exit();
        if (!empty($_POST['new_sidebar_name'])) {
            $kopa_sidebar_name = ($_POST['new_sidebar_name']);
            global $KOPA_SIDEBAR;
            $sidebar_id = strtolower(trim(str_replace(" ", "_", $kopa_sidebar_name)));
            $found_sidebar = false;
            foreach ($KOPA_SIDEBAR as $e_sidebar_id => $e_sidebar_name) {
                if ($sidebar_id == $e_sidebar_id) {
                    $found_sidebar = true;
                }
            }
            if ($found_sidebar) {
                $error_message = 'The sidebar name "' . $kopa_sidebar_name . '" already exist!';
                echo json_encode(array("is_exist" => true, "error_message" => $error_message, "sidebar_id" => $sidebar_id));
            } else {
                echo json_encode(array("is_exist" => false, "error_message" => "", "sidebar_id" => $sidebar_id));
                $KOPA_SIDEBAR[$sidebar_id] = $kopa_sidebar_name;
                update_option("kopa_sidebar", $KOPA_SIDEBAR);
            }
        }
        exit();
    }

    add_action('wp_ajax_kopa_add_sidebar', 'kopa_add_sidebar');
}
////////////////////////////////////////////////////////
if (!function_exists('kopa_save_sidebar_setting')) {

    function kopa_save_sidebar_setting() {
        if (!wp_verify_nonce($_POST['wpnonce'], 'save_sidebar_setting'))
            exit();
        if (!empty($_POST[kopa_sidebar])) {
            $kopa_sidebar_name_arr = ($_POST[kopa_sidebar]);
            $kopa_sidebar_existing = get_option("kopa_sidebar", array());

            foreach ($kopa_sidebar_name_arr as $key => $value) {
                $sidebar_id = trim(str_replace(" ", "_", $value)) . $key;
                if (in_array($sidebar_id, $kopa_sidebar_existing)) {
                    $sidebar_id = $sidebar_id . 'kopa';
                }
                $KOPA_SIDEBAR[$sidebar_id] = $value;
            }
            update_option("kopa_sidebar", $KOPA_SIDEBAR);
        }
        exit();
    }

    add_action('wp_ajax_kopa_save_sidebar_setting', 'kopa_save_sidebar_setting');
}
////////////////////////////////////////////////////////
if (!function_exists('kopa_save_layout')) {

    function kopa_save_layout() {
        global $KOPA_SETTING;
        if (!wp_verify_nonce($_POST['wpnonce'], 'save_layout_setting'))
            exit();
        if (!empty($_POST)) {
            $new_kopa_setting = $_POST['kopa_setting'];
            $template_id = $_POST['template_id'];

            $KOPA_SETTING[$template_id] = $new_kopa_setting[0];
            update_option("kopa_setting", $KOPA_SETTING);
        }
        exit();
    }

    add_action('wp_ajax_kopa_save_layout', 'kopa_save_layout');
}

if (!function_exists('kopa_load_layout')) {

    function kopa_load_layout() {
        if (!wp_verify_nonce($_POST['wpnonce'], 'load_layout_setting'))
            exit();
        if (!empty($_POST)) {
            echo kopa_layout_page($_POST['kopa_template_id']);
        }
        exit();
    }

    add_action('wp_ajax_kopa_load_layout', 'kopa_load_layout');
}

function kopa_layout_page($_kopa_template_id) {
    global $KOPA_LAYOUT;
    global $KOPA_TEMPLATE_HIERARCHY;
    global $KOPA_SIDEBAR_POSITION;
    global $KOPA_SETTING;
    global $KOPA_SIDEBAR;
    wp_nonce_field("load_layout_setting", "nonce_id");
    wp_nonce_field("save_layout_setting", "nonce_id_save");
    ?>
    <div id="kopa-admin-wrapper" class="clearfix">
        <div id="kopa-loading-gif"></div>
        <input type="hidden" id="kopa_template_id" value="<?php echo $_kopa_template_id; ?>">
        <?php
        if ($KOPA_TEMPLATE_HIERARCHY) {
            echo '<div class="kopa-nav list-container">
                <ul class="tabs clearfix">';
            foreach ($KOPA_TEMPLATE_HIERARCHY as $kopa_template_key => $kopa_template_value) {
                if ($kopa_template_key === $_kopa_template_id)
                    $_active = "class='active'";
                else {
                    $_active = '';
                }
                echo '<li ' . $_active . '><span title="' . $kopa_template_key . '" onclick="kopa_load_layout_setting(jQuery(this))">' . $kopa_template_value['title'] . '</span></li>';
            }
            echo '</ul><!--tabs--->
             </div><!--kopa-nav-->';
        }
        ?>
        <div class="kopa-content">
            <div class="kopa-page-header clearfix">
                <div class="pull-left">
                    <h4><?php echo KopaIcon::getIcon('cog'); ?>Layout And Sidebar Manager</h4>
                </div>
                <div class="pull-right">
                    <div class="kopa-copyrights">
                        <span>Visit author URL: </span><a href="<?php echo KOPA_URL; ?>" target="_blank"><?php echo KOPA_URL; ?></a>
                    </div><!--="kopa-copyrights-->
                </div>
            </div><!--kopa-page-header-->
            <div class="tab-container">
                <div class="kopa-content-box tab-content kopa-content-main-box" id="<?php echo $_kopa_template_id; ?>">
                    <div class="kopa-actions clearfix">
                        <div class="kopa-button">
                            <span class="btn btn-primary" onclick="kopa_save_layout_setting(jQuery(this))"><?php echo KopaIcon::getIcon('check-circle'); ?>Save</span>
                        </div>
                    </div><!--kopa-actions-->
                    <div class="kopa-box-head">
                        <?php echo KopaIcon::getIcon('hand-right'); ?>
                        <span class="kopa-section-title"><?php echo $KOPA_TEMPLATE_HIERARCHY[$_kopa_template_id]['title'] ?></span>
                    </div><!--kopa-box-head-->
                    <div class="kopa-box-body clearfix"> 
                        <div class="kopa-layout-box pull-left">
                            <div class="kopa-select-layout-box kopa-element-box">
                                <span class="kopa-component-title">Select the layout</span>
                                <select class="kopa-layout-select"  onchange="show_onchange(jQuery(this));" autocomplete="off">
                                    <?php
                                    foreach ($KOPA_TEMPLATE_HIERARCHY[$_kopa_template_id]['layout'] as $keys => $value) {
                                        echo '<option value="' . $value . '"';
                                        /* foreach ($KOPA_SETTING as $kopa_setting_key => $kopa_setting_value) {
                                          if ($kopa_setting_key == $_kopa_template_id && $kopa_setting_value[layout_id] == $value) {
                                          echo 'selected="selected"';
                                          }
                                          } */
                                        if ($value === $KOPA_SETTING[$_kopa_template_id]['layout_id']) {
                                            echo 'selected="selected"';
                                        }
                                        echo '>' . $KOPA_LAYOUT[$value]['title'] . '</option>';
                                    }
                                    ?>
                                </select>                          
                            </div><!--kopa-select-layout-box-->
                            <?php
                            foreach ($KOPA_TEMPLATE_HIERARCHY[$_kopa_template_id]['layout'] as $keys => $value) {
                                foreach ($KOPA_LAYOUT as $layout_key => $layout_value) {
                                    if ($layout_key == $value) {
                                        ?>
                                        <div class="<?php echo 'kopa-sidebar-box-wrapper sidebar-position-' . $layout_key; ?>">
                                            <?php
                                            foreach ($layout_value['positions'] as $postion_key => $postion_id) {
                                                ?>
                                                <div class="kopa-sidebar-box kopa-element-box">
                                                    <span class="kopa-component-title"><?php echo $KOPA_SIDEBAR_POSITION[$postion_id]['title']; ?></span>
                                                    <label class="kopa-label">Select sidebars</label>
                                                    <?php
                                                    echo '<select class="kopa-sidebar-select" autocomplete="off">';
                                                    foreach ($KOPA_SIDEBAR as $sidebar_list_key => $sidebar_list_value) {
                                                        $__selected_sidebar = '';
                                                        if ($layout_key === $KOPA_SETTING[$_kopa_template_id]['layout_id']) {
                                                            if ($sidebar_list_key === $KOPA_SETTING[$_kopa_template_id]['sidebars'][$postion_key]) {
                                                                $__selected_sidebar = 'selected="selected"';
                                                            }
                                                        }
                                                        echo '<option value="' . $sidebar_list_key . '" ' . $__selected_sidebar . '>' . $sidebar_list_value . '</option>';
                                                        $__selected_sidebar = '';
                                                    }
                                                    echo '</select>';
                                                    ?>
                                                </div><!--kopa-sidebar-box-->
                                            <?php } ?>
                                        </div><!--kopa-sidebar-box-wrapper-->
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </div><!--kopa-layout-box-->
                        <div class="kopa-thumbnails-box pull-right">
                            <?php
                            foreach ($KOPA_TEMPLATE_HIERARCHY[$_kopa_template_id]['layout'] as $thumbnails_key => $thumbnails_value) {
                                ?>
                                <image class="responsive-img <?php echo ' kopa-cpanel-thumbnails kopa-cpanel-thumbnails-' . $thumbnails_value; ?>" src="<?php echo KOPA_CPANEL_IMAGE_DIR . $KOPA_LAYOUT[$thumbnails_value]['thumbnails']; ?>" class="img-polaroid" alt="">
                                <?php
                            }
                            ?>
                        </div><!--kopa-thumbnails-box-->
                    </div><!--kopa-box-body-->
                    <div class="kopa-actions kopa-bottom-action-bar clearfix">
                        <div class="kopa-button">
                            <span class="btn btn-primary" onclick="kopa_save_layout_setting(jQuery(this))"><?php echo KopaIcon::getIcon('check-circle'); ?>Save</span>
                        </div>
                    </div>

                </div><!--kopa-content-box-->
            </div><!--tab-container-->
        </div><!--kopa-content-->
    </div><!--kopa-admin-wrapper-->
    <?php
}


if (!function_exists('kopa_ajax_set_view_count')) {

    function kopa_ajax_set_view_count() {
        check_ajax_referer('kopa_set_view_count', 'wpnonce');
        if (!empty($_POST['post_id'])) {
            $post_id = (int) $_POST['post_id'];
            $data = kopa_set_view_count($post_id);
            echo json_encode($data);
        }
        die();
    }

    add_action('wp_ajax_kopa_set_view_count', 'kopa_ajax_set_view_count');
    add_action('wp_ajax_nopriv_kopa_set_view_count', 'kopa_ajax_set_view_count');
}


