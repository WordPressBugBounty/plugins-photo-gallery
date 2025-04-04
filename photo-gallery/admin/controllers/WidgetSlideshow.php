<?php

/**
 * Class WidgetSlideshowController_bwg
 */
class WidgetSlideshowController_bwg extends WP_Widget {

	private $view;
	private $model;

	public function __construct() {
		$widget_ops = array(
		  'classname' => 'bwp_gallery_slideshow',
		  'description' => __('Add Photo Gallery slideshow to Your widget area.', 'photo-gallery')
		);
		// Widget Control Settings.
		$control_ops = array('id_base' => 'bwp_gallery_slideshow');
		// Create the widget.
		parent::__construct('bwp_gallery_slideshow', 'Photo Gallery Slideshow', $widget_ops, $control_ops);
		require_once( BWG()->plugin_dir . '/admin/models/Widget.php');
		$this->model = new WidgetModel_bwg();

		require_once( BWG()->plugin_dir . '/admin/views/WidgetSlideshow.php');
		$this->view = new WidgetSlideshowView_bwg($this->model);
	}

  /**
   * Widget.
   *
   * @param array $args
   * @param array $instance
   */
	public function widget($args, $instance) {
		$this->view->widget($args, $instance);
	}

  /**
   * Form.
   *
   * @param array $instance
   */
 	public function form( $instance ) {
		$slideshow_effects = array(
		  'none' => __('None', 'photo-gallery'),
		  'cubeH' => __('Cube Horizontal', 'photo-gallery'),
		  'cubeV' => __('Cube Vertical', 'photo-gallery'),
		  'fade' => __('Fade', 'photo-gallery'),
		  'sliceH' => __('Slice Horizontal', 'photo-gallery'),
		  'sliceV' => __('Slice Vertical', 'photo-gallery'),
		  'slideH' => __('Slide Horizontal', 'photo-gallery'),
		  'slideV' => __('Slide Vertical', 'photo-gallery'),
		  'scaleOut' => __('Scale Out', 'photo-gallery'),
		  'scaleIn' => __('Scale In', 'photo-gallery'),
		  'blockScale' => __('Block Scale', 'photo-gallery'),
		  'kaleidoscope' => __('Kaleidoscope', 'photo-gallery'),
		  'fan' => __('Fan', 'photo-gallery'),
		  'blindH' => __('Blind Horizontal', 'photo-gallery'),
		  'blindV' => __('Blind Vertical', 'photo-gallery'),
		  'random' => __('Random', 'photo-gallery'),
		);

		// Set params for view.
		$params = array(
      'id_title' => parent::get_field_id('title'),
      'name_title' => parent::get_field_name('title'),
      'id_gallery_id' => parent::get_field_id('gallery_id'),
      'name_gallery_id' => parent::get_field_name('gallery_id'),
      'id_width' => parent::get_field_id('width'),
      'name_width' => parent::get_field_name('width'),
      'id_height' => parent::get_field_id('height'),
      'name_height' => parent::get_field_name('height'),
      'id_filmstrip_height' => parent::get_field_id('filmstrip_height'),
      'name_filmstrip_height' => parent::get_field_name('filmstrip_height'),
      'id_effect' => parent::get_field_id('effect'),
      'name_effect' => parent::get_field_name('effect'),
      'id_interval' => parent::get_field_id('interval'),
      'name_interval' => parent::get_field_name('interval'),
      'id_shuffle' => parent::get_field_id('shuffle'),
      'name_shuffle' => parent::get_field_name('shuffle'),
      'id_theme_id' => parent::get_field_id('theme_id'),
      'name_theme_id' => parent::get_field_name('theme_id'),
      'id_enable_ctrl_btn' => parent::get_field_id('enable_ctrl_btn'),
      'name_enable_ctrl_btn' => parent::get_field_name('enable_ctrl_btn'),
      'id_enable_autoplay' => parent::get_field_id('enable_autoplay'),
      'name_enable_autoplay' => parent::get_field_name('enable_autoplay'),
      'gallery_rows' => $this->model->get_gallery_rows_data(),
      'theme_rows' => $this->model->get_theme_rows_data(),
      'slideshow_effects' => $slideshow_effects
    );
		$this->view->form($params, $instance);
	}

	// Update Settings.
	public function update($new_instance, $old_instance) {
		$instance['title'] = isset($new_instance['title']) ? strip_tags(esc_html($new_instance['title'])) : '';
		$instance['gallery_id'] = isset($new_instance['gallery_id']) ? intval($new_instance['gallery_id']) : 0;
		$instance['width'] = isset($new_instance['width']) ? intval($new_instance['width']) : 200;
		$instance['height'] = isset($new_instance['height']) ? intval($new_instance['height']) : 200;
		$instance['filmstrip_height'] = isset($new_instance['filmstrip_height']) ? intval($new_instance['filmstrip_height']) : 40;
		$instance['effect'] = isset($new_instance['effect']) ? esc_html($new_instance['effect']) : 'fade';
		$instance['interval'] = isset($new_instance['interval']) ? intval($new_instance['interval']) : 5;
		$instance['shuffle'] = isset($new_instance['shuffle']) ? intval($new_instance['shuffle']) : 0;
		$instance['theme_id'] = isset($new_instance['theme_id']) ? intval($new_instance['theme_id']) : 1;
		$instance['enable_ctrl_btn'] = isset($new_instance['enable_ctrl_btn']) ? intval($new_instance['enable_ctrl_btn']) : 0;
		$instance['enable_autoplay'] = isset($new_instance['enable_autoplay']) ? intval($new_instance['enable_autoplay']) : 0;
		return $instance;
	}
}

/**
 * Class BWGControllerWidgetSlideshow
 *
 * Allow to work old widgets registered with this name of class added with SiteOrigin builder.
 */
class BWGControllerWidgetSlideshow extends WidgetSlideshowController_bwg {}
