<?php

namespace jackh\material\generators\model;

class Generator extends \yii\gii\generators\model\Generator {
    public $enableUpload = false;

    public function getName()
    {
        return 'Material Model Generator';
    }

    public function getDescription()
    {
        return 'Build basic Model in Material style';
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['enableUpload'], 'boolean'],
        ]);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'enableUpload' => 'Enable Upload',
        ]);
    }
}
