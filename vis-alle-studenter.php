<?php

include("db-tilkobling.php");

$sqlSetning = "SELECT * FROM student;";

$sqlResultat = mysqli_query($db, $sqlSetning)
    or die("ikke mulig å hente data fra databasen");

$antallRader = mysqli_num_rows($sqlResultat);

print("<h3>Registrerte studenter</h3>");
print("<table border=1>");
print("<tr><th>brukernavn</th><th>fornavn</th><th>etternavn</th><th>klassekode</th></tr>");

for ($r = 1; $r <= $antallRader; $r++)
{
    $rad = mysqli_fetch_array($sqlResultat);

    $brukernavn = $rad["brukernavn"];
    $fornavn = $rad["fornavn"];
    $etternavn = $rad["etternavn"];
    $klassekode = $rad["klassekode"];

    print("<tr><td>" . htmlspecialchars($brukernavn) . "</td><td>"
        . htmlspecialchars($fornavn) . "</td><td>"
        . htmlspecialchars($etternavn) . "</td><td>"
        . htmlspecialchars($klassekode) . "</td></tr>");
}

print("</table>");

mysqli_close($db);
?>