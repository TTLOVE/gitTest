<?php

use \NoahBuscher\Macaw\Macaw;

//use Laravel\App\Controller\HomeController;

//$home = new HomeController();
//$home->home();
//exit();
Macaw::get('fuck', function() {
    echo "成功！";
});

Macaw::get('/', function() {
    echo 'welcome';
});

Macaw::get('home', 'Controller\HomeController@home');

Macaw::get('redis', 'Controller\TeaController@testRedis');

Macaw::get('tea', 'Controller\TeaController@index');

Macaw::$error_callback = function() {
      throw new Exception("路由无匹配项 404 Not Found");
};

Macaw::dispatch();
