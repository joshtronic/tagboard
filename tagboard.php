<?

/******************************************************************************\
 * Copyright (C) 2001-2002 Tag Board by Josh Sherman                          *
 *                                                                            *
 * This script parses the data from the database or flat file, and then       *
 * displays it in a nice neat layout.                                         *
 *                                                                            *
 *                                           Last modified : April 16th, 2002 *
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

echo "<!-- $scriptname v$version Start -->\n\n";
echo "<HTML>\n";
echo "  <HEAD>\n";
echo "    <LINK rel=\"stylesheet\" type=\"text/css\" href=\"tagboard.css\">\n";
echo "  </HEAD>\n";
echo "  <BODY topmargin=\"2\" leftmargin=\"2\" bottommargin=\"2\" rightmargin=\"2\">\n";

if ($usemysql == 1)
  {
    /* Load the tagboard, the X number of most recent posts */
    if ($order == "0")
      $SQL = "SELECT * FROM $tablname ORDER BY -id LIMIT $howmany";
    else
      $SQL = "SELECT * FROM $tablname ORDER BY id LIMIT $howmany";

    $results = mysql_db_query($database, "$SQL", $connection);
    if (!$results)
      return ("ERROR: " . mysql_error() . "\n$SQL\n");
	
    while ($row = mysql_fetch_array($results))
      { 
        $nick     = $row["nick"]; 
        $url      = $row["url"];
        $message  = $row["message"];
        $datetime = $row["datetime"];

        /* Add Emoticons to the user's message */
        if ($emoticon == 1)
          emoticon($message);

        /* Some people don't have web sites, so we check to see if they put a URL in the database */
        if ($url=="" or $url=="http://") /* If they didn't then we just display the nick and the message */
          $nick = "<B>$nick";
        else /* If they did, then we link it!! */
          $nick = "<B><a href=\"$url\" target=\"_blank\">$nick</a>";
        
        if ($timestamping == 1)
          echo "    $nick ($datetime)$spacer</B> $message<BR>\n";
        else
          echo "    $nick$spacer</B> $message<BR>\n";
      }
				
      /* Like always, we close the connection to the database */
      mysql_close($connection);
  }
else
  {
    $i = 0;
    $file_lines = file($flatfile);

    foreach($file_lines as $line)
      {
        if ($i <= $howmany)
          {
            $delim    = strpos($line, "%%");
            $ts_delim = strpos($line, "@@");
            $ip_delim = strpos($line, "##");

            $nick = substr($line, 0, $delim);
            $message = substr($line, $delim + 2, $ts_delim - $delim - 2);
            $ts = substr($line, $ts_delim + 2, $ip_delim - $ts_delim - 2);
  
            if ($timestamping == 1)
              echo "    <B>$nick ($ts)$spacer</B> ";
            else 
              echo "    <B>$nick$spacer</B> ";

            if ($emoticon == 1)
              echo (emoticon($message)); 
            else
              echo "$message";

            echo "<BR>\n";

            $i++;
          }
      }
  }

echo "    <BR>\n";
echo "    <CENTER>\n";
echo "      <A href=\"http://www.bombthebox.com/opensource/tagboard/\" target=\"_blank\">$scriptname v$version</A>\n";
echo "    </CENTER>\n";
echo "  </BODY>\n";
echo "</HTML>\n";
echo "\n<!-- $scriptname v$version End -->";

function emoticon($msg)
  {
    $msg = str_replace("o:-)", "<IMG src=\"./images/angel.gif\">", $msg);
    $msg = str_replace("o:)", "<IMG src=\"./images/angel.gif\">", $msg);
    $msg = str_replace("O:-)", "<IMG src=\"./images/angel.gif\">", $msg);
    $msg = str_replace("O:)", "<IMG src=\"./images/angel.gif\">", $msg);
    $msg = str_replace(":-)", "<IMG src=\"./images/smile.gif\">", $msg);
    $msg = str_replace(":)", "<IMG src=\"./images/smile.gif\">", $msg);
    $msg = str_replace(":-(", "<IMG src=\"./images/frown.gif\">", $msg);
    $msg = str_replace(":(", "<IMG src=\"./images/frown.gif\">", $msg);
    $msg = str_replace(":-\\", "<IMG src=\"./images/unsure.gif\">", $msg);
    $msg = str_replace(":\\", "<IMG src=\"./images/unsure.gif\">", $msg);
    $msg = str_replace(":-p", "<IMG src=\"./images/tongue.gif\">", $msg);
    $msg = str_replace(":p", "<IMG src=\"./images/tongue.gif\">", $msg);
    $msg = str_replace(":-P", "<IMG src=\"./images/tongue.gif\">", $msg);
    $msg = str_replace(":P", "<IMG src=\"./images/tongue.gif\">", $msg);
    $msg = str_replace(";-)", "<IMG src=\"./images/wink.gif\">", $msg);
    $msg = str_replace(";)", "<IMG src=\"./images/wink.gif\">", $msg);
    $msg = str_replace(":-*", "<IMG src=\"./images/kiss.gif\">", $msg);
    $msg = str_replace(":*", "<IMG src=\"./images/kiss.gif\">", $msg);
    $msg = str_replace(":-*", "<IMG src=\"./images/kiss.gif\">", $msg);
    $msg = str_replace(":*", "<IMG src=\"./images/kiss.gif\">", $msg);
    $msg = str_replace(":-!", "<IMG src=\"./images/foot.gif\">", $msg);
    $msg = str_replace(":!", "<IMG src=\"./images/foot.gif\">", $msg);
    $msg = str_replace(":'(", "<IMG src=\"./images/cry.gif\">", $msg);
    $msg = str_replace(">:-o", "<IMG src=\"./images/yell.gif\">", $msg);
    $msg = str_replace(">:o", "<IMG src=\"./images/yell.gif\">", $msg);
    $msg = str_replace(">:-O", "<IMG src=\"./images/yell.gif\">", $msg);
    $msg = str_replace(">:O", "<IMG src=\"./images/yell.gif\">", $msg);
    $msg = str_replace(":-o", "<IMG src=\"./images/surprise.gif\">", $msg);
    $msg = str_replace(":o", "<IMG src=\"./images/surprise.gif\">", $msg);
    $msg = str_replace(":-O", "<IMG src=\"./images/surprise.gif\">", $msg);
    $msg = str_replace(":O", "<IMG src=\"./images/surprise.gif\">", $msg);
    $msg = str_replace(":-$", "<IMG src=\"./images/money.gif\">", $msg);
    $msg = str_replace(":$", "<IMG src=\"./images/money.gif\">", $msg);
    $msg = str_replace(":-[", "<IMG src=\"./images/embarass.gif\">", $msg);
    $msg = str_replace(":[", "<IMG src=\"./images/embarass.gif\">", $msg);
    $msg = str_replace(":-X", "<IMG src=\"./images/lipssealed.gif\">", $msg);
    $msg = str_replace(":X", "<IMG src=\"./images/lipssealed.gif\">", $msg);
    $msg = str_replace(":-x", "<IMG src=\"./images/lipssealed.gif\">", $msg);
    $msg = str_replace(":x", "<IMG src=\"./images/lipssealed.gif\">", $msg);
    $msg = str_replace("8-)", "<IMG src=\"./images/shades.gif\">", $msg);
    $msg = str_replace("8)", "<IMG src=\"./images/shades.gif\">", $msg);
    $msg = str_replace(":-d", "<IMG src=\"./images/grin.gif\">", $msg);
    $msg = str_replace(":d", "<IMG src=\"./images/grin.gif\">", $msg);
    $msg = str_replace(":-D", "<IMG src=\"./images/grin.gif\">", $msg);
    $msg = str_replace(":D", "<IMG src=\"./images/grin.gif\">", $msg);
    
    return $msg;
  }

?>