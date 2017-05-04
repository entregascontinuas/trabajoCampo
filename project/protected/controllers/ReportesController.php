<?php

class ReportesController extends Controller{
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
					'create',
					'generar'
				),
				'users'=>array('@'),
				'expression'=>'Tools::hasPermission(6)',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function actionCreate(){
		$load = Yii::app()->getClientScript();
		$load->registerScriptFile(Yii::app()->request->baseUrl.'/js/controllers/reportes.js',CClientScript::POS_END);

		$this->render('create');
	}

	public function actionGenerar(){
		if(Yii::app()->getRequest()->getIsAjaxRequest() && isset($_GET['from']) && isset($_GET['to'])){
			$response = array('status'=>'error', 'report'=>array());
			$error = false;

			if((Tools::dateIsValid($_GET['from'], 'd/m/Y')) && (Tools::dateIsValid($_GET['to'], 'd/m/Y'))){
				$from = @date_create(str_replace("/","-",trim($_GET['from'])), new DateTimeZone('Europe/London'));
				$from = date_format($from, 'Y-m-d H:i:s');
				$to = @date_create(str_replace("/","-",trim($_GET['to'])), new DateTimeZone('Europe/London'));
				$to = date_format($to, 'Y-m-d H:i:s');
			}
			else{
                $response['message'] = 'El formato de las fechas no son validos.';
                $error = true;
			}

			if(!$error){
				$ingresos = RegistrosIngreso::model()->count(array('condition'=>'t.fecha >= "'.$from.'" AND t.fecha <= "'.$to.'"'));
				$response['report']['ingresos'] = $ingresos;

				if($ingresos > 0){
					$ingresosSql = $this->querySql("select tipo, count(ri.tipo) as total from registros_ingreso ri where ri.fecha >= '".$from."' AND ri.fecha <= '".$to."' group by ri.tipo order by 2 DESC;");
					$ingresosTipo = array(
						'tipos'=>array(),
						'template'=>null
					);
					foreach ($ingresosSql as $key => $tipo) {
						$tipo0 = TiposIngreso::model()->findByPk($tipo['tipo']);
						$ingresosTipo['tipos'][] = array('nombre'=>$tipo0->nombre, 'total'=>$tipo['total']);
					}
					$ingresosTipo['template'] = $this->renderPartial('_tipos', array('tipos'=>$ingresosTipo['tipos'],'ingresos'=>$ingresos), true);
					$response['report']['tipo'] = $ingresosTipo;

					//////////////////////////////////////////////////////////////////////////////

					$ingresosSql = $this->querySql("select v.tipo, count(v.tipo) as total from vehiculos v right join (select ri.vehiculo from registros_ingreso ri where ri.fecha >= '".$from."' AND ri.fecha <= '".$to."') ri on (v.id = ri.vehiculo) group by v.tipo order by 2 DESC");
					$tiposVehiculo = array(
						'tipos'=>array(),
						'template'=>null
					);
					foreach ($ingresosSql as $key => $tipo) {
						$tipo0 = TiposVehiculo::model()->findByPk($tipo['tipo']);
						$tiposVehiculo['tipos'][] = array('nombre'=>$tipo0->nombre,'total'=>$tipo['total']);
					}
					$tiposVehiculo['template'] = $this->renderPartial('_vehiculos', array('tipos'=>$tiposVehiculo['tipos'],'ingresos'=>$ingresos), true);
					$response['report']['vehiculos_tipo'] = $tiposVehiculo;

					//////////////////////////////////////////////////////////////////////////////

					$ingresosSql = $this->querySql("select v.marca, count(v.marca) as total from vehiculos v right join (select ri.vehiculo from registros_ingreso ri where ri.fecha >= '".$from."' AND ri.fecha <= '".$to."') ri on (v.id = ri.vehiculo) group by v.marca order by total DESC;");
					$marcasVehiculo = array(
						'marcas'=>array(),
						'template'=>null
					);
					$totalMarcas = 0;
					foreach ($ingresosSql as $key => $marca) {
						if($key < 15){
							$marca0 = MarcasVehiculo::model()->findByPk($marca['marca']);
							$marcasVehiculo['marcas'][] = array('nombre'=>$marca0->nombre,'total'=>$marca['total']);
						}
						else{
							$marcasVehiculo['marcas'][] = array('nombre'=>'Otras marcas','total'=>($ingresos-$totalMarcas));
							break;
						}
						$totalMarcas += $marca['total'];
					}
					$marcasVehiculo['template'] = $this->renderPartial('_marcas', array('marcas'=>$marcasVehiculo['marcas'],'ingresos'=>$ingresos), true);
					$response['report']['vehiculos_marca'] = $marcasVehiculo;

					//////////////////////////////////////////////////////////////////////////////

					$ingresosSql = $this->querySql("select v.tipo_combustible, count(v.tipo_combustible) as total from vehiculos v right join (select ri.vehiculo from registros_ingreso ri where ri.fecha >= '".$from."' AND ri.fecha <= '".$to."') ri on (v.id = ri.vehiculo) group by v.tipo_combustible order by 2 DESC");
					$combustiblesVehiculo = array(
						'tipos'=>array(),
						'template'=>array()
					);
					foreach ($ingresosSql as $key => $combustible) {
						$combustible0 = TiposCombustible::model()->findByPk($combustible['tipo_combustible']);
						$combustiblesVehiculo['tipos'][] = array('nombre'=>$combustible0->nombre, 'total'=>$combustible['total']);
					}
					$combustiblesVehiculo['template'] = $this->renderPartial('_combustibles', array('tipos'=>$combustiblesVehiculo['tipos'],'ingresos'=>$ingresos), true);
					$response['report']['vehiculos_combustible'] = $combustiblesVehiculo;

					//////////////////////////////////////////////////////////////////////////////

					$ingresosSql = $this->querySql("select c.ciudad, count(c.ciudad) as total from clientes c right join (select v.propietario from vehiculos v right join (select ri.vehiculo from registros_ingreso ri where ri.fecha >= '".$from."' AND ri.fecha <= '".$to."') ri on (v.id = ri.vehiculo)) v on (c.id = v.propietario) group by c.ciudad order by 2 DESC");
					$ciudadesPropietario = array(
						'ciudades'=>array(),
						'template'=>null
					);
					$totalCiudades = 0;
					foreach ($ingresosSql as $key => $ciudad) {
						if($key < 7){
							$ciudad0 = Lugares::model()->findByPk($ciudad['ciudad']);
							$ciudadesPropietario['ciudades'][] = array('nombre'=>$ciudad0->nombre,'total'=>$ciudad['total']);						
						}
						else{
							$ciudadesPropietario['ciudades'][] = array('nombre'=>'Otras ciudades','total'=>($ingresos-$totalCiudades));
							break;
						}
						$totalCiudades += $ciudad['total'];
					}
					$ciudadesPropietario['template'] = $this->renderPartial('_ciudades', array('ciudades'=>$ciudadesPropietario['ciudades'],'ingresos'=>$ingresos), true);
					$response['report']['propietario_ciudad'] = $ciudadesPropietario;

					//////////////////////////////////////////////////////////////////////////////

					$ingresosSql = $this->querySql("select date_format(ri.fecha, '%a') as dia, count(date_format(ri.fecha, '%a')) as total from registros_ingreso ri where ri.fecha >= '".$from."' AND ri.fecha <= '".$to."' group by date_format(ri.fecha, '%a')");
					$diasIngresos = array(
						'dias'=>array('mon'=>array('total'=>0,'nombre'=>'Lunes'),'tue'=>array('total'=>0,'nombre'=>'Martes'),'wed'=>array('total'=>0,'nombre'=>'Miercoles'),'thu'=>array('total'=>0,'nombre'=>'Jueves'),'fri'=>array('total'=>0,'nombre'=>'Viernes'),'sat'=>array('total'=>0,'nombre'=>'Sabado'),'sun'=>array('total'=>0,'nombre'=>'Domingo')),
						'template'=>null
					);
					foreach ($ingresosSql as $key => $dias) {
						$diasIngresos['dias'][strtolower($dias['dia'])]['total'] = $dias['total'];
					}
					$diasIngresos['template'] = $this->renderPartial('_dias', array('dias'=>$diasIngresos,'ingresos'=>$ingresos), true);
					$response['report']['ingresos_dias'] = $diasIngresos;
				}

				$response['error'] = 'success';
			}

			echo CJSON::encode($response);
		}
		else
            throw new CHttpException(404,'The requested page does not exist.');
	}

	private function querySql($sql){
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$dataReader = $command->query();

		return $dataReader->readAll();
	}
}