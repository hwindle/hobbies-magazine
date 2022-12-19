<?php

require_once "dbsettings.php";
include_once "display.php";
 
$db = "pgsql:host=localhost;port=5432;dbname=$database;user=$username;password=$password";
try {
  // create a PostgreSQL database connection
  $dbConnect = new PDO($db);
 
  // display a message if connected to the PostgreSQL successfully
  if ($dbConnect) {
    $msg = "<p class='success' >
      Connected to the <strong>$database</strong> database successfully!</p>";
  }
} catch (PDOException $e){
 // report error message
 echo $e->getMessage();
}

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
  <title>Search - Hobbies Annuals</title>
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
  <div class="row" id="content">

  <h2>Search</h2>

  <div class="col-sm-4 col-md-4">
  <form method="post" action="search.php" class="form">
    <label for="date">Date
      <input id="date" class="form-control" name="date" type="text" required="required" placeholder="06/08/1948" />
    </label>
    <button type="submit" id="search-by-date" name="search-date" class="submit-button">Search by date</button>
  </form>
  </div>

  <div class="col-sm-4 col-md-4">
  <form method="post" action="search.php" class="form">
    <label for="category">Category
      <input id="category" name="category" class="form-control" type="text" required="required" placeholder="gardening" />
    </label>
    <button type="submit" id="search-by-cat" name="search-category" class="submit-button">Category search</button>
  </form>
  </div>

  <div class="col-sm-4 col-md-4">
  <form method="post" action="search.php" class="form">
    <label for="volume">Volume No
      <input id="volume" name="volume" type="text" class="form-control" required="required" placeholder="345" />
    </label>
    <button type="submit" id="search-by-vol" name="search-vol" class="submit-button">Search by volume</button>
  </form>
  </div>

<?php

  if (isset($_POST["search-date"])) {
    $select = "SELECT * FROM hobbies WHERE date LIKE :date ORDER BY date";
    $statement = $dbConnect->prepare($select);
    $dirtyDate = trim($_POST["date"]);
    if (preg_match("/\d+\/\d+\/\d.../", $dirtyDate)) {
      $statement->bindValue(":date", $dirtyDate);
      displayMagResults($statement);
    } else {
      $msg = "please format the date like 06/08/1939, otherwise it won't be saved";
    }

  } 
  if (isset($_POST["search-category"])) {
    $select = "SELECT * FROM hobbies 
              LEFT JOIN contents ON  hobbies.id = contents.mag_id 
              WHERE category LIKE :category 
              ORDER BY date";
    $statement = $dbConnect->prepare($select);
    $dirtyCategory = trim($_POST['category']);
    $category = preg_replace("/[^A-Za-z ,.]/", "", $dirtyCategory);
    $statement->bindValue(":category", $category);
    displayMagResults($statement);
  }
  if (isset($_POST['search-vol'])) {
    $select = "SELECT * FROM hobbies 
              WHERE vol = :vol 
              ORDER BY date";
    $statement = $dbConnect->prepare($select);
    $dirtyVol = trim($_POST['volume']);
    if (preg_match("/\d+/", $dirtyVol)) {
      $statement->bindValue(":vol", $dirtyVol);
      displayMagResults($statement);
    } else {
      $msg = "Numbers only in the volume number please.";
    }
  }
  
  

?>

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
