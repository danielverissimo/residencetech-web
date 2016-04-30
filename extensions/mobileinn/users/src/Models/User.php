<?php namespace Mobileinn\Users\Models;

use Platform\Users\Models\User as PlatformUser;

class User extends PlatformUser {

	public function getTokenAttribute()
	{
		return $this->persistences->first()->code ?: null;
	}

	public function person()
	{
		return $this->hasOne('Mobileinn\People\Models\Person');
	}
}