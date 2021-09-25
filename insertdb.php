<?php 

$dbHost = "localhost";
$dbUser = "phpmyadmin";
$dbPassword = "ttn";
$dbName = "testDB";

try {
  $dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
  $pdo = new PDO($dsn, $dbUser, $dbPassword);
} catch(PDOException $e) {
  echo "DB Connection Failed: " . $e->getMessage();
}

$status = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $contactno = $_POST['contactno'];

  if(empty($fname) || empty($lname) || empty($email) || empty($contactno)) {
    $status = "All fields are compulsory.";
  } else {
    if(strlen($fname) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $fname)) {
      $status = "Please enter a valid name";
    } 
    else if(strlen($lname) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $lname)) {
      $status = "Please enter a valid name";
    } 
    
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $status = "Please enter a valid email";
    } 
    
 else {

      $sql = "INSERT INTO test2 (firstname,lastname, email_id, contact_no) VALUES (:fname,:lname, :email, :contactno)";

      $stmt = $pdo->prepare($sql);
      
      $stmt->execute(['fname' => $fname,'lname'=> $lname, 'email' => $email, 'contactno' => $contactno]);

      $status = "Your message was sent";
      $fname = "";
      $lname ="";
      $email = "";
      $contactno = "";
    }
  }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>Registration form</title>
</head>

<body>

  <div class="container">
    <h1>Register Here</h1>

    <form action="" method="POST" class="main-form">
      <div class="form-group">
        <label for="fname">First Name</label>
        <input type="text" name="fname" id="fname" class="gt-input"
          value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $fname ?>">
      </div>
      
       <form action="" method="POST" class="main-form">
      <div class="form-group">
        <label for="lname">Last Name</label>
        <input type="text" name="lname" id="lname" class="gt-input"
          value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $lname ?>">
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" class="gt-input"
          value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $email ?>">
      </div>
        <form action="" method="POST" class="main-form">
      <div class="form-group">
        <label for="contactno">Contact No</label>
        <input type="text" name="contactno" id="contactno" class="gt-input"
          value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $contactno ?>">
      </div>
      
      <input type="submit" class="gt-button" value="Submit">

      <div class="form-status">
        <?php echo $status ?>
      </div>
    </form>
  </div>

  <script src="main.js"></script>

</body>

</html>
