<?php
/*=======================================================================
 PHP-Nuke Titanium: Enhanced and Advanced
 =======================================================================*/
echo "/* Sets the left and right side block elements Style with CSS 3 */\n"; 
echo ".block {\n";
echo "background-image: 
      url(../../../themes/HTML5-Titanium/images/backgrounds/titanium_blocks_background.png),
	  url(../../../themes/HTML5-Titanium/images/backgrounds/titanium_blocks_background.png);\n";
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
echo "}\n\n";

// sides
echo ".leftsidetopblock {\n";
echo "background-size 9px 1px;\n"; 
echo "background-image: 
      url(../../../themes/HTML5-Titanium/tables/OpenTable/leftside01.png),
	  url(../../../themes/HTML5-Titanium/tables/OpenTable/leftside01.png);\n";
//echo "background-position: center top;\n";
echo "background-repeat: repeat-y;\n";
echo "}\n\n";

echo ".rightsidetopblock {\n";
echo "background-size 9px 1px;\n"; 
echo "background-image: 
      url(../../../themes/HTML5-Titanium/tables/OpenTable/rightside01.png),
	  url(../../../themes/HTML5-Titanium/tables/OpenTable/rightside01.png);\n";
//echo "background-position: center top;\n";
echo "background-repeat: repeat-y;\n";
echo "}\n\n";


//top
echo ".lefttopblock {\n";
echo "background-size 10px 9px;\n";
echo "background-image: 
      url(../../../themes/HTML5-Titanium/tables/OpenTable/lfttop.png),
	  url(../../../themes/HTML5-Titanium/tables/OpenTable/lfttop.png);\n";
echo "background-position: center top;\n";
echo "background-repeat: no-repeat;\n";
echo "}\n\n";

echo ".middletopblock {\n";
echo "background-size 100% 10px;\n";
echo "background-image: 
      url(../../../themes/HTML5-Titanium/tables/OpenTable/midtop.png),
	  url(../../../themes/HTML5-Titanium/tables/OpenTable/midtop.png);\n";
echo "background-position: center top;\n";
echo "background-repeat: repeat-x;\n";
echo "}\n\n";

echo ".righttopblock {\n";
echo "background-size 10px 9px;\n";
echo "background-image: 
      url(../../../themes/HTML5-Titanium/tables/OpenTable/rttop.png),
	  url(../../../themes/HTML5-Titanium/tables/OpenTable/rttop.png);\n";
echo "background-position: center top;\n";
echo "background-repeat: no-repeat;\n";
echo "}\n\n";


//bottom
echo ".leftbottomblock {\n";
echo "background-size 10px 9px;\n";
echo "background-image: 
      url(../../../themes/HTML5-Titanium/tables/OpenTable/bottomleft01.png),
	  url(../../../themes/HTML5-Titanium/tables/OpenTable/bottomleft01.png);\n";
echo "background-position: center top;\n";
echo "background-repeat: no-repeat;\n";
echo "}\n\n";

echo ".middlebottomblock {\n";
echo "background-size 100% 10px;\n";
echo "background-image: 
      url(../../../themes/HTML5-Titanium/tables/OpenTable/bottommiddle01.png),
	  url(../../../themes/HTML5-Titanium/tables/OpenTable/bottommiddle01.png);\n";
echo "background-position: center top;\n";
echo "background-repeat: repeat-x;\n";
echo "}\n\n";

echo ".rightbottomblock {\n";
echo "background-size 10px 9px;\n";
echo "background-image: 
      url(../../../themes/HTML5-Titanium/tables/OpenTable/bottomright01.png),
	  url(../../../themes/HTML5-Titanium/tables/OpenTable/bottomright01.png);\n";
echo "background-position: center top;\n";
echo "background-repeat: no-repeat;\n";
echo "}\n\n";


//metalbar
echo ".leftmetalbar {\n";
echo "background-size 10px 9px;\n";
echo "background-image: 
      url(../../../themes/HTML5-Titanium/tables/OpenTable/leftmetalbar01.png),
	  url(../../../themes/HTML5-Titanium/tables/OpenTable/leftmetalbar01.png);\n";
echo "background-position: center top;\n";
echo "background-repeat: no-repeat;\n";
echo "}\n\n";

echo ".middlemetalbar {\n";
echo "background-size 100% 10px;\n";
echo "background-image: 
      url(../../../themes/HTML5-Titanium/tables/OpenTable/middlemetalbar01.png),
	  url(../../../themes/HTML5-Titanium/tables/OpenTable/middlemetalbar01.png);\n";
echo "background-position: center top;\n";
echo "background-repeat: repeat-x;\n";
echo "}\n\n";

echo ".rightmetalbar {\n";
echo "background-size 10px 9px;\n";
echo "background-image: 
      url(../../../themes/HTML5-Titanium/tables/OpenTable/rightmetalbar01.png),
	  url(../../../themes/HTML5-Titanium/tables/OpenTable/rightmetalbar01.png);\n";
echo "background-position: center top;\n";
echo "background-repeat: no-repeat;\n";
echo "}\n\n";

//carbin-fiber
echo ".carbinfiber {\n";
echo "background-image: 
      url(../../../themes/HTML5-Titanium/images/backgrounds/cf.png),
	  url(../../../themes/HTML5-Titanium/images/backgrounds/cf.png);\n";
echo "background-position: center top;\n";
echo "background-repeat: repeat-x;\n";
echo "color: #FFFFFF;\n";
echo "text-decoration: none;\n";
//echo "line-height: 1.28;\n";
echo "font-size: ".$fontsize.";\n";
echo "font-weight: bold;\n";
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
echo "}\n\n";
//block footer
echo ".block {\n";
	/* width is 500px */
	/* REPEAT TOP TO BOTTOM */
echo "background-position: center;\n";
echo "background-repeat: repeat-y;\n";
echo "background-image: url(../../../themes/86it-Titanium/images/backgrounds/titanium_blocks_background.png);\n";
echo "}\n";


echo " .maintable {\n";
	/* width is 1920px */
	/* REPEAT TOP TO BOTTOM */
echo "background-position: center;\n";
echo "   background-repeat: repeat-y;\n";   
echo "background-image: url(../../../themes/Kinon/images/backgrounds/titanium_background.png);\n";
echo "}\n";


echo ".otthree {\n";
	/* width is 500px */
	/* REPEAT TOP TO BOTTOM */
echo "background-position: center;\n";
echo "background-repeat: repeat-y;\n";
echo "background-image: url(../../../themes/Kinon/images/backgrounds/titanium_background.png);\n";
echo "}\n";

echo " .maintable {\n";
	/* width is 1920px */
	/* REPEAT TOP TO BOTTOM */
echo "background-position: center;\n";
echo "   background-repeat: repeat-y;\n";   
echo "background-image: url(../../../themes/Kinon/images/backgrounds/titanium_background.png);\n";
echo "}\n";




echo ".maintable2 {\n";
echo "background-image: 
      url(../../../themes/Kinon/images/backgrounds/cf.png),
	  url(../../../themes/Kinon/images/backgrounds/cf.png);\n";
echo "background-position: center top;\n";
echo "background-repeat: repeat-x;\n";
echo "color: #FFFFFF;\n";
echo "text-decoration: none;\n";
//echo "line-height: 1.28;\n";
echo "font-size: ".$fontsize.";\n";
echo "font-weight: bold;\n";
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
echo "}\n\n";

 ?>  