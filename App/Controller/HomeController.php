<?php

namespace Controller;
use Model\Article;
use Service\View;

/**
 * Class HomeController
 * @author xiaozhu
 */
class HomeController extends BaseController
{
    /**
        * 测试页面
        *
        * @return 
     */
    public function home()
    {
        $myView = new View();
        $this->view = $myView->make('home')->with('article',Article::first())

            ->withTitle('good');
    }
}
