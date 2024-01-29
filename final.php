<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

define('_HOST_NAME_', 'localhost');
define('_DATABASE_NAME_', 'tepabloexamenst');
define('_user_', 'parodi');
define('_DB_PASSWORD', '2380');

$databaseConnection = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _user_, _DB_PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

function dibuix($ample) {
  // Crear dibuix
  $result = '';
  for ($i = $ample; $i >= 1; $i--) {
    for ($j = $i; $j >= 1; $j--) {
      $result .= "*";
    }
    $result .= "<br>";
  }

  for ($i = 2; $i <= $ample; $i++) {
    for ($j = 1; $j <= $i; $j++) {
      $result .= "*";
    }
    $result .= "<br>";
  }
  return $result;
}

echo "<h1>Asterisk Art Generator</h1>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ample = $_POST["ample"];

  echo dibuix($ample);

  // Guardar a la base de dades
  $sql = "INSERT INTO MyTable (date, ample) VALUES (CURRENT_TIMESTAMP, $ample)";

  if ($conn->query($sql) === TRUE) {
    echo "Registre guardat amb èxit";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $sqlQuery = $databaseConnection->prepare("INSERT INTO `testphp` (`nom`, `cognom1`, `cognom2`,`iduser`) VALUES (:nom, :cognom1, :cognom2,:iduser);");
  $sqlQuery->execute(array(':nom' => 'Joan',
                                      ':cognom1' => 'Vila',
                                      ':cognom2' => 'Capdevila',
                                      ':iduser' => '5'
                      ));
  $rsResultat = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
  var_dump($rsResultat);
}

$conn->close();
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Ample del dibuix: <input type="number" name="ample">
  <input type="submit">
</form>
