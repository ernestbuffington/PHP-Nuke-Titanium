<?php
/*=======================================================================
 PHP-Nuke Titanium: Enhanced and Advanced
 =======================================================================*/
echo "/* Sets the body element Style with CSS 3 */\n";  

echo "#tableheader {\n";
echo "border-collapse: collapse;\n";
echo "}\n";

echo ".spacer{\n";
echo "height: 7px;\n";
echo "background-image: none\n";
echo "width: 1px;\n";
echo "display:block\n";
echo "border:none;\n";
echo "outline:none;\n";
echo "}\n\n";


echo ".img{\n";
echo "display:block\n";
echo "border:none;\n";
echo "outline:none;\n";
echo "}\n\n";

echo "body {\n";
echo "margin-left: 0px;\n"; 
echo "margin-top: 0px;\n"; 
echo "margin-right: 0px;\n"; 
echo "margin-bottom: 0px;\n"; 
echo "color: #000000;\n"; 
echo "-webkit-text-size-adjust: none;\n";
echo "cursor: default;\n"; 
//echo "line-height: 1.28;\n"; 
echo "font-size: ".$fontsize.";\n"; 
echo "font-weight: normal;\n";
echo "font-style: normal;\n";
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
echo "background-color: #cecece;\n";
echo "}\n\n";
 ?>