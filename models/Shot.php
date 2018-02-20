<?php

/**
 * This is the model class for table "shot".
 *
 * The followings are the available columns in table 'shot':
 * @property integer $id
 * @property string $title
 * @property string $sketch
 * @property integer $sequence_id
 * @property integer $rank
 *
 * The followings are the available model relations:
 * @property Sequence $sequence
 */
class Shot extends CActiveRecord
{
	public $sketch;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Shot the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shot';
	}
	
	

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('sequence_id, rank', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>200),
			array('angle', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, sketch, sequence_id, rank', 'safe', 'on'=>'search'),
			//array('sketch', 'file', 'types'=>'jpg, gif, png, JPG, bmp'),
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
			'sequence' => array(self::BELONGS_TO, 'Sequence', 'sequence_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'sketch' => 'Sketch',
			'sequence_id' => 'Sequence',
			'rank' => 'Rank',
			'angle' => 'Angle',
		);
	}
	
public function beforeSave()
    {
    	
    	$file = CUploadedFile::getInstance($this,'sketch');
        if($file)
        {
        	
           // $this->file_name=$file->name;
        // echo $file->type;
         //echo $file->size;
       //  echo file_get_contents($file->tempName);
            $this->sketch=file_get_contents($file->tempName);
          //  $this->sketch = $file;
        }
 
    return parent::beforeSave();
    }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('sketch',$this->sketch,true);
		$criteria->compare('sequence_id',$this->sequence_id);
		$criteria->compare('rank',$this->rank);
		$criteria->compare('angle',$this->angle);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}