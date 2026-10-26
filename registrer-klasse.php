
<?php

?>

<h3>Registrer klasse</h3>

<form method="post" action="" id="registrerKlasseSkjema" name="registrerKlasseSkjema">

    Klassekode <input type="text" id="klassekode" name="klassekode" maxlength="5" required /> <br />
    Klassenavn <input type="text" id="klassenavn" name="klassenavn" maxlength="50" required /> <br />
    Studiumkode <input type="text" id="studiumkode" name="studiumkode" maxlength="50" required /> <br />

    <input type="submit" value="Registrer klasse" id="registrerKlasseKnapp" name="registrerKlasseKnapp" />
    <input type="reset" value="Nullstill" /> <br />

</form>

<?php
if (isset($_POST["registrerKlasseKnapp"]))
{
    $klassekode = trim($_POST["klassekode"]);
    $klassenavn = trim($_POST["klassenavn"]);
    $studiumkode = trim($_POST["studiumkode"]);

    if ($klassekode == "" || $klassenavn == "" || $studiumkode == "")
    {
        print("Alle feltene må fylles ut");
    }
    else
    {
        include("db-tilkobling.php");

        $klassekode = mysqli_real_escape_string($db, $klassekode);
        $klassenavn = mysqli_real_escape_string($db, $klassenavn);
        $studiumkode = mysqli_real_escape_string($db, $studiumkode);

        $sqlSetning = "SELECT * FROM klasse WHERE klassekode='$klassekode';";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");

        $antallRader = mysqli_num_rows($sqlResultat);

        if ($antallRader != 0)
        {
            print("Klassen er registrert fra før");
        }
        else
        {
            $sqlSetning = "INSERT INTO klasse VALUES('$klassekode','$klassenavn','$studiumkode');";
            mysqli_query($db, $sqlSetning) or die("Ikke mulig å registrere data i databasen");

            print("Klassen er nå registrert");
        }
    }
}
?>

<p><a href="index.php">Tilbake til hovedmenyen</a></p>
