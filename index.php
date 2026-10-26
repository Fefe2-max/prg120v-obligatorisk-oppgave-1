<?php


print("<h1>Studentdatabase</h1>");

print("<h2>Klasser</h2>");

print("<a href='index.php?valg=visKlasser'>Vis alle klasser</a><br />");
print("<a href='index.php?valg=registrerKlasse'>Registrer klasse</a><br />");
print("<a href='index.php?valg=slettKlasse'>Slett klasse</a><br />");

print("<h2>Studenter</h2>");

print("<a href='index.php?valg=visStudenter'>Vis alle studenter</a><br />");
print("<a href='index.php?valg=registrerStudent'>Registrer student</a><br />");
print("<a href='index.php?valg=slettStudent'>Slett student</a><br />");

$valg = $_GET["valg"] ?? "";

switch ($valg)
{
    case "visKlasser":
        include("vis-alle-klasser.php");
        break;

    case "registrerKlasse":
        include("registrer-klasse.php");
        break;

    case "slettKlasse":
        include("slett-klasse.php");
        break;

    case "visStudenter":
        include("vis-alle-studenter.php");
        break;

    case "registrerStudent":
        include("registrer-student.php");
        break;

    case "slettStudent":
        include("slett-student.php");
        break;
}
?>