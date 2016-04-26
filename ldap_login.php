<?php

   $ldapserver = "ldap.technikum-wien.at";
   $searchbase = "dc=technikum-wien,dc=at";

   $loginname = (isset($_POST['loginname']))?$_POST['loginname']:NULL;
   $loginpw = (isset($_POST['loginpw']))?$_POST['loginpw']:NULL;

   if (!$loginname)
   {
	   $error=1;
      //
      echo "<html>";
      echo "<head>";
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">";
      echo "<title>FH Verwaltung - Login</title>";
      echo "<meta name=\"Description\" content=\"\">";
      echo "<meta name=\"Keywords\" content=\"\">";
      echo "<link rel='stylesheet' type='text/css' href='fh.css'>";
      echo "</head>";
      echo "<body bgcolor=\"#FFFFFF\" text=\"#000000\" style=\"font-family:Tahoma;font-size:10pt;\">";
      echo "<h3>Melden Sie sich bitte mit Ihrem FH Account an.</h3><br>\n";
      echo "<form action='".$_SERVER['PHP_SELF']."' enctype=\"multipart/form-data\" method='post'>\n";
      echo "<table border=0>\n";
      echo "<tr valign='top'><td>Benutzer:</td><td>";
      echo "<input type='text' name='loginname' size=20 value='".$loginname."'></td></tr>\n";
      echo "<tr valign='top'><td>Kennwort:</td><td>";
      echo "<input type='password' name='loginpw' size=20 value='".$loginpw."'></td></tr>\n";
      echo "<tr valign='top'><td></td><td><input type='submit' name='login' value='Login'></td><td></td></tr>\n";
      echo "</table>\n</form><br>\n";
   } else {
   	
     $loginname = strtolower($loginname);
     $ds=ldap_connect($ldapserver);


     if (! $ds) {
          $error = "Unable to connect to LDAP server.<br>\n";
          $error .= "<a href='".$_SERVER['PHP_SELF']."'>Neuer Versuch >></a>";
      } else {

        if (!ldap_bind($ds))
        {
           $error = "Unable to bind to LDAP server.<br>\n";
           $error .= "<a href='".$_SERVER['PHP_SELF']."'>Neuer Versuch >></a>";
        }
        else
        {
          if (TRUE) {
               $filter="(&(uid=".$loginname.")(objectClass=posixAccount))";
               $sr = ldap_search($ds, $searchbase, $filter);
               $info=ldap_get_entries($ds,$sr);
          }
          if ($info["count"]==0)
          {

              $error = "<h3>Technikum-Wien</h3>";
              $error .= "Ung&uuml;ltiges Login / Password.<br><br>\n";
              $error .= "<a href='".$_SERVER['PHP_SELF']."'>Neuer Versuch >></a>";
          }
          else
          {
          $dn=$info[0]["dn"];
          // bind
          //$dn = "uid=".$loginname.", ou=People, dc=technikum-wien, dc=at";
          $pw = $loginpw;
          if(! @ldap_bind($ds, $dn, $pw) || !$loginpw) {
              $error = "<h3>Technikum-Wien</h3>";
              $error .= "Ung&uuml;ltiges Login / Password.<br><br>\n";
              $error .= "<a href='".$_SERVER['PHP_SELF']."'>Neuer Versuch >></a>";
          } else {
//            echo "Connected to LDAP server at technikum-wien.at.";
              unset($loginpw);
              $user_name = $loginname;
              $vorname = $info[0]['givenname'][0];
              $nachname = $info[0]['sn'][0];
			  $_SESSION["username"]="1";

          }
          }
          ldap_close($ds);
          /*if (isset($error))
          {
              echo "<head>";
              echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">";
              echo "<title>FH-Verwaltung</title>";
              echo "</head>";
              echo "<body bgcolor=\"#FFFFFF\" text=\"#000000\" style=\"font-family:Tahoma;font-size:10pt;\">";
              echo "$error";
          }
          else {
              echo "Login OK <br>";
              echo "Vorname: $vorname <br>";
              echo "Nachname: $nachname <br>";
          }*/

      }
     }
    }

?>
