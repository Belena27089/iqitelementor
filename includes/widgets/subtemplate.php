<?php
namespace Elementor;

use IqitElementorLanding;

if ( ! defined( 'ELEMENTOR_ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_Subtemplate extends Widget_Base {

	public function get_id() {
		return 'subtemplate';
	}

	public function get_title() {
		return \IqitElementorWpHelper::__( 'Sub template', 'elementor' );
	}

	public function get_icon() {
		return 'post';
	}

	protected function _register_controls() {
		$this->add_control(
			'section_subtemplate',
			[
				'label' => \IqitElementorWpHelper::__( 'Sub template', 'elementor' ),
				'type' => Controls_Manager::SECTION,
			]
		);

        $pages = IqitElementorLanding::getLandingPages();
        $options = [
            0 => '----'
        ];

        foreach ($pages as $page) {
            $options[$page['id']] = $page['name'];
        }

		$this->add_control(
			'layout',
			[
				'label' => \IqitElementorWpHelper::__('Layouts', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'tab' => self::TAB_CONTENT,
				'options' => $options,
                'section' => 'section_subtemplate',
			]
		);
	}

	protected function render( $instance = [] ) {

        $layoutId = (int) $instance['layout'];
        if (!$layoutId) {
            echo \IqitElementorWpHelper::__('You should choose template', 'elementor');
            return;
        }

        $layout = new IqitElementorLanding($layoutId, \Context::getContext()->language->id);
        PluginElementor::instance()->editor->setForceEditMode(false);
        PluginElementor::instance()->get_frontend((array) json_decode($layout->data, true));
        PluginElementor::instance()->editor->setForceEditMode(null);
	}

    protected function content_template() {}
}
