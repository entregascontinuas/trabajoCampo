<?php

class LugaresController extends Controller{
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
					'get_list',
				),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionGet_list(){
		if(isset($_GET['id'])){
			$response = array(
				'status'=>true,
				'items'=>'<option value="">-- Seleccione una opción --</option>',
			);
			$lugar = $this->loadModel($_GET['id']);

			$lugares = Lugares::model()->findAllByAttributes(array('depende'=>$lugar->id, 'estado'=>1), array('order'=>'t.nombre ASC'));
			foreach ($lugares as $key => $lugar) {
				$response['items'] .= '<option value="'.$lugar->id.'">'.$lugar->nombre.'</option>';
			}

			echo CJSON::encode($response);
		}
		else
			throw new CHttpException(404,'The requested page does not exist.');
	}

	private function loadModel($id)
	{
		$model=Lugares::model()->findByAttributes(array('id'=>$id, 'estado'=>1));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}