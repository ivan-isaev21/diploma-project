<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tours".
 *
 * @property int $id Номер тура
 * @property string $title Заголовок
 * @property string|null $description Описание
 * @property array|null $images Массив картинок
 * @property float|null $price Цена
 * @property integer|null $rating Рейтинг
 * @property string|null $map_code HTML код карт
 */
class Tour extends \yii\db\ActiveRecord
{
    
        /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tours';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','short_description'], 'required'],
            [['description',], 'string'],            
            [['map_code','description'],'safe'],   
            [['images'], 'safe'],    
            [['price'], 'number'],
            [['rating'], 'integer','min'=>1,'max'=>5],
            [['short_description'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер тура',
            'title' => 'Заголовок',
            'short_description' => 'Краткое описание',
            'description' => 'Описание',
            'images' => 'Массив картинок',
            'map_code'=>'HTML код карт',
            'price' => 'Цена',
            'rating' => 'Рейтинг',
        ];
    }    
}
