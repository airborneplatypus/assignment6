<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<html>\n";
echo "<head>\n";
echo "<title> Movie Database </title>\n";
echo "</head>\n";
echo "<body>\n";

echo "<h1>Add Movie</h1>";
echo "Name of Movie: <input type=\"text\" id=\"name\"><br>";
echo "Category of Movie: <input type=\"text\" id=\"category\"><br>";
echo "Length of Movie: <input type=\"number\" id=\"length\"><br>";
echo "Is it rented? <input type=\"checkbox\" id=\"rented\">Yes<br>";
echo "<button id=\"movieButton\" class=\"btn btn-primary\">Add Movie</button><br>";

echo "<script src=\"code.js\"></script>";
echo "</body>\n";
echo "</html>\n";

?>