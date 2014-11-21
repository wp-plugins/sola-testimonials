<?php $sola_t_options = get_option('sola_t_options_settings'); ?>
<h4><?php _e('The below options will only affect testimonials using the \'Single\' or \'Grid\' Layouts. To change the options of your slider, plese navigate to the \'Slider\' tab.', 'sola_t'); ?><h4>
<form name="sola_t_options_form" method="post">
    <tr>
        <th><label for=""><?php _e('Show Testimonial Title', 'sola_t'); ?></label></th>
        <td>        
            <input type="checkbox" name="sola_t_show_title" id="sola_t_show_title" value="1" <?php if(isset($sola_t_options['show_title']) && $sola_t_options['show_title'] == 1){ echo 'checked'; } ?> />
            <p class="description"><?php _e('By checking this, the title of each testimonial will be displayed in all layouts', 'sola_t'); ?></p>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Show Testimonial Body', 'sola_t'); ?></label></th>
        <td>        
            <input type="checkbox" name="sola_t_show_excerpt" id="sola_t_show_excerpt" value="1" <?php if(isset($sola_t_options['show_excerpt']) && $sola_t_options['show_excerpt'] == 1){ echo 'checked'; } ?> />
            <p class="description"><?php _e('By checking this, the body of each testimonial will be displayed in all layouts', 'sola_t'); ?></p>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Excerpt Length', 'sola_t'); ?></label></th>
        <td>        
            <input type="text" name="sola_t_except_length" id="sola_t_except_length" value="<?php if(isset($sola_t_options['excerpt_length'])){ echo $sola_t_options['excerpt_length']; } ?>" />
            <p class="description"><?php _e('How long should your testimonial teaser be? (Specify number of words).', 'sola_t'); ?></p>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Default Image Size', 'sola_t'); ?></label></th>
        <td>        
            <input type="text" name="sola_t_image_size" id="sola_t_image_size" value="<?php if(isset($sola_t_options['image_size'])){ echo $sola_t_options['image_size']; } ?>" />
            <p class="description"><?php _e('Size of testimonial images (px).', 'sola_t'); ?></p>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Read More Link', 'sola_t'); ?></label></th>
        <td>        
            <input type="text" name="sola_t_read_more_link" id="sola_t_read_more_link" value="<?php if(isset($sola_t_options['read_more_link']) && $sola_t_options['read_more_link'] != ""){ echo $sola_t_options['read_more_link']; } ?>" />
            <p class="description"><?php _e('What would you like your users to click on to read more about your testimonial?', 'sola_t'); ?></p>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Show User\'s Name', 'sola_t'); ?></label></th>
        <td>        
            <input type="checkbox" name="sola_t_show_user_name" id="sola_t_show_user_name" value="1" <?php if(isset($sola_t_options['show_user_name']) && $sola_t_options['show_user_name'] == 1){ echo 'checked'; } ?>/>
            <p class="description"><?php _e('By checking this, the user\'s name will display next to each testimonial', 'sola_t'); ?></p>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Show Link To User\'s Website', 'sola_t'); ?></label></th>
        <td>        
            <input type="checkbox" name="sola_t_show_web" id="sola_t_show_web" value="1" <?php if(isset($sola_t_options['show_user_web']) && $sola_t_options['show_user_web'] == 1){ echo 'checked'; } ?>/>
            <p class="description"><?php _e('By checking this, a link will display next to each testimonial containing their web address.', 'sola_t'); ?></p>
        </td>
    </tr>
    <tr>
        <th><label for=""><?php _e('Show Testimonial Image', 'sola_t'); ?></label></th>
        <td>        
            <input type="checkbox" name="sola_t_show_image" id="sola_t_show_image" value="1" <?php if(isset($sola_t_options['show_image']) && $sola_t_options['show_image'] == 1){ echo 'checked'; } ?>/>
            <p class="description"><?php _e('By checking this, an image will display next to each testimonial', 'sola_t'); ?></p>
        </td>
    </tr>    
    <tr>
        <td colspan="2">
            <hr/>
        </td>
    </tr>
    <tr>
        <th><input type="submit" name="sola_t_save_options"  class="button-primary" value="<?php _e('Update Settings', 'sola_t'); ?>" /></th>
        <td></td>
    </tr>
</form>

