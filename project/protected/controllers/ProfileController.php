<?php

class ProfileController extends Controller{
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
					'view',
					'change_pass'
				),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionView(){
		$load = Yii::app()->getClientScript();
		$load->registerScriptFile(Yii::app()->request->baseUrl.'/js/controllers/perfil.js',CClientScript::POS_END);

		$user = Usuarios::model()->findByPk(Yii::app()->user->getState('_idUser'));

		$this->render('//usuarios/view',array(
			'user'=>$user
		));
	}

	public function actionChange_pass(){
		if(Yii::app()->getRequest()->getIsAjaxRequest() && isset($_POST['Password'])){
			$response = array('status'=>'error');

			$user = Usuarios::model()->findByPk(Yii::app()->user->getState('_idUser'));

			if(crypt($_POST['Password']['current'], $user->password) != $user->password){
				$response['title'] = 'Error validación';
        		$response['message'] = 'La contraseña actual no es correcta.';
			}
			else{
				$user->password = Tools::crypt($_POST['Password']['new']);
				$user->save();

				$response['title'] = 'Hecho';
            	$response['message'] = 'La contraseña se ha cambiado con exito.';
            	$response['status'] = 'success';
			}

			echo CJSON::encode($response);
		}
		else
            throw new CHttpException(404,'The requested page does not exist.');
	}
}