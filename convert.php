<?php
class convert extends page 
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
}
?>

