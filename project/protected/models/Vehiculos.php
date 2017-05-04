<?php

/**
 * This is the model class for table "vehiculos".
 *
 * The followings are the available columns in table 'vehiculos':
 * @property integer $id
 * @property integer $propietario
 * @property integer $tipo
 * @property integer $marca
 * @property string $referencia
 * @property integer $modelo
 * @property string $placas
 * @property integer $tipo_combustible
 * @property string $numero_motor
 * @property string $numero_chasis
 * @property string $color
 * @property string $descripcion
 * @property string $observaciones
 * @property string $fecha_creacion
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property Clientes $propietario0
 * @property MarcasVehiculo $marca0
 * @property TiposCombustible $tipoCombustible
 * @property TiposVehiculo $tipo0
 */
class Vehiculos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vehiculos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('propietario, tipo, marca, referencia, modelo, placas, tipo_combustible, numero_motor, numero_chasis, color', 'required'),
			array('propietario, tipo, marca, modelo, tipo_combustible, estado', 'numerical', 'integerOnly'=>true),
			array('referencia', 'length', 'max'=>155),
			array('placas', 'length', 'max'=>10),
			array('numero_motor, numero_chasis', 'length', 'max'=>65),
			array('color', 'length', 'max'=>45),
			array('descripcion', 'length', 'max'=>255),
			array('observaciones, fecha_creacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, propietario, tipo, marca, referencia, modelo, placas, tipo_combustible, numero_motor, numero_chasis, color, descripcion, observaciones, fecha_creacion, estado', 'safe', 'on'=>'search'),
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
			'propietario0' => array(self::BELONGS_TO, 'Clientes', 'propietario'),
			'marca0' => array(self::BELONGS_TO, 'MarcasVehiculo', 'marca'),
			'tipoCombustible' => array(self::BELONGS_TO, 'TiposCombustible', 'tipo_combustible'),
			'tipo0' => array(self::BELONGS_TO, 'TiposVehiculo', 'tipo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'propietario' => 'Propietario',
			'tipo' => 'Tipo',
			'marca' => 'Marca',
			'referencia' => 'Referencia',
			'modelo' => 'Modelo',
			'placas' => 'Placas',
			'tipo_combustible' => 'Tipo de Combustible',
			'numero_motor' => 'Número de Motor',
			'numero_chasis' => 'Número de Chasis',
			'color' => 'Color',
			'descripcion' => 'Descripción',
			'observaciones' => 'Observaciones',
			'fecha_creacion' => 'Fecha de Creación',
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
		$criteria->compare('propietario',$this->propietario);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('marca',$this->marca);
		$criteria->compare('referencia',$this->referencia,true);
		$criteria->compare('modelo',$this->modelo);
		$criteria->compare('placas',$this->placas,true);
		$criteria->compare('tipo_combustible',$this->tipo_combustible);
		$criteria->compare('numero_motor',$this->numero_motor,true);
		$criteria->compare('numero_chasis',$this->numero_chasis,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vehiculos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
