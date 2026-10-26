
<?php


include("db-tilkobling.php");

$melding = "";

if (isset($_POST["slettKlasseKnapp"]))
{
    $klassekode = trim($_POST["klassekode"]);

    if (!$klassekode)
    {
        $melding = "Du må velge en klasse";
    }
    else
    {
        $klassekode = mysqli_real_escape_string($db, $klassekode);

        $sqlSetning = "SELECT * FROM klasse WHERE klassekode='$klassekode';";
        $sqlResultat = mysqli_query($db, $sqlSetning)
            or die("Ikke mulig å hente data fra databasen");

        $antallRader = mysqli_num_rows($sqlResultat);

        if ($antallRader == 0)
        {
            $melding = "Klassen finnes ikke";
        }
        else
        {
            $sqlSetning = "SELECT * FROM student WHERE klassekode='$klassekode';";
            $sqlResultat = mysqli_query($db, $sqlSetning)
                or die("Ikke mulig å hente data fra databasen");

            $antallStudenter = mysqli_num_rows($sqlResultat);

            if ($antallStudenter != 0)
            {
                $melding = "Klassen kan ikke slettes fordi den har studenter";
            }
            else
            {
                $sqlSetning = "DELETE FROM klasse WHERE klassekode='$klassekode';";
                mysqli_query($db, $sqlSetning)
                    or die("Ikke mulig å slette data fra databasen");

                $melding = "Klassen er nå slettet";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Slett klasse</title>
    <script src="funksjoner.js"></script>
</head>
<body>

<h3>Slett klasse</h3>

<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema" onsubmit="return bekreft()">

    Klassekode
    <select id="klassekode" name="klassekode" required>
        <option value="">Velg klasse</option>

        <?php
        $sqlSetning = "SELECT * FROM klasse ORDER BY klassekode;";
        $sqlResultat = mysqli_query($db, $sqlSetning)
            or die("Ikke mulig å hente data fra databasen");

        $antallRader = mysqli_num_rows($sqlResultat);

        for ($r = 1; $r <= $antallRader; $r++)
        {
            $rad = mysqli_fetch_array($sqlResultat);

            $klassekode = htmlspecialchars($rad["klassekode"], ENT_QUOTES, "UTF-8");
            $klassenavn = htmlspecialchars($rad["klassenavn"], ENT_QUOTES, "UTF-8");

            print("<option value='$klassekode'>$klassekode - $klassenavn</option>");
        }
        ?>
    </select>

    <br />

    <input type="submit" value="Slett klasse" id="slettKlasseKnapp" name="slettKlasseKnapp" />

</form>

<?php
print("<p>$melding</p>");
?>

<p><a href="index.php">Tilbake til hovedmenyen</a></p>

</body>
</html>
