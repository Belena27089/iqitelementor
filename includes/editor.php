<?php
namespace Elementor;

if ( ! defined( 'ELEMENTOR_ABSPATH' ) ) exit; // Exit if accessed directly

class Editor {

    private $forceEditMode = null;

    public function is_edit_mode() {

        if (!is_null($this->forceEditMode)) {
            return $this->forceEditMode;
        }

        if ( isset( $_GET['controller']  ) && $_GET['controller']  == 'IqitElementorEditor' ) {
            return true;
        }

        if ( isset( $_GET['controller']  ) && $_GET['controller']  == 'Widget' ) {
            if ( isset( $_GET['action']  ) && $_GET['action']  == 'widgetPreview' ) {
                return true;
            }
        }

        return false;
    }

    public function print_panel_html() {

        include( 'editor-templates/editor-wrapper.php' );
        include( 'editor-templates/panel.php' );
        include( 'editor-templates/panel-elements.php' );
        include( 'editor-templates/repeater.php' );
        include( 'editor-templates/templates.php' );

        PluginElementor::instance()->controls_manager->render_controls();
        PluginElementor::instance()->widgets_manager->render_widgets_content();
        PluginElementor::instance()->elements_manager->render_elements_content();

    }

    public function setForceEditMode($editMode)
    {
        $this->forceEditMode = $editMode;
    }
}
