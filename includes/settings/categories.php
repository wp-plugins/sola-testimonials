<?php
if(function_exists('sola_t_display_categories')){
    sola_t_display_categories();
} else {
    echo "<tr class='error'><td>".__('Please update your Pro to the latest version to view a list of categories and their ID\'s', 'sola_t')."</td></tr>";
}




