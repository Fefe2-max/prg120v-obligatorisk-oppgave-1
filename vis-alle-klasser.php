
<?php


include("db-tilkobling.php");

$sqlSetning = "SELECT * FROM klasse;";

$sqlResultat = mysqli_query($db, $sqlSetning)
    or die("Ikke mulig å hente data fra databasen");

$antallRader = mysqli_num_rows($sqlResultat);

print("<h3>Registrerte klasser</h3>");

if ($antallRader == 0)
{
    print("Ingen klasser er registrert");
}
else
{
    print("<table border='1'>");
    print("<tr><th>Klassekode</th><th>Klassenavn</th><th>Studiumkode</th></tr>");

    for ($r = 1; $r <= $antallRader; $r++)
    {
        $rad = mysqli_fetch_array($sqlResultat);

        $klassekode = htmlspecialchars($rad["klassekode"], ENT_QUOTES, "UTF-8");
        $klassenavn = htmlspecialchars($rad["klassenavn"], ENT_QUOTES, "UTF-8");
        $studiumkode = htmlspecialchars($rad["studiumkode"], ENT_QUOTES, "UTF-8");

        print("<tr><td>$klassekode</td><td>$klassenavn</td><td>$studiumkode</td></tr>");
    }

    print("</table>");
}
?>

<p><a href="index.php">Tilbake til hovedmenyen</a></p>
