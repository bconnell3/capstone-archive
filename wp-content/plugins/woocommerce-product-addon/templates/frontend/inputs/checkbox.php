<?php
/**
* Checkbox Input Template
* 
* This template can be overridden by copying it to yourtheme/ppom/frontend/inputs/checkbox.php
* 
* @version 1.0
**/

/* 
**========== Block direct access =========== 
*/
if( ! defined('ABSPATH' ) ){ exit; }

$fm = new PPOM_InputManager($field_meta, 'checkbox');
	
$options = ppom_convert_options_to_key_val($fm->options(), $field_meta, $product);

$onetime    = $fm->get_meta_value('onetime');
$taxable    = $fm->get_meta_value('onetime_taxable');

// If options empty
if ( ! $options ) {
	
	echo '<div class="ppom-option-notice">';
        echo '<p>'. __( "Please add some options to render this input.", "ppom" ) .'</p>';
    echo '</div>';
    
	return '';
}

// Defualt Checked Values
$checked_value = array();
if( is_array($default_value) ){
	$checked_value = array_map('stripcslashes', $default_value);
}

$check_wrapper_class = apply_filters('ppom_checkbox_wrapper_class','form-check-inline');

?>

<div class="<?php echo esc_attr($fm->field_inner_wrapper_classes()); ?>" >

	<!-- if title of field exist -->
	<?php if ($fm->field_label()): ?>
		<label class="<?php echo esc_attr($fm->label_classes()); ?>" for="<?php echo esc_attr($fm->data_name()); ?>" ><?php echo sprintf(__("%s", "ppom"), $fm->field_label()); ?></label>
	<?php endif ?>


	<?php 
	foreach ($options as $key => $value){ 

		$option_label = $value['label'];
        $option_price = $value['price'];
        $raw_label    = $value['raw'];
        $without_tax  = $value['without_tax'];
        $option_id    = $value['option_id'];
        $dom_id       = apply_filters('ppom_dom_option_id', $option_id, $field_meta);

        $checked_option = '';
        if( count($checked_value) > 0 && in_array($key, $checked_value) && !empty($key)){
        
            $checked_option = checked( $key, $key, false );
        }

	?>
		<div class="<?php echo esc_attr($check_wrapper_class); ?>">
			<label class="<?php echo esc_attr($fm->checkbox_label_classes()); ?>" for="<?php echo esc_attr($dom_id); ?>">
				
				<input 
					type="checkbox" 
					name="<?php echo esc_attr($fm->form_name()); ?>[]" 
					id="<?php echo esc_attr($dom_id); ?>" 
					class="<?php echo esc_attr($fm->input_classes()); ?>" 
					data-optionid="<?php echo esc_attr($option_id); ?>" 
					data-price="<?php echo esc_attr($option_price); ?>" 
					data-label="<?php echo esc_attr($raw_label); ?>" 
					data-title="<?php echo esc_attr($fm->title()); ?>" 
					data-onetime="<?php echo esc_attr($onetime); ?>" 
					data-taxable="<?php echo esc_attr($taxable); ?>" 
					data-without_tax="<?php echo esc_attr($without_tax); ?>" 
					data-data_name="<?php echo esc_attr($fm->data_name()); ?>" 
					value="<?php echo esc_attr($key); ?>" 
					<?php echo $checked_option; ?>
				>
				<span class="ppom-label-checkbox"><?php echo $option_label; ?></span>
			</label>
		</div>

	<?php } ?>
</div>