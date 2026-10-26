<?php

?>

<script src="funksjoner.js"></script>

<h3>Slett student</h3>

<form method="post" action="" onsubmit="return bekreft()">
    Brukernavn
    <input type="text" name="brukernavn" maxlength="7" required />
    <br />

    <input type="submit" value="Slett student" name="slettStudentKnapp" />
</form>

<?php
if (isset($_POST["slettStudentKnapp"]))
{
    $brukernavn = trim($_POST["brukernavn"]);

    include("db-tilkobling.php");

    $sqlSetning = "SELECT * FROM student WHERE brukernavn='$brukernavn';";
    $sqlResultat = mysqli_query($db, $sqlSetning)
        or die("ikke mulig å hente data fra databasen");

    $antallRader = mysqli_num_rows($sqlResultat);

    if ($antallRader == 0)
    {
        print("Studenten finnes ikke");
    }
    else
    {
        $sqlSetning = "DELETE FROM student WHERE brukernavn='$brukernavn';";

        mysqli_query($db, $sqlSetning)
            or die("ikke mulig å slette data i databasen");

        print("Studenten er nå slettet: " . htmlspecialchars($brukernavn));
    }

    mysqli_close($db);
}
?>