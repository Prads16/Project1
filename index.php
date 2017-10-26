<?php

//Class to load classes when the program fails for calling the missing class
class Manage 
{
    public static function autoload($class) 
    {
        include $class . '.php';
    }
}

spl_autoload_register(array('Manage', 'autoload'));

$obj = new main();//Creating and instantiating the object of the class

class main 
{
    public function __construct()
    {
        $pageRequest = 'upload';//Setting default page when no parameters are in URL
        
        if(isset($_REQUEST['page'])) //Checking for the parameters
        {
            $pageRequest = $_REQUEST['page'];//Loading the page
        }
        
        $page = new $pageRequest;

        if($_SERVER['REQUEST_METHOD'] == 'GET') 
        {
            $page->get();
        } 
        else 
        {
            $page->post();
        }
    }
}

abstract class page 
{
    protected $html;

    public function __construct()
    {
        $this->html .= '<html>';
        $this->html .= '<body>';
    }
    public function __destruct()
    {
        stringfunctions::printThis($this->html);
    }

    public function get() 
    {
        echo 'Welcome';
    }

    public function post() 
    {
        print_r($_POST);
    }
}

?>
