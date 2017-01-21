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

include('classes/BsUserList.php');

class BillingSystem {

	//** Constructor **//
	function __construct() {
		add_action('admin_menu', array(&$this, 'addMenu') );		
	}

	function addMenu() {
		add_menu_page( 'Billing System', 'Billing System', 'manage_options', 'billingsystem', array(&$this	, 'plugin_homepage'), 'dashicons-groups', 10 );
	}

	function settingPage() {		
	?>	
		<div class="wrap">
			<h1>Billing System Members.</h1>			
			<?php //echo do_shortcode("[ultimatemember form_id=20569]");?>
			
			<?php
				$blogusers = get_users( );
				echo '<table style="text-align: center; width: 100%;" border=1>
								<thead>
									<tr>
										<th>User ID</th>
										<th>Username</th>
										<th>Email</th>
										<th>Commission</th>
									</tr>	
								</thead>
								<tbody>';
				foreach ( $blogusers as $user ) {
					if(in_array('instructor', $user->roles)){
						echo '<tr style="text-align: center;">';
							echo	'<td>'.esc_html( $user->ID ).'</td>';
							echo	'<td>'.esc_html( $user->display_name ).'</td>';
							echo	'<td>'.esc_html( $user->user_email ).'</td>';
							echo	'<td>10%</td>';
						echo '</tr>';	
					}					
				}
				echo '</tbody>
						</table>';
			?>
		</div>		
	<?php		
	}

	function plugin_homepage(){
        $bsUserList = new BsUserList();
        $bsUserList->prepare_items();
        ?>
            <div class="wrap">
                <div id="icon-users" class="icon32"></div>
                <div class="awst_header">
                    <h2 class="aw_awst_header_h2">Billing System Users</h2>
                    <div class="clear"></div>
                </div>
                <?php $bsUserList->display(); ?>
            </div>
        <?php
    }

}//** Class ends here. **//

new BillingSystem;
?>
