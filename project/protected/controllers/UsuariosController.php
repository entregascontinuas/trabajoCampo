<?php

class UsuariosController extends Controller{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(
					'create', 'create__ajax',
					'admin',
					'view',
					'reset_password',
					'update', 'update__ajax',
					'delete_user'
				),
				'users'=>array('@'),
				'expression'=>'Tools::hasPermission(1)',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**** CREACION DE USUARIOS *****/
	public function actionCreate(){
		$load = Yii::app()->getClientScript();
		$load->registerScriptFile(Yii::app()->request->baseUrl.'/js/controllers/usuarios.js',CClientScript::POS_END);


		$model = new Usuarios;
		$rolDefault = RolsUsuario::model()->findByPk(3);

		$rols = RolsUsuario::model()->findAllByAttributes(array('system'=>1));
		$permissions = Permisos::model()->findAll(array('order'=>'t.nombre ASC'));

		$model->rol = $rolDefault->id;
		$model->permisos = $rolDefault->permisos;

		$this->render('create',array(
			'model'=>$model,

			'rols'=>$rols,
			'permissions'=>$permissions,

			'rolsList'=>Tools::toListSelect($rols, 'id', 'nombre'),
		));
	}
	public function actionCreate__ajax(){
		if(Yii::app()->getRequest()->getIsAjaxRequest() && isset($_POST['Usuarios'])){
			$response = array('status'=>'error');
			$error = false;

			$validator = new CEmailValidator;
			$email = $_POST['Usuarios']['email'];

			if($validator->validateValue($email)){
				$cedula = $_POST['Usuarios']['cedula'];
				$user = Usuarios::model()->findByAttributes(array('cedula'=>$cedula));
				if($user != null){
					$error = true;
					$response['title'] = 'Error validación';
            		$response['message'] = 'El documento de identificación ya se encuentra registrado por otro usuario. Por favor verifique los datos e intente de nuevo.';
            	}
			}
			else{
				$error = true;
				$response['title'] = 'Error validación';
        		$response['message'] = 'El correo electronico ingresado no es valido. Por favor verifique los datos e intente de nuevo.';
			}

			if(!$error){
				$passDefault = 'siadcar_'.rand(100, 1000);
	            $model=new Usuarios;

	            $model->attributes=$_POST['Usuarios'];
	            $model->password = Tools::crypt($passDefault);
	            
	            $model->fecha_creacion = new CDbExpression('now()');
	            $model->fecha_sesion_actual = $model->fecha_creacion;
	            $model->fecha_ultima_sesion = $model->fecha_creacion;

	            //$rol = RolsUsuario::model()->findByPk($_POST['Usuarios']['rol']);
	            $rol = RolsUsuario::model()->findByAttributes(array('id'=>$_POST['Usuarios']['rol'],'system'=>1));
	            if($rol != null){
		            if(isset($_POST['Usuarios']['permissions'])){
		            	$permissions = CJSON::decode($rol->permisos);
		            	foreach ($_POST['Usuarios']['permissions'] as $key => $permissionIn) {
		            		$permission = Permisos::model()->findByPk($permissionIn);
		            		if($permission != null){
		            			if(!in_array($permissionIn,$permissions,false))
		            				$permissions[] = $permissionIn;
		            		}
		            	}
		            	$rol->permisos = CJSON::encode($permissions);
		            }
		            $model->permisos = $rol->permisos;
		            
		            if($model->validate(null, false)){
		            	$model->save();

		            	$response['title'] = 'Hecho';
		            	$response['message'] = 'El nuevo usuario se agrego con exito. Estos son sus datos de acceso. <br> <p><strong>Usuario:</strong> '.$model->cedula.'</p><p><strong>Password:</strong> '.$passDefault.'</p>';
		            	$response['status'] = 'success';
		            }
		            else{
		            	$errors = $model->getErrors();
						$keyErrors = array_keys($model->getErrors());
						$nameInput = Tools::strToUpper(CHtml::encode($model->getAttributeLabel($keyErrors[0])));

						$response['title'] = 'Error validación';
		            	$response['message'] = $nameInput.': '.$errors[$keyErrors[0]][0];
		            }
	            }
	            else{
	            	$error = true;
					$response['title'] = 'Error validación';
	        		$response['message'] = 'Los datos de roll no muestran coincidencia en nuestro sistema. Por favor, verifique los datos e intente de nuevo.';
	            }
			}

			echo CJSON::encode($response);
		}
		else
            throw new CHttpException(404,'The requested page does not exist.');
	}
	/****** FIN CREACION DE USUARIOS *****/

	public function actionAdmin(){
		$load = Yii::app()->getClientScript();
		$load->registerScriptFile(Yii::app()->request->baseUrl.'/js/controllers/usuarios.js',CClientScript::POS_END);

		$users = Usuarios::model()->findAll(array('condition'=>'t.rol != 4 AND t.estado != 2 AND t.id != '.Yii::app()->user->getState('_idUser')));

		$this->render('admin', array(
			'users'=>$users
		));
	}

	public function actionView($id){
		$user = $this->loadModel($id);

		$this->render('view', array(
			'user'=>$user
		));
	}

	public function actionReset_password($id){
		if(Yii::app()->getRequest()->getIsAjaxRequest()){
			$response = array('status'=>'error');

			$model = $this->loadModel($id);
			$passDefault = 'siadcar_'.rand(100, 1000);
			$model->password = Tools::crypt($passDefault);

			if($model->save()){
				$response['title'] = 'Hecho';
            	$response['message'] = 'Al usuario '.$model->nombres.' se le cambio la contraseña con exito. Estos son sus datos de acceso. <br> <p><strong>Usuario:</strong> '.$model->cedula.'</p><p><strong>Password:</strong> '.$passDefault.'</p>';
            	$response['status'] = 'success';
			}
			else{
				$response['title'] = 'Error en la operacón';
            	$response['message'] = 'Ocurrio un error durante el proceso de asignar una nueva contraseña. Informe al desarrollador e intente mas tarde.';
			}

			echo CJSON::encode($response);
		}
		else
            throw new CHttpException(404,'The requested page does not exist.');
	}

	/********* MODIFICACION USUARIOS *********/
	public function actionUpdate($id){
		$load = Yii::app()->getClientScript();
		$load->registerScriptFile(Yii::app()->request->baseUrl.'/js/controllers/usuarios.js',CClientScript::POS_END);


		$model = $this->loadModel($id);

		$rols = RolsUsuario::model()->findAllByAttributes(array('system'=>1));
		$permissions = Permisos::model()->findAll(array('order'=>'t.nombre ASC'));

		$this->render('update',array(
			'model'=>$model,

			'rols'=>$rols,
			'permissions'=>$permissions,

			'rolsList'=>Tools::toListSelect($rols, 'id', 'nombre'),
		));
	}
	public function actionUpdate__ajax($id){
		if(Yii::app()->getRequest()->getIsAjaxRequest() && isset($_POST['Usuarios'])){
			$response = array('status'=>'error');
			$error = false;

			$model = $this->loadModel($id);

			$validator = new CEmailValidator;
			$email = $_POST['Usuarios']['email'];

			if($validator->validateValue($email)){
				$cedula = $_POST['Usuarios']['cedula'];
				$user = Usuarios::model()->findByAttributes(array('cedula'=>$cedula), array('condition'=>'t.id != '.$model->id));
				if($user != null){
					$error = true;
					$response['title'] = 'Error validación';
            		$response['message'] = 'El documento de identificación ya se encuentra registrado por otro usuario. Por favor verifique los datos e intente de nuevo.';
            	}
			}
			else{
				$error = true;
				$response['title'] = 'Error validación';
        		$response['message'] = 'El correo electronico ingresado no es valido. Por favor verifique los datos e intente de nuevo.';
			}
			if(!$error){
				$model->attributes=$_POST['Usuarios'];
	            //$rol = RolsUsuario::model()->findByPk($_POST['Usuarios']['rol']);
	            $rol = RolsUsuario::model()->findByAttributes(array('id'=>$_POST['Usuarios']['rol'],'system'=>1));
	            if($rol != null){
		            if(isset($_POST['Usuarios']['permissions'])){
		            	$permissions = CJSON::decode($rol->permisos);
		            	foreach ($_POST['Usuarios']['permissions'] as $key => $permissionIn) {
		            		$permission = Permisos::model()->findByPk($permissionIn);
		            		if($permission != null){
		            			if(!in_array($permissionIn,$permissions,false))
		            				$permissions[] = $permissionIn;
		            		}
		            	}
		            	$rol->permisos = CJSON::encode($permissions);
		            }
		            $model->permisos = $rol->permisos;
		            
		            if($model->validate(null, false)){
		            	$model->save();

		            	$response['title'] = 'Hecho';
		            	$response['message'] = 'Los datos del usuario '.$model->nombres.' se modificaron con exito.';
		            	$response['status'] = 'success';
		            }
		            else{
		            	$errors = $model->getErrors();
						$keyErrors = array_keys($model->getErrors());
						$nameInput = Tools::strToUpper(CHtml::encode($model->getAttributeLabel($keyErrors[0])));

						$response['title'] = 'Error validación';
		            	$response['message'] = $nameInput.': '.$errors[$keyErrors[0]][0];
		            }
	            }
	            else{
	            	$error = true;
					$response['title'] = 'Error validación';
	        		$response['message'] = 'Los datos de roll no muestran coincidencia en nuestro sistema. Por favor, verifique los datos e intente de nuevo.';
	            }
	        }

			echo CJSON::encode($response);
		}
		else
            throw new CHttpException(404,'The requested page does not exist.');			
	}
	/********* FIN MODIFICACION USUARIOS *********/

	public function actionDelete_user($id){
		if(Yii::app()->getRequest()->getIsAjaxRequest()){
			$response = array('status'=>'error');

			$model = $this->loadModel($id);
			$model->estado = 2;
			if($model->save()){
				$response['status'] = 'success';
				$response['title'] = 'Hecho';
				$response['message'] = 'El usuario se a eliminado del sistema.';
			}
			else{
				$response['title'] = 'Error';
				$response['message'] = 'Ocurrio un error durante el proceso. Informe al desarrollor e intente mas tarde.';
			}

			echo CJSON::encode($response);
		}
		else
			throw new CHttpException(404,'The requested page does not exist.');	
	}

	private function loadModel($id)
	{
		$model=Usuarios::model()->findByAttributes(array('id'=>$id), array('condition'=>'t.rol != 4 AND t.estado != 2'));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}