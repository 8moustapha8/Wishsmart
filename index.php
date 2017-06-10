<?php require_once("activity.php") ?>
<?php include("header.php") ?>

<body>
<div id="wrapper">
     <!-- Navigation -->
        <nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">WishSmart</a>
            </div>

			<form class="navbar-default sidebar" action="index.php" method="POST">
                <div class= role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <input type="text" name="query" class="form-control" value="Search..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search...';}" >
                    <ul class="nav" id="side-menu"> <br/>
                        <li>
                            <h5 class="panel-title">Refine Results:</h5>
                        </li>
                        <li>
                            <input type="radio" name="Refine" value="LH">Low to High</input>
                        </li>
                        <li>
                            <input type="radio" name="Refine" value="HL">High to Low</input>
                        </li>
                        <li>
                            <input type="radio" name="Refine" value="POP">Popularity</input>
                        </li>
                        <li>
                            <input type="radio" name="Refine" value="REL">Relavance</input>
                        </li>
                    </ul> <br/>
                    <button type="submit" class="btn-success btn">Search</button>
                </div>
                </div>
                <!-- /.sidebar-collapse -->
            </form>
            <!-- /.navbar-static-side -->
        </nav>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $query = "";
        $refine = "";
        // validate submission
        if (empty($_POST['query']))
        {
            echo "You must provide a Product name.";
        }
        else
        {
            $query = $_POST['query'];
        }
        if(isset($_POST['Refine']))
        $refine = $_POST['Refine'];

        display1();
        display_shopclues($query,$refine);
        display_askmeba($query,$refine);
        //display_infibeam($query,$refine);
        //display2();
        //display1();
        //display_askmeba($query,$refine);
        display2();
        display2();
        echo "<div class=\"activity_box\">";
        echo "<h5>*Tool just pulls and shows the data from the sites</h5>";
        echo "<div class=\"blank_thing\"><h1>Showing ";
        if ($refine == "" || $refine == "REL")
            echo "Relevant";
        else if ($refine == "LH")
            echo "Lowest Priced";
        else if ($refine == "HL")
            echo "Highest Priced";
        echo " Result:</h1></div>";
        echo "</div>";
        display_shopclues1($query,$refine);
        //display_infibeam1($query,$refine);
        display_askmeba1($query,$refine);
        display2();
        compare();
        //display2();
    }
    else
    {
        include("passive_main.php");
        
    }
?>
		<div class="copy">
            <p>Copyright &copy; 2016 Compare. All Rights Reserved | Design by "Rajesh Dixit" </p>
            <p>This tool has been written as part of Project submission for the Web Technologies Laboratory in the 6th semester under the guidance of Venkateswarlu sir.</p>
	    </div>
		</div>
       </div>
      <!-- /#page-wrapper -->
   </div>
    <!-- /#wrapper -->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>