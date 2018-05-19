<?php

namespace common\widgets;

use Yii;

class LastStreams extends \yii\bootstrap\Widget
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        echo '
                 <div class="now_on_air">
                    <h3>Новые трансляции</h3>
                    <ul class="now_on_air_list clearfix">
                        <li>
                            <a href="#">
                                <img src="/images/img1.jpg" alt="">
                            </a>
                        </li>
 
                    </ul>
                    <a href="/streams" class="more_broadcast_btn">еще трансляции</a>
                </div>
        ';

    }
}
