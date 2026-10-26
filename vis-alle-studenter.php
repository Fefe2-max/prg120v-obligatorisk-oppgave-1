
<?php


include("db-tilkobling.php");

$sqlSetning = "SELECT * FROM student;";

$sqlResultat = mysqli_query($db, $sqlSetning)
    or die("Ikke mulig å hente data fra databasen");

$antallRader = mysqli_num_rows($sqlResultat);

print("<h3>Registrerte studenter</h3>");

if ($antallRader == 0)
{
    print("Ingen studenter er registrert");
}
else
{
    print("<table border='1'>");
    print("<tr><th>Brukernavn</th><th>Fornavn</th><th>Etternavn</th><th>Klassekode</th></tr>");

    for ($r = 1; $r <= $antallRader; $r++)
    {
        $rad = mysqli_fetch_array($sqlResultat);

        $brukernavn = htmlspecialchars($rad["brukernavn"], ENT_QUOTES, "UTF-8");
        $fornavn = htmlspecialchars($rad["fornavn"], ENT_QUOTES, "UTF-8");
        $etternavn = htmlspecialchars($rad["etternavn"], ENT_QUOTES, "UTF-8");
        $klassekode = htmlspecialchars($rad["klassekode"], ENT_QUOTES, "UTF-8");

        print("<tr><td>$brukernavn</td><td>$fornavn</td><td>$etternavn</td><td>$klassekode</td></tr>");
    }

    print("</table>");
}
?>

<p><a href="index.php">Tilbake til hovedmenyen</a></p>
