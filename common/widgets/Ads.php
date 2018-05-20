<?php
namespace common\widgets;

use Yii;

class Ads extends \yii\bootstrap\Widget
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        echo '
        <div class="event">
            <div class="event_block">
                <div class="user_name">
                    <span>Василий Домбровский</span>
                </div>
                <div class="date">15-16 августа 15:30</div>
                <p>Конференция по новым компьютерным технологиям и защите компьютерных программ!</p>
                <a href="#" class="connect_btn">Подключиться</a>
            </div>
        </div>
        ';

    }
}
