<?php

class SIADCARClientes extends CApplicationComponent
{
	public static function createCliente($postUsuarios, $postClientes){
		$return = array();

		$response = array('status'=>'error');
		$error = false;

		$userClient = false;

		$validator = new CEmailValidator;
		$email = $postUsuarios['email'];

		if($validator->validateValue($email)){
			$cedula = $postUsuarios['cedula'];
			$user = Usuarios::model()->findByAttributes(array('cedula'=>$cedula));
			if($user != null){
				$clientUser = Clientes::model()->findByAttributes(array('usuario'=>$user->id));

				if($clientUser != null){
					$error = true;
					$response['title'] = 'Error validación';
            		$response['message'] = 'El documento de identificación ya se encuentra registrado por otro cliente. Por favor verifique los datos e intente de nuevo.';
				}
				else
					$userClient = true;
        	}
		}
		else{
			$error = true;
			$response['title'] = 'Error validación';
    		$response['message'] = 'El correo electronico ingresado no es valido. Por favor verifique los datos e intente de nuevo.';
		}

		if(!$error){
			$passDefault = 'siadcar_'.rand(100, 1000);

			if($userClient)
				$modelUser = $user;
			else{
            	$modelUser=new Usuarios;
            	
            	$modelUser->password = Tools::crypt($passDefault);
	            
	            $modelUser->fecha_creacion = new CDbExpression('now()');
	            $modelUser->fecha_sesion_actual = $modelUser->fecha_creacion;
	            $modelUser->fecha_ultima_sesion = $modelUser->fecha_creacion;
            	
            	$modelUser->rol = 4;
			}

            $modelUser->attributes=$postUsuarios;
            
            if($modelUser->validate(null, false)){
            	$modelClient = new Clientes;
				$modelClient->attributes=$postClientes;

				$ciudad = Lugares::model()->findByAttributes(array('id'=>$postClientes['ciudad'], 'estado'=>1, 'tipo'=>3));
				if($ciudad == null){
					$error = true;
					$response['title'] = 'Error validación';
	        		$response['message'] = 'Los datos de ciudad no muestran coincidencia en nuestro sistema. Por favor, verifique los datos e intente de nuevo.';
				}

				if(!$error){
					if($modelUser->save()){
						$modelClient->usuario = $modelUser->id;
						if($modelClient->save()){
			            	$response['title'] = 'Hecho';
			            	$response['message'] = 'El cliente '.$modelUser->nombres.' '.$modelUser->apellidos.' se agrego con exito en el sistema.';
			            	$response['status'] = 'success';

			            	$return['cliente'] = $modelClient;
						}
						else{
							$errors = $modelClient->getErrors();
							$keyErrors = array_keys($modelClient->getErrors());
							$nameInput = Tools::strToUpper(CHtml::encode($modelClient->getAttributeLabel($keyErrors[0])));

							$response['title'] = 'Error validación';
							$response['message'] = $nameInput.': '.$errors[$keyErrors[0]][0];
						}
					}
					else{
						$errors = $modelUser->getErrors();
						$keyErrors = array_keys($modelUser->getErrors());
						$nameInput = Tools::strToUpper(CHtml::encode($modelUser->getAttributeLabel($keyErrors[0])));

						$response['title'] = 'Error validación';
						$response['message'] = $nameInput.': '.$errors[$keyErrors[0]][0];
					}
				}
            }
            else{
            	$errors = $modelUser->getErrors();
				$keyErrors = array_keys($modelUser->getErrors());
				$nameInput = Tools::strToUpper(CHtml::encode($modelUser->getAttributeLabel($keyErrors[0])));

				$response['title'] = 'Error validación';
				$response['message'] = $nameInput.': '.$errors[$keyErrors[0]][0];
            }
		}

		$return['response'] = $response;

		return $return;
	}
}