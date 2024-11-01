<?php
/*
Plugin Name: WP-CC
Plugin URI: http://firasd.org/studio/wp/wp-cc
Description: Facilitates the usage of Creative Commons licenses. Configure in Options &rarr; WP-CC.
Version: 2005-01-31
Author: Firas Durri
Author URI: http://firasd.org
*/
/*
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors","1");*/

load_plugin_textdomain('wp-cc');

if(is_plugin_page()) {wp_cc_config(); }

else {
/* Check for / Initialize basic settings */
if (!(get_option('wp_cc_version'))) {
	add_option('wp_cc_version');
}

update_option('wp_cc_version', '2005-01-31');

$wp_cc_version = get_option('wp_cc_version');
	
/* Check if a license has been chosen; if not, initialize license variable with placeholder text */
if (!(get_option('wp_cc_license'))) {
	add_option('wp_cc_license', 'none', 'Creative Commons license for WP-CC');
	add_option('wp_cc_auto_text', false, '');
	add_option('wp_cc_auto_image', false, '');
	add_option('wp_cc_auto_metadata', false, '');
}
/* Get WP-CC options */
$wp_cc_license = get_option('wp_cc_license');
$wp_cc_auto_text = get_option('wp_cc_auto_text');
$wp_cc_auto_image = get_option('wp_cc_auto_image');
$wp_cc_auto_metadata = get_option ('wp_cc_auto_metadata');

function wp_cc_option_clearall() {
}

/*
Function: Output RDF metadata of selected CC license
Parameters: None
Run by: User
*/
function cc_output_metadata() {
	global $wp_cc_license;
	
	switch ($wp_cc_license) {	
		case 'by-2.0':
			echo(cc_output_by_20('metadata', "")); break;
		case 'by-nd-2.0':
			echo(cc_output_by_nd_20('metadata', "")); break;
		case 'by-nc-nd-2.0':
			echo(cc_output_by_nc_nd_20('metadata', "")); break;
		case 'by-nc-2.0':
			echo(cc_output_by_nc_20('metadata', "")); break;
		case 'by-nc-sa-2.0':
			echo(cc_output_by_nc_sa_20('metadata', "")); break;
		case 'by-sa-2.0':
			echo(cc_output_by_sa_20('metadata', "")); break;
		case 'none':
			echo("No license chosen."); break;
	}
}

/*
Function: Output text linked to selected CC license
Parameters:
	$text is the text specified when calling function from template
Run by: User
*/
function cc_output_text($text='') {
	global $wp_cc_license;
	
	switch ($wp_cc_license) {
		case 'by-2.0':
			echo(cc_output_by_20('text', $text)); break;
		case 'by-nd-2.0':
			echo(cc_output_by_nd_20('text', $text)); break;
		case 'by-nc-nd-2.0':
			echo(cc_output_by_nc_nd_20('text', $text)); break;
		case 'by-nc-2.0':
			echo(cc_output_by_nc_20('text', $text)); break;
		case 'by-nc-sa-2.0':
			echo(cc_output_by_nc_sa_20('text', $text)); break;
		case 'by-sa-2.0':
			echo(cc_output_by_sa_20('text', $text)); break;
		case 'none':
			echo("No license chosen."); break;
	}
}
/*
Function: Output image linked to selected CC license
Parameters:
	$text is the text specified when calling function from template
Run by: User
*/
function cc_output_image($text='') {
	global $wp_cc_license;
	
	switch ($wp_cc_license) {
		case 'by-2.0':
			echo(cc_output_by_20('image', $text)); break;
		case 'by-nd-2.0':
			echo(cc_output_by_nd_20('image', $text)); break;
		case 'by-nc-nd-2.0':
			echo(cc_output_by_nc_nd_20('image', $text)); break;
		case 'by-nc-2.0':
			echo(cc_output_by_nc_20('image', $text)); break;
		case 'by-nc-sa-2.0':
			echo(cc_output_by_nc_sa_20('image', $text)); break;
		case 'by-sa-2.0':
			echo(cc_output_by_sa_20('image', $text)); break;
		case 'none':
			echo("No license chosen."); break;
	}
}
/*
Function: Output metadata, text or image linked to by-2.0 license
Parameters:
	$item is the output type desired
	$options is text specified to customize output
Run by: cc_output_image, cc_output_metadata, cc_output_text
*/
function cc_output_by_20($item, $options) {
	
	switch ($item) {
		case 'metadata':
			$output = '
			<!--
			<rdf:RDF xmlns="http://web.resource.org/cc/"
			    xmlns:dc="http://purl.org/dc/elements/1.1/"
			    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
			<Work rdf:about="">
			   <license rdf:resource="http://creativecommons.org/licenses/by/2.0/" />
			</Work>
			<License rdf:about="http://creativecommons.org/licenses/by/2.0/">
			   <permits rdf:resource="http://web.resource.org/cc/Reproduction" />
			   <permits rdf:resource="http://web.resource.org/cc/Distribution" />
			   <requires rdf:resource="http://web.resource.org/cc/Notice" />
			   <requires rdf:resource="http://web.resource.org/cc/Attribution" />
			   <permits rdf:resource="http://web.resource.org/cc/DerivativeWorks" />
			</License>
			</rdf:RDF>
			-->' . "\n";
			return $output; break;
		case 'text':
			If($options == "") { $options = 'Creative Commons License'; }
			$output = '
			<a rel="license" href="http://creativecommons.org/licenses/by/2.0/">' . $options . '</a>';
			return $output; break;
		case 'image':
			If($options == "") { $options = 'Creative Commons License'; }
			$output = '
			<a rel="license" href="http://creativecommons.org/licenses/by/2.0/"><img alt="' . $options . '"  src="http://creativecommons.org/images/public/somerights20.gif" /></a>';
			return $output; break;
		}
	}

/*
Function: Output metadata, text or image linked to by-nd-2.0 license
Parameters:
	$item is the output type desired
	$options is text specified to customize output
Run by: cc_output_image, cc_output_metadata, cc_output_text
*/
function cc_output_by_nd_20($item, $options) {
	
	switch ($item) {
		case 'metadata':
			$output = '
			<!--
			<rdf:RDF xmlns="http://web.resource.org/cc/"
			    xmlns:dc="http://purl.org/dc/elements/1.1/"
			    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
			<Work rdf:about="">
			   <license rdf:resource="http://creativecommons.org/licenses/by-nd/2.0/" />
			</Work>
			
			<License rdf:about="http://creativecommons.org/licenses/by-nd/2.0/">
			   <permits rdf:resource="http://web.resource.org/cc/Reproduction" />
			   <permits rdf:resource="http://web.resource.org/cc/Distribution" />
			   <requires rdf:resource="http://web.resource.org/cc/Notice" />
			   <requires rdf:resource="http://web.resource.org/cc/Attribution" />
			</License>
			
			</rdf:RDF>
			-->' . "\n";
			return $output; break;
		case 'text':
			If($options == "") { $options = 'Creative Commons License'; }
			$output = '
			<a rel="license" href="http://creativecommons.org/licenses/by-nd/2.0/">' . $options . '</a>';
			return $output; break;
		case 'image':
			If($options == "") { $options = 'Creative Commons License'; }
			$output = '
			<a rel="license" href="http://creativecommons.org/licenses/by-nd/2.0/"><img alt="' . $options . '"  src="http://creativecommons.org/images/public/somerights20.gif" /></a>';
			return $output; break;
		}
	}
/*
Function: Output metadata, text or image linked to by-nc-nd-2.0 license
Parameters:
	$item is the output type desired
	$options is text specified to customize output
Run by: cc_output_image, cc_output_metadata, cc_output_text
*/
function cc_output_by_nc_nd_20($item, $options) {
	
	switch ($item) {
		case 'metadata':
			$output = '
			<!--

			<rdf:RDF xmlns="http://web.resource.org/cc/"
			    xmlns:dc="http://purl.org/dc/elements/1.1/"
			    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
			<Work rdf:about="">
			   <license rdf:resource="http://creativecommons.org/licenses/by-nc-nd/2.0/" />
			</Work>
			
			<License rdf:about="http://creativecommons.org/licenses/by-nc-nd/2.0/">
			   <permits rdf:resource="http://web.resource.org/cc/Reproduction" />
			   <permits rdf:resource="http://web.resource.org/cc/Distribution" />
			   <requires rdf:resource="http://web.resource.org/cc/Notice" />
			   <requires rdf:resource="http://web.resource.org/cc/Attribution" />
			   <prohibits rdf:resource="http://web.resource.org/cc/CommercialUse" />
			</License>
			
			</rdf:RDF>
			
			-->
			' . "\n";
			return $output; break;
		case 'text':
			If($options == "") { $options = 'Creative Commons License'; }
			$output = '
			<a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/2.0/">' . $options . '</a>';
			return $output; break;
		case 'image':
			If($options == "") { $options = 'Creative Commons License'; }
			$output = '
			<a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/2.0/"><img alt="' . $options . '"  src="http://creativecommons.org/images/public/somerights20.gif" /></a>';
			return $output; break;
		}
	}
/*
Function: Output metadata, text or image linked to by-nc-2.0 license
Parameters:
	$item is the output type desired
	$options is text specified to customize output
Run by: cc_output_image, cc_output_metadata, cc_output_text
*/
function cc_output_by_nc_20($item, $options) {
	
	switch ($item) {
		case 'metadata':
			$output = '
			<!--

			<rdf:RDF xmlns="http://web.resource.org/cc/"
			    xmlns:dc="http://purl.org/dc/elements/1.1/"
			    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
			<Work rdf:about="">
			   <license rdf:resource="http://creativecommons.org/licenses/by-nc/2.0/" />
			</Work>
			
			<License rdf:about="http://creativecommons.org/licenses/by-nc/2.0/">
			   <permits rdf:resource="http://web.resource.org/cc/Reproduction" />
			   <permits rdf:resource="http://web.resource.org/cc/Distribution" />
			   <requires rdf:resource="http://web.resource.org/cc/Notice" />
			   <requires rdf:resource="http://web.resource.org/cc/Attribution" />
			   <prohibits rdf:resource="http://web.resource.org/cc/CommercialUse" />
			   <permits rdf:resource="http://web.resource.org/cc/DerivativeWorks" />
			</License>
			
			</rdf:RDF>
			
			-->' . "\n";
			return $output; break;
		case 'text':
			If($options == "") { $options = 'Creative Commons License'; }
			$output = '
			<a rel="license" href="http://creativecommons.org/licenses/by-nc/2.0/">' . $options . '</a>';
			return $output; break;
		case 'image':
			If($options == "") { $options = 'Creative Commons License'; }
			$output = '
			<a rel="license" href="http://creativecommons.org/licenses/by-nc/2.0/"><img alt="' . $options . '"  src="http://creativecommons.org/images/public/somerights20.gif" /></a>';
			return $output; break;
		}
	}
	
	/*
Function: Output metadata, text or image linked to by-nc-sa-2.0 license
Parameters:
	$item is the output type desired
	$options is text specified to customize output
Run by: cc_output_image, cc_output_metadata, cc_output_text
*/
function cc_output_by_nc_sa_20($item, $options) {
	
	switch ($item) {
		case 'metadata':
			$output = '
			<!--
			
			<rdf:RDF xmlns="http://web.resource.org/cc/"
			    xmlns:dc="http://purl.org/dc/elements/1.1/"
			    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
			<Work rdf:about="">
			   <license rdf:resource="http://creativecommons.org/licenses/by-nc-sa/2.0/" />
			</Work>
			
			<License rdf:about="http://creativecommons.org/licenses/by-nc-sa/2.0/">
			   <permits rdf:resource="http://web.resource.org/cc/Reproduction" />
			   <permits rdf:resource="http://web.resource.org/cc/Distribution" />
			   <requires rdf:resource="http://web.resource.org/cc/Notice" />
			   <requires rdf:resource="http://web.resource.org/cc/Attribution" />
			   <prohibits rdf:resource="http://web.resource.org/cc/CommercialUse" />
			   <permits rdf:resource="http://web.resource.org/cc/DerivativeWorks" />
			   <requires rdf:resource="http://web.resource.org/cc/ShareAlike" />
			</License>
			
			</rdf:RDF>
			
			-->' . "\n";
			return $output; break;
		case 'text':
			If($options == "") { $options = 'Creative Commons License'; }
			$output = '
			<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.0/">' . $options . '</a>';
			return $output; break;
		case 'image':
			If($options == "") { $options = 'Creative Commons License'; }
			$output = '
			<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.0/"><img alt="' . $options . '"  src="http://creativecommons.org/images/public/somerights20.gif" /></a>';
			return $output; break;
		}
	}
/*
Function: Output metadata, text or image linked to by-sa-2.0 license
Parameters:
	$item is the output type desired
	$options is text specified to customize output
Run by: cc_output_image, cc_output_metadata, cc_output_text
*/
function cc_output_by_sa_20($item, $options) {
	
	switch ($item) {
		case 'metadata':
			$output = '
			<!--

			<rdf:RDF xmlns="http://web.resource.org/cc/"
			    xmlns:dc="http://purl.org/dc/elements/1.1/"
			    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
			<Work rdf:about="">
			   <license rdf:resource="http://creativecommons.org/licenses/by-sa/2.0/" />
			</Work>
			
			<License rdf:about="http://creativecommons.org/licenses/by-sa/2.0/">
			   <permits rdf:resource="http://web.resource.org/cc/Reproduction" />
			   <permits rdf:resource="http://web.resource.org/cc/Distribution" />
			   <requires rdf:resource="http://web.resource.org/cc/Notice" />
			   <requires rdf:resource="http://web.resource.org/cc/Attribution" />
			   <permits rdf:resource="http://web.resource.org/cc/DerivativeWorks" />
			   <requires rdf:resource="http://web.resource.org/cc/ShareAlike" />
			</License>
			
			</rdf:RDF>
			
			-->' . "\n";
			return $output; break;
		case 'text':
			If($options == "") { $options = 'Creative Commons License'; }
			$output = '
			<a rel="license" href="http://creativecommons.org/licenses/by-sa/2.0/">' . $options . '</a>';
			return $output; break;
		case 'image':
			If($options == "") { $options = 'Creative Commons License'; }
			$output = '
			<a rel="license" href="http://creativecommons.org/licenses/by-sa/2.0/"><img alt="' . $options . '"  src="http://creativecommons.org/images/public/somerights20.gif" /></a>';
			return $output; break;
		}
	}

/* Function: Process Options Form
Parameters: none
Run by: wp-cc.php
*/
function wp_cc_process() {
	$wp_cc_new_license = $_POST['wp-cc-new-license'];
	update_option('wp_cc_license', $wp_cc_new_license);
	
	if(isset($_POST['auto_text'])) {
		$wp_cc_new_auto_text = $_POST['auto_text'];
		update_option('wp_cc_auto_text', true);
	} else {
		update_option('wp_cc_auto_text', false);
	}
	
	if(isset($_POST['auto-image'])) {
		$wp_cc_new_auto_image = $_POST['auto-image'];
		update_option('wp_cc_auto_image', true);
	} else {
		update_option('wp_cc_auto_image', false);
	}
	
	if(isset($_POST['auto-metadata'])) {
		$wp_cc_new_auto_metadata = $_POST['auto-metadata'];
		update_option('wp_cc_auto_metadata', true);
	} else {
		update_option('wp_cc_auto_metadata', false);
	}
	
	$location = get_option('siteurl') . '/wp-admin/admin.php?page=wp-cc.php';
	header('Location: '.$location);
}
if(isset($_POST['submitted'])) { wp_cc_process(); }
function wp_cc_version_if_update() {
/*	
	global $wp_cc_version;
	
	$wp_cc_version_latest =  file_get_contents('http://firasd.org/hotlinks/wp-cc-version-latest.txt');
	
	$wp_cc_version_current = implode('',explode('.', $wp_cc_version)); /* change eg. '1.2.3' to '''123' for easy comparison */
/*
	$wp_cc_version_latest_temp = implode('',explode('.', $wp_cc_version_latest));
			
	if($wp_cc_version_current < $wp_cc_version_latest_temp) {
		return TRUE;}
	else { return FALSE; } */
	return false;
	
}

	
/*
Function: Output HTML to render Config page
Parameters: None
Run by: wp-cc.php
*/
function wp_cc_config () {
	
	global $wp_cc_license;
	global $wp_cc_auto_text;
	global $wp_cc_auto_image;
	global $wp_cc_auto_metadata;
	global $wp_cc_version;
	global $wp_cc_locale_strings;
	
	if(wp_cc_version_if_update()) {
		$wp_cc_update =
		'(<a href="http://firasd.org/studio/wp/wp-cc" title="Download Latest Version">Update Available</a>)';
		}

	echo '
<div class="wrap">
	<fieldset class="options">
		<div style="float: right"><img src="http://firasd.org/hotlinks/wp-cc.gif" alt="" /></div>
		<p><strong><a href="http://firasd.org/studio/wp/wp-cc">WP-CC</a></strong>
		&nbsp;v' . $wp_cc_version . '&nbsp;' . $wp_cc_update . '</p>
		<p>'.__('Current Global License: ', 'wp-cc').$wp_cc_license . '</p>
	</fieldset>
</div>
<div class="wrap">
	<h2>'.__('Configure', 'wp-cc').'</h2>
	<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
	<fieldset class="options">
	<legend>' .__('Pick License', 'wp-cc'). '</legend>
	<table style="width: 100%; padding-bottom: 4m;">
		
		<tr>
			<th>'.__('Choose', 'wp-cc').'</th>
			<th>'.__('Name', 'wp-cc').'</th>
		    <th>'.__('Characteristics', 'wp-cc').'</th>
		</tr>';
		
		if($wp_cc_license == 'by-2.0') {
		echo '
		<tr class="alternate" style="background-color: #ffffcf">
			<td style="text-align: center">
				<input type="radio" name="wp-cc-new-license" value="by-2.0" checked="checked" />
			</td>
			<td><a href="http://creativecommons.org/licenses/by/2.0/">Attribution</a></td>
			<td><img src="http://creativecommons.org/icon/by/standard.gif" alt="by" /></td>
		</tr>';}
		else {
		echo '
		<tr class="alternate">
			<td style="text-align: center">
				<input type="radio" name="wp-cc-new-license" value="by-2.0" />
			</td>
			<td><a href="http://creativecommons.org/licenses/by/2.0/">Attribution</a></td>
			<td><img src="http://creativecommons.org/icon/by/standard.gif" alt="by" /></td>
		</tr>';}
		
		if($wp_cc_license == 'by-nd-2.0') {
		echo '
		<tr style="background-color: #ffffcf">
			<td style="text-align: center">
				<input type="radio" name="wp-cc-new-license" value="by-nd-2.0" checked="checked" />
			</td>
			<td><a href="http://creativecommons.org/licenses/by-nd/2.0/">Attribution-NoDerivs</a></td>
			<td>
				<img src="http://creativecommons.org/icon/by/standard.gif" alt="by" />
				<img src="http://creativecommons.org/icon/nd/standard.gif" alt="nd" /></td>
			</td>
		</tr>'; }
		else {
		echo '
		<tr>
			<td style="text-align: center">
				<input type="radio" name="wp-cc-new-license" value="by-nd-2.0" />
			</td>
			<td><a href="http://creativecommons.org/licenses/by-nd/2.0/">Attribution-NoDerivs</a></td>
			<td>
				<img src="http://creativecommons.org/icon/by/standard.gif" alt="by" />
				<img src="http://creativecommons.org/icon/nd/standard.gif" alt="nd" />
			</td>
		</tr>';
	}
		if($wp_cc_license == 'by-nc-nd-2.0') {
		echo '
		<tr class="alternate" style="background-color: #ffffcf">
			<td style="text-align: center">
				<input type="radio" name="wp-cc-new-license" value="by-nc-nd-2.0" checked="checked" />
			</td>
			<td class="odd"><a href="http://creativecommons.org/licenses/by-nc-nd/2.0/">Attribution-NonCommercial-NoDerivs</a></td>
			<td>
				<img src="http://creativecommons.org/icon/by/standard.gif" alt="by" />
				<img src="http://creativecommons.org/icon/nc/standard.gif" alt="nc" />
				<img src="http://creativecommons.org/icon/nd/standard.gif" alt="nd" />
			</td>
		</tr>'; }
		else {
		echo '
		<tr class="alternate">
			<td style="text-align: center">
				<input type="radio" name="wp-cc-new-license" value="by-nc-nd-2.0" />
			</td>
			<td class="odd"><a href="http://creativecommons.org/licenses/by-nc-nd/2.0/">Attribution-NonCommercial-NoDerivs</a></td>
			<td>
				<img src="http://creativecommons.org/icon/by/standard.gif" alt="by" />
				<img src="http://creativecommons.org/icon/nc/standard.gif" alt="nc" />
				<img src="http://creativecommons.org/icon/nd/standard.gif" alt="nd" />
			</td>
		</tr>'; }

		if($wp_cc_license == 'by-nc-2.0') {
		echo '
		<tr style="background-color: #ffffcf">
			<td style="text-align: center">
				<input type="radio" name="wp-cc-new-license" value="by-nc-2.0" checked="checked" />
			</td>
			<td><a href="http://creativecommons.org/licenses/by-nc/2.0/">Attribution-NonCommercial</a></td>
			<td>
				<img src="http://creativecommons.org/icon/by/standard.gif" alt="by" />
				<img src="http://creativecommons.org/icon/nc/standard.gif" alt="nc" />
			</td>
		</tr>'; }
		else {
		echo '
		<tr>
			<td style="text-align: center">
				<input type="radio" name="wp-cc-new-license" value="by-nc-2.0" />
			</td>
			<td><a href="http://creativecommons.org/licenses/by-nc/2.0/">Attribution-NonCommercial</a></td>
			<td>
				<img src="http://creativecommons.org/icon/by/standard.gif" alt="by" />
				<img src="http://creativecommons.org/icon/nc/standard.gif" alt="nc" />
			</td>
		</tr>'; }
		if($wp_cc_license == 'by-nc-sa-2.0') {
		echo '
		<tr class="alternate" style="background-color: #ffffcf">
			<td style="text-align: center">
				<input type="radio" name="wp-cc-new-license" value="by-nc-sa-2.0" checked="checked" />
			</td>
			<td><a href="http://creativecommons.org/licenses/by-nc-sa/2.0/">Attribution-NonCommercial-ShareAlike</a></td>
			<td>
				<img src="http://creativecommons.org/icon/by/standard.gif" alt="by" />
				<img src="http://creativecommons.org/icon/nc/standard.gif" alt="nc" />
				<img src="http://creativecommons.org/icon/sa/standard.gif" alt="sa" /></td>
		</tr>';}
		else {
		echo '		
		<tr class="alternate">
			<td style="text-align: center">
				<input type="radio" name="wp-cc-new-license" value="by-nc-sa-2.0" />
			</td>
			<td><a href="http://creativecommons.org/licenses/by-nc-sa/2.0/">Attribution-NonCommercial-ShareAlike</a></td>
			<td>
				<img src="http://creativecommons.org/icon/by/standard.gif" alt="by" />
				<img src="http://creativecommons.org/icon/nc/standard.gif" alt="nc" />
				<img src="http://creativecommons.org/icon/sa/standard.gif" alt="sa" /></td>
		</tr>';}
		
		if($wp_cc_license == 'by-sa-2.0') {
		echo '
		<tr style="background-color: #ffffcf">
			<td style="text-align: center">
				<input type="radio" name="wp-cc-new-license" value="by-sa-2.0" checked="checked" />
			</td>
			<td><a href="http://creativecommons.org/licenses/by-sa/2.0/">Attribution-ShareAlike</a></td>
			<td>
				<img src="http://creativecommons.org/icon/by/standard.gif" alt="by" />
				<img src="http://creativecommons.org/icon/sa/standard.gif" alt="sa" /></td>
		</tr>';}
		else {
		echo '
		<tr>
			<td style="text-align: center">
				<input type="radio" name="wp-cc-new-license" value="by-sa-2.0" />
			</td>
			<td><a href="http://creativecommons.org/licenses/by-sa/2.0/">Attribution-ShareAlike</a></td>
			<td>
				<img src="http://creativecommons.org/icon/by/standard.gif" alt="by" />
				<img src="http://creativecommons.org/icon/sa/standard.gif" alt="sa" /></td>
		</tr>';}

		if($wp_cc_license == 'none') {
		echo '
		<tr class="alternate" style="background-color: #ffffcf">
			<td style="text-align: center">
				<input type="radio" name="wp-cc-new-license" value="none" checked="checked" />
			</td>
			<td><p>'.__('None', 'wp-cc').'</p></td>
			<td style="font-size: xx-large">&copy;</td>
		</tr>'; }
		else {
		echo '
		<tr class="alternate">
			<td style="text-align: center">
				<input type="radio" name="wp-cc-new-license" value="none" />
			</td>
			<td>'.wp_cc__('None').'</td>
			<td style="font-size: xx-large">&copy;</td>
		</tr>'; }
	echo '
	</table>
	</fieldset>
	
	<fieldset class="options">
	<legend>'.__('Automatic Output', 'wp-cc').'</legend>
	<table>
		<tr>
			<th>'.__('Activate', 'wp-cc').'</th>
			<th>'.__('Item', 'wp-cc').'</th>
		    <th>'.__('Description', 'wp-cc').'</th>
		</tr>
		
		<tr>
			<td style="text-align: center"><input type="checkbox" name="auto_text" value="auto_text" ';
			if($wp_cc_auto_text == true) { echo('checked="checked"'); }
			echo ' /></td>
			<td>'.__('Text', 'wp-cc').'</td>
			<td>'.__('Output link to your license in the footer. Automatic output may not work with some templates.', 'wp-cc').'<br />'.__('See \'<a href="#wp_cc_output">Output Functions</a>\' for more control.', 'wp-cc').'</td>
		</tr>
		<tr class="alternate">
			<td style="text-align: center"><input type="checkbox" name="auto-image" value="auto-image" ';
			if($wp_cc_auto_image == true) { echo('checked="checked"'); }
			echo ' /></td>
			<td>'.__('Image', 'wp-cc').'</td>
			<td>'.__('Output CC logo linked to your license in footer. Automatic output may not work with some templates. <br />See \'<a href="#wp_cc_output">Output Functions</a>\' more control.', 'wp-cc').'</td>
		</tr>
		<tr>
			<td style="text-align: center"><input type="checkbox" name="auto-metadata" value="auto-metadata" ';
			if($wp_cc_auto_metadata == true) { echo('checked="checked"'); }
			echo ' /></td>
			<td>'.__('Metadata', 'wp-cc').'</td>
			<td>'.__('Output <abbr title="Creative Commons">CC</abbr> license in machine-readable <abbr title="Resource Description Framework">RDF</abbr> code, in the &lt;head&gt; section of every page rendered by WordPress. Used by browsers, search engines, &amp;c.<br /><em>Recommended</em>.', 'wp-cc').'</td>
		</tr>
	</table>
	</fieldset>
	
	<input type="hidden" name="submitted" value="submitted" />
	<p class="submit"> 
    <input type="submit" name="Submit" value="'.__('Update Options', 'wp-cc').' &raquo;" /> 
	</p> 
	</form> 
</div>
	
<div class="wrap">
	<h2>'.__('Documentation', 'wp-cc').'</h2>
	<h3>'.__('Functions are placed in your templates.', 'wp-cc').'</h3>
	<fieldset class="options" id="wp_cc_output">
	<legend>'.__('Output Functions', 'wp-cc').'</legend>
	<table>
		<tr>
			<th style="width: 15%; text-align: center">'.__('Item', 'wp-cc').'</th>
		    <th>'.__('Description', 'wp-cc').'</th>
		    <th style="width: 30%">'.__('Code', 'wp-cc').'</th>
		</tr>
		
		<tr>
			<td style="text-align: center">Text</td>
			<td><p>Outputs text linked to your license.</p>
			<p>If no text is specified, it defaults to "Creative Commons License".</p>
			</td>
			<td style="text-align: center"><code>&lt;?php cc_output_text("text") ?&gt;</code></td>
		</tr>
		<tr class="alternate">
			<td style="text-align: center">Linked Image</td>
			<td><p>Outputs image linked to your license, with <code>alt</code> attribute set to ""text" value.</p><p>If no text is specified, it defaults to "Creative Commons License".</p>
			</td>
			<td style="text-align: center"><code>&lt;?php cc_output_image("text") ?&gt;</code></td>
		</tr>
		<tr class="alternate">
			<td style="text-align: center">Metadata</td>
			<td>Output <abbr title="Creative Commons">CC</abbr> license in machine-readable <abbr title="Resource Description Framework">RDF</abbr> code.</td>
			<td style="text-align: center"><code>&lt;?php cc_output_metadata() ?&gt;</code></td>
		</tr>

		
	</table>
	</fieldset>
	
	<fieldset class="options">
	<legend>Usage Examples</legend>
	<table>
		<tr>
			<th style="width: 50%">Code</th>
			<th>Output</th>
		</tr>
		
		<tr class="alternate">
			<td style="text-align: center"><p>All content by Bridget Jones provided under a &lt;?php cc_output_text("Creative Commons license") ?>.</p></td>
			<td><p>All content by Bridget Jones provided under a <a href="#">Creative Commons license</a>.</p></td>
		</tr>
		<tr>
			<td style="text-align: center">
				&lt;div style="text-align: center"&gt;<br />
				&lt;?php cc_output_image("") ?&gt;&lt;br /&gt;<br />
				&lt;?php cc_output_text("") ?&gt;<br />
				&lt;/div&gt;</td>
			<td>
				<div style="text-align: center">
				<a rel="license" href="http://creativecommons.org/licenses/by/2.0/"><img alt="CC License" src="http://creativecommons.org/images/public/somerights20.gif" /></a><br />
				<a rel="license" href="http://creativecommons.org/licenses/by/2.0/">Creative Commons License</a>
				</div>
			</td>
		</tr>
	</table>
	</fieldset>
	
</div>
</body>
</html>' ;
}

/* Add WP-CC Tab to Options Menu */
function wp_cc_add_options_page() {
	if (function_exists('add_options_page')) {
		add_options_page('WP-CC Configuration', 'WP-CC', 5, basename(__FILE__));
		}
	}

/* If this is an admin page, run the function to Add WP-CC Tab to Options Menu */
add_action('admin_head', 'wp_cc_add_options_page');
/* If this is a WP output page, run plugin! */
if($wp_cc_auto_metadata) {add_action('wp_head', 'cc_output_metadata');}
if($wp_cc_auto_image) {add_action('wp_footer', 'cc_output_image' );}
if($wp_cc_auto_text) {add_action('wp_footer', 'cc_output_text' );}
}
?>