<?php



$WPMG_SETTINGS = get_option("WPMG_SETTINGS");



/* get all variables */

	$_POST = stripslashes_deep( $_POST );

		$group_name = (isset($_REQUEST["group_name"])? sanitize_text_field($_REQUEST["group_name"]): '');

		$email_format="";

		$table_name_group = $wpdb->prefix . "mailing_group";

		$result_groups = $objMem->selectRows($table_name_group, "", " order by id asc");

		$disabled = '';

		if(empty($result_groups)){$disabled = 'disabled'; $message = 'Please create a mailing group first.';}



if($_POST){



	if(($_POST['testmessage'])&& $_POST['subject'] && $_POST['group_name']) {

	

    	$from_email      = get_test_email();

		$noreply_email    = get_noreply_email();

		$receiverGroupId   = (isset($_REQUEST["group_name"])? sanitize_text_field($_REQUEST["group_name"]): '');

	

	/* get group details */

		$resultGroup = $objMem->selectRows($table_name_group, "",  " where id = '".$receiverGroupId."' order by id desc");

		$resultGroup = $resultGroup[0];



		$groupTitle = $resultGroup->title;

		$groupEmail = $resultGroup->email;

		$useinSubject = $resultGroup->use_in_subject;			

		$mail_type = $resultGroup->mail_type;

		$sendtouserEmailFormat = 1;

		$sendToEmail = $groupEmail;
		$sendToName = $groupTitle;


	$subject = sanitize_text_field($_REQUEST['subject']);

	$body = sanitize_text_field($_REQUEST['testmessage']);


				if($mail_type == 'smtp'){

								require_once(ABSPATH . WPINC . '/PHPMailer/PHPMailer.php');
								require_once(ABSPATH . WPINC . '/PHPMailer/SMTP.php');
								require_once(ABSPATH . WPINC . '/PHPMailer/Exception.php');

								$mail = new \PHPMailer\PHPMailer\PHPMailer();	

								$mail->IsSMTP();			

								$mail->SMTPDebug = 1; 		

		

								if($resultGroup->smtp_username!='' && $resultGroup->smtp_password!='') {	

									$mail->Username   = $resultGroup->smtp_username; 	

									$mail->Password   = $resultGroup->smtp_password; 

									$mail->SMTPAuth   = true;								

									$mail->SMTPSecure = "ssl";	

																	

								} else {				

									$mail->Username   = $resultGroup->email; 	

									$mail->Password   = $resultGroup->password; 

									$mail->SMTPAuth   = false;								

								}	

								$mail->Host    = $resultGroup->smtp_server; 		

								$mail->Port    = $resultGroup->smtp_port; 	

								$replyEmail = $groupEmail;

								$replyName  = $groupTitle;
								
								$FromName  = $groupTitle;

						/* reply to needs to be added before From or it wont work*/	
						/*Dont use filters in troubleshooting page*/						

								/*$replyName = apply_filters('mg_modify_reply_to_name_smtp', $replyName, $senderName, $resultGroup);

								$replyEmail = apply_filters('mg_modify_reply_to_email_smtp', $replyEmail, $senderEmail, $resultGroup);
								
								$FromName = apply_filters('mg_modify_from_name_smtp', $FromName, $senderName, $resultGroup);
								*/
								
								$mail->ClearReplyTos();

								$mail->AddReplyTo($noreply_email, $groupTitle);
							
								$mail->Sender  = $resultGroup->email; 	

								$mail->SetFrom($from_email, "Wp Mailing Group");	


								if($useinSubject) {			

									$mail->Subject = $subject;

	


								} else {					

									$mail->Subject = $emailParsed->email_subject;

								}					

								if($sendtouserEmailFormat=='1') {	

									$mail->IsHTML(true);				

								} else {				

									$mail->IsHTML(false);	

								}						

								$mail->MsgHTML($body);			

								$mail->AddAddress($sendToEmail, $sendToName);	
								

								if(!$mail->Send()) {				
									
									wpmg_showmessages("error", __( "Test Email Failed, Check debugging info above.", 'mailing-group-module') );						
									$_ARRDB['status'] = "1";
									
									
								}else{
									wpmg_showmessages("updated", __( "Test Mail Sent Succesfully!", 'mailing-group-module') );
									$_ARRDB['status']    = "0";
									print_r($mail->ErrorInfo);
								
								}
							} 


					    			

							if($mail_type == 'php'){	

								if($useinSubject) {				

									$mail_Subject = "[".$groupTitle."] ".$subject;	

								} else {								

									$mail_Subject = $subject;	

								}	

								

								$to = $sendToEmail;	

								$subject = $mail_Subject;
								$headers = 'From: Wp Mailing Group Test <'.$from_email.'>'."\r\n";
								$headers .= 'Reply-To: '.$groupTitle .' <'.$noreply_email.'>'."\r\n";  

								/* $headers .= 'Cc: '. $sendToName .'<'.$sendToEmail.'>'."\r\n"; */

								$headers .= 'X-Mailer: PHP' . phpversion() . "\r\n";

								$headers .= 'MIME-Version: 1.0'."\r\n";

								$headers .= 'Content-Type: ' . get_bloginfo('html_type') . '; charset=\"'. get_bloginfo('charset') . '\"'."\r\n";

								if($sendtouserEmailFormat=='1') {	

								   $headers .= 'Content-type: text/html'."\r\n";				

								}else{

								   $headers .= 'Content-type: text/plain'."\r\n";

								} 	

								

								$php_sent = mail($to, $subject, $body, $headers);


								if($php_sent) {				



								wpmg_showmessages("updated", __( "Test Mail Sent Succesfully!", 'mailing-group-module') );	

								}else{
									
								wpmg_showmessages("error", __( "Test Email Failed, Check debugging info below.", 'mailing-group-module') );		
								
								print_r(error_get_last());
								
								}

							}

							

					if($mail_type == 'wp'){	

								if($useinSubject) {				

								$mail_Subject = "[".$groupTitle."] ".$subject;

								} else {						

								$mail_Subject = $subject;	

								}	

						
								$to = $sendToEmail;	

								$subject = $mail_Subject;

								$headers[] = 'From: Wp Mailing Group Test <'.$from_email.'>'."\r\n";


								$headers[] = 'Reply-To: '. $groupTitle .' <'.$noreply_email.'>'."\r\n";

								/* $headers[] = 'Cc: '. $sendToName .'<'.$sendToEmail.'>'."\r\n"; */

								$headers[] = 'X-Mailer: PHP' . phpversion() . "\r\n";

								$headers[] = 'MIME-Version: 1.0'."\r\n";

								$headers[] = 'Content-Type: ' . get_bloginfo('html_type') . '; charset=\"'. get_bloginfo('charset') . '\"'."\r\n";

								if($sendtouserEmailFormat=='1') {	

								   $headers[] = 'Content-type: text/html;  charset=utf-8'."\r\n";				

								}else{

								   $headers[] = 'Content-type: text/plain;  charset=utf-8'."\r\n";

								} 					

								$wp_sent = wp_mail( $to,$subject,$body);
								

								if($wp_sent) {	

									wpmg_showmessages("updated", __( "Test Mail Sent Succesfully!", 'mailing-group-module') );							
		

								} else {						

									wpmg_showmessages("error", __( "Test Mail Failed, Try using PHP Mail in group settings!", 'mailing-group-module') );							
		
								}							

							}			

							

							

						}else{

		

							

							wpmg_showmessages('error', __( "Please fill all fields!", 'mailing-group-module') );

							

						}

						
}
						

?>



<style>





.dataTables_info {





	display:none;





}





.check_div {





	width:400px;





}





.col-left-2 {





	width:100% !important;





}





</style>

<div xmlns="http://www.w3.org/1999/xhtml" class="wrap nosubsub">

	<div class="icon32" id="icon-edit"><br/></div>

    <h2><?php _e("Test Email", 'mailing-group-module'); ?></h2>

<div class="div800">

<?php _e("You can test the 'Send Email' function here, to verify that your mailing group’s outgoing mail settings are functioning correctly. It will use the exact settings you have input for the mailing group you select below, and this test email will be sent to all subscribers of the selected mailing group.

If you have not yet set up a mailing group, please ensure you do so, and add at least one member to it before you run this test.", 'mailing-group-module');
 ?>

</div>

    <div id="col-left-2">

        <div class="col-wrap">


            <div>

                <div class="form-wrap">

                    <form class="validate" action="" method="post" id="testmail">


    					<div class="form-field" id="gen_username">


                            <label for="tag-name"><?php _e("Subject", 'mailing-group-module'); ?> : </label>
							
							 <input type="text" size="40" id="subject" name="subject"  value=""/>

 
                        </div>


                        <div class="form-field">


                            <label for="tag-name"><?php _e("Message", 'mailing-group-module'); ?> : </label>


                            <textarea size="40" id="testmessage" name="testmessage" cols="38"></textarea>

                        </div>

                        <div class="bootstrap-wrapper form-field">

                            <label for="tag-name"><?php _e("Group Name", 'mailing-group-module'); ?> : </label>


                            <div class="check_div">

                            	<table class="wp-list-table widefat fixed table" id="memberaddedit">

                                	<thead>

                                        <tr role="row" class="topRow">


                                            <th class="sort topRow_messagelist"><?php _e("Mailing Group Name", 'mailing-group-module'); ?></th>


                                        </tr>


                                    </thead>

                                    <tbody>

									<?php

									foreach($result_groups as $group) {

									$checkSelected = false;


									?>
                                       <tr>


                                        	<td><input type="radio" name="group_name" id="selector" value="<?php echo $group->id; ?>"  />&nbsp;<?php echo $group->title; ?>

                                            </td>

                                        </tr>

                                    <?php } ?>

                                    	</tbody>

                            	</table>


                            </div>


                        </div>



                        <div class="clearbth"></div>

                        <p class="submit">

                            <input type="submit" id="test_email" value="Send Email" class="button" <?php echo $disabled; ?>  name="submit"/>

                            <?php if(!empty($message)){ ?>

					<br/><?php wpmg_showmessages('error',$message); ?>

                    <?php } ?>

                        </p>

                    </form>

<div class="bootstrap-wrapper wpmg_sys_info">
		  
		<table class="table table-striped" id="mailinggroup_troubleshoot"> 
			<h2>Mailing Groups - Troubleshooting Info</h2>
		<tbody>
		<thead>
		<th>
		Group Name
		</th>
		
		<th>
		Imap/POP3 Status
		</th>
		
		<th>
		Send Email Status
		</th>
		
		</thead>

		<tr>	
	
			<?php 
			
		foreach($result_groups as $group){
		echo '<tr>';
		echo '<td>'.$group->title.'</td>';
		
			echo '<td>';
			
			
					$status = get_option('wpmg_status_for_'.$group->email,'No data found - Refresh this page again in 10 minutes. If you still see this message correct your IMAP/POP setting on mailing groups page');
					echo $status;
				
		echo '</td>';
		
		echo '<td>';
		global $table_name_sent_emails;
		$result = $objMem->selectRows($table_name_sent_emails, "",  " where group_id='".$group->id."' LIMIT 0,1"); 
		//var_dump($result_email);	
		if($result){
			foreach($result as $result_email){
				$status_of_send_email = '';
				if(isset($result->status)){
					$status_of_send_email = $result->status;
				}
				if($status_of_send_email != ''){
					
					if($status_of_send_email == '1'){
								
								echo 'Last Email Sent Successfully, without error';
								
							}else{
								
									echo 'Error'.'<br/>';
									echo  $result_email->error_msg;
								
							}
				}else{
					
					
					echo 'No Data Available';
				}
						}
		}else{
			
				echo 'No Emails Sent';
		}
		echo '</td>';
		echo '</tr>';
					}
	?>
	<table class="table table-striped"> 
		<tbody>
		<thead>
		<th>	<h2>Troubleshooting</h2> </th>
		</thead>

		<tr>	
			<td><label>PHP Version : </label></td>       
			<td><?php echo phpversion(); ?></td>
		</tr>	
	
		<tr>	
			<td><label>Function imap_open():</label>  </td>
			<td><?php 
			if (function_exists('imap_open')) {
				echo "Available.<span class='glyphicon glyphicon-ok'></span>";} else {echo "<span style'color=red'>Not Available. This is a must to make wpmg work, contact your server admin to get imap extension enabled.</span><span class='glyphicon glyphicon-remove'></span>";}?>
			<td>
		
		</tr>
	
		<tr>
	
		<td><label>Wp Cron:</label></td>
		<td>
		<?php if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) : ?>

							<span style'color=red'>Diabled. Enable cron by contacting your server admin.<span class="glyphicon glyphicon-remove"></span></span>

						<?php else : ?>

							Enabled

						<?php endif; ?>
		</td>
	</tr>

<tr>
	
		<td>
		<label>Plugin Crons:</label>
		<p class='help-block'>If any of crons is not queued, deactivate WPMG and re-activate. See if this fixes the crons)</p>
		</td>
		<td>
		<div class='cron_list'><?php 
		
			$all = array(); 
			$all = _get_cron_array() ;
			$cron_jobs = array(); 


			foreach ( _get_cron_array() as $key => $data )
				{
				foreach ( $data as $k => $d )
							{
								$v = array_values( current( $d ) );
								$cron_jobs[ $k ] = $v;
								$crons []= $k ;
							}	
				}

			$plugin_crons = array("wpmg_cron_task_send_email" ,"wpmg_cron_task_bounced_email" ,"wpmg_cron_task_parse_email" ,"wpmg_cron_auto_delete_attachments");

			foreach($plugin_crons as $plugin_cron){
				
				if(!in_array($plugin_cron,$crons)){
					
					echo '<span style="color:red">'.$plugin_cron.' is not queued <span class="glyphicon glyphicon-remove"></span></span><br/>';
				
				}else{
					
					echo $plugin_cron.' is queued  <span class="glyphicon glyphicon-ok"></span><br/>';
				}
			}


		?>           
		</div>
		</td>
	<tr>
		<td><label>Number of queued Emails:</label><p class='help-block'>(Emails read from inbox, waiting to be sent out. It can be 0 or more)</p> </td>

		<td>
		<?php 
			global $table_name_parsed_emails;
			$results = $objMem->selectRows($table_name_parsed_emails, "",  " where status = 0 AND type = 'email'");
			echo count($results);
			?>
		</td>
	</tr>
	<tr>
			<td><label>WPMG Version:</label>	</td>

			<td><?php echo $WPMG_SETTINGS['MG_VERSION_NO'];?></td>
	</tr>

	<tr>
			<td><label>Web Server Info: </label>  </td>
			<td><?php echo $_SERVER['SERVER_SOFTWARE'] . "<br/>"; ?></td>
	</tr>


	<tr>
			<td><label>WordPress Memory Limit: </></td> 
			<td><?php echo ( wpmg_let_to_num( WP_MEMORY_LIMIT )/( 1024 ) )."MB"; ?></td>

	</tr>

	<tr>
			<td><label>PHP Memory Limit:</label> </td>
			<td><?php echo ini_get( 'memory_limit' ); ?></td>
	</tr>


	<tr>
			<td><label>PHP Upload Max Size:</label></td>
			<td><?php echo ini_get( 'upload_max_filesize' ); ?></td>

	</tr>

	<tr>
			<td><label>PHP Post Max Size:</label></td>        <td><?php echo ini_get( 'post_max_size' ) ; ?></td>

	</tr>

	<tr>
	<td><label>PHP Upload Max Filesize:</label> </td> <td><?php echo ini_get( 'upload_max_filesize' ); ?></td>

	</tr>

	<tr>
			<td><label>PHP Time Limit:</label></td>           <td><?php echo ini_get( 'max_execution_time' ); ?></td>

	</tr>

	<tr>
	
	<td><label>PHP Max Input Vars:</label> </td>      <td><?php echo ini_get( 'max_input_vars' ); ?></td>

	</tr>

	<tr>
			<td><label>PHP Arg Separator:</label></td>        <td><?php echo ini_get( 'arg_separator.output' ) ; ?></td>

	</tr>
	<tr>
			<td><label>PHP Allow URL File Open:</label></td>  <td><?php echo ini_get( 'allow_url_fopen' ) ? "Yes" : "<span style='color=red'>No. This might create problems in license activation and applying future updates of plugin<span class='glyphicon glyphicon-remove'></span></span>";  ?></td>

	</tr>
	
	<tr>
			<td><label>WP_DEBUG:</label></td>    <td><?php echo defined( 'WP_DEBUG' ) ? WP_DEBUG ? 'Enabled' . "<br/>" : 'Disabled' . "<br/>" : 'Not set'; ?></td>

	</tr>


<?php

$request['cmd'] = '_notify-validate';



$params = array(

	'sslverify'		=> false,

	'timeout'		=> 60,

	'user-agent'	=> 'WPMG/' . $WPMG_SETTINGS['MG_VERSION_NO'],

	'body'			=> $request

);



$response = wp_remote_post( 'https://www.paypal.com/cgi-bin/webscr', $params );



if ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) {

	$WP_REMOTE_POST =  'wp_remote_post() works' . "<span class='glyphicon glyphicon-ok'></span>";

} else {

	$WP_REMOTE_POST =  '<span style"color=red">wp_remote_post() does not work <span class="glyphicon glyphicon-remove"></span></span>' . "<br/>";

}

?>

	<tr>
			<td><label>WP Remote Post:</label></td>           <td><?php echo $WP_REMOTE_POST; ?></td>

	</tr>

	<tr>
			<td><label>Session:</label></td>                  <td><?php echo isset( $_SESSION ) ? 'Enabled' : 'Disabled'; ?></td>

	</tr>

	<tr>
				<td><label>Session Name:</label></td>             <td><?php echo esc_html( ini_get( 'session.name' ) ); ?></td>

	</tr>

	<tr>
			<td><label>Cookie Path:</label></td>              <td><?php echo esc_html( ini_get( 'session.cookie_path' ) ); ?></td>

	</tr>

	<tr>
			<td><label>Save Path:</label></td>                <td><?php echo esc_html( ini_get( 'session.save_path' ) ); ?></td>

	</tr>

	<tr>
			<td><label>Use Cookies:</label></td>             <td><?php echo ini_get( 'session.use_cookies' ) ? 'On' : 'Off'; ?></td>

	</tr>

	<tr>
			<td><label>Use Only Cookies:</label></td>         <td><?php echo ini_get( 'session.use_only_cookies' ) ? 'On' : 'Off'; ?></td>

	</tr>

	<tr>
			<td><label>DISPLAY ERRORS:</label></td>           <td><?php echo ( ini_get( 'display_errors' ) ) ? 'On (' . ini_get( 'display_errors' ) . ')' : 'N/A'; ?></td>

	</tr>

	<tr>
			<td><label>FSOCKOPEN:</label></td>                <td><?php echo ( function_exists( 'fsockopen' ) ) ? 'Your server supports fsockopen.' : 'Your server does not support fsockopen.'; ?></td>

	</tr>
	
	<tr>
		<td><label>cURL:</label></td>                    <td> <?php echo ( function_exists( 'curl_init' ) ) ? 'Your server supports cURL.' : 'Your server does not support cURL.'; ?></td>

	</tr>
	
	</tbody>
	</table>



</div>

                    

                   

<div class="div800" style="margin-top:20px;">                      

More Troubleshooting functions will be added here, as the plugin is developed further. 

If you have specific requests for this, please let us know on the Contact page at: <a target='_blank' href='https://www.wpmailinggroup.com'>www.wpmailinggroup.com</a></div>





                </div>





            </div>





        </div>





    </div>





</div>