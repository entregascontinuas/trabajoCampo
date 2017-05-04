<?php

class ClientesController extends Controller{
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
					'get_cliente',
				),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(
					'create', 'create__ajax',
					'admin',
					'view',
					'update', 'update__ajax',
					'delete_client'
				),
				'users'=>array('@'),
				'expression'=>'Tools::hasPermission(2)',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**** CREACION DE CLIENTES *****/
	public function actionCreate(){
		$load = Yii::app()->getClientScript();
		$load->registerScriptFile(Yii::app()->request->baseUrl.'/js/controllers/clientes.js',CClientScript::POS_END);


		$modelUser = new Usuarios;
		$modelClient = new Clientes;

		$departamentos = Lugares::model()->findAllByAttributes(array('depende'=>1, 'tipo'=>2));

		$this->render('create',array(
			'modelUser'=>$modelUser,
			'modelClient'=>$modelClient,

			'departamentos'=>$departamentos,
		));
	}
	public function actionCreate__ajax(){
		if(Yii::app()->getRequest()->getIsAjaxRequest() && isset($_POST['Usuarios']) && isset($_POST['Clientes'])){
			$registerCliente = SIADCARClientes::createCliente($_POST['Usuarios'],$_POST['Clientes']);
			$response = $registerCliente['response'];

			echo CJSON::encode($response);
		}
		else
            throw new CHttpException(404,'The requested page does not exist.');
	}
	/****** FIN CREACION DE CLIENTES *****/

	public function actionAdmin(){
		$load = Yii::app()->getClientScript();
		$load->registerScriptFile(Yii::app()->request->baseUrl.'/js/controllers/clientes.js',CClientScript::POS_END);

		$clients = Clientes::model()->findAll(array('condition'=>'t.estado != 2','order'=>'t.id DESC'));

		$this->render('admin', array(
			'clients'=>$clients
		));
	}

	public function actionView($id){
		$client = $this->loadModel($id);
		$user = $client->usuario0;

		$vehiculos = Vehiculos::model()->findAllByAttributes(array('propietario'=>$client->id), array('condition'=>'t.estado != 2'));

		$this->render('view', array(
			'client'=>$client,
			'user'=>$user,

			'vehiculos'=>$vehiculos
		));
	}

	/********* MODIFICACION CLIENTES *********/
	public function actionUpdate($id){
		$load = Yii::app()->getClientScript();
		$load->registerScriptFile(Yii::app()->request->baseUrl.'/js/controllers/clientes.js',CClientScript::POS_END);


		$modelClient = $this->loadModel($id);
		$modelUser = $modelClient->usuario0;

		$departamentos = Lugares::model()->findAllByAttributes(array('depende'=>1, 'tipo'=>2));
		$ciudades = Lugares::model()->findAllByAttributes(array('depende'=>$modelClient->ciudad0->depende, 'tipo'=>3));

		$this->render('update',array(
			'modelUser'=>$modelUser,
			'modelClient'=>$modelClient,

			'departamentos'=>$departamentos,
			'ciudades'=>Tools::toListSelect($ciudades, 'id', 'nombre'),
		));
	}
	public function actionUpdate__ajax($id){
		if(Yii::app()->getRequest()->getIsAjaxRequest() && isset($_POST['Usuarios']) && isset($_POST['Clientes'])){
			$response = array('status'=>'error');
			$error = false;

			$modelClient = $this->loadModel($id);
			$modelUser = $modelClient->usuario0;

			$validator = new CEmailValidator;
			$email = $_POST['Usuarios']['email'];

			if($validator->validateValue($email)){
				$cedula = $_POST['Usuarios']['cedula'];
				$user = Usuarios::model()->findByAttributes(array('cedula'=>$cedula), array('condition'=>'t.id != '.$modelUser->id));
				if($user != null){
					$error = true;
					$response['title'] = 'Error validación';
            		$response['message'] = 'El documento de identificación ya se encuentra registrado por otro cliente. Por favor verifique los datos e intente de nuevo.';
            	}
			}
			else{
				$error = true;
				$response['title'] = 'Error validación';
        		$response['message'] = 'El correo electronico ingresado no es valido. Por favor verifique los datos e intente de nuevo.';
			}

			if(!$error){
	            $modelUser->attributes=$_POST['Usuarios'];
	            
	            if($modelUser->validate(null, false)){
	            	$modelClient->attributes=$_POST['Clientes'];

					$ciudad = Lugares::model()->findByAttributes(array('id'=>$_POST['Clientes']['ciudad'], 'estado'=>1, 'tipo'=>3));
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
				            	$response['message'] = 'Los datos del cliente '.$modelUser->nombres.' se modificaron con exito.';
				            	$response['status'] = 'success';
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

			echo CJSON::encode($response);
		}
		else
            throw new CHttpException(404,'The requested page does not exist.');			
	}
	/********* FIN MODIFICACION CLIENTES *********/

	public function actionDelete_client($id){
		if(Yii::app()->getRequest()->getIsAjaxRequest()){
			$response = array('status'=>'error');

			$model = $this->loadModel($id);
			$model->estado = 2;
			if($model->save()){
				$user = $model->usuario0;
				if($user->rol == 4){
					$user->estado = 2;
					$user->save();
				}

				$response['status'] = 'success';
				$response['title'] = 'Hecho';
				$response['message'] = 'El cliente se a eliminado del sistema.';
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

	public function actionGet_cliente(){
		if(isset($_GET['cedula'])){
			$response = array('status'=>'error');

			$user = Usuarios::model()->findByAttributes(array('cedula'=>$_GET['cedula'],'estado'=>1));
			if($user != null){
				$client = Clientes::model()->findByAttributes(array('usuario'=>$user->id,'estado'=>1));
				if($client != null){
					$response['status'] = 'success';
					$response['client'] = array(
						'id'=>$client->id,
						'nombres'=>$client->usuario0->nombres,
						'apellidos'=>$client->usuario0->apellidos,
						'ciudad'=>array(
							'id'=>$client->ciudad,
							'nombre'=>$client->ciudad0->nombre,
							'departamento'=>array(
								'id'=>$client->ciudad0->depende,
								'nombre'=>$client->ciudad0->depende0->nombre
							)
						),
						'direccion'=>$client->direccion,
						'celular'=>$client->celular,
						'email'=>$client->usuario0->email
					);
				}
			}

			if(Yii::app()->getRequest()->getIsAjaxRequest())
				echo CJSON::encode($response);
			else
				return $response;
		}
		else
			throw new CHttpException(404,'The requested page does not exist.');
	}

	private function loadModel($id)
	{
		$model=Clientes::model()->findByAttributes(array('id'=>$id), array('condition'=>'t.estado != 2'));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}