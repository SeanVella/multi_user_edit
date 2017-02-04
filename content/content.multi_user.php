<?php

require_once(TOOLKIT . '/class.administrationpage.php');

Class contentExtensionMulti_User_EditMulti_User extends AdministrationPage {

	public function __viewIndex() {

		//Lock entry to user
		if(isset($_GET['id']) && isset($_GET['entry'])){

			$userId = MySQL::cleanValue($_GET['id']);
			$entryId = MySQL::cleanValue($_GET['entry']);

			//Get current time
			$region = Symphony::Configuration()->get('timezone', 'region');
			date_default_timezone_set($region);
			$dateTime = date('Y/m/d h:i:s', time());

			$update = array();
			$update['user_id'] = intval($userId);
			$update['session_start'] = date($dateTime);

			if(Symphony::Database()->update($update, 'sym_multi_user', "`entry_id` = ".$entryId)){
				echo('Success');
			}
			else{
				echo('error');
			}
		}

		//Check if entry is being used
		if(isset($_GET['entry']) && !isset($_GET['id'])){
				
			$entryId = MySQL::cleanValue($_GET['entry']);

			$query = "SELECT session_start, user_id 
                FROM sym_multi_user
                WHERE `entry_id` = '".$entryId."'
                LIMIT 1";

            $userId = Symphony::Database()->fetchVar('user_id',0,$query);

	        if( $userId == 0){
	            echo('<div class="unlocked">Unlocked</div>');
	        }
			else{
	        	$time = new DateTime(Symphony::Database()->fetchVar('session_start',0,$query));

	        	$now = new DateTime();

	        	//Check for how long the article is locked
	        	$diff = $now->diff($time);

	        	$diffString = $diff->format('%i.%S');


				echo('<div class="locked">User ID <div class="user">'.$userId.'</div> has this article locked for <div id="diff">'.$diffString.'</div> (minutes.seconds).<div class="show">Please wait for other editors to finish editing this article.</div></div>');
			}
			die;
		}
	}

}
