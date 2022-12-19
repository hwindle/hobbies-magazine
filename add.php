<?php

require_once "dbsettings.php";
 
$db = "pgsql:host=localhost;port=5432;dbname=$database;user=$username;password=$password";
try {
  // create a PostgreSQL database connection
  $dbConnect = new PDO($db);
 
  // display a message if connected to the PostgreSQL successfully
  if ($dbConnect) {
    echo "Connected to the <strong>$database</strong> database successfully!";
  }
} catch (PDOException $e){
 // report error message
 echo $e->getMessage();
}

if (isset($_POST['submit-mag'])) {
    $dateMag = preg_replace("/[^\d\/]*/", "", $_POST["date-mag"]); 
    $dirtyVol = trim($_POST['vol']);
    $dirtyIssue = trim($_POST['issue']);
    $folder = mysql_escape_string(trim($_POST['folder']));
    $volume = preg_replace("/[^0-9]*/", "", $dirtyVol);
    $issue = preg_replace("/[^0-9]*/", "", $dirtyIssue); 

    $insert = "INSERT INTO hobbies (date, vol, issue, folder) 
             VALUES (:date, :vol, :issue, :folder ) ";
    $statement = $dbConnect->prepare($insert);
    $statement->bindValue(":date", $dateMag);
    $statement->bindValue(":vol", $volume);
    $statement->bindValue(":issue", $issue);
    $statement->bindValue(":folder", $folder);
    if ($statement->execute()) {
      $msg = "<p class='success'> Your magazine was plonked into the database.</p>\n";
    } else {
      $msg = "<p class='errors'> Unable to insert record!</p>";
    }
  } // submit-mag isset

  if (isset($_POST["submit-con"])) {
    $dateCon = preg_replace("/[^\d\/]*/", "", $_POST["date-con"]);
    $sql = "SELECT id FROM hobbies WHERE date = :datecon LIMIT 1";
    $statement = $dbConnect->prepare($sql);
    $statement->bindValue(":datecon", $dateCon);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      $magId = $result["id"];
    } else {
      $msg .= "A Hobbies annual of that year hasn't been put in the database yet.";
    }
    $dirtyContents = mysql_escape_string(trim($_POST["contents"]));
    $dirtyPage = $_POST["page"];
    $dirtyCategory = mysql_escape_string(trim($_POST["category"]));
    $contents = preg_replace("/[^A-Za-z ,.]*/", "", $dirtyContents);
    $category = preg_replace("/[^A-Za-z ,.]*/", "", $dirtyCategory);
    $insert = "INSERT INTO contents (contents, page, category, mag_id) VALUES (:contents, :page, :category, :mag_id)";
    $inStmt = $dbConnect->prepare($insert);
    $inStmt->bindValue(":contents", $contents);
    $inStmt->bindValue(":page", $dirtyPage);
    $inStmt->bindValue(":category", $category);
    $inStmt->bindValue(":mag_id", $magId);
    
    if ($inStmt->execute()) {
      $msg = "<p class='success'>Record successfully saved. </p>\n";
    } else {
      $msg = "<p class='errors'>Database boo-boo.</p>\n";
    }

  } // submit-con isset


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="apple-touch-icon.png">
  <!-- Place favicon.ico in the root directory  -->
  <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
  <title>Add a Hobbies Annual</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>

<div class="container-fluid">
  
  <div class="row">
    <div class="">
      <div id="logo"><img src="photos/hobbies_logo.svg" /></div>
    </div>
  </div>

 <nav class="hamburger-phone-menu">
  <ul>
    <li><a href="add.php" title="Add an annual">Add</a></li>
    <li><a href="index.php" title="View Hobbies annuals">View</a></li>
    <li><a href="search.php" title="Search by category, year">Search</a></li>
  </ul>  
</nav> 
  <!-- Bootstrap navigation with hamburger menu -->
  <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="add.php" title="Add an annual">Add</a></li>
                <li><a href="index.php" title="View Hobbies annuals">View</a></li>
                <li><a href="search.php" title="Search by category, year">Search</a></li>
            </ul>
        </div>
    </div>
</nav>
  
  <!-- Main content  -->
  <div id="content">
    <h2>Add a magazine</h2>

  <form action="add.php" method="post" class="form">
    <div class="form-group">
      <div class="col-sm-3 col-md-3">
      <label for="date-mag">Date</label>
      <input class="form-control" type="text" id="date-mag" name="date-mag"  length="10" placeholder="06/08/1934" required="required" />
      </div>
      <div class="col-sm-3 col-md-3">
      <label for="vol">Volume</label>
      <input class="form-control" type="text" id="vol" name="vol" placeholder="333" required="required" />
	</div>
      <div class="col-sm-3 col-md-3">
      <label for="issue">Issue</label>
      <input  class="form-control" type="text" id="issue" name="issue" placeholder="3913" required="required" />
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-3 col-md-3">
      <label for="folder">Folder </label>
      <input  class="form-control" type="text" id="folder" length="10" name="folder" placeholder="A" />
  
      </div></div>
      <button type="submit" id="submit-mag" name="submit-mag" class="submit-button">Add magazine</button>
    </div>
  </form>
	<br />
  <form action="add.php" method="post" class="form">
    <div class="form-group">
      <div class="col-sm-4 col-md-4">
      <label for="date-con">Date</label>
      <input class="form-control" type="text" id="date-con" name="date-con"  length="10" placeholder="06/08/1934" required="required" />
      </div>
      <div class="col-sm-8 col-md-8">
      <label for="contents">Contents</label>
      <input class="form-control" type="text" id="contents" name="contents" length="50" placeholder="wooden bird bath" required="required" />
      
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-3 col-md-3">
      <label for="page">Page</label>
      <input id="page" class="form-control" name="page" type="number" placeholder="32" required="required" />
      </div>
      <div class="col-sm-9 col-md-9">
      <label for="category">Category</label>
      <input id="category" class="form-control" name="category" type="text" placeholder="camping" required="required" />
     
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3 col-md-3">
      <button type="submit" id="submit-con" name="submit-con" class="submit-button">Add contents</button>
      </div>
    </div>
  </form>

  </div><!-- row -->

  <div class="row"><?php echo $msg; ?></div>
</div><!-- fluid container -->
<!-- start of scripts -->
  <script type="text/JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
  </script>
  <script type="text/JavaScript" src="scripts/jquery-1.11.2-min.js"></script>
  <script type="text/JavaScript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
