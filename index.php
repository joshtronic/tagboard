<?

/******************************************************************************\
 * Copyright (C) 2001-2002 Tag Board by Josh Sherman                          *
 *                                                                            *
 * This script is for displaying the Tag Board, and providing the form for a  *
 * user to post their data.                                                   *
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
echo "    <FORM action=\"post.php\" method=\"POST\" target=\"tagboard\" name=\"post\" id=\"post\">\n";
echo "      <TABLE cellpadding=\"0\" cellspacing=\"2\" width=\"1%\">\n";
echo "        <TR>\n";
echo "          <TD>\n";
echo "            <B>$scriptname v$version:</B>\n";
echo "          </TD>\n";
echo "        </TR>\n";
echo "        <TR>\n";
echo "          <TD align=\"center\">\n";
echo "            <IFRAME src=\"tagboard.php\" width=\"100%\" height=\"200\" frameborder=\"0\" scrolling=\"auto\" name=\"tagboard\"></IFRAME>\n";
echo "          </TD>\n";
echo "        </TR>\n";
echo "        <TR>\n";
echo "          <TD align=\"center\">\n";
echo "            <INPUT type=\"text\" name=\"nick\" size=25 value=\"nick\" maxlength=\"$nicklength;\">\n";
echo "          </TD>\n";
echo "        </TR>\n";
echo "        <TR>\n";
echo "          <TD align=\"center\">\n";
echo "            <INPUT type=\"text\" name=\"url\" size=\"25\" value=\"http://\" maxlength=\"$urllength\">\n";
echo "          </TD>\n";
echo "        </TR>\n";
echo "        <TR>\n";
echo "          <TD align=\"center\">\n";
echo "            <INPUT type=\"text\" name=\"message\" size=\"25\" value=\"message\" maxlength=\"$messagelength\">\n";
echo "          </TD>\n";
echo "        </TR>\n";
echo "        <TR>\n";
echo "          <TD align=\"center\">\n";
echo "            <INPUT type=\"submit\" value=\"Tag It!\" name=\"submit\">\n";

if ($emoticon=="1")
  echo "            <BR>[ <A href=\"emoticons.php\">Emoticon Help</A> ]\n";

echo "          </TD>\n";
echo "        </TR>\n";
echo "      </TABLE>\n";
echo "    </FORM>\n";
echo "  </BODY>\n";
echo "</HTML>\n";

?>