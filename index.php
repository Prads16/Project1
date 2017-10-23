<?php

ini_set('display_errors', 'On');//Turning the debug messages ON
error_reporting(E_ALL);

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
        /*$this->html .= '<html>';
        $this->html .= '<link rel = "stylesheet" href = "styles.css">';
        $this->html .= '<body>';*/
    }
    public function __destruct()
    {
        //$this->html .= '</body></html>';
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

/*class homepage extends page 
{
    public function get()
    {
        //Displaying the HTML form for uploading the CSV files
        $form = '<form method="post" enctype="multipart/form-data">';
        $form .= '<input type="file" name="fileToUpload" id="fileToUpload">';
        $form .= '<input type="submit" value="Upload File" name="submit">';
        $form .= '</form> ';
        $this->html .= '<h1>Upload CSV File for Conversion</h1>';
        $this->html .= $form;
    }

    public function post() 
    {
        $saved_in_dir = "Uploads/";//Assigning the directory in which the csv files will be saved
        $saved_file = $saved_in_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $csvFileType = pathinfo($saved_file,PATHINFO_EXTENSION);
        $csvFileName = pathinfo($saved_file,PATHINFO_BASENAME);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $saved_file); //Saving the csv file in the directory on AFS
        header('Location: index.php?page=htmlTable&filename='.$saved_file);//Sending the HTTP Header
    }
}*/

/*class htmlTable extends page 
{
    public function get()
    {
        //$csvname = $_GET['fileName'];
        $convert = fopen($_REQUEST['filename'], "r");//Reading the .csv File 
        echo '<table border = "3">';//Generating a table
        $tabledata = (fgetcsv($convert));//Reading the file for headers of the file
        //Displaying the header row
        echo '<tr>';
        foreach ($tabledata as $headercolumn)
        {
            echo "<th>$headercolumn</th>";
        }
        echo '</tr>';
    
        while (!feof($convert))//Read all the rows till the end of file
        {
            $tabledata = (fgetcsv($convert));// Reading the content of the file
            //echo "<table border = '3'>";
            //for ($row = 0; $row < sizeof($tabledata); $row++)
            echo '<tr>';
            for ($col = 0; $col < sizeof($tabledata); $col++)
            {
                echo "<td>$tabledata[$col]</td>";   // Displaying the column data line by line       
            }
            echo '</tr>';  
        }
        echo '</table>';//Displaying the table
        fclose($convert);//Closing the file
    }
}*/

/*class stringFunctions 
{
     static public function printThis($inputText) 
     {
        return print($inputText);
     }
}*/

?>
