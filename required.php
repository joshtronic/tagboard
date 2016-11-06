<?

/******************************************************************************\
 * Copyright (C) 2001-2002 Tag Board by Josh Sherman                          *
 *                                                                            *
 * This script contains all the variables needed to customize the Tag Board,  *
 * and should be the only file you need to edit.                              *
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

/* For the variables, 0 = off and 1 = on, unless otherwise specified. */

/******************************************************************************/

/* Universal Variables */

  /* 0 = Use Flat file; 1 = Use MySQL */
  $usemysql = 0;

  /* Maximum length for each field */
  $nicklength    = 16;
  $urllength     = 128;
  $messagelength = 128;

  /* How many items to display in the tag board */
  $howmany = 25;

  /* Character(s) used to seperate the name and message */
  $spacer = "»";

  /* Enable timestamping */
  $timestamping = 0;

  /* Timestamp format (refer to http://www.php.net/manual/en/function.date.php) */
  $ts_format = "r";

  /* Enable emoticons */
  $emoticon = 1;

  /* Enable the keyword filter */
  $filter = 1;
  
  /* Words to filter, if the keyword filter is enabled */
  $keywords = array('shit','damn','fuck','ass','cunt','pussy','piss','cock','suck');

  /* Enable HTML stripping from the board (recommended) */
  $htmlfilter = 1;

  /* Enable flood protection (multiple posts) */
  $floodprotect = 1;

  /* Number of messages allowed in succession from the same IP (floodprotect must be enabled) */
  $floodtotal = 1;

  /* Enable the big word filter */
  $bigword = 1;

  /* Max length allowed when the big word filter is on */
  $maxword = 10;

  /* Enable email notification for each new post */
  $emailnotify = 0;

  /* Address, subject and body to send. */
  $emailaddy    = "your@email.com";
  $emailsubject = "You tag board has been violated!";
  $emailbody    = "Well, not really, but someone did tag it recently!";

/* End Universal Variables */

/******************************************************************************/

/* Custom error message for... */

  /* when HTML is diabled */
  $error_html = "No HTML allowed!";	

  /* the user's nick is too long */
  $error_length = "Your nick, url or message contains too many characters.";

  /* a word is longer than the maximum word length */
  $error_wordlen = "You can't post words that large, they must be 10 characters or less.";

  /* the user posts a word that is in the "ban" list, use [KEYWORD] to have the violating keyword in the error message */
  $error_keyword = "The word \"[KEYWORD]\" is not allowed.";

  /* when the user doesn't specify a nick */
  $error_nonick = "You must specify a nick.";

  /* when the user doesn't specify a message */
  $error_nomsg = "You have to post a message.";

  /* when the user tries flooding the board */
  $error_flood = "What do you think this is, a chat client?  Flooding is bad.. mmmkay.";

  /* when the URL isn't formatted correctly */
  $error_badurl = "That URL is not valid.";

/* End custom error messages */

/******************************************************************************/

/* Flat File Only Variables */

  /* Path and file name of your flat file, must be chmod 666 */
  $flatfile = "./tagboard.dat";

/* End Flat File Only Variables */

/******************************************************************************/

/* MySQL Only Variables */

  /* Login information for your database */     
  $username = "";
  $password = "";

  /* Name of the database we are trying to access */
  $database = "";

  /* Hostname for the database, typically "localhost" */
  $hostname = "localhost";

  /* Table that contains your tag board data */
  $tablname = "tagboard";

  /* What order to display the data. 0 = descending (most recent first); 1 = ascending */
  $order = 0; 		

/* End MySQL Only Variables */

/******************************************************************************/

/** IF YOU KNOW WHAT'S GOOD FOR YOU, YOU WON'T EDIT BELOW THIS LINE!! **/

  /* MySQL Connection String */
  $connection = mysql_connect($hostname, $username, $password);
  if (!$connection)
    echo ("ERROR: " . mysql_error() . "\n");

  /* Script Information */
  $scriptname = "Tag It!";
  $version = "0.6.1";

?>