<?php
/*
Plugin Name: Billing System
Plugin URI:
Description: Plugin allow Billing/communication between student and tutor.
Version: 1.0.0
Author: Gurjeet Singh
Author URI: 
License:
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class BillingSystem {

	//** Constructor **//
	function __construct() {
		add_action('admin_menu', array(&$this, 'addMenu') );		
	}

	function addMenu() {
		add_menu_page( 'Billing System', 'Billing System', 'manage_options', 'billingsystem', array(&$this	, 'settingPage'), 'dashicons-groups', 10 );
	}

	function settingPage() {		
	?>	
		<div class="wrap">
			<h1>Billing System Settings.</h1>			
		</div>
	<?php
	}

}//** Class ends here. **//

new BillingSystem;
?>
