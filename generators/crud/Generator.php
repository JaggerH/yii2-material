<?php

namespace jackh\material\generators\crud;

class Generator extends \yii\gii\generators\crud\Generator {
    public $enableUpload = false;

    public function getName()
    {
        return 'Material CRUD Generator';
    }

    public function getDescription()
    {
        return 'Build basic CRUD in Material style';
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
