<div class="notification-icon">
  <?php 
   $user = $this->request->getSession()->read('Auth.User'); 
   $group =  $user['group_id']; 
			switch($group){
				case 1:
					$layout = 'default';
					$title = "SYSTEM ADMINISTRATOR";
				break;
				case 2:
					$layout = 'default_inspector';
					$title = "INSPECTOR TEAM";
				break;
				case 3:
					$layout = 'default_regional';
					$title = "3PL & REGIONAL SUPPLY OFFICERS";
				break;
				case 4:
					$layout = 'default_custodian';
					$title = "PROPERTY CUSTODIAN";
				break;
				case 5:
					$layout = 'default_asset_management';
					$title = "ASSET MANAGEMENT DIVISION";
				break;
				default:
					$layout = 'default_custodian';
					$title = "PROPERTY CUSTODIAN";
				break;
			}
	
	echo $title." WEB PORTAL";
			
  ?>
</div>