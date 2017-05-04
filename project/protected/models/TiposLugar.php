<?php

/**
 * This is the model class for table "tipos_lugar".
 *
 * The followings are the available columns in table 'tipos_lugar':
 * @property integer $id
 * @property string $nombre
 * @property integer $depende
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property Lugares[] $lugares
 * @property TiposLugar $depende0
 * @property TiposLugar[] $tiposLugars
 */
class TiposLugar extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tipos_lugar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre', 'required'),
			array('depende, estado', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>55),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, depende, estado', 'safe', 'on'=>'search'),
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
			'lugares' => array(self::HAS_MANY, 'Lugares', 'tipo'),
			'depende0' => array(self::BELONGS_TO, 'TiposLugar', 'depende'),
			'tiposLugars' => array(self::HAS_MANY, 'TiposLugar', 'depende'),
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
	 * @return TiposLugar the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
