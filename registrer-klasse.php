<?php

?>

<h3>Registrer klasse</h3>

<form method="post" action="">
    Klassekode
    <input type="text" name="klassekode" maxlength="5" required />
    <br />

    Klassenavn
    <input type="text" name="klassenavn" maxlength="50" required />
    <br />

    Studiekode
    <input type="text" name="studiumkode" maxlength="50" required />
    <br />

    <input type="submit" value="Registrer klasse" name="registrerKlasseKnapp" />
    <input type="reset" value="Nullstill" />
</form>

<?php
if (isset($_POST["registrerKlasseKnapp"]))
{
    $klassekode = strtoupper(trim($_POST["klassekode"]));
    $klassenavn = trim($_POST["klassenavn"]);
    $studiumkode = trim($_POST["studiumkode"]);

    include("db-tilkobling.php");

    $sqlSetning = "SELECT * FROM klasse WHERE klassekode='$klassekode';";
    $sqlResultat = mysqli_query($db, $sqlSetning)
        or die("ikke mulig å hente data fra databasen");

    $antallRader = mysqli_num_rows($sqlResultat);

    if ($antallRader != 0)
    {
        print("Klassen er registrert fra før");
    }
    else
    {
        $sqlSetning = "INSERT INTO klasse
                       VALUES('$klassekode','$klassenavn','$studiumkode');";

        mysqli_query($db, $sqlSetning)
            or die("ikke mulig å registrere data i databasen");

        print("Klassen er nå registrert: "
            . htmlspecialchars($klassekode) . " "
            . htmlspecialchars($klassenavn));
    }

    mysqli_close($db);
}
?>