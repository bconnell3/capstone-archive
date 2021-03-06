<?php
/**
* Quantities Input Grid Layout Template
* 
* This template can be overridden by copying it to yourtheme/ppom/frontend/component/quantities/grid-layout.php
* 
* @version 1.0
**/

/* 
**========== Block direct access =========== 
*/
if( ! defined('ABSPATH' ) ){ exit; }

$fm = new PPOM_InputManager($field_meta, 'quantities');

// TODO: re-check again
global $product;

$min_qty   = $fm->get_meta_value('min_qty');
$max_qty   = $fm->get_meta_value('max_qty');
$default_price   = $fm->get_meta_value('default_price', 0);

$include_productprice = '';
if( ppom_is_field_has_price( $field_meta ) ) {
    $include_productprice = 'on';
}

// If price matrix attached then disable default_price
$pricematrix_field = ppom_has_field_by_type(ppom_get_product_id($product), 'pricematrix');
if ( $pricematrix_field ) {
    $default_price = 0;
}

$options = ppom_convert_options_to_key_val($fm->options(), $field_meta, $product);

?>

<div class="form-row  ppom-quantity-box-wrapper">
				
	<?php 
	foreach ($options as $opt){ 

		$min    = (isset($opt['min']) ? $opt['min'] : 0 );
        $max    = (isset($opt['max']) ? $opt['max'] : 10000 );
        
      	$the_price		= isset($opt['price']) ? $opt['price'] : $default_price;
        $usebaseprice   = isset($opt['price']) ? 'no' : 'yes';
    
        $label  = $opt['label'];
        $name	= $fm->form_name().'['.htmlentities($label).']';

        $required = ($fm->required() == 'on' ? 'required' : '');
        
        $option_id      = $opt['id'];
		$dom_id         = apply_filters('ppom_dom_option_id', $option_id, $field_meta);
        
        // Default value
        $selected_val = '';
        if($default_value){
            foreach($default_value as $k => $v) {
                if( $k == $label ) {
                    $selected_val = $v;
                }
            }
        }

        $the_price  = isset($opt['price']) && $opt['price'] != '' ? $opt['price'] : $default_price;

	?>
		<div class="col-md-3 ppom-quantity-box-cols text-center">
			<div class="ppom-quantity-label">
				<label class="quantities-lable"> <?php echo stripslashes(trim($opt['label'])); ?></label>
				<?php if( $the_price ){ ?>
				    <span class="ppom-quantity-price-wrap"><?php echo wc_price($the_price); ?></span>
				<?php } ?>
			</div>

			<?php
            // Price need to filter for currency switcher here not in wc_price
            $the_price = apply_filters('ppom_option_price', $the_price);
            ?>

            <span class="ppom-quantity-qty-section">
                <input 
                	type="number" 
                	name="<?php echo htmlentities($name); ?>" 
                	id="<?php echo esc_attr($dom_id); ?>" 
                	data-data_name="<?php echo esc_attr( $fm->data_name() ); ?>"
                	class="ppom-quantity" 
                	placeholder="0" 
                	min="<?php echo esc_attr($min); ?>" 
                	max="<?php echo esc_attr($max); ?>" 
                	data-min="<?php echo esc_attr($min_qty); ?>" 
					data-max="<?php echo esc_attr($max_qty); ?>" 
                	data-label="<?php echo esc_attr($label); ?>" 
                	data-optionid="<?php echo esc_attr($option_id); ?>" 
                	data-includeprice="<?php echo esc_attr($include_productprice); ?>" 
                	data-usebase_price="<?php echo esc_attr($usebaseprice); ?>" 
                	data-price="<?php echo esc_attr($the_price); ?>" 
                	value="<?php echo esc_attr($selected_val); ?>" 
                	<?php echo esc_attr($required); ?> 
                	style="width: 50%;"
                >
            </span>
		</div>	
	<?php 
	} 
	?>
</div>