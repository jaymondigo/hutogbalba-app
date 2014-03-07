<?php
	/**
	* 
	*/
	class DbsHelper
	{
		public static function navs($userType, $position='left')
		{	
			$left_navs = array(); 
			$uri = $_SERVER['REQUEST_URI'];

			switch ($userType) {
				case 'dreamer':
					$left_navs = array(
							array('label'=>'Dashboard', 'link'=>URL::to('home'),'icon'=>'fa fa-dashboard', 'active'=>strpos($uri, 'home')&&!strpos($uri, 'profile')),
							array('label'=>'Profile', 'link'=>URL::to('home/profile'),'icon'=>'fa fa-user', 'active'=>strpos($uri, 'profile')),
							array('label'=>'Dreams', 'link'=>URL::to('dremear/dreams'),'icon'=>'fa fa-moon-o', 'active'=>strpos($uri, 'dreams')),								
						);

					break;
				case 'admin':
					$left_navs = array(
							array('label'=>'Dashboard', 'link'=>URL::to('home'),'icon'=>'fa fa-dashboard', 'active'=>strpos($uri, 'home')&&!strpos($uri, 'profile')),
							array('label'=>'Profile', 'link'=>URL::to('home/profile'),'icon'=>'fa fa-user', 'active'=>strpos($uri, 'profile')),
							array('label'=>'Vendors', 'link'=>URL::to('vendors'),'icon'=>'fa fa-users', 'active'=>strpos($uri, 'vendors')),
							array('label'=>'Products', 'link'=>URL::to('product'),'icon'=>'fa fa-briefcase', 'active'=>strpos($uri, 'products')),
						);
					break;
				case 'vendor':
					$left_navs = array(
							array('label'=>'Dashboard', 'link'=>URL::to('home'),'icon'=>'fa fa-dashboard', 'active'=>strpos($uri, 'home')&&!strpos($uri, 'profile')),
							array('label'=>'Profile', 'link'=>URL::to('home/profile'),'icon'=>'fa fa-user', 'active'=>strpos($uri, 'profile')),
							array('label'=>'Vendors', 'link'=>URL::to('vendors'),'icon'=>'fa fa-user', 'active'=>strpos($uri, 'vendors')),
							array('label'=>'Products', 'link'=>URL::to('product'),'icon'=>'fa fa-briefcase', 'active'=>strpos($uri, 'products')),
						);
					break;
				default:
					# code...
					break;
			} 
			 
			if($position=='left')
				return $left_navs;
			else
				return array(); 
		}
	}
?>