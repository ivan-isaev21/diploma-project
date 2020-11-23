<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property string $ip IP с которого написан отзыв
 * @property int $tour_id Id экскурсии
 * @property string $comment Текст отзыва
 * @property int $rating
 *
 * @property Tour $tour
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip', 'tour_id', 'comment', 'rating'], 'required'],
            [['tour_id', 'rating'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['comment'], 'string', 'max' => 3000],
            [['ip'], 'string', 'max' => 39],
            [['ip', 'tour_id'], 'unique','targetAttribute' => ['ip', 'tour_id']],
            [['tour_id'], 'exist', 'skipOnError' => false, 'targetClass' => Tour::className(), 'targetAttribute' => ['tour_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ip' => 'IP с которого написан отзыв',
            'tour_id' => 'Id экскурсии',
            'name' => 'Имя',
            'comment' => 'Текст отзыва',
            'rating' => 'Рейтинг',
        ];
    }

    /**
     * Возвращает к-во отзывов у экскурсии
     *
     * @param integer $tour_id
     * @return integer
     */
    public static function getCount($tour_id)
    {
        $count = Review::find()->where(['tour_id' => $tour_id])->count();
        return $count;
    }

    /**
     * Сохраняет средний рейтинг экскурсии
     *
     * @param integer $tour_id
     * @return bool
     */
    public static function setAverageRating($tour_id)
    {
        $rating = round(self::getAverageRating($tour_id));
        $tour = Tour::find()->where(['id' => $tour_id])->one();
        $tour->rating = $rating;
        if ($tour->save()) {
            return true;
        }
        return false;
    }
    /**
     * Получает средний рейтинг экскурсии
     *
     * @param integer $tour_id
     * @return integer
     */
    public static function getAverageRating($tour_id)
    {
        $count = Review::find()->where(['tour_id' => $tour_id])->average('rating');
        return round($count);
    }

    /**
     * Gets query for [[Tour]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tour_id']);
    }
}
