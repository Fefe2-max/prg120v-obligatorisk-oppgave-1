<?php

include("db-tilkobling.php");

$sqlSetning = "SELECT * FROM klasse;";
$sqlResultat = mysqli_query($db, $sqlSetning)
    or die("ikke mulig å hente data fra databasen");

$klasser = array();

while ($rad = mysqli_fetch_array($sqlResultat))
{
    $klasser[] = $rad;
}
?>

<h3>Registrer student</h3>

<form method="post" action="">
    Brukernavn
    <input type="text" name="brukernavn" maxlength="7" required />
    <br />

    Fornavn
    <input type="text" name="fornavn" maxlength="50" required />
    <br />

    Etternavn
    <input type="text" name="etternavn" maxlength="50" required />
    <br />

    Klassekode
    <select name="klassekode" required>
        <option value="">Velg klasse</option>

        <?php
        foreach ($klasser as $rad)
        {
            print("<option value='" . htmlspecialchars($rad["klassekode"]) . "'>"
                . htmlspecialchars($rad["klassekode"]) . " - "
                . htmlspecialchars($rad["klassenavn"]) . "</option>");
        }
        ?>
    </select>
    <br />

    <input type="submit" value="Registrer student" name="registrerStudentKnapp" />
    <input type="reset" value="Nullstill" />
</form>

<?php
if (isset($_POST["registrerStudentKnapp"]))
{
    $brukernavn = trim($_POST["brukernavn"]);
    $fornavn = trim($_POST["fornavn"]);
    $etternavn = trim($_POST["etternavn"]);
    $klassekode = $_POST["klassekode"];

    if (strlen($brukernavn) > 7 || strlen($fornavn) > 50 ||
        strlen($etternavn) > 50)
    {
        print("Kontroller lengden på feltene");
    }
    else
    {
        $sqlSetning = "SELECT * FROM student WHERE brukernavn='$brukernavn';";
        $sqlResultat = mysqli_query($db, $sqlSetning)
            or die("ikke mulig å hente data fra databasen");

        $antallRader = mysqli_num_rows($sqlResultat);

        if ($antallRader != 0)
        {
            print("Studenten er registrert fra før");
        }
        else
        {
            $sqlSetning = "INSERT INTO student
                           VALUES('$brukernavn','$fornavn','$etternavn','$klassekode');";

            mysqli_query($db, $sqlSetning)
                or die("ikke mulig å registrere data i databasen");

            print("Studenten er nå registrert: "
                . htmlspecialchars($brukernavn) . " "
                . htmlspecialchars($fornavn));
        }
    }
}

mysqli_close($db);
?>