<?php

namespace app\models;

use Yii;
use yii\base\Model;

class File extends Model
{
    public $images;
    public $fileName;


    public function rules()
    {
        return [
            [['images'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 5],
        ];
    }

    public function getPath($images_json)
    {
        if (empty($images_json)) {
            return false;
        }
        $images = json_decode($images_json);
        $result = [];
        foreach ($images as $img) {
            $result[] = $img->path;
        }
        return $result;
    }

    public function upload($tour_id)
    {
        if ($this->images && $this->validate()) {
            $dir = 'uploads/';
            $images = [];
            $i = 1;
            foreach ($this->images as $file) {
                $config = [];
                //$name = $this->randomFileName($file->extension);  
                $name = $tour_id . '_' . $i . '.' . $file->extension;
                $path = $dir . $name;
                if ($file->saveAs($path, false)) {
                    $images[] = ['caption' => $name, 'path' => $path, 'key' => $i, 'extra' => ['id' => $i, 'tour_id' => $tour_id]];
                    $i++;
                }
            }
            return json_encode($images);
        }
        return false;
    }

    private function randomFileName($extension = false)
    {
        $extension = $extension ? '.' . $extension : '';
        do {
            $name = md5(microtime() . rand(0, 1000));
            $file = $name . $extension;
        } while (file_exists($file));
        return $file;
    }
}
