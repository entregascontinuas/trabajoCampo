<?php

/**
 * This is the model class for table "mantenimientos".
 *
 * The followings are the available columns in table 'mantenimientos':
 * @property integer $id
 * @property integer $ingreso
 * @property integer $mecanico
 * @property integer $tipo
 * @property string $cambios
 * @property string $observaciones
 * @property integer $usuario_registro
 * @property string $fecha
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property RegistrosIngreso $ingreso0
 * @property Usuarios $mecanico0
 * @property Usuarios $usuarioRegistro
 * @property TiposIngreso $tipo0
 */
class Mantenimientos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mantenimientos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ingreso, mecanico, tipo, cambios, usuario_registro, fecha', 'required'),
			array('ingreso, mecanico, tipo, usuario_registro, estado', 'numerical', 'integerOnly'=>true),
			array('observaciones', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ingreso, mecanico, tipo, cambios, observaciones, usuario_registro, fecha, estado', 'safe', 'on'=>'search'),
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
			'ingreso0' => array(self::BELONGS_TO, 'RegistrosIngreso', 'ingreso'),
			'mecanico0' => array(self::BELONGS_TO, 'Usuarios', 'mecanico'),
			'usuarioRegistro' => array(self::BELONGS_TO, 'Usuarios', 'usuario_registro'),
			'tipo0' => array(self::BELONGS_TO, 'TiposIngreso', 'tipo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ingreso' => 'Ingreso',
			'mecanico' => 'Mecanico',
			'tipo' => 'Tipo',
			'cambios' => 'Cambios',
			'observaciones' => 'Observaciones',
			'usuario_registro' => 'Usuario Registro',
			'fecha' => 'Fecha',
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
		$criteria->compare('ingreso',$this->ingreso);
		$criteria->compare('mecanico',$this->mecanico);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('cambios',$this->cambios,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('usuario_registro',$this->usuario_registro);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mantenimientos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
