<?php

namespace common\models;

use dektrium\user\models\User as BaseUser;
use common\helpers\Image;


class User extends BaseUser
{

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        // add field to scenarios
        $scenarios['create'][] = 'last_visit_at';
        $scenarios['update'][] = 'last_visit_at';
        $scenarios['register'][] = 'last_visit_at';

        return $scenarios;
    }

    public function rules()
    {
        $rules = parent::rules();
        // add some rules
        $rules['fieldLength'] = ['last_visit_at', 'string', 'max' => 10];

        return $rules;
    }

    public function getStatusOnline()
    {
        if ((time() - (@$this->last_visit_at ? $this->last_visit_at : 0)) > (60 * 20)) {
            return false;
        } else {
            return true;
        }
    }

    public function getLastVisit()
    {
        if (isset($this->last_visit_at)) {
            return 'последний визит: ' . date('d.m.Y H:i', $this->last_visit_at);
        } else {
            return 'последний визит: никогда';
        }
    }

    public function getName()
    {
        return $this->username;
    }

    public function thumb($width = null, $height = null, $crop = true)
    {
        return $this->profile->getAvatarUrl($width);
    }

}