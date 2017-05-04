<?php

/**
 * This is the model class for table "lugares".
 *
 * The followings are the available columns in table 'lugares':
 * @property integer $id
 * @property string $nombre
 * @property integer $tipo
 * @property integer $depende
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property Clientes[] $clientes
 * @property TiposLugar $tipo0
 * @property Lugares $depende0
 * @property Lugares[] $lugares
 */
class Lugares extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lugares';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, nombre, tipo', 'required'),
			array('id, tipo, depende, estado', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>155),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, tipo, depende, estado', 'safe', 'on'=>'search'),
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
			'clientes' => array(self::HAS_MANY, 'Clientes', 'ciudad'),
			'tipo0' => array(self::BELONGS_TO, 'TiposLugar', 'tipo'),
			'depende0' => array(self::BELONGS_TO, 'Lugares', 'depende'),
			'lugares' => array(self::HAS_MANY, 'Lugares', 'depende'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'tipo' => 'Tipo',
			'depende' => 'Depende',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('depende',$this->depende);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Lugares the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
