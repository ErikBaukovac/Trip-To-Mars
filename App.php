<link rel="stylesheet" href="Style.css" type="text/css">

<?php
$servername="localhost";
$username= "root";
$password="BP2Erik";
$dbname="mars";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("Greska u povezivanju".$conn->connect_error);
}

$pull ="SELECT ID_tima , Naziv, Broj_clanova, Funkcija_tima from tim";
$result = $conn->query($pull);

if($result->num_rows>0){
    $raspolozivi_timovi="";
    while($row= $result->fetch_assoc())
        $raspolozivi_timovi .="ID tima: ". $row["ID_tima"]." Naziv tima: ".$row["Naziv"]." Broj clanova: ".$row["Broj_clanova"]." Funkcija tima: ".$row["Funkcija_tima"]."<br>";
    }
else
    echo "Nema";


$pull = "select ID_rakete, Proizvodac, Naziv, Opis , Nosivost, Spremnik, Težina from rakete";
$result = $conn->query($pull);

if($result->num_rows>0){
    $raspolozive_rakete="";
    while($row= $result->fetch_assoc()){
        $raspolozive_rakete .="ID rakete: ". $row["ID_rakete"]." Proizvodac: ".$row["Proizvodac"]." Naziv: ".$row["Naziv"]." Opis: ".$row["Opis"]." Nosivost: ".$row["Nosivost"]." Spremnik: ".$row["Spremnik"]." Tezina: ".$row["Težina"]."<br>";
    }
    }
else
    echo"Nema";



$pull = "select ID_tereta, Naziv, Opis,Tezina from teret";
$result = $conn->query($pull);

if($result->num_rows>0){
    $raspoloziv_teret="";
    while($row= $result->fetch_assoc()){
        $raspoloziv_teret .="ID Tereta: ". $row["ID_tereta"]." Naziv: ".$row["Naziv"]." Opis: ".$row["Opis"]." Tezina: ".$row["Tezina"]."<br>";
    }
    }
else
        echo"Nema";

$pull = "select ID_lokacije, Naziv, Koordinate, Nosivost_lansirne_podloge from lokacije";
$result = $conn->query($pull);

if($result->num_rows>0){
    $raspolozive_lokacije="";
    while($row= $result->fetch_assoc()){
        $raspolozive_lokacije .="ID Lokacije: ". $row["ID_lokacije"]." Naziv: ".$row["Naziv"]." Koordinate: ".$row["Koordinate"]." Nosivost podloge: ".$row["Nosivost_lansirne_podloge"]."<br>";
    }
}
else
        echo"Nema";

$pull = "select kolonije.ID_kolonije, kolonije.Naziv, kolonije.Koordinate, kolonije.Generacija, funkcija_kolonije.Naziv_funkcije, kolonije.Status from kolonije,funkcija_kolonije where kolonije.Svrha=funkcija_kolonije.ID_funkcije";
$result = $conn->query($pull);

if($result->num_rows>0) {
    $raspolozive_kolonije = "";
    while ($row = $result->fetch_assoc()) {
        $raspolozive_kolonije .= "ID kolonije: " . $row["ID_kolonije"] . " Naziv: " . $row["Naziv"] . " Koordinate: " . $row["Koordinate"] . " Generacija: " . $row["Generacija"] . " Svrha: " . $row["Naziv_funkcije"] . " Status: " . $row["Status"] . "<br>";
    }
}
else
        echo"Nema";

?>

<html lang="hr">

    <body>
        <h3>Raspolozivi timovi</h3>
            <p><?php echo $raspolozivi_timovi;?></p>

        <h3>Raspolozive rakete</h3>
        <p><?php echo $raspolozive_rakete;?></p>

        <h3>Raspolozivi teret</h3>
        <p><?php echo $raspoloziv_teret;?></p>

        <h3>Raspolozive lokacije</h3>
        <p><?php echo $raspolozive_lokacije;?></p>

        <h3>Raspolozive kolonije</h3>
        <p><?php echo $raspolozive_kolonije;?></p>

        <h3>Unos nove misije</h3>
    <form id="" method="post">
        <label>Naziv misije:</label>
        <input type="text" name="misija" placeholder="Naziv misije"><br>

        <label>Opis:</label>
        <input type="text" name="opis" placeholder="Opis misije"><br>

        <label>Tim:</label>
        <input type="text" name="tim" placeholder="ID tima"><br>

        <label>Raketa:</label>
        <input type="text" name="raketa" placeholder="ID rakete"><br>

        <label>Lansirno mjesto:</label>
        <input type="text" name="polaziste" placeholder="ID lansirnog mjesta"><br>

        <label>Teret:</label>
        <input type="text" name="teret" placeholder="ID tereta"><br>

        <label >Odrediste:</label>
        <input type="text" name="odrediste" placeholder="ID odredista"><br>
        <input type="submit" name="proslijedi" id="proslijedi" value="Posalji na Mars">
    </form>

        <?php
        if(isset($_POST['proslijedi'])){
            $sql = "INSERT INTO misija (ID_misije,Naziv,Raketa,Opis,Tim,Teret,Polaziste,Odredište) 
            VALUES (default,'$_POST[misjia]','$_POST[raketa]','$_POST[opis]','$_POST[tim]','$_POST[teret]','$_POST[polaziste]','$_POST[odrediste]') ";

            if($conn->query($sql)===true){
                echo "T-minus 10..9..8..7..6..5..4..3..2..1 WE HAVE A LIFTOFF!!!! ";
            }
            else{
                echo "Huston we have a problem".$sql."<br>". $conn->error;
            }
        }
        $conn->close();
        ?>
    </body>

</html>
