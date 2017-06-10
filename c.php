<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $query = "";
        $refine = "";
        // validate submission
        if (empty($_POST['query']))
        {
            echo "You must provide a name.";
        }
        else
        {
            $query = $_POST['query'];
        }
        if(isset($_POST['Refine']))
        $refine = $_POST['Refine'];

        //echo $query;
        //echo $refine;
    }
    else
    {
        header("location:index.php");
    }
?>