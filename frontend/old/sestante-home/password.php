<?php

/* change .. me! - shell script name*/
$shellscript = "sudo /var/www/theta/data/script/chpasswdWEB";

/* Make sure form is submitted by user*/
if(!(isset($_POST['pwdchange']))) {
 /* if not display them form*/
 writeForm();
}
else {
 /* try to change the password*/
 $callshell=true;
 /* get username and password*/
 $_POST['username'] = stripslashes(trim($_POST['username']));
 $_POST['passwd'] = stripslashes(trim($_POST['passwd']));
echo "".crypt($_POST['passwd'])."";
/* if user skip our javascript �
   make sure we can only change password if we have both username and password*/
 if(empty($_POST['username'])) {
   $callshell=false;
 }
 if(empty($_POST['passwd'])) {
   $callshell=false;
 }
 if ( $callshell == true ) {
  /* command to change password*/
  $cmd="$shellscript " . $_POST['username'] . " " . $_POST['passwd'];
  /* call command
     $cmd - command, $output - output of $cmd, $status - useful to find if command failed or not*/
   exec($cmd,$output,$status);
   if ( $status == 0 ) { /* Success - password changed*/
   echo "Password changed";
if (CRYPT_MD5 == 1)
echo "".crypt($_POST['passwd'], '$1$')."";
   echo '<h3>Password changed</h3><a href='. $_SERVER[PHP_SELF] . '>Home page</a>';
   }
   else { /* Password failed*/
      echo 'Password change failed';
      echo '<h3>Password change failed</h3>';
      echo '<p>System returned following information:</p><pre>';
      print_r($output);
      echo '</pre>';
      echo '<p><em>Please contact tech-support for more info! Or try <a href=�.$_SERVER[�PHP_SELF�].�again</a></em></p>';
   }
 }
 else {
  echo 'Error - Please enter username and password';
 }
}

function writeForm() {

echo '<h3>Use following form to change password:</h3>';

echo '
<form action="" method="post" name="changepassword">
<div>User Name:</div>
<div<input type="text" name="username" size=""30" maxlength="50" value=""> (required)</div>
<div>Password:</div>
<div><input type="password" name="passwd" size="30" maxlength="50" value=""> (required)</div>
<div><input type="submit" name="Submit" value="Change password">
<input type="hidden" name="pwdchange"></div>
</form>';

}

?>