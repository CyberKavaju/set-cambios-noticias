<?php
/**
 * Adds Set_Cambios_Widget widget.
 */
class Set_Cambios_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'set_cambios_widget', // Base ID
			esc_html__( 'SET Cambios y Noticias', 'set_cambios_domain' ), // Name
			array( 'description' => esc_html__( 'Widget para mostrar los cambios del dia de la SET', 'set_cambios_domain' ), ) // Args
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
		echo $args['before_widget'];//before widget options
    //widget title
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
    //widget main content
		$html = file_get_html('https://www.set.gov.py/portal/PARAGUAY-SET/');
		$cambios = $html->find('table.UITable tbody', 0);
		$cambiosTitulo = $cambios->find('td.UICotizacionTitulo', 0);
		$cambiosCompra = $cambios->find('td.UICotizacion p', 0)->plaintext;
		$cambiosVenta = $cambios->find('td.UICotizacion p', 1)->plaintext;
		$noticias = $html->find('div#UICLVPresentation_05f1f908-d473-4477-b8b8-09a3db149975', 0);
		$links = $noticias->find('a');
		?>
				<div>
			<p class="cambiostitulo">
			<b>
				<?php echo $cambiosTitulo; ?>
			</b>	
			</p>
			<p class="cambioscompra">
				<b>Compra 1USD:</b>  <?php echo str_replace(' ', '', $cambiosCompra); ?>
			</p>
			<p class="cambiosventa">
				<b>Venta 1USD:</b>  <?php echo str_replace(' ', '', $cambiosVenta); ?>
			</p>
			</div>
			<ul class="noticias">
			<?php foreach ($links as $link) : ?>
				<?php if ($link->innertext != "Leer más") : ?>
					<li>- <a href="https://www.set.gov.py<?php echo $link->href; ?>" target="_blank"> <?php echo $link->innertext; ?></a></li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	<?php

		echo $args['after_widget'];//after widget options
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'SET Cambios', 'set_cambios_domain' );
		?>
		<p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
        <?php esc_attr_e( 'Title:', 'set_cambios_domain' ); ?>
      </label> 
      <input class="widefat" 
      id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
      name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
      type="text" 
      value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Set_Cambios