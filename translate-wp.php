<?php
/*
Plugin Name: WP Translate
Plugin URI: http://plugins.wp-themes.ws/wp-translate
Description: Widget to enable visitors to translate your webpage to their native language through a widget.
Version: 1.0.5
Author: WP-Themes.ws
Author URI: http://wp-themes.ws
*/


/*  Copyright 2010 WP-Themes.ws - support@wp-themes.ws

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Hook for adding admin menus
add_action('admin_menu', 'wp_translate_add_pages');

// action function for above hook
function wp_translate_add_pages() {
    add_options_page('WP Translate', 'WP Translate', 'administrator', 'wp_translate', 'wp_translate_options_page');
}

// wp_translate_options_page() displays the page content for the Test Options submenu
function wp_translate_options_page() {

    // variables for the field and option names 
    $opt_name = 'mt_translate_main';
	$opt_name_4 = 'mt_translate_title';
    $opt_name_5 = 'mt_translate_plugin_support';
    $hidden_field_name = 'mt_translate_submit_hidden';
    $data_field_name = 'mt_translate_main';
	$data_field_name_4 = 'mt_translate_title';
    $data_field_name_5 = 'mt_translate_plugin_support';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
	$opt_val_4 = get_option($opt_name_4);
    $opt_val_5 = get_option($opt_name_5);

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];
		$opt_val_4 = $_POST[$data_field_name_4];
        $opt_val_5 = $_POST[$data_field_name_5];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );
		update_option( $opt_name_4, $opt_val_4 );
        update_option( $opt_name_5, $opt_val_5 );

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'WP Translate Plugin Settings', 'mt_trans_domain' ) . "</h2>";

    // options form
    

    $change1 = get_option("mt_translate_plugin_support");

if ($change1=="Yes" || $change1=="") {
$change1="checked";
$change11="";
} else {
$change1="";
$change11="checked";
}

    ?>
<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Widget Title:", 'mt_trans_domain' ); ?> 
<input type="text" name="<?php echo $data_field_name_4; ?>" value="<?php echo $opt_val_4; ?>" size="50">
</p><hr />

<p><?php _e("Support the Plugin?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="Yes" <?php echo $change1; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_5; ?>" value="No" <?php echo $change11; ?>>No
</p><hr />

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p><hr />

</form>
</div>
<?php
 
}

function show_translate($args) {

extract($args);

  $widget_title = get_option("mt_translate_title"); 
  $widget_main = get_option("mt_translate_main");
  $supportplugin = get_option("mt_translate_plugin_support"); 

$current_url="http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];

echo $before_widget.$before_title.stripslashes($widget_title).$after_title;
  
echo '<form action="http://translate.google.com/translate" method="get" id="translatewp3">
<select name="tl" onChange="this.parentNode.submit();">
<option value="af">Afrikaans</option>
<option value="sq">Albanian</option>
<option value="ar">Arabic</option>
<option value="be">Belarusian</option>
<option value="bg">Bulgarian</option>
<option value="ca">Catalan</option>
<option value="zh-CN">Chinese (Simplified)</option>
<option value="zh-TW">Chinese (Traditional)</option>
<option value="hr">Croatian</option>
<option value="cs">Czech</option>
<option value="da">Danish</option>
<option value="nl">Dutch</option>
<option value="en" selected>English</option>
<option value="et">Estonian</option>
<option value="tl">Filipino</option>
<option value="fi">Finnish</option>
<option value="fr">French</option>
<option value="de">German</option>
<option value="el">Greek</option>
<option value="he">Hebrew</option>
<option value="hi">Hindi</option>
<option value="is">Icelandic</option>
<option value="ga">Irish</option>
<option value="it">Italian</option>
<option value="ja">Japanese</option>
<option value="ko">Korean</option>
<option value="lv">Latvian</option>
<option value="lt">Lithuanian</option>
<option value="mk">Macedonian</option>
<option value="ms">Malay</option>
<option value="no">Norwegian</option>
<option value="fa">Persian</option>
<option value="pl">Polish</option>
<option value="pt">Portuguese</option>
<option value="ru">Russian</option>
<option value="es">Spanish</option>
<option value="sk">Slovak</option>
<option value="sw">Swahili</option>
<option value="sv">Swedish</option>
<option value="th">Thai</option>
<option value="tr">Turkish</option>
<option value="uk">Ukrainian</option>
<option value="cy">Welsh</option>
<option value="vi">Vietnamese</option>
<option value="yi">Yiddish</option>
</select><input type="hidden" name="sl" value="auto" /><input type="hidden" name="u" value="'.$current_url.'" /></form>';

if ($supportplugin=="Yes" || $supportplugin=="") {
echo "<p style='font-size:x-small'>Translate Plugin made by <a href='http://www.ares-p2p-download.com'>Ares Free Download</a></p>";
}

echo $after_widget;

}


function init_translate_widget() {
register_sidebar_widget("WP Translate", "show_translate");
}

add_action("plugins_loaded", "init_translate_widget");

?>
