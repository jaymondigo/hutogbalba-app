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
							array('label'=>'Dreams', 'link'=>URL::to('dreamer/dreams'),'icon'=>'fa fa-moon-o', 'active'=>strpos($uri, 'dreams')),								
						);

					break;
				case 'admin':
					$left_navs = array(
							array('label'=>'Dashboard', 'link'=>URL::to('home'),'icon'=>'fa fa-dashboard', 'active'=>strpos($uri, 'home')&&!strpos($uri, 'profile')),
							array('label'=>'Profile', 'link'=>URL::to('home/profile'),'icon'=>'fa fa-user', 'active'=>strpos($uri, 'profile')),
							array('label'=>'Vendors', 'link'=>URL::to('vendor'),'icon'=>'fa fa-users', 'active'=>strpos($uri, 'vendor')),
							array('label'=>'Products', 'link'=>URL::to('product'),'icon'=>'fa fa-briefcase', 'active'=>strpos($uri, 'product')),
						);
					break;
				case 'vendor':
					$left_navs = array(
							array('label'=>'Dashboard', 'link'=>URL::to('home'),'icon'=>'fa fa-dashboard', 'active'=>strpos($uri, 'home')&&!strpos($uri, 'profile')),
							array('label'=>'Profile', 'link'=>URL::to('home/profile'),'icon'=>'fa fa-user', 'active'=>strpos($uri, 'profile')),
							array('label'=>'Vendors', 'link'=>URL::to('vendor'),'icon'=>'fa fa-user', 'active'=>strpos($uri, 'vendor')),
							array('label'=>'Products', 'link'=>URL::to('product'),'icon'=>'fa fa-briefcase', 'active'=>strpos($uri, 'product')),
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

		public static function in2cm($in)
		{
			return $in * 2.54;
		}

		public static function cm2in($cm)
		{
			return $cm / 2.54;
		}

		public static function cm2ft($cm) {
			return $cm / 12.54 / 12;
		}

		public function ft2cm($ft) {
			return $ft * 12 * 2.54;
		}

		public static function getTiles($area, $dim = 9) {
			$tiles = 0;
			switch($dim) {
				case 4:
					$tiles = $area / 0.1089;
					break;
				case 6:
					$tiles = $area / 0.25;
					break;
				case 9:
					$tiles = $area / 0.5625;
					break;
				case 12:
					$tiles = $area;
					break;
				case 18:
					$tiles = $area / 2.25;
					break;
			}
			return $tiles;
		}

		public static function getShingles($area) {
			return $area / 100;
		}

		public static function getSandGravel($cubeF) {
			$cubeY = $cubeF / 27; // convert to yards
			return $cubeY * 1.25; // tons
		}

		public static function getBricks($area) {
			return $area / 100 * 3;
		}

		public static function getPlywoodSheets($area) {
			return $area / 32;
		}

		public static function getHollowBlocks($area) {
			return $area * 2;
		}

		public static function getMortar($blocks) {
			return $blocks / 11;
		}

		public static function getJalousie($windows) {
			return $windows / 750;
		}

	}
?>