<?php

use Zizaco\Confide\ConfideUser;

class User extends ConfideUser {
	use Codesleeve\Stapler\Stapler;

	public function __construct(array $attributes = array()) {
      $this->hasAttachedFile('avatar', [
          'styles' => [
            'medium' => '300x300',
            'thumb' => '100x100'
          ],
          'default_url' => '/:attachment/:style/missing.jpg'
      ]);

      parent::__construct($attributes);
  	}

	public static $rules = array(
		'firstname' => 'required',
		'lastname' => 'required',
        'username' => 'required|alpha_dash|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|between:4,11|confirmed',
        'password_confirmation' => 'between:4,11',
    );

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	protected $appends = array('fullname');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function getFullnameAttribute(){
		return $this->firstname.' '.$this->lastname;
	}
}
 