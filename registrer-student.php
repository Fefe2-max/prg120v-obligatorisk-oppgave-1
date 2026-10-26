
<?php


include("db-tilkobling.php");
?>

<h3>Registrer student</h3>

<form method="post" action="" id="registrerStudentSkjema" name="registrerStudentSkjema">

    Brukernavn <input type="text" id="brukernavn" name="brukernavn" maxlength="7" required /> <br />
    Fornavn <input type="text" id="fornavn" name="fornavn" maxlength="50" required /> <br />
    Etternavn <input type="text" id="etternavn" name="etternavn" maxlength="50" required /> <br />

    Klassekode
    <select id="klassekode" name="klassekode" required>
        <option value="">Velg klasse</option>

        <?php
        $sqlSetning = "SELECT * FROM klasse ORDER BY klassekode;";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");

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

    <input type="submit" value="Registrer student" id="registrerStudentKnapp" name="registrerStudentKnapp" />
    <input type="reset" value="Nullstill" /> <br />

</form>

<?php
if (isset($_POST["registrerStudentKnapp"]))
{
    $brukernavn = trim($_POST["brukernavn"]);
    $fornavn = trim($_POST["fornavn"]);
    $etternavn = trim($_POST["etternavn"]);
    $klassekode = trim($_POST["klassekode"]);

    if ($brukernavn == "" || $fornavn == "" || $etternavn == "" || $klassekode == "")
    {
        print("Alle feltene må fylles ut");
    }
    else
    {
        $brukernavn = mysqli_real_escape_string($db, $brukernavn);
        $fornavn = mysqli_real_escape_string($db, $fornavn);
        $etternavn = mysqli_real_escape_string($db, $etternavn);
        $klassekode = mysqli_real_escape_string($db, $klassekode);

        $sqlSetning = "SELECT * FROM student WHERE brukernavn='$brukernavn';";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");

        $antallRader = mysqli_num_rows($sqlResultat);

        if ($antallRader != 0)
        {
            print("Studenten er registrert fra før");
        }
        else
        {
            $sqlSetning = "SELECT * FROM klasse WHERE klassekode='$klassekode';";
            $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");

            $antallKlasser = mysqli_num_rows($sqlResultat);

            if ($antallKlasser == 0)
            {
                print("Klassen finnes ikke");
            }
            else
            {
                $sqlSetning = "INSERT INTO student VALUES('$brukernavn','$fornavn','$etternavn','$klassekode');";
                mysqli_query($db, $sqlSetning) or die("Ikke mulig å registrere data i databasen");

                print("Studenten er nå registrert");
            }
        }
    }
}
?>

<p><a href="index.php">Tilbake til hovedmenyen</a></p>
