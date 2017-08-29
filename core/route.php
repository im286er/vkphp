<?php
/**
 * 路由控制
 */
namespace core;

class route{
    public $ctrl;
    public $action;
    public $params=array();
    public function __construct(){
        //echo 'route is ready!';

        /**
         * 1、隐藏index.php
         * 2、获取URL中的控制器和方法
         * 3、获取URL中的参数
         */

        if(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/'){
            $path = $_SERVER['REQUEST_URI'];
            $patharr = explode('/',trim($path, '/'));
            //p($patharr);

            if(isset($patharr[0])){
                if($patharr[0] != 'index.php'){
                    // 省略了index.php
                    $this->ctrl = $patharr[0];

                    if(isset($patharr[1])){
                        $this->action = $patharr[1];
                    } else{
                        $this->action = 'index';
                    }
                    $count = count($patharr);
                    $i=2;
                    while($i < $count){
                        $this->params[$patharr[$i]] = $patharr[$i+1];
                        $i = $i + 2;
                    }
                }else{
                    // 没省略index.php
                    if(isset($patharr[1])){
                        $this->ctrl = $patharr[1];
                    }
                    if(isset($patharr[2])){
                        $this->action = $patharr[2];
                    } else{
                        $this->action = 'index';
                    }

                    $count = count($patharr);
                    $i=3;
                    while($i < $count){
                        $this->params[$patharr[$i]] = $patharr[$i+1];
                        $i = $i + 2;
                    }
                }
            }else{
                $this->ctrl = 'index';
                $this->action = 'index';
            }

        }else {
            $this->ctrl = 'index';
            $this->action = 'index';
        }
        p($this->params);
    }
}