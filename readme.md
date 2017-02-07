# Multi User Edit

Multi User Edit is an extension for Symphony. This extension is responsible of locking and unlocking the functionality of editing content when multiple users are accessing the same entry.

### How it works

It works by recording the time of when the first user accesses the entry and when the second user tries to access the same article, an error pops up showing how long he/she has to wait for user 1 to complete his/her 'wait_time' cycle.

### Installation

1. Add the following code in config.php

>		###### MULTI USER EDIT ######
>		'multi_user_edit' => array(
>			'wait_time' => '5'
>		),
>		########

2. Change the 'wait_time' to your required time (in minutes) of how long you want to lock the entries.