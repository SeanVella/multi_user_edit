<?php

	require_once(TOOLKIT . '/class.administrationpage.php');

	Class contentExtensionMulti_User_EditMulti_User extends AdministrationPage {

		public function __viewIndex() {

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
			die;
		}

	}
