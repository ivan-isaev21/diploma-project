<?php

namespace app\models;

use yii\base\Model;

class SearchMainForm extends Model
{
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
