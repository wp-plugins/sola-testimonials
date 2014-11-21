<?php

add_shortcode('sola_testimonial', 'sola_t_all_testimonials');
add_shortcode('sola_t_all_testimonials', 'sola_t_all_testimonials');

function sola_t_all_testimonials($atts){
    global $post;

    $options = get_option('sola_t_options_settings');
    
    $show_title = $options['show_title'];
    $show_body = $options['show_excerpt'];
    $show_name = $options['show_user_name'];
    $show_website = $options['show_user_web'];
    $show_image = $options['show_image'];
    $image_size = $options['image_size'];
    
    if(function_exists('sola_t_register_pro')){
        $my_query = testimonials_in_categories($atts);
    } else {
        if (isset($atts['id']) && $atts['id'] > 0) {
            $my_query = new WP_Query('post_type=testimonials&posts_per_page=1&p='.$atts['id']);
        } else {
            $my_query = new WP_Query('post_type=testimonials&posts_per_page=-1&status=publish');
        }
    }
    $ret = "<div class='sola_t_container'>";
    $cnt = 0;
    while ($my_query->have_posts()): $my_query->the_post(); 
    $cnt++;
        if(isset($show_title) && $show_title == 1){
            $the_title = "
                <div class=\"sola_t_title\"><a href=\"".get_the_permalink($post->ID)."\">".get_the_title()."</a></div>";
        } else {
            $the_title = "";
        }
        
        if(isset($show_body) && $show_body == 1){
            $the_body = "
                <div class=\"sola_t_body\">&ldquo;".striptags(get_the_excerpt(),"<a><b><em><strong><i><h>")."&rdquo;</div>";
        } else {
            $the_body = "";
        }
        
        if(isset($show_name) && $show_name == 1){
            if($name = get_post_meta($post->ID, 'sola_t_user_name')) {
                $name = $name[0]; 
                if($name != ""){
                    $the_name = "
                    <span class=\"sola_t_name\">$name</span>";
                } else {
                    $the_name = "";
                }
            } else { 
                $the_name = "";
            }
        } else {
            $the_name = "";
        }
        
        if(isset($show_website) && $show_website == 1){
            if($website_name = get_post_meta($post->ID, 'sola_t_website_name')) {
                $website_name = $website_name[0]; 
            } else { 
                $website_name = '';
            }
            if($website = get_post_meta($post->ID, 'sola_t_website_address')) {
                $website = $website[0]; 
            } else { 
                $website = '';
            }
            if($website_name == ""){
                $website_name = $website;
            }
            if($website != "" && $website != "http://"){
                $the_website = "
                    <span class=\"sola_t_website\">, <a href=\"".$website."\" target=\"_BLANK\" rel=\"nofollow\" >".$website_name."</a>"."</span>";
            } else {
                $the_website = "<span class=\"sola_t_website\">&nbsp;</span>";
            }
        } else {
            $the_website = "<span class=\"sola_t_website\">&nbsp;</span>";
        }
            
        $layouts = get_option('sola_t_style_settings');
        
        if (isset($layouts['image_layout'])) { $image = $layouts['image_layout']; } else { $image = "image-1"; }
        if (isset($layouts['chosen_layout'])) { $layout = $layouts['chosen_layout']; } else { $layout = "layout-1"; }
        if (isset($layouts['chosen_theme'])) { $theme = $layouts['chosen_theme']; } else { $theme = "theme-1"; }
        

        if (isset($atts['theme']) && $atts['theme'] != '') { $theme = $atts['theme']; }
        if (isset($atts['layout']) && $atts['layout'] != '') { $layout = $atts['layout']; }
        
        
        if(isset($image) && $image == 'image-1'){
            $class = "";
        } else if(isset($image) && $image == 'image-2'){
            $class = "sola-t-round-image";
        } else {
            $class = "";
        }

        
        if(isset($show_image) && $show_image == 1){ 
                
            $sola_t_custom_image = get_post_meta($post->ID, 'sola_t_image_url', true);
            
            if(isset($sola_t_custom_image) && $sola_t_custom_image != "" && !empty($sola_t_custom_image)){

                $the_image = "<div class=\"sola_t_image $class\"  style=\"width:".$image_size."px; height:".$image_size."px;\"><img src=\"$sola_t_custom_image\" title=\"".get_the_title()."\" alt=\"".get_the_title()."\" /></div>";

            } else {

                $sola_t_user_email = get_post_meta($post->ID, 'sola_t_user_email', true);

                if(isset($sola_t_user_email) && $sola_t_user_email != "" && !empty($sola_t_user_email)){

                    $author_email_address = $sola_t_user_email;

                    $grav_url = "http://www.gravatar.com/avatar/".md5(strtolower(trim($author_email_address)))."?s=$image_size&d=mm";

                    $the_image = "<div class=\"sola_t_image $class\" style=\"width:".$image_size."px; height:".$image_size."px;\"><img src=\"$grav_url\" title=\"".get_the_title()."\" alt=\"".get_the_title()."\"/></div>";

                } else {

                    $author_email_address = get_the_author_meta('user_email');

                    $grav_url = "http://www.gravatar.com/avatar/".md5(strtolower(trim($author_email_address)))."?s=$image_size&d=mm";

                    $the_image = "<div class=\"sola_t_image $class\" style=\"width:".$image_size."px; height:".$image_size."px;\"><img src=\"$grav_url\" title=\"".get_the_title()."\" alt=\"".get_the_title()."\"/></div>";
                }
            }

        } else {
            $the_image = "";
        }
        
        switch($layout){
            case 'layout-1':
                $content = "
                    <div class=\"sola_t_layout_1_container $theme sola_t_cnt_$cnt\">                    
                        <div class=\"sola_t_container\">
                            $the_image
                            <div class=\"sola_t_container_body\">
                                $the_title
                                $the_body
                            </div>
                            <div class=\"sola_t_meta_data\">
                                $the_name
                                $the_website
                            </div>
                        </div>
                    </div>
                ";
                break;
            case 'layout-2':
                $content = "
                    <div class=\"sola_t_layout_2_container $theme sola_t_cnt_$cnt\">                    
                        <div class=\"sola_t_container\">
                            $the_image
                            <div class=\"sola_t_container_body\">
                                $the_title
                                $the_body
                            </div>
                            <div class=\"sola_t_meta_data\">
                                $the_name
                                $the_website
                            </div>
                        </div>
                    </div>
                ";
                break;
            case 'layout-3':
                $content = "
                    <div class=\"sola_t_layout_3_container $theme sola_t_cnt_$cnt\">                    
                        <div class=\"sola_t_container\">
                            $the_image
                            <div class=\"sola_t_container_body\">
                                $the_title
                                $the_body
                            </div>
                            <div class=\"sola_t_meta_data\">
                                $the_name
                                $the_website
                            </div>
                        </div>

                    </div>
                ";
                break;
            case 'layout-4':
                $content = "
                    <div class=\"sola_t_layout_4_container $theme sola_t_cnt_$cnt\">                    
                        <div class=\"sola_t_container\">
                            $the_image
                            <div class=\"sola_t_container_body\">
                                $the_title
                                $the_body
                            </div>
                            <div class=\"sola_t_meta_data\">
                                $the_name
                                $the_website
                            </div>
                        </div>
                    </div>
                ";
                break;
            case 'layout-5':
                    $content = "
                        <div class=\"sola_t_layout_5_container sola_t_cnt_$cnt\">                    
                            <div class=\"sola_t_container\">
                                    $the_image
                                    $the_title
                                    $the_body
                                <div class=\"sola_t_meta_data\">
                                    $the_name
                                    $the_website
                                </div>
                            </div>
                        </div>
                    ";
                    break;
        }        
        $ret .= $content;
    endwhile;
    
    $ret .= "</div>";
    return $ret;
    wp_reset_query();
}



