<?

/******************************************************************************\
 * Copyright (C) 2001-2002 Tag Board by Josh Sherman                          *
 *                                                                            *
 * This script is for parsing the data the user wants to post to the board,   *
 * and then either adds it to the MySQL database, or to a flat file.          *
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

echo "<HTML>\n";
echo "  <HEAD>\n";
echo "    <LINK rel=\"stylesheet\" type=\"text/css\" href=\"tagboard.css\">\n";
echo "  </HEAD>\n";
echo "  <BODY topmargin=\"2\" leftmargin=\"2\" bottommargin=\"2\" rightmargin=\"2\">\n";

$beginning = "<CENTER>";
$ending    = "<BR><BR><B><A href=\"tagboard.php\">Return</A></B></CENTER>";

if ($REQUEST_METHOD == "POST")
  {
    /* Determine if the nick and message exceed their limits */
    if (strlen($nick) > $nicklength || strlen($message) > $messagelength || strlen($url) > $urllength )
      {
        echo "<CENTER>$error_length<BR><BR><B><A href=\"tagboard.php\">Return</A></B></CENTER>";
        exit;
      }

    /* Filter out HTML commands */
    if ($htmlfilter == 1)
      {
        $nick = strip_tags ($nick);
        $url = strip_tags ($url);
        $message = strip_tags ($message);
      }

    /* Make sure the person isn't trying to exploit the board */
    $url = trim($url);
  
    if ( !eregi("^(http://|ftp://)?(www\.)?([a-z0-9\.-])+(\.[a-z])+(:[0-9])?(/{1}[\.a-z0-9\+_-])*", $url) && $url != "" && $url != "http://" )
      {
        if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$", $url))
          $url = "mailto:" . $url; 
        else
          {
            echo $beginning . "Don't you have better shit to do with your time?  Go read a book, bitch." . $ending;
            exit;
          }
      }
    else
      {
        if( !stristr($url, "http://") && !stristr($url, "ftp://") )
          $url = "http://" . $url;
      }

    /* Filters out big words, larger than X characters long */
    if ($bigword == 1)
      {
        $word_array = split(" ", $message);
        for($i = 0; $i < count($word_array); $i++)
          {
            if (strlen($word_array[$i]) > $maxword)
              {
                echo "$beginning$error_wordlen$ending";
                exit;
              }
          }
      }

    /* Filters out keywords, can be used to limit profanity */
    if ($filter == 1)
      {
        for ($i = 0; $i <= sizeof($keywords); $i++)
          {
            if (stristr($nick, $keywords[$i]) || stristr($message, $keywords[$i]))
              {
                $error = str_replace("[KEYWORD]", $keywords[$i], $error_keyword);
                echo "$beginning$error$ending";
                exit;
              }
          }
      }

    /* Check to make sure they aren't trying to post a blank message or use the default values */
    if ( $nick == "" || substr($nick, 0, 4) == "nick" || trim($nick) == "" )
      {
        echo "$beginning$error_nonick$ending";
        exit;
      }

    if ( $message == "" || substr($message, 0, 7) == "message" || trim($message) == "" )
      {
        echo "$beginning$error_nomsg$ending";
        exit;
      }

    if ($usemysql == 1)
      {
        if ($floodprotect == 1)
          {
            /* This part will limit flooding of the board */
            $SQL = "SELECT * FROM $tablname ORDER BY -id LIMIT 1;";
            $results = mysql_db_query($database, "$SQL", $connection);
            if (!$results)
              return ("ERROR: " . mysql_error() . "\n$SQL\n");

            while ($row = mysql_fetch_array($results))
              $prev_ip = $row["ip"];

            $SQL = "SELECT COUNT(*) as dupeips FROM $tablname WHERE ip='$REMOTE_ADDR' ORDER BY -id LIMIT $floodtotal;";
            $results = mysql_db_query($database, "$SQL", $connection);
            if (!$results)
              return ("ERROR: " . mysql_error() . "\n$SQL\n");

            while ($row = mysql_fetch_array($results))
              $dupeips = $row["dupeips"];

            /* If the IP was the same IP that posted last time, then deny them */
            if ($dupeips >= $floodtotal)
              {
                echo "$beginning$error_flood$ending";
                exit;
              }
          }

          /* Put the tag into the database... */
          $SQL = "INSERT INTO $tablname (nick, url, message, datetime, ip) VALUES ('$nick', '$url', '$message', '" . date($ts_format) . "', '$REMOTE_ADDR');";
          $results = mysql_db_query($database, "$SQL", $connection);
          if (!$results)
            return ("ERROR: " . mysql_error() . "\n$SQL\n");

          /* Close up that databsae connection like a good code monkey */
          mysql_close($connection);
      }
    else
      {
        if ($floodprotect == 1)
          {
            $file_lines = file($flatfile);
            $how_many_times = 0;
            $ip_addy  = substr($file_lines[0], ((strpos($file_lines[0], "##")) + 2), ((strlen(substr($file_lines[0], ((strpos($file_lines[0], "##")) + 2)))) - 1));

            if ($REMOTE_ADDR == $ip_addy)
              {

                for ($i = 0; $i+1 <= $floodtotal; $i++)
                  {
                    $ip_addy = substr($file_lines[$i], (strpos($file_lines[$i], "##"))+2, (strlen(substr($file_lines[$i], ((strpos($file_lines[0], "##")) + 2)))) - 1);

                    if ($ip_addy == $REMOTE_ADDR)
                      {
                        $how_many_times++;

                        if ($how_many_times == $floodtotal)
                          {
                            echo "$beginning$error_flood$ending";
                            exit;
                          }
                      }
                  }
              }    
          }

        $output = "";
        $file_lines = file($flatfile);

        foreach($file_lines as $line) 
          $output .= $line;

        if ($url != "" && $url != "http://")
          {
            $nick = "<A href=\"$url\" target=\"_blank\">$nick</A>";
          }

        $ff_input = "$nick%%$message@@" . date($ts_format) . "##$REMOTE_ADDR\n" . $output;
        $fp = fopen($flatfile, "w");
        fwrite($fp, stripslashes($ff_input));
        fclose($fp);
    }

    if ($emailnotify == 1)
      mail($emailaddy, $emailsubject, $emailbody, "From: $scriptname");

    /* Then redirect back to the board, instead of saying "click here to see your post"... lame. */
    echo "    <META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0; URL=tagboard.php\">\n";
  }

echo "  </BODY>\n";
echo "</HTML>";

?>