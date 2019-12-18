<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-size: 20px;
  font-family: Arial, Helvetica, sans-serif;
}

.header {
  background-color: #f1f1f1;
  padding: 30px;
  text-align: center;
}

#navbar {
  overflow: hidden;
  background-color: #4CAF50;
  border: 2px solid black;
}

#navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

#navbar a:hover {
  background-color: #ddd;
  color: black;
}

#navbar a.active {
  background-color: #4CAF50;
  color: white;
}

.content {
  padding: 16px;
}

.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

.sticky + .content {
  padding-top: 60px;
}
</style>
</head>
<body>


<div id="navbar">
  <a class="active"><img src="http://www.lfant.se/wp-content/uploads/2017/07/lfant-vit-300x164.png" alt="LFANT" width="50%" height="50%"></a>
  <a class="active"><form  method="post">
    <input type='text' name="name" placeholder="Type Search" />
    <input type="submit" name="go" value="Search"/> 
</form> </a>
<a class="active"><h1>DEMO</h1></a>

</div>

<div class="content" >
<body style="background-color:#4CAF50;">
<?php

echo $_POST['name'];
//echo $_REQUEST['name'];
$varSearch = $_POST['name'];

# [START bigquery_simple_app_all]
require __DIR__ . '/vendor/autoload.php';

# [START bigquery_simple_app_deps]
use Google\Cloud\BigQuery\BigQueryClient;

# [END bigquery_simple_app_deps]

// get the project ID as the first argument

// if (2 != count($argv)) {
//     die("Usage: php stackoverflow.php lfanttest1\n");
// }

$projectId = $argv[1];

# [START bigquery_simple_app_client]
$bigQuery = new BigQueryClient([
    'lfanttest1' => $projectId,
]);
# [END bigquery_simple_app_client]
# [START bigquery_simple_app_query]
$query = <<<ENDSQL

SELECT id, title, date_time, location, price, images
FROM `lfanttest1.items.items`
WHERE title LIKE '%$varSearch%'
ORDER BY id ASC
LIMIT 1000;

ENDSQL;
$queryJobConfig = $bigQuery->query($query);
$queryResults = $bigQuery->runQuery($queryJobConfig);

# [END bigquery_simple_app_query]


# [START bigquery_simple_app_print]
if ($queryResults->isComplete()) {
    $i = 0;
    $rows = $queryResults->rows();
    print '<table border=1><tr><th>title</th><th>date_time</th><th>location</th><th>price</th><th>images</th></tr>';
    $arr = array($rows);
    foreach ($rows as $row) {
            $arr = array($row);
            #print_r($arr);
            #print '<table border=1><tr><th>id</th><th>title</th><th>date_time</th><th>location</th><th>price</th><th>images</th></tr>';
            foreach ($arr as $value1) {
            #echo "<td>" . $theCurrentRow["id"] . "</td><td>" . $theCurrentRow["title"] . "</td><td>" . "</td>";
            echo "<tr><td>".$value1["title"]."</td><td>".$value1["date_time"]."</td><td>".$value1["location"]."</td><td>".$value1["price"].'</td><td><img src="'.$value1["images"].'" height="100" width="100"></td>';
            
            }
    }
    print '</table>';
    //printf('Found %s row(s)' . PHP_EOL, $i);
    
} else {
    throw new Exception('The query failed to complete');
}
# [END bigquery_simple_app_print]
# [END bigquery_simple_app_all]

?>

</div>

<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>

</body>
</html>
