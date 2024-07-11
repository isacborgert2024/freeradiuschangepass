<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<title>Change Password Radius</title>
</head>
<body>
<b><font color="blue" size=5>
Passwords only in Crypt-Password format, minimum 6 characters with uppercase, lowercase and number.
<b></font size=5>
    <form name="frmChange" role="form" class="form-signin" method="POST" action="backand-change-password-user-radius.php">

  <div class="form-group">
    <label for="InputUser">User Name</label>
    <input type="text" class="form-control" id="InputUser" placeholder="User Name" name="username">
    <label for="InputPassword1">Current Password</label>
    <input type="password" class="form-control" id="InputPassword1" placeholder="Current Password" name="curPassword">
    <label for="InputPassword2">New Password</label>
    <input type="password" class="form-control" id="InputPassword2" placeholder="New Password" name="newPassword">
     <label for="InputPassword3">Confirm New Password</label>
    <input type="password" class="form-control" id="InputPassword3" placeholder="Confirm Password" name="confirmPassword">  </div>
  <button class="btn btn-lrg btn-default btn-block" type="submit" value="send">Change it</button>


      </div>


      </form>

</body>
</html>
<?php
if( isset($_GET['msg']) ) {
        echo '<script type="text/javascript">alert("' .$_GET['msg'] . '");</script>';
}
?>




