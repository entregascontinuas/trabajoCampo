<?php

/**
 * This is the model class for table "usuarios".
 *
 * The followings are the available columns in table 'usuarios':
 * @property integer $id
 * @property integer $cedula
 * @property string $password
 * @property string $nombres
 * @property string $apellidos
 * @property string $telefono
 * @property string $email
 * @property string $image
 * @property integer $rol
 * @property string $permisos
 * @property string $fecha_creacion
 * @property string $fecha_sesion_actual
 * @property string $fecha_ultima_sesion
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property Clientes[] $clientes
 * @property Mantenimientos[] $mantenimientoses
 * @property Mantenimientos[] $mantenimientoses1
 * @property RegistrosIngreso[] $registrosIngresos
 * @property RolsUsuario $rol0
 */
class Usuarios extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cedula, password, nombres, apellidos, rol, fecha_creacion, fecha_sesion_actual, fecha_ultima_sesion', 'required'),
			array('cedula, rol, estado', 'numerical', 'integerOnly'=>true),
			array('password, nombres, apellidos, image', 'length', 'max'=>155),
			array('telefono', 'length', 'max'=>65),
			array('email, permisos', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cedula, password, nombres, apellidos, telefono, email, image, rol, permisos, fecha_creacion, fecha_sesion_actual, fecha_ultima_sesion, estado', 'safe', 'on'=>'search'),
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
			'clientes' => array(self::HAS_MANY, 'Clientes', 'usuario'),
			'mantenimientoses' => array(self::HAS_MANY, 'Mantenimientos', 'mecanico'),
			'mantenimientoses1' => array(self::HAS_MANY, 'Mantenimientos', 'usuario_registro'),
			'registrosIngresos' => array(self::HAS_MANY, 'RegistrosIngreso', 'recibio'),
			'rol0' => array(self::BELONGS_TO, 'RolsUsuario', 'rol'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cedula' => 'Identificación',
			'password' => 'Contraseña',
			'nombres' => 'Nombres',
			'apellidos' => 'Apellidos',
			'telefono' => 'Teléfono',
			'email' => 'Correo electrónico',
			'image' => 'Imagen',
			'rol' => 'Rol',
			'permisos' => 'Permisos',
			'fecha_creacion' => 'Fecha de Creación',
			'fecha_sesion_actual' => 'Fecha Sesion Actual',
			'fecha_ultima_sesion' => 'Fecha Ultima Sesion',
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
		$criteria->compare('cedula',$this->cedula);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('nombres',$this->nombres,true);
		$criteria->compare('apellidos',$this->apellidos,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('rol',$this->rol);
		$criteria->compare('permisos',$this->permisos,true);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('fecha_sesion_actual',$this->fecha_sesion_actual,true);
		$criteria->compare('fecha_ultima_sesion',$this->fecha_ultima_sesion,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuarios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
