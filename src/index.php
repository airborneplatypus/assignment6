<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<html>\n";
echo "<head>\n";
echo "<title> Movie Database </title>\n";
echo "</head>\n";
echo "<body>\n";

echo "<h1>Add Movie</h1>\n";
echo "Name of Movie: <input type=\"text\" id=\"name\"><br>\n";
echo "Category of Movie: <input type=\"text\" id=\"category\"><br>\n";
echo "Length of Movie: <input type=\"number\" id=\"length\"><br>\n";
echo "Is it rented? <input type=\"checkbox\" id=\"rented\">Yes<br>\n";
echo "<button id=\"movieButton\" class=\"btn btn-primary\">Add Movie</button><br>\n";
echo "<br><br><br>\n";

echo "<table id=\"videos\">\n";
echo "</table>\n";

echo "<script src=\"code.js\"></script>\n";
echo "</body>\n";
echo "</html>\n";

?>