<?php
session_start(); 

include('../control/updatecheck.php');


if(empty($_SESSION["username"])) // Destroying All Sessions
{
header("Location: ../control/login.php"); // Redirecting To Home Page
}

?>

<!DOCTYPE html>
<html>
<body>
<h2>Profile Page</h2>

Hii, <h3><?php echo $_SESSION["username"];?></h3>
<br>Your Profile Page.
<br><br>
<?php
$radio1=$radio2=$radio3="";
$firstname=$email="";
$connection = new db();
$conobj=$connection->OpenCon();

$userQuery=$connection->CheckUser($conobj,"student",$_SESSION["username"],$_SESSION["password"]);

if ($userQuery->num_rows > 0) {

    // output data of each row
    while($row = $userQuery->fetch_assoc()) {
      $firstname=$row["firstname"];
      $email=$row["email"];
     
      if(  $row["gender"]=="female" )
      { $radio1="checked"; }
      else if($row["gender"]=="male")
      { $radio2="checked"; }
      else{$radio3="checked";}

      if( $row["profession"]=="Accountant")
      { $option1="selected";}
      else if( $row["profession"]=="Doctor")
      { $option2="selected";}
      else if( $row["profession"]=="Engineer")
      { $option3="selected";}
      else if( $row["profession"]=="Teacher")
      { $option4="selected";}
      else if( $row["profession"]=="Lawyer")
      { $option5="selected";}
      else if( $row["profession"]=="Driver")
      { $option6="selected";}
      else if( $row["profession"]=="Pharmacist")
      { $option7="selected";}
      else
      { $option8="selected";}
   
  } 
}
  else {
    echo "0 results";
  }



?>
<form action='' method='post'>
Firstname : <input type='text' name='firstname' value="<?php echo $firstname; ?>" >
<br>

Password: <input type="text" name='password' value="<?php echo $password; ?>">
<br>

Email : <input type='text' name='email' value="<?php echo $email; ?>" >
<br>

Address:<input type="text" name='address' value="<?php echo $address; ?>">
<br>

Date:<input type="date" name='dob' value="<?php echo $dob; ?>">

<br><br>
 Gender:
     <input type='radio' name='gender' value='female'<?php echo $radio1; ?>>Female
     <input type='radio' name='gender' value='male' <?php echo $radio2; ?> >Male
     <input type='radio' name='gender' value='other'<?php  $radio3; ?> > Other
     <br><br>

     <h2>INTERESTS</h2>

     <form action="/action_page.php" method="get">
  <input type="checkbox" name="surfing" value="surfing">
  <label for="surfing"> Surfing</label><br>
  <input type="checkbox" name="swmming" value="swmming">
  <label for="swmming">Swmming </label><br>
  <input type="checkbox" name="cycling" value="cycling">
  <label for="cycling">Cycling </label><br>
  <input type="checkbox" name="drawing" value="drawing" checked>
  <label for="drawing">Drawing </label><br><br>

  <?php
  $str = "Value"."+"."Value"."+"."Value"."+"."Value";
  
  echo"<br>";
  $pattern ="/[\+]/";
  $splitteddata = preg_split($pattern,$str);
  echo sizeof($splitteddata);
?>
<br>
     <input name='update' type='submit' value='Update'>  

     <?php echo $error; ?>
<br>
<br>
<a href="../view/pageone.php">Back </a>

<a href="../control/logout.php"> logout</a>

</body>
</html