<?php

namespace Service;

/**
 * \View
 */
class View
{
    const CACHE_PATH = BASE_PATH . '/App/View/Cache/';
    const VIEW_PATH = [
        BASE_PATH . '/App/View'
    ];
    
    public $view;
    public $viewName;
    public $data;

    /**
        * 设置对应的view
        *
        * @param $viewName 文件名称
        *
        * @return 
     */
    public function make($viewName = null)
    {
        if ( ! $viewName ) {
            throw new InvalidArgumentException("视图名称不能为空！");
        } else {
            $this->viewName = $viewName;

            $compiler = new \Xiaoler\Blade\Compilers\BladeCompiler(self::CACHE_PATH);

            // you can add a custom directive if you want
            $compiler->directive('datetime', function($timestamp) {
                return preg_replace('/(\(\d+\))/', '<?php echo date("Y-m-d H:i:s", $1); ?>', $timestamp);
            });

            $engine = new \Xiaoler\Blade\Engines\CompilerEngine($compiler);
            $finder = new \Xiaoler\Blade\FileViewFinder(self::VIEW_PATH);

            // if your view file extension is not php or blade.php, use this to add it
            $finder->addExtension('tpl');

            // get an instance of factory
            $this->view = new \Xiaoler\Blade\Factory($engine, $finder);

            return $this;
        }

    }

    /**
        * 设置参数
        *
        * @param $key 参数名称
        * @param $value 参数值
        *
        * @return 
     */
    public function with($key, $value = null)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function __call($method, $parameters)
    {
        if (starts_with($method, 'with'))
        {
            return $this->with(snake_case(substr($method, 4)), $parameters[0]);
        }

        throw new BadMethodCallException("方法 [$method] 不存在！.");
    }
}

