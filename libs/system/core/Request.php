<?php
class Request {
    
    private $class = null;
    private $action = null;
    private $arguments = null;

    public function __construct($class = null, $action = null, $arguments = null) {
        $this->class = $class;
        $this->action = $action;
        $this->arguments = $arguments;
    }

    public function action(){
        if(empty($_REQUEST)){
            return null;
        }
        $request = filter_input(INPUT_POST, "request", FILTER_SANITIZE_STRING);
        $action = filter_input(INPUT_POST, "action", FILTER_SANITIZE_STRING);
        if(empty($request) || empty($action)){
            if(empty($request)){
                $request = filter_input(INPUT_GET, "request", FILTER_SANITIZE_STRING);
            }
            if(empty($action)){
                $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
            }
            if(empty($request) || empty($action)){
                return;
            }
        }
        $return  = "";
        $this->setClass($request);
        $this->setAction($action);
        if(!empty($this->class)){
            $this->setClass(ucfirst($this->class));
            if(method_exists($this->getClass(), $this->action)){
                $methodType = $this->getMehodType($this->class, $this->action);
                $class = $this->class;
                if(!empty($this->arguments)){
                    $action = "{$this->action}({$this->arguments})";
                }else{
                    $action = "{$this->action}";
                }
                switch ($methodType){
                    case 'public':
                    case 'private':
                    case 'protected':
                        $ref = new $class();
                        $return = $ref->$action();
                        break;
                    case 'static':
                        $return = $class::$action();
                        break;
                }
            }
        }
        return $return;
    }
    
    protected function getMehodType($class = "", $method = null) { 
        $class = new ReflectionMethod($class, $method); 
        if($class->isAbstract()){
            return "abstract";
        }else if ($class->isConstructor()) {
            return "contructor";
        }else if ($class->isStatic()) {
            return "static";
        }else if ($class->isPublic()) {
            return "public";
        }else if ($class->isPrivate()) {
            return "private";
        }
        return "public";
    }     
    
    public function getClass() {
        return $this->class;
    }

    public function setClass($class = null) {
        $this->class = $class;
    }

    public function getAction() {
        return $this->action;
    }

    public function setAction($action = null) {
        $this->action = $action;
    }

    public function getArguments() {
        return $this->arguments;
    }

    public function setArguments($arguments = null) {
        $this->arguments = $arguments;
    }
    
}