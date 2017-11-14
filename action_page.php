
<html>
<body>
<?php
$uname = $pword = $email = "";
$unameErr = $pwordErr = $emailErr = "";
if (empty($_POST["uname"])) {
  $unameErr = "User name is required";
}
else {
  $uname = htmlspecialchars($_POST["uname"]);
}
if (empty($_POST["pword"])) {
  $pwordErr = "Password is required";
}
else {
  $pword = htmlspecialchars($_POST["pword"]);
}
if (empty($_POST["email"])) {
  $emailErr = "Email is required";
}
else {
  $email = htmlspecialchars(stripslashes(trim($_POST["email"])));
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $emailErr = "Invalid email format";
}

$uid = stripslashes(trim($uname));

$dbh = new PDO('pgsql:dbname=Writing_Site;user=postgres;password=LMLsMTU89;host=localhost');

$date = DateTime::__construct();
$dbh->beginTransaction();
$dbh->exec("INSERT INTO Internal_Profiles (uname, uid, email, join_date, profile_text, loud_mail, loud_marks, loud_comms)
VALUES ($uname, $uid, $email, $date, null, true, true, true)");
$dbh->exec("CREATE USER tester2 WITH ENCRYPTED PASSWORD $pword;
ALTER GROUP reg_users ADD USER $uid");
$dbh->commit();
?>
</body>
</html>
