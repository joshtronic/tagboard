<?

/******************************************************************************\
 * Copyright (C) 2001-2002 Tag Board by Josh Sherman                          *
 *                                                                            *
 * This script is for explaining the use of emoticons on the Tag Board.       *
 *                                                                            *
 *                                           Last modified : April 15th, 2002 *
 ******************************************************************************
 * This source and program come as is, WITHOUT ANY WARRANTY and/or WITHOUT    *
 * ANY IMPLIED WARRANTY.                                                      *
 *                                                                            *
 * Users of said software should realize that they cannot and will not hold   *
 * bombthebox.com reliable or responsible for any purpose WHAT SO EVER.       *
 * Please read all documentation and use said software responsibly.           *
 *                                                                            *
 * ANY COMMERCIAL REDISTRIBUTION OR ANY PROPRIETARY REDISTRIBUTION OF THIS    *
 * OR ANY SOURCE FROM BOMBTHEBOX.COM IS PROHIBITED UNDER CERTAIN CONDITIONS   *
 * AND SHALL NOT BE RE-SOLD OR REDISTRIBUTED WITHOUT PRIOR AGREEMENTS WITH    *
 * BOMBTHEBOX.COM                                                             *
 *                                                                            *
 * I can be reached by electronic mail if there are any questions or          *
 * concerns about this or any other software that was written/distributed by  *
 * bombthebox.com - josh@bombthebox.com                                       *
 *                                                                            *
 * Software supplied and written by http://www.bombthebox.com/                *
\******************************************************************************/

require ("required.php");

echo "<HTML>\n";
echo "  <HEAD>\n";
echo "    <LINK rel=\"stylesheet\" type=\"text/css\" href=\"tagboard.css\">\n";
echo "  </HEAD>\n";
echo "  <BODY bgcolor=\"#EEEEEE\">\n";
echo "    <TABLE width=\"400\">\n";
echo "      <TR>\n";
echo "        <TD>\n";
echo "          <P align=\"justify\">\n";
echo "            The following is a run down of the emoticons supported by $scriptname version&nbsp;$version.  They are case insensitive, so if someone uses <B>:-X</B> or <B>:-x</B> it will still show up as <IMG src=\"./images/lipssealed.gif\">.  If you're daring, then feel free to change out the images with your own, or even code in more faces and expressions and such.\n";
echo "          </P>\n";
echo "          <TABLE border=\"1\" align=\"center\">\n";
echo "            <TR><TD><IMG src=\"./images/smile.gif\"></TD><TD>Smile</TD><TD>:-) or :)</TD></TR>\n";
echo "            <TR><TD><IMG src=\"./images/frown.gif\"></TD><TD>Frown</TD><TD>:-( or :(</TD></TR>\n";
echo "            <TR><TD><IMG src=\"./images/grin.gif\"></TD><TD>Big grin</TD><TD>:-D or :D</TD></TR>\n";
echo "            <TR><TD><IMG src=\"./images/surprise.gif\"></TD><TD>Surprise</TD><TD>:-O or :O</TD></TR>\n";
echo "            <TR><TD><IMG src=\"./images/tongue.gif\"></TD><TD>Sticking out tongue</TD><TD>:-P or :P</TD></TR>\n";
echo "            <TR><TD><IMG src=\"./images/lipssealed.gif\"></TD><TD>My lips are sealed</TD><TD>:-X or :X</TD></TR>\n";
echo "            <TR><TD><IMG src=\"./images/foot.gif\"></TD><TD>Foot in mouth</TD><TD>:-! or :!</TD></TR>\n";
echo "            <TR><TD><IMG src=\"./images/money.gif\"></TD><TD>Put your money where your mouth is</TD><TD>:-$ or :$</TD></TR>\n";
echo "            <TR><TD><IMG src=\"./images/kiss.gif\"></TD><TD>Kiss</TD><TD>:-* or :*</TD></TR>\n";
echo "            <TR><TD><IMG src=\"./images/embarass.gif\"></TD><TD>Embarassed</TD><TD>:-[ or :[</TD></TR>\n";
echo "            <TR><TD><IMG src=\"./images/unsure.gif\"></TD><TD>Unsure</TD><TD>:-\ or :\</TD></TR>\n";
echo "            <TR><TD><IMG src=\"./images/wink.gif\"></TD><TD>Wink</TD><TD>;-) or ;)</TD></TR>\n";
echo "            <TR><TD><IMG src=\"./images/shades.gif\"></TD><TD>Wearing sun glasses</TD><TD>8-) or 8)</TD></TR>\n";
echo "            <TR><TD><IMG src=\"./images/cry.gif\"></TD><TD>Crying</TD><TD>:'(</TD></TR>\n";
echo "            <TR><TD><IMG src=\"./images/angel.gif\"></TD><TD>Angel</TD><TD>O:-) or O:)</TD></TR>\n";
echo "            <TR><TD><IMG src=\"./images/yell.gif\"></TD><TD>Yelling</TD><TD>>:-O or >:O</TD></TD>\n";
echo "          </TABLE>\n";
echo "        </TD>\n";
echo "      </TR>\n";
echo "    </TABLE>\n";
echo "  </BODY>\n";
echo "</HTML>\n";

?>