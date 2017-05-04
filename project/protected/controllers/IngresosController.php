<?php

class IngresosController extends Controller{
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
					'create','create__ajax',
					'print',
				),
				'users'=>array('@'),
				'expression'=>'Tools::hasPermission(4)',
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(
					'update','update__ajax',
					'delete_ingreso',

					'mantenimientos_delete',
				),
				'users'=>array('@'),
				'expression'=>'(Yii::app()->user->getState("_rolUser") == 1)',
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(
					'admin',
					'view',
					'change_estado',

					'mantenimientos',
					'mantenimientos_create', 'mantenimientos_create__ajax',
					'mantenimientos_view',
					'mantenimientos_update', 'mantenimientos_update__ajax',
				),
				'users'=>array('@'),
				'expression'=>'Tools::hasPermission(4) || Tools::hasPermission(5)',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionCreate(){
		$load = Yii::app()->getClientScript();
		$load->registerScriptFile(Yii::app()->request->baseUrl.'/js/controllers/ingresos.js',CClientScript::POS_END);

		$model = new RegistrosIngreso;
		
		$tipos = TiposIngreso::model()->findAll(array('order'=>'t.nombre ASC'));
		$elementos = ElementosVehiculo::model()->findAll(array('order'=>'t.nombre ASC'));

		$this->render('create', array(
			'model'=>$model,

			'tipos'=>Tools::toListSelect($tipos, 'id', 'nombre'),
			'elementos'=>$elementos
		));
	}

	public function actionCreate__ajax(){
		if(Yii::app()->getRequest()->getIsAjaxRequest() && isset($_POST['Vehiculos']) && isset($_POST['RegistrosIngreso'])){
			$response = array('status'=>'error');
			
			$vehiculo = Vehiculos::model()->findByAttributes(array('id'=>$_POST['RegistrosIngreso']['vehiculo'], 'placas'=>$_POST['Vehiculos']['placas'], 'estado'=>1));
			if($vehiculo != null){
				$model = new RegistrosIngreso;

				$model->attributes=$_POST['RegistrosIngreso'];
				$model->vehiculo = $vehiculo->id;
				$model->fecha = new CDbExpression('now()');
				$model->recibio = Yii::app()->user->getState('_idUser');

	            $elementos = array();
				if(isset($_POST['RegistrosIngreso']['elementos'])){
	            	foreach ($_POST['RegistrosIngreso']['elementos'] as $key => $elementoIn) {
	            		$elemento = ElementosVehiculo::model()->findByPk($elementoIn);
	            		if($elementoIn != null){
	            			if(!in_array($elementoIn,$elementos,false))
	            				$elementos[] = $elementoIn;
	            		}
	            	}
	            }
            	$model->elementos = CJSON::encode($elementos);

				if($model->save()){
					$response['title'] = 'Hecho';
	            	$response['message'] = 'Se hizo el registro de ingreso del vehiculo con placas '.$vehiculo->placas.'. ¿Desea ver el comprobante de ingreso?';
	            	$response['status'] = 'success';
	            	$response['print'] = $this->createUrl('ingresos/print/'.$model->id);
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
				$response['title'] = 'Error validación';
        		$response['message'] = 'Los datos del vehiculo no coinsiden en nuestro sistema. Verifique los datos e intente de nuevo.';
			}

			echo CJSON::encode($response);
		}
		else
            throw new CHttpException(404,'The requested page does not exist.');
	}

	public function actionPrint($id){
		$model = $this->loadModel($id);
		$vehiculo = $model->vehiculo0;
		$propietario = $vehiculo->propietario0;

		$mantenimientos = Mantenimientos::model()->findAllByAttributes(array('ingreso'=>$model->id,'estado'=>1));

		$this->render('print', array(
			'model'=>$model,
			'vehiculo'=>$vehiculo,
			'propietario'=>$propietario,

			'mantenimientos'=>$mantenimientos
		));
	}

	public function actionAdmin(){
		$load = Yii::app()->getClientScript();
		$load->registerScriptFile(Yii::app()->request->baseUrl.'/js/controllers/ingresos.js',CClientScript::POS_END);

		if(Yii::app()->user->getState("_rolUser") == 3)
			$ingresos = RegistrosIngreso::model()->findAllByAttributes(array('estado'=>3), array('order'=>'t.fecha DESC'));
		if(Tools::hasPermission(4))
			$ingresos = RegistrosIngreso::model()->findAll(array('condition'=>'t.estado != 2','order'=>'t.fecha DESC'));

		$this->render('admin', array(
			'ingresos'=>$ingresos
		));
	}

	public function actionView($id){
		$ingreso = $this->loadModel($id);
		$vehiculo = $ingreso->vehiculo0;
		$propietario = $vehiculo->propietario0;

		$mantenimientos = Mantenimientos::model()->findAllByAttributes(array('ingreso'=>$ingreso->id,'estado'=>1));

		$this->render('view', array(
			'ingreso'=>$ingreso,
			'vehiculo'=>$vehiculo,
			'propietario'=>$propietario,

			'mantenimientos'=>$mantenimientos
		));
	}

	public function actionUpdate($id){
		$load = Yii::app()->getClientScript();
		$load->registerScriptFile(Yii::app()->request->baseUrl.'/js/controllers/ingresos.js',CClientScript::POS_END);

		$model = $this->loadModel($id);
		
		$tipos = TiposIngreso::model()->findAll(array('order'=>'t.nombre ASC'));
		$elementos = ElementosVehiculo::model()->findAll(array('order'=>'t.nombre ASC'));

		$vehiculo = Vehiculos::model()->findByPk($model->vehiculo);

		$this->render('update', array(
			'model'=>$model,

			'tipos'=>Tools::toListSelect($tipos, 'id', 'nombre'),
			'elementos'=>$elementos,

			'vehiculo'=>$this->renderPartial('_propietario_info', array('vehiculo'=>$vehiculo), true),
		));
	}

	public function actionUpdate__ajax($id){
		if(Yii::app()->getRequest()->getIsAjaxRequest() && isset($_POST['RegistrosIngreso'])){
			$response = array('status'=>'error');

			$model = $this->loadModel($id);

			if($model->vehiculo == $_POST['RegistrosIngreso']['vehiculo']){
				$vehiculo = $model->vehiculo0;

				$model->attributes=$_POST['RegistrosIngreso'];
				$model->recibio = Yii::app()->user->getState('_idUser');

	            $elementos = array();
				if(isset($_POST['RegistrosIngreso']['elementos'])){
	            	foreach ($_POST['RegistrosIngreso']['elementos'] as $key => $elementoIn) {
	            		$elemento = ElementosVehiculo::model()->findByPk($elementoIn);
	            		if($elementoIn != null){
	            			if(!in_array($elementoIn,$elementos,false))
	            				$elementos[] = $elementoIn;
	            		}
	            	}
	            }
            	$model->elementos = CJSON::encode($elementos);

				if($model->save()){
					$response['title'] = 'Hecho';
	            	$response['message'] = 'Se modifico el registro de ingreso del vehiculo con placas '.$vehiculo->placas.'. ¿Desea ver el comprobante de ingreso?';
	            	$response['status'] = 'success';
	            	$response['print'] = $this->createUrl('ingresos/print/'.$model->id);
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
				$response['title'] = 'Error validación';
	        		$response['message'] = 'Los datos no coinsiden en nuestro sistema. Verifique los datos e intente de nuevo.';
			}

			echo CJSON::encode($response);
		}
		else
            throw new CHttpException(404,'The requested page does not exist.');
	}

	public function actionChange_estado($id){
		if(Yii::app()->getRequest()->getIsAjaxRequest() && isset($_GET['estado'])){
			$response = array('status'=>'error');
			$ingreso = $this->loadModel($id);

			if(Tools::hasPermission(4))
				$estados = [0,1,3,4];
			else
				$estados = [3,4];

			if(!(in_array($_GET['estado'], $estados)))
				throw new CHttpException(403,'You are not authorized to perform this action.');

			$ingreso->estado = $_GET['estado'];

			if($ingreso->estado == 3)
				$response['tag'] = '<span class="label label-warning">En revisión</span>';
			else if($ingreso->estado == 4)
				$response['tag'] = '<span class="label label-success">Listo</span>';
			else if($ingreso->estado == 1)
				$response['tag'] = '<span class="label label-primary">Entregado</span>';
			else
				$response['tag'] = '<span class="label label-danger">En espera</span>';

			if($ingreso->save()){
				$response['status'] = 'success';
				$response['new'] = $ingreso->estado;
			}

			echo CJSON::encode($response);
		}
		else
            throw new CHttpException(404,'The requested page does not exist.');
	}

	public function actionDelete_ingreso($id){
		if(Yii::app()->getRequest()->getIsAjaxRequest()){
			$model = $this->loadModel($id);
			$vehiculo = $model->vehiculo0;

			$mantenimientos = Mantenimientos::model()->findAllByAttributes(array('ingreso'=>$model->id));
			foreach ($mantenimientos as $key => $mantenimiento) {
				$mantenimiento->estado = 2;
				$mantenimiento->save();
			}

			$model->estado = 2;
			$model->save();

			$response['status'] = 'success';
			$response['title'] = 'Hecho';
			$response['message'] = 'El registro de ingreso del vehiculo '.$vehiculo->placas.' se a eliminado del sistema.';

			echo CJSON::encode($response);
		}
		else
            throw new CHttpException(404,'The requested page does not exist.');
	}

	/***********************************************************************/

	public function actionMantenimientos($id){
		$load = Yii::app()->getClientScript();
		$load->registerScriptFile(Yii::app()->request->baseUrl.'/js/controllers/mantenimientos.js',CClientScript::POS_END);

		$ingreso = $this->loadModel($id);
		$mantenimientos = Mantenimientos::model()->findAllByAttributes(array('ingreso'=>$ingreso->id),array('condition'=>'t.estado != 2'));

		$this->render('//mantenimientos/admin', array(
			'ingreso'=>$ingreso,
			'mantenimientos'=>$mantenimientos
		));
	}

	public function actionMantenimientos_create($id){
		$load = Yii::app()->getClientScript();
		$load->registerScriptFile(Yii::app()->request->baseUrl.'/js/controllers/mantenimientos.js',CClientScript::POS_END);

		$ingreso = $this->loadModel($id);
		if($ingreso->estado != 3)
			throw new CHttpException(404,'The requested page does not exist.');
		$model = new Mantenimientos;

		$tipos = TiposIngreso::model()->findAll();
		$mecanicos = Usuarios::model()->findAllByAttributes(array('rol'=>3, 'estado'=>1));

		$this->render('//mantenimientos/create', array(
			'ingreso'=>$ingreso,
			'model'=>$model,

			'tipos'=>Tools::toListSelect($tipos, 'id', 'nombre'),
			'mecanicos'=>Tools::toListSelect($mecanicos, 'id', 'nombres'),
		));
	}
	public function actionMantenimientos_create__ajax($id){
		if(Yii::app()->getRequest()->getIsAjaxRequest() && isset($_POST['Mantenimientos'])){
			$response = array('status'=>'error');

			$ingreso = $this->loadModel($id);
			if($ingreso->estado == 3){
				$vehiculo = $ingreso->vehiculo0;
				$model = new Mantenimientos;

				$model->attributes=$_POST['Mantenimientos'];
				$model->ingreso = $ingreso->id;
				$model->usuario_registro = Yii::app()->user->getState('_idUser');
				$model->fecha = new CDbExpression('now()');

				if(Yii::app()->user->getState("_rolUser") == 3)
					$model->mecanico = Yii::app()->user->getState('_idUser');

				if($model->cambios != ''){
					if($model->save()){
						$response['title'] = 'Hecho';
		            	$response['message'] = 'Se agrego el registro de mantenimiento al vehiculo con placas '.$vehiculo->placas.'.';
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
					$response['title'] = 'Error validación';
	        		$response['message'] = 'Tiene que especificar los cambios que se le hicieron al vehiculo.';
				}				
			}
			else{
				$response['title'] = 'Error validación';
        		$response['message'] = 'En el estado que se encuentra el vehiculo no se pueden asignar registros de mantenimiento.';
			}

			echo CJSON::encode($response);
		}
		else
			throw new CHttpException(404,'The requested page does not exist.');
	}

	public function actionMantenimientos_view($id){
		$mantenimiento = $this->loadModelMantenimiento($id);
		$ingreso = $mantenimiento->ingreso0;
		$vehiculo = $ingreso->vehiculo0;
		$propietario = $vehiculo->propietario0;

		$this->render('//mantenimientos/view', array(
			'mantenimiento'=>$mantenimiento,
			'ingreso'=>$ingreso,
			'vehiculo'=>$vehiculo,
			'propietario'=>$propietario
		));
	}

	public function actionMantenimientos_update($id){
		$load = Yii::app()->getClientScript();
		$load->registerScriptFile(Yii::app()->request->baseUrl.'/js/controllers/mantenimientos.js',CClientScript::POS_END);

		$model = $this->loadModelMantenimiento($id);
		$ingreso = $model->ingreso0;

		if($ingreso->estado != 3)
			throw new CHttpException(404,'The requested page does not exist.');

		$tipos = TiposIngreso::model()->findAll();
		$mecanicos = Usuarios::model()->findAllByAttributes(array('rol'=>3, 'estado'=>1));

		$this->render('//mantenimientos/update', array(
			'ingreso'=>$ingreso,
			'model'=>$model,

			'tipos'=>Tools::toListSelect($tipos, 'id', 'nombre'),
			'mecanicos'=>Tools::toListSelect($mecanicos, 'id', 'nombres'),
		));
	}
	public function actionMantenimientos_update__ajax($id){
		if(Yii::app()->getRequest()->getIsAjaxRequest() && isset($_POST['Mantenimientos'])){
			$response = array('status'=>'error');

			$model = $this->loadModelMantenimiento($id);
			$ingreso = $model->ingreso0;
			$vehiculo = $ingreso->vehiculo0;

			if($model->usuario_registro == Yii::app()->user->getState('_idUser')){
				if($ingreso->estado == 3){
					$model->attributes=$_POST['Mantenimientos'];
					$model->ingreso = $ingreso->id;
					if($model->cambios != ''){
						if($model->save()){
							$response['title'] = 'Hecho';
			            	$response['message'] = 'Se modifico el registro de mantenimiento al vehiculo con placas '.$vehiculo->placas.'.';
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
						$response['title'] = 'Error validación';
		        		$response['message'] = 'Tiene que especificar los cambios que se le hicieron al vehiculo.';
					}
				}
				else{
					$response['title'] = 'Error validación';
	        		$response['message'] = 'En el estado que se encuentra el vehiculo no se pueden modificar registros de mantenimiento.';
				}
			}
			else{
				$response['title'] = 'Error validación';
        		$response['message'] = 'No es posible modificar los valores de este registro.';
			}

			echo CJSON::encode($response);
		}
		else
			throw new CHttpException(404,'The requested page does not exist.');
	}

	public function actionMantenimientos_delete($id){
		if(Yii::app()->getRequest()->getIsAjaxRequest()){
			$mantenimiento = $this->loadModelMantenimiento($id);
			$mantenimiento->estado = 2;
			$mantenimiento->save();

			$response['status'] = 'success';
			$response['title'] = 'Hecho';
			$response['message'] = 'El registro de mantenimiento se a eliminado del sistema.';

			echo CJSON::encode($response);
		}
	}

	private function loadModel($id)
	{
		$model=RegistrosIngreso::model()->findByAttributes(array('id'=>$id), array('condition'=>'t.estado != 2'));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	private function loadModelMantenimiento($id)
	{
		$model=Mantenimientos::model()->findByAttributes(array('id'=>$id), array('condition'=>'t.estado != 2'));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}