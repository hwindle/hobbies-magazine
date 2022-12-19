<?php

require_once "dbsettings.php";
 
$db = "pgsql:host=localhost;port=5432;dbname=$database;user=$username;password=$password";
try {
  // create a PostgreSQL database connection
  $dbConnect = new PDO($db);
 
  // display a message if connected to the PostgreSQL successfully
  if ($dbConnect) {
    $msg = "<p class='success'>Connected to the 
      <strong>$database</strong> database successfully!</p>";
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
  <title>Hobbies - Contents</title>
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
    <h2>Contents</h2>
<section>
  
<div class="contents">
  <table class="contents-list">
    <thead>
      <tr>
        <th>Article</th>
        <th>Page</th>
        <th>Category</th>
      </tr>
    </thead>
    <tbody>

<?php
  $getId = $_GET["id"];
  if (preg_match("/\d+/", $getId)) {
    $msg .= "get id is fine";
  } else {
    $msg .= "faulty id GET string in URL";
  }
  $select = "SELECT * FROM contents WHERE mag_id = :mag_id ORDER BY page";
  $statement = $dbConnect->prepare($select);
  $statement->bindValue(":mag_id", $getId);
  $statement->execute();

  try {
    if ($statement === false) {
      $msg = "There aren't any cotents for that magazine.";
      return NULL;
    }
    //$result = $statement->fetch(PDO::FETCH_ASSOC);
    while ($result = $statement->fetch(PDO::FETCH_ASSOC)): ?>
      <tr>
        <td><?php echo $result["contents"]; ?></td>
        <td><?php echo $result["page"]; ?></td>
        <td><?php echo $result["category"]; ?></td>
      </tr>
    
      
<?php endwhile; 
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

?>

    </table>
  </div>
</section>
<div class="row"><?php echo $msg; ?></div>
    
  </div><!-- row -->

</div><!-- fluid container -->
<!-- start of scripts -->
  
  <script type="text/JavaScript" src="scripts/jquery-1.11.2-min.js"></script>
  <script type="text/JavaScript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
