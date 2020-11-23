<?php

namespace app\models;

use yii\base\Model;

/**
 * SearchTour represents the model behind the search form of `app\models\Tour`.
 */
class SearchMainForm extends Model
{
   public $title;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [            
            [['title'], 'safe'],           
        ];
    }
    
}
