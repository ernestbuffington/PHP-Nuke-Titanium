<?php
/*=======================================================================
 PHP-Nuke Titanium: Enhanced and Advanced
 =======================================================================*/
//            'bgcolor1',
//            'bgcolor2',
//            'bgcolor3',
//            'bgcolor4',
//            'textcolor1',
//            'textcolor2'

//$textcolor2
echo "/* Sets the Font Color & Size for tiny with CSS 3 */\n"; 
echo ".tiny {\n";
echo "text-decoration: none;\n";
//echo "line-height: 1.28;\n";
echo "font-size: 10px;\n";
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
echo "background-color: none;\n";
echo "}\n";

global $textcolor1, $textcolor2;
//$textcolor1
echo "/* Sets the Font Color for textcolor1 with CSS 3 */\n"; 
echo ".textcolor1 {\n";
echo "color: ".$textcolor1.";\n";
echo "text-decoration: none;\n";
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
echo "background-color: none;\n";
echo "}\n";

//$textcolor2
echo "/* Sets the Font Color for textcolor2 with CSS 3 */\n"; 
echo ".textcolor2{\n";
echo "color: ".$textcolor2.";\n";
echo "text-decoration: none;\n";
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
echo "background-color: none;\n";
echo "}\n";

//maintable css
echo "/* Sets the center block elements Style with CSS 3 */\n"; 
echo ".maintable {\n";
echo "background-image: 
     url(../../../themes/HTML5-Titanium/images/backgrounds/titanium_background.png), 
	 url(../../../themes/HTML5-Titanium/images/backgrounds/titanium_background.png);\n";
echo "background-position: center top;\n";
echo "background-repeat: repeat-y;\n";
echo "color: #000000;\n";
echo "text-decoration: none;\n";
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
echo "background-color: none;\n";
echo "}\n";
 ?>