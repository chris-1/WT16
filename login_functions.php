<?php
function ldap_anmeldung($loginname, $loginpw)
{
   $ldapserver = "ldap.technikum-wien.at";
   $searchbase = "dc=technikum-wien,dc=at";

   //$loginname = (isset($_POST['loginname']))?$_POST['loginname']:NULL;
   //$loginpw = (isset($_POST['loginpw']))?$_POST['loginpw']:NULL;

     $loginname = strtolower($loginname);
     $ds=ldap_connect($ldapserver);

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
				  //$_SESSION["username"]="1";
				  //header('Location: index.php');

			  }
          }
          ldap_close($ds);
          if (isset($error))
          {
			return false;
          }
          else {
			  return true;
			
		  }

      }

}


		function authenticateuser($user, $password)
		{
			if(ldap_anmeldung($user, $password))
			{
				return true;
			}
			elseif($user == "1" && $password == "1")
			{
				return true;
			}
			else
			{
				return false;
			}
		}

?>
