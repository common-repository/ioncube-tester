<?php
/*
Plugin Name: IonCube Tester
Plugin URI: http://www.netbomber.com
Description: A plugin to detect if IonCube loaders are installed and running ok.
Version: 1.0
Author: netbomber.com
Author URI: http://www.netbomber.com
License: GPL 2
Copyright 2011 netbomber.com  (email : support@netbomber.com)
*/
/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action('admin_menu', 'ict_add_page_fn');

function ict_add_page_fn() {
	add_options_page('IonCube Tester', 'IonCube Tester', 'administrator', __FILE__, 'ict_options_page_fn');
}

function ict_get_ad(){
	$prod_ver = base64_encode("1.0");
	$prod_name = base64_encode("IonCube Tester");
	$adcode = wp_remote_fopen('http://www.netbomber.com/supportinfo.php?id='.$prod_name.'&v='.$prod_ver);
	return $adcode;
}

function ict_options_page_fn() {
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general"><br /></div>';
	echo '<h2>ionCube Loaders Availability</h2>';
	if(extension_loaded("ionCube Loader")) {
		echo '<h3>IonCube loaders are <span style="color:green;">AVAILABLE</span> on this server.</h3>';
	} else {
		echo '<h3>IonCube loaders are <span style="color:red;">NOT AVAILABLE</span> on this server.</h3>';
	}
	$adcode = ict_get_ad();
	if(strlen($adcode)>0){
	echo $adcode;
	}
	echo '</div>';
}
?>