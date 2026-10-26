<?php

?>

<script src="funksjoner.js"></script>

<h3>Slett klasse</h3>

<form method="post" action="" onsubmit="return bekreft()">
    Klassekode
    <input type="text" name="klassekode" maxlength="5" required />
    <br />

    <input type="submit" value="Slett klasse" name="slettKlasseKnapp" />
</form>

<?php
if (isset($_POST["slettKlasseKnapp"]))
{
    $klassekode = strtoupper(trim($_POST["klassekode"]));

    include("db-tilkobling.php");

    $sqlSetning = "SELECT * FROM klasse WHERE klassekode='$klassekode';";
    $sqlResultat = mysqli_query($db, $sqlSetning)
        or die("ikke mulig å hente data fra databasen");

    $antallRader = mysqli_num_rows($sqlResultat);

    if ($antallRader == 0)
    {
        print("Klassen finnes ikke");
    }
    else
    {
        $sqlSetning = "DELETE FROM klasse WHERE klassekode='$klassekode';";
        $sqlResultat = mysqli_query($db, $sqlSetning);

        if ($sqlResultat)
        {
            print("Klassen er nå slettet");
        }
        else
        {
            print("Klassen kan ikke slettes. Den kan ha registrerte studenter.");
        }
    }

    mysqli_close($db);
}
?>