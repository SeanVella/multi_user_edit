<?php

	require_once(TOOLKIT . '/class.administrationpage.php');

	Class contentExtensionMulti_User_EditMulti_User extends AdministrationPage {

		public function __viewIndex() {

			$userId = $_GET['id'];
			$entryId = $_GET['entry'];

			$query = "UPDATE sym_multi_user 
					SET user_id = ".$userId."
					WHERE entry_id = ".$entryId;

			if(Symphony::Database()->query($query) == TRUE){
				var_dump('Success');
			}
			die;
		}

	}
