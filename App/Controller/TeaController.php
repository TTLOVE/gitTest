<?php

namespace Controller;
use Service\Mail;
use Service\RRedis as Redis;

/**
 * Class TeaController
 * @author xiaozhu
 */
class TeaController extends BaseController
{

    public function index()
    {
        $this->mail = Mail::to(['348977791@qq.com'])

            ->from('zyz <yanzongnet@163.com>')

            ->title('最近可好')

            ->content('<h1>么么哒~~</h1>');
    }

    public function testRedis()
    {
        Redis::set('key','value',5,'s');

        echo Redis::get('key');
    }

}
