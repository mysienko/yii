<?php

namespace common\widgets;

use Yii;

class PopularVideo extends \yii\bootstrap\Widget
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        echo '
                <div class="popular_video">
                    <h3>Популярное видео</h3>
                    <ul class="popular_video_list clearfix">
                        <li>
                            <a href="#">
                                <img src="/images/img1.jpg" alt="">
                            </a>
                        </li>
                    </ul>
                    <a href="/video" class="more_videos_btn">еще видео</a>
                </div>
  
        ';

    }
}
