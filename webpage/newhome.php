<html>
<script type="text/javascript">
	// twee functies voor het laten zien / verbergen van de database en de status
  function dbbutton() {
	  // twee veriabelen voor allebei de elementen
    var database = document.getElementById("db");
    var status = document.getElementById("status");
		// controle voor de database: is deze al zichtbaar of niet?
    if (database.style.display === "none") {
			// wanneer niet zichtbaar: maak de status voor de zekerheid onzichtbaar
			// en maak de database zichtbaar
      status.style.display = "none";
      database.style.display = "inline";
    } else {
			// wanneer wel zichtbaar: maak de database onzichtbaar
      database.style.display = "none";
    }
}
function statusbutton() {
  var database = document.getElementById("db");
  var status = document.getElementById("status");
	// controle voor status: is deze al zichtbaar of niet?
  if (status.style.display === "none") {
		// wanneer niet zichtbaar: maak de database voor de zekerheid onzichtbaar
		// en maak de status zichtbaar
    database.style.display = "none";
    status.style.display = "inline";
  } else {
		// wanneer wel zichtbaar: maak de status onzichtbaar
    status.style.display = "none";
  }
}
</script>

  <link rel="stylesheet" href="main.css">
<head>
  <h1>
    <img src="iContainer.png" alt="logo" width=20% height: auto>
  </h1>
  <h1>
		<!--- 4 knoppen die verschillende referenties hebben.
		divider is voor gelijke afstanden tussen de buttons terwijl
		de buttons zelf in het midden blijven.
		href refereert naar de database functie in javascript --->
    <a href="javascript:dbbutton();" class="button1">Database</a>
    <div class="divider"/> </div>
		<!---href refereert naar een aparte pagina die via een python script
		 de google maps route opent. --->
    <a href="iContainer/includes/maps.inc.php" class="button1">Route</a>
    <div class="divider"/> </div>
		<!--- href refereert naar de status functie in javascript --->
    <a href="javascript:statusbutton();" class="button1">Status</a>
    <div class="divider"/> </div>
		<!--- refereert ook naar een apart php script, deze sluit alle connecties
		 en stuurt je door naar de login pagina. --->
    <a href="iContainer/includes/logout.inc.php" class="button1">Uitloggen</a>
  </h1>
</head>
<style>
.db {
  border: none;
  border-collapse: collapse;
  margin: 0px auto;
  display: none;
}

.status {
  color: white;
  font-family: arial;
  font-size: 20px;
  display: none;
}

table, th, td {
  border: none;
  font-family:Arial;
  font-size:16.5px;
	color: white;
}

th, td {
  padding: 20px;
}
td{
  border-bottom: 1px solid #0f0f0f;
}
th {
  font-size: 20px;
  border-bottom: 1px solid white;
}

tr:hover td {
  background: #0f0f0f;
}
</style>



<?php
# login informatie voor de database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "containers";

# Connectie wordt opgesteld
$conn = new mysqli($servername, $username, $password, $dbname);
# Controle of verbinding werkt
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
# Selectie van alle gegevens
$sql = "SELECT ContainerID, SensorGroep, Grootte, Vol, LaatsteVol, Locatie FROM container";
$result = $conn->query($sql);
# Terwijl er nog resultaten zijn:
if ($result->num_rows > 0) {
  echo "<table class='db' id='db'><tr><th>ContainerID</th><th>SensorGroep</th><th>Grootte(m3)</th><th>Vol?</th><th>Laatste keer vol</th><th>Locatie</th></tr>";
    # Data van elke kolom exporteren
    while($row = $result->fetch_assoc()) {
			# Hieronder de database tabel die eerst verstopt is.
    echo "<tr><td>".$row["ContainerID"]."</td><td>".$row["SensorGroep"]."</td><td>".$row["Grootte"]."</td><td>".$row["Vol"]."</td><td>".$row["LaatsteVol"]."</td><td>".$row["Locatie"]."</td></tr>";
			# Is Vol bij deze container gelijk aan 1?
		if ($row["Vol"] == 1) {
			# Ja -> Zin met id "status" om meteen te kunnen verstoppen.
      echo "<h1 id='status' class='status' color='red'>Container ".$row["ContainerID"]." is vol. Locatie: ".$row["Locatie"]."</h1>";
    }
    }
    echo "</table>";
  } else {
    echo "0 results";

}
$conn->close();
?>
<body>

</body>
</html>
