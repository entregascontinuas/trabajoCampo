<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		if(!Yii::app()->user->isGuest){
			$clientes = Clientes::model()->countByAttributes(array('estado'=>1));
			$vehiculos = Vehiculos::model()->countByAttributes(array('estado'=>1));
			$espera = RegistrosIngreso::model()->countByAttributes(array('estado'=>0));

			$mantenimientos = RegistrosIngreso::model()->findAllByAttributes(array('estado'=>3), array('order'=>'t.fecha ASC'));

			$this->render('index', array(
				'clientes'=>$clientes,
				'vehiculos'=>$vehiculos,
				'espera'=>$espera,
				'mantenimientos'=>$mantenimientos,
			));
		}
		else{
			$this->redirect(array('login'));
		}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if (Yii::app()->user->isGuest)
			$this->layout = '//layouts/login';
		else
			$this->layout = '//layouts/main';
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout = '//layouts/login';
		$model=new LoginForm;

		if(Yii::app()->getRequest()->getIsAjaxRequest()){
			$response = array('status'=>'error');

			$model->attributes=$_POST['LoginForm'];
			$model->login();
			if (CActiveForm::validate($model)!="[]"){
				$response = array(
					'status'=>'error',
					'title'=>'Error de validación',
					'message'=>'Nombre de usuario o password incorrecto.'
				);
			}
			else{
				$response = array(
					'status'=>'success',
					'title'=>'Exito',
					'message'=>'La validación se realizo correctamente.'
				);
			}
			echo CJSON::encode($response);
			Yii::app()->end();
		}
		else{
			if (Yii::app()->user->isGuest) {
				$this->render('login',array('model'=>$model));
			}
			else{
				Yii::app()->user->setReturnUrl('index');
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}