
<?php


include("db-tilkobling.php");

$melding = "";

if (isset($_POST["slettStudentKnapp"]))
{
    $brukernavn = trim($_POST["brukernavn"] ?? "");

    if (!$brukernavn)
    {
        $melding = "Du må velge en student";
    }
    else
    {
        $brukernavn = mysqli_real_escape_string($db, $brukernavn);

        $sqlSetning = "SELECT * FROM student WHERE brukernavn='$brukernavn';";
        $sqlResultat = mysqli_query($db, $sqlSetning)
            or die("Ikke mulig å hente data fra databasen");

        $antallRader = mysqli_num_rows($sqlResultat);

        if ($antallRader == 0)
        {
            $melding = "Studenten finnes ikke";
        }
        else
        {
            $sqlSetning = "DELETE FROM student WHERE brukernavn='$brukernavn';";
            mysqli_query($db, $sqlSetning)
                or die("Ikke mulig å slette data fra databasen");

            $melding = "Studenten er nå slettet";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Slett student</title>
    <script src="funksjoner.js"></script>
</head>
<body>

<h3>Slett student</h3>

<form method="post" action="" id="slettStudentSkjema" name="slettStudentSkjema" onsubmit="return bekreft()">

    Brukernavn
    <select id="brukernavn" name="brukernavn" required>
        <option value="">Velg student</option>

        <?php
        $sqlSetning = "SELECT * FROM student ORDER BY brukernavn;";
        $sqlResultat = mysqli_query($db, $sqlSetning)
            or die("Ikke mulig å hente data fra databasen");

        $antallRader = mysqli_num_rows($sqlResultat);

        for ($r = 1; $r <= $antallRader; $r++)
        {
            $rad = mysqli_fetch_array($sqlResultat);

            $brukernavn = htmlspecialchars($rad["brukernavn"], ENT_QUOTES, "UTF-8");
            $fornavn = htmlspecialchars($rad["fornavn"], ENT_QUOTES, "UTF-8");
            $etternavn = htmlspecialchars($rad["etternavn"], ENT_QUOTES, "UTF-8");

            print("<option value='$brukernavn'>$brukernavn - $fornavn $etternavn</option>");
        }
        ?>
    </select>

    <br />

    <input type="submit" value="Slett student" id="slettStudentKnapp" name="slettStudentKnapp" />

</form>

<?php
print("<p>$melding</p>");
?>

<p><a href="index.php">Tilbake til hovedmenyen</a></p>

</body>
</html>
