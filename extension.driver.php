<?php

	class Extension_Multi_User_Edit extends Extension {
	/*-------------------------------------------------------------------------
		Definition:
	-------------------------------------------------------------------------*/

		public static $active = true;

		public function getSubscribedDelegates() {
			return array(
				array(
					'page'		=> '/publish/edit/',
					'delegate'	=> 'EntryPreRender',
					'callback'	=> 'preRender'
				),
				array(
					'page'		=> '/publish/edit/',
					'delegate'	=> 'EntryPostEdit',
					'callback'	=> 'postEdit'
				)
			);
		}

		public function install(){
            try{
                Symphony::Database()->query("
                    CREATE TABLE IF NOT EXISTS `tbl_multi_user` (
                        `id` int(11) unsigned NOT NULL auto_increment,
                        `user_id` int(11) unsigned NOT NULL,
                        `entry_id` int(11) unsigned NOT NULL,
                        PRIMARY KEY  (`id`),
                        KEY `entry_id` (`entry_id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                ");
            }
            catch(Exception $e){
                return false;
            }

            return true;
        }

		public function enable(){
			return $this->install();
		}

		public function preRender($context) {
			Symphony::Log()->pushToLog('test');
			$entry_id = $context['entry']->get('id');

			//Check if the entry id is being used by another author.

			$query = "SELECT count(multi.entry_id) as count 
			 			FROM tbl_multi_user as multi
			 			WHERE multi.entry_id = '". $entry_id ."'";

            

            $count = Symphony::Database()->fetchVar('count',0,$query);

            if ($count == 0){
            	//Add the user and entry id to the database.
				 $query = "INSERT INTO tbl_multi_user (user_id, entry_id)
							VALUES ('1', $entry_id)";

	            if(Symphony::Database()->query($query) == TRUE){
	            	return true;
	            }

	            return false;
            }
            else{
            	//Entry is already being edited.
            }

			
		}

		public function postEdit($context) {
			$entry_id = $context['entry']->get('id');

			//Delete all the entries related to this entry.

			$query = "DELETE FROM tbl_multi_user
		 			WHERE multi.entry_id = '". $entry_id ."'";

            if(Symphony::Database()->query($query) == TRUE){
            	return true;
            }

            return false;

		}
	}
