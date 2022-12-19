<?php

function displaySearchResults($boundQuery) 
{
  if ($boundQuery == "") {
    return;
  }

echo <<<EOFORM
 <table class="table table-stripped">
    <thead>
      <th>Volume</th>
      <th>Issue</th>
      <th>Date</th>
      <th>Summary</th>
    </thead>    
    <tbody>
EOFORM;

  
  try {
    $boundQuery->execute();
    if ($boundQuery === false) {
      $msg = "There aren't any magazines in the table.";
      return NULL;
    }
    //$result = $boundQuery->fetch(PDO::FETCH_ASSOC);
    while ($result = $boundQuery->fetch(PDO::FETCH_ASSOC)) {
      echo "<tr>\n";
      echo "<td class='volume'>" . stripslashes($result["vol"]) . "</td>\n";
      echo "<td class='issue'>" . stripslashes($result["issue"]) . "</td>\n";
      echo "<td class='date'>" . stripslashes($result["date"]) . "</td>\n";
      echo "  <td class='summary' id='" . $result["id"] . "'>\n"; 
      echo "    <a href='contents.php?id=" . $result["id"] . "' target='blank'>";
      echo "Contents</a></td>\n";
      echo "</tr>\n";
      }
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  echo "</tbody>\n</table>\n";
}



function displayMagResults($boundQuery) 
{
  if ($boundQuery == "") {
    return;
  }

echo <<<EOFORM
 <table class="table table-stripped">
    <thead>
      <th>Volume</th>
      <th>Issue</th>
      <th>Date</th>
      <th>Folder</th>
    </thead>    
    <tbody>
EOFORM;

  
  try {
    $boundQuery->execute();
    if ($boundQuery === false) {
      $msg = "There aren't any magazines in the table.";
      return NULL;
    }
    //$result = $boundQuery->fetch(PDO::FETCH_ASSOC);
    while ($result = $boundQuery->fetch(PDO::FETCH_ASSOC)) {
      echo "<tr>\n";
      echo "<td class='volume'>" . stripslashes($result["vol"]) . "</td>\n";
      echo "<td class='issue'>" . stripslashes($result["issue"]) . "</td>\n";
      echo "<td class='date'>" . stripslashes($result["date"]) . "</td>\n";
      echo "<td class='shelf'>" . stripslashes($result["folder"]) . "</td>\n";
      echo "</tr>\n";
      }
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  echo "</tbody>\n</table>\n";
}

?>
