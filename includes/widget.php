<?php

/*
 * This will display a specific testimonial chosen by the user
 */

class Sola_Testimonials_Widget_Single extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'sola_testimonials_widget_single',
			__( 'Sola Testimonials Widget - Single', 'sola_t' ), 
			array( 'description' => __( 'Display a single testimonial by using this widget.', 'sola_t' ), )
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

		$testimonial_array = array( 'id' => $instance['sola_t_chosen_testimonial'] );

		echo sola_t_all_testimonials( $testimonial_array );

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Testimonials', 'sola_t' );

		$chosen_testimonial  = ! empty( $instance['sola_t_chosen_testimonial'] ) ? $instance['sola_t_chosen_testimonial'] : "" ;

		$ret = "";

		$ret .= "<p>";
		$ret .= "<label for='" . $this->get_field_id( 'title' ) . "'>" . __( 'Title:', 'sola_st' ) . "</label>";
		$ret .= "<input class='widefat' id='" . $this->get_field_id( 'title' ) . "' name='" . $this->get_field_name( 'title' ) . "' type='text' value='" . esc_attr( $title ) . "'>";	
		$ret .= "</p>";

		$ret .= "<p>";
		$ret .= "<label for='" . $this->get_field_id( 'title' ) . "''>" . __( 'Select a testimonial:', 'sola_st' ) . "</label>";		

		$ret .= "<select name='" . $this->get_field_name( 'sola_t_chosen_testimonial' ) . "' class='widefat' id='" . $this->get_field_id( 'sola_t_chosen_testimonial' ) . "'>";

		$ret .= "<option value=''></option>";

		$my_query = new WP_Query('post_type=testimonials&posts_per_page=-1&status=publish');

		while ($my_query->have_posts()): $my_query->the_post(); 

		if( get_the_ID() == $chosen_testimonial ) {
			
			$dropdown_selected = 'selected';

		} else {

			$dropdown_selected = '';					

		}

		$ret .= "<option value='" . get_the_ID() . "' " . $dropdown_selected . ">" . get_the_title() . "</option>";				

		endwhile;
	
		$ret .= "</select>";

		wp_reset_query();

		$ret .= "</p>";

		echo $ret;

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		
		$instance['sola_t_chosen_testimonial'] = ( ! empty( $new_instance['sola_t_chosen_testimonial'] ) ) ? strip_tags( $new_instance['sola_t_chosen_testimonial'] ) : '';

		return $instance;
	}

}

/*
 * This will display a random testimonial on every page load 
 */

class Sola_Testimonials_Widget_Random extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'sola_testimonials_widget_random',
			__( 'Sola Testimonials Widget - Random', 'sola_t' ), 
			array( 'description' => __( 'Display a random testimonial on every page load by using this widget.', 'sola_t' ), )
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}

		echo do_shortcode( "[sola_t_all_testimonials random=yes]" );

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Testimonials', 'sola_t' );

		$ret = "";

		$ret .= "<p>";
		$ret .= "<label for='" . $this->get_field_id( 'title' ) . "'>" . __( 'Title:', 'sola_st' ) . "</label>";
		$ret .= "<input class='widefat' id='" . $this->get_field_id( 'title' ) . "' name='" . $this->get_field_name( 'title' ) . "' type='text' value='" . esc_attr( $title ) . "'>";	
		$ret .= "</p>";

		wp_reset_query();

		$ret .= "</p>";

		echo $ret;

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		
		return $instance;
	}

}

/*
 * This will display testimonials in a slider
 */

class Sola_Testimonials_Widget_Slider_Basic extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'sola_testimonials_widget_slider_basic',
			__( 'Sola Testimonials Widget - Slider', 'sola_t' ), 
			array( 'description' => __( 'Display your testimonials in a slider by using this widget.', 'sola_t' ), )
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		/*
		 * Nothing to output as this is a Pro feature. 
		 */

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Testimonials', 'sola_t' );

		$pro_link = "<a href='http://solaplugins.com/plugins/sola-testimonials/?utm_source=plugin&utm_medium=link&utm_campaign=sola_t_slider_widget'>" . __( 'Pro version', 'sola_st' ) . "</a>";

		$ret = "";

		$ret .= "<p>". __( 'Get the ' . $pro_link . ' to display your testimonials in a slider', 'sola_t' ) . "</p>";

		$ret .= "</p>";

		echo $ret;

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		
		return $instance;
	}

}