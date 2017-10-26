<?php
class upload extends page 
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
        header('Location: index.php?page=convert&filename='.$saved_file);//Sending the HTTP Header
    }
}
?>