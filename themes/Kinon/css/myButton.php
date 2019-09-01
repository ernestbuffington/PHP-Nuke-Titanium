<?php 
/*======================================================================= 
 PHP-Nuke Titanium: Enhanced and Advanced 
 =======================================================================*/
echo ".myButton {\n";
echo "-moz-box-shadow:inset 0px 0px 0px 0px #91b8b3;\n";
echo "-webkit-box-shadow:inset 0px 0px 0px 0px #91b8b3;\n";
echo "box-shadow:inset 0px 0px 0px 0px #91b8b3;\n";
echo "background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #cecece), color-stop(1, #6c7c7c));\n";
echo "background:-moz-linear-gradient(top, #cecece 5%, #6c7c7c 100%);\n";
echo "background:-webkit-linear-gradient(top, #cecece 5%, #6c7c7c 100%);\n";
echo "background:-o-linear-gradient(top, #cecece 5%, #6c7c7c 100%);\n";
echo "background:-ms-linear-gradient(top, #cecece 5%, #6c7c7c 100%);\n";
echo "background:linear-gradient(to bottom, #cecece 5%, #6c7c7c 100%);\n";
echo "filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#cecece', endColorstr='#6c7c7c',GradientType=0);\n";
echo "background-color:#cecece;\n";
echo "-moz-border-radius:8px;\n";
echo "-webkit-border-radius:8px;\n";
echo "border-radius:8px;\n";
echo "border:1px solid #566963;\n";
echo "display:inline-block;\n";
echo "cursor:pointer;\n";
echo "color:#080008;\n";

switch ($currentfont)
{
    case "1":
    echo "font-family: Consolas, 
	     \"Andale Mono WT\", 
		 \"Andale Mono\", 
		 \"Lucida Console\", 
		 \"Lucida Sans Typewriter\", 
		 \"DejaVu Sans Mono\", 
		 \"Bitstream Vera Sans Mono\", 
		 \"Liberation Mono\", 
		 \"Nimbus Mono L\", 
		 Monaco, 
		 \"Courier New\", 
		 Courier, monospace;\n";
    break;
	case "2":
    echo "font-family: Impact, 
	     Haettenschweiler, 
		 \"Franklin Gothic Bold\", 
		 Charcoal, 
		 \"Helvetica Inserat\", 
		 \"Bitstream Vera Sans Bold\", 
		 \"Arial Black\", sans-serif;\n";
	break;
	case "3":
    echo "font-family: \"Segoe UI\", 
	     Candara, 
		 \"Bitstream Vera Sans\", 
		 \"DejaVu Sans\", 
		 \"Bitstream Vera Sans\", 
		 \"Trebuchet MS\", 
		 Verdana, 
		 \"Verdana Ref\", 
		 sans-serif;\n";
    break;
	case "4":
	echo "font-family: Corbel, 
	     \"Lucida Grande\", 
		 \"Lucida Sans Unicode\", 
		 \"Lucida Sans\", 
		 \"DejaVu Sans\", 
		 \"Bitstream Vera Sans\", 
		 \"Liberation Sans\", 
		 Verdana, 
		 \"Verdana Ref\", 
		 sans-serif;\n";
	break;
	case "5":
	echo "font-family: Frutiger, 
	     \"Frutiger Linotype\", 
		 Univers, Calibri, 
		 \"Gill Sans\", 
		 \"Gill Sans MT\", 
		 \"Myriad Pro\", 
		 Myriad, 
		 \"DejaVu Sans Condensed\", 
		 \"Liberation Sans\", 
		 \"Nimbus Sans L\", 
		 Tahoma, Geneva, 
		 \"Helvetica Neue\", 
		 Helvetica, Arial, sans-serif;\n";
	break;
	case "6":
	echo "font-family: \"Palatino Linotype\", 
	     Palatino, 
		 Palladio, 
		 \"URW Palladio L\", 
		 \"Book Antiqua\", 
		 Baskerville, 
		 \"Bookman Old Style\", 
		 \"Bitstream Charter\", 
		 \"Nimbus Roman No9 L\", 
		 Garamond, 
		 \"Apple Garamond\", 
		 \"ITC Garamond Narrow\", 
		 \"New Century Schoolbook\", 
		 \"Century Schoolbook\", 
		 \"Century Schoolbook L\", 
		 Georgia, 
		 serif;\n";
    break;		 
	case "7";
	echo "font-family: Constantia, 
	     \"Lucida Bright\", 
		 Lucidabright, 
		 \"Lucida Serif\", 
		 Lucida, 
		 \"DejaVu Serif\", 
		 \"Bitstream Vera Serif\", 
		 \"Liberation Serif\", 
		 Georgia, 
		 serif;\n";		 
    break;
	case "8";
	echo "font-family: Cambria, 
	     \"Hoefler Text\", 
		 Utopia, 
		 \"Liberation Serif\", 
		 \"Nimbus Roman No9 L Regular\", 
		 Times, 
		 \"Times New Roman\", 
		 serif;\n";
    break;
}

echo "font-size:".$fontsize.";\n";
echo "padding:3px 6px;\n";
echo "text-decoration:none;\n";
echo "text-shadow:0px 1px 0px #2b665e;\n";
echo "}\n";

echo ".myButton:hover {\n";
echo "color:#CC0000;\n";
echo "}\n";

echo ".myButton:active {\n";
echo "background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #6c7c7c), color-stop(1, #cecece));\n";
echo "background:-moz-linear-gradient(top, #6c7c7c 5%, #cecece 100%);\n";
echo "background:-webkit-linear-gradient(top, #6c7c7c 5%, #cecece 100%);\n";
echo "background:-o-linear-gradient(top, #6c7c7c 5%, #cecece 100%);\n";
echo "background:-ms-linear-gradient(top, #6c7c7c 5%, #cecece 100%);\n";
echo "background:linear-gradient(to bottom, #6c7c7c 5%, #cecece 100%);\n";
echo "filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#6c7c7c', endColorstr='#cecece',GradientType=0);\n";
echo "background-color:#6c7c7c;\n";
echo "position:relative;\n";
echo "top:1px;\n";
echo "}\n";
?>