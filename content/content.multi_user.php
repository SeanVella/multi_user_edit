<?php

	require_once(TOOLKIT . '/class.administrationpage.php');

	Class contentExtensionMulti_User_EditMulti_User extends AdministrationPage {

		public function __viewIndex() {

			$userId = MySQL::cleanValue($_GET['id']);
			$entryId = MySQL::cleanValue($_GET['entry']);

			$update = array();
			$update['user_id'] = intval($userId);


			if(Symphony::Database()->update($update, 'sym_multi_user', "`entry_id` = ".$entryId)){
				echo('Success');
			}
			else{
				echo('error');
			}
			die;
		}

	}
