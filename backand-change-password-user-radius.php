<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


$dbcon = mysqli_connect('localhost', 'radius', 'G@s%w&rJ', 'radius');


$curPassword  = $_POST['curPassword'];
$newPassword = $_POST['newPassword'];
$confirmPass = $_POST['confirmPassword'];
$username = preg_replace("/[^A-Za-z0-9. ]/", "", $_POST['username']);

$find_letters = array('{', '}', '[', ']', '*', '%','"',"'");
$msg = '';

try {
        if (strposa($curPassword, $find_letters) == true || strposa($newPassword, $find_letters) == true || strposa($confirmPass, $find_letters) == true)
                throw new Exception("Your password cannot contain single or double quotes, *, %, [], {}");

        if (!senhaValida($newPassword))
                throw new Exception($msg = "Password too weak");

        $dbPassword = mysqli_query($dbcon, "select username,value from radcheck where username = '$username'");
        $dbPassword = mysqli_fetch_assoc($dbPassword);
        $dbusername = $dbPassword['username'];
        $dbPassword = $dbPassword['value'];
        $curPassword = crypt($curPassword, 'SALT_DALORADIUS');

        $newPass = crypt($newPassword, 'SALT_DALORADIUS');

        if (empty($dbusername))
                throw new Exception("User does not exist");

        if ($newPassword <> $confirmPass)
                throw new Exception("Your passwords do not match");

        if($curPassword != $dbPassword)
                throw new Exception("Wrong current password");

        if (mysqli_query($dbcon, "UPDATE radcheck SET value='$newPass' WHERE username='$username'"))
                throw new Exception("You have successfully changed your password.");

        if (mysqli_error($dbcon))
                throw new Exception($dbcon);


        mysqli_close($dbcon);

}
catch (Exception $e) {
        $msg = $e->getMessage();
        header("location:change-password-user-radius.php?msg=$msg");
}

function strposa($haystack, $needles=array(), $offset=0) {
        $chr = array();
        foreach($needles as $needle) {
                $res = strpos($haystack, $needle, $offset);
                if ($res !== false) $chr[$needle] = $res;
        }
        if(empty($chr)) return false;
        return min($chr);
}
function senhaValida($senha) {
    return preg_match('/[a-z]/', $senha) // tem pelo menos uma letra minúscula
     && preg_match('/[A-Z]/', $senha) // tem pelo menos uma letra maiúscula
     && preg_match('/[0-9]/', $senha) // tem pelo menos um número
     && preg_match('/^[\w$@]{6,}$/', $senha); // tem 6 ou mais caracteres
}
?>



