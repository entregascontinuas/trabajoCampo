<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = Usuarios::model()->findByAttributes(array('cedula'=>$this->username,'estado'=>1), array('condition'=>'t.rol != 4'));

		if(!is_object($user))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($user->password!==$this->password)
		//else if(crypt($this->password, $user->password) != $user->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
			$this->errorCode=self::ERROR_NONE;
			
			//Cargamos datos para aplicación
			$this->setState('_idUser',$user->id);
			$this->setState('_nameUser',$user->nombres);
			$this->setState('_lastNameUser',$user->apellidos);
			$this->setState('_identificationUser',$user->cedula);
			$this->setState('_emailUser',$user->email);
			$this->setState('_imageUser',$user->image);
			$this->setState('_rolUser',$user->rol);
			$this->setState('_permissionUser',$user->permisos);


			//Registramos el acceso
			$user->fecha_ultima_sesion = $user->fecha_sesion_actual;
			$user->fecha_sesion_actual = new CDbExpression('now()');
			$user->save();
		}
		return !$this->errorCode;
	}
}