<?php

/**
 * This is the model class for table "clientes".
 *
 * The followings are the available columns in table 'clientes':
 * @property integer $id
 * @property integer $usuario
 * @property integer $ciudad
 * @property string $direccion
 * @property integer $celular
 * @property string $observaciones
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property Usuarios $usuario0
 * @property Lugares $ciudad0
 * @property Vehiculos[] $vehiculoses
 */
class Clientes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'clientes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usuario, ciudad', 'required'),
			array('usuario, ciudad, celular, estado', 'numerical', 'integerOnly'=>true),
			array('direccion', 'length', 'max'=>155),
			array('observaciones', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, usuario, ciudad, direccion, celular, observaciones, estado', 'safe', 'on'=>'search'),
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
			'usuario0' => array(self::BELONGS_TO, 'Usuarios', 'usuario'),
			'ciudad0' => array(self::BELONGS_TO, 'Lugares', 'ciudad'),
			'vehiculoses' => array(self::HAS_MANY, 'Vehiculos', 'propietario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'usuario' => 'Usuario',
			'ciudad' => 'Ciudad',
			'direccion' => 'Dirección',
			'celular' => 'Celular',
			'observaciones' => 'Observaciones',
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
		$criteria->compare('usuario',$this->usuario);
		$criteria->compare('ciudad',$this->ciudad);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('celular',$this->celular);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Clientes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
