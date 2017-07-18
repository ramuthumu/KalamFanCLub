<?php include('templates/header.html');?>

<h2>Administrative Functions</h2>

<?php
error_reporting(E_ALL ^ E_NOTICE);
if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
         
  $r= $_SESSION['username'];              



if($conn=mysqli_connect('localhost','web_user','webpassword')){
 mysqli_select_db($conn,"fanclub");

if($_POST['submit']){
   $u=$_POST['username'];
$q1="select status from users where username='$u'";
$r= mysqli_query( $conn,$q1);
while($rs=mysqli_fetch_assoc($r)){
    $s="{$rs['status']}";
    echo"$s";
    }
    $q2="select admin from users where username='$u'";
    $re=mysqli_query( $conn,$q2);
    while($res=mysqli_fetch_assoc($re)){
        $a="{$res['admin']}";
        
    }
    ?>
<form action="status.php" method="post">
	
        Account Options:<br>
  <input type="radio" name="status" value="Open" <?php if(isset($s)) {if($s == 'OPEN') echo "checked = 'checked'" ;}?> > Open<br>
  <input type="radio" name="status" value="Locked" <?php if(isset($s)) {if($s =='LOCKED') echo "checked = 'checked'" ;}?> > Locked<br>
  <input type="radio" name="status" value="Admin"> <?php if($a=='N') {echo 'Grant Administrator Role';}else{echo'Revoke Administrator Role';}?><br>
  <input type="radio" name="status" value="Delete"> Delete This Account<br>  
  <input type="hidden" name="use" value="<?php echo"$u"; ?>"
         <p><input type="submit" name="user" value="submit" /></p>
 </form> 

<?php
}
 

else{ 
                      $cad="select admin from users where username='$username'";
                      $cad1=mysqli_query($conn,$cad);
                      while ($cad2=mysqli_fetch_assoc($cad1)){
                      $cad3=$cad2['admin'];}
        if ($cad3=='N'){
      
      echo"You are Not an administrator You have to be an administrator to acces this page";
                      } else {
  

$sql = "SELECT username FROM users where username!='$r'";
$result = mysqli_query($conn,$sql);
echo'<form action="admin.php"method="post"';
echo "<b>USERNAME</b>: <select name='username'>";
while ($row = mysqli_fetch_array($result)) {
    echo "<option value='" . $row['username'] ."'>" . $row['username'] ."</option>";
 }
echo "</select>";



echo'<t> <input type="submit" name="submit" value="Submit" />';
}}}
else{echo'';}
}
else{echo'PLease Login to continue and Remember only administators can access this page';}
?>

<?php include('templates/footer.html');?>
