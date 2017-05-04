<?php

/**
 * This is the model class for table "registros_ingreso".
 *
 * The followings are the available columns in table 'registros_ingreso':
 * @property integer $id
 * @property integer $vehiculo
 * @property integer $tipo
 * @property string $observaciones_cliente
 * @property integer $kilmetraje
 * @property string $desperfectos
 * @property string $elementos
 * @property string $observaciones
 * @property string $fecha
 * @property integer $recibio
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property TiposIngreso $tipo0
 * @property Usuarios $recibio0
 * @property Vehiculos $vehiculo0
 */
class RegistrosIngreso extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'registros_ingreso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vehiculo, tipo, observaciones_cliente, kilmetraje, fecha, recibio', 'required'),
			array('vehiculo, tipo, kilmetraje, recibio, estado', 'numerical', 'integerOnly'=>true),
			array('elementos', 'length', 'max'=>255),
			array('desperfectos, observaciones', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, vehiculo, tipo, observaciones_cliente, kilmetraje, desperfectos, elementos, observaciones, fecha, recibio, estado', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'tipo0' => array(self::BELONGS_TO, 'TiposIngreso', 'tipo'),
			'recibio0' => array(self::BELONGS_TO, 'Usuarios', 'recibio'),
			'vehiculo0' => array(self::BELONGS_TO, 'Vehiculos', 'vehiculo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'vehiculo' => 'Vehículo',
			'tipo' => 'Tipo',
			'observaciones_cliente' => 'Observaciones del cliente',
			'kilmetraje' => 'Kilometraje',
			'desperfectos' => 'Desperfectos',
			'elementos' => 'Elementos en el auto',
			'observaciones' => 'Observaciones',
			'fecha' => 'Fecha',
			'recibio' => 'Recibio',
			'estado' => 'Estado',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('vehiculo',$this->vehiculo);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('observaciones_cliente',$this->observaciones_cliente,true);
		$criteria->compare('kilmetraje',$this->kilmetraje);
		$criteria->compare('desperfectos',$this->desperfectos,true);
		$criteria->compare('elementos',$this->elementos,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('recibio',$this->recibio);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegistrosIngreso the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
