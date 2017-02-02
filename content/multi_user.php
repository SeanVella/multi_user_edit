<?php
	public $userId = $_GET['id'];
	public $entryId = $_GET['entry'];

	public $query = "UPDATE tbl_multi_user 
			SET (user_id = ".$userId.")
			WHERE entry_id = '".$entryId."'
			";

	if(Symphony::Database()->query($query) == TRUE){
		return true;
	}

	return false;

