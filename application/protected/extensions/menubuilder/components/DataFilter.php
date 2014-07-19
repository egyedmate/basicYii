<?php

class DataFilter extends EMBDataFilter
{

	public static function getCurrentUserRoles()
	{
		/*switch (Yii::app()->user->id)
		{
			case 'admin':
				$roles = array('authenticated' => 'Authenticated user', 'admin' => 'Admin');
				break;

			case 'sitemaster':
				$roles = array('authenticated' => 'Authenticated user', 'sitemaster' => 'Sitemaster');
				break;
			default:
				$roles = parent::getCurrentUserRoles(); //authenticated or guest or configured in config/main.php
		}*/

		if (Yii::app()->user->isAdmin)
			$roles = array('admin' => 'Admin');
		elseif (!(Yii::app()->user->isGuest))
			$roles = array('authenticated' => 'Authenticated user');
		else
			//$roles = array('authenticated' => 'Authenticated user');
			$roles = array('guest' => 'Guest');

		return $roles;
	}

	public static function getSupportedUserRoles()
	{
		//return array_merge(parent::getSupportedUserRoles(), array('admin' => 'Admin', 'sitemaster' => 'Sitemaster'));
		return array(
			'admin' => 'Admin',
			'authenticated' => 'Authenticated user',
			'guest' => 'Guest'
		);
	}

}
