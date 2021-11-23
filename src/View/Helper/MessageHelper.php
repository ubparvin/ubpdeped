<?php

/* src/View/Helper/LinkHelper.php */
namespace App\View\Helper;

use Cake\View\Helper;

class MessageHelper extends Helper{
	
	public function showMsg($msg=null){
		$messages = array(
			'save' 				=> 'New data has been saved',
			'save_failed' 		=> 'Saving new data failed.',
			'update' 			=> 'Data changes has been saved',
			'update_faled' 		=> 'Saving changes failed.',
			'remove'			=> 'Data has been removed'
		);
		
		return $messages[$msg];
	}
	
}