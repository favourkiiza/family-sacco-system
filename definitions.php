<?php
/*
-login into the system
-add members into the system
-add investment details into the system
-accept or deny loan requests
*/


function register(){                           // function for registering members into the system
if(isset($_POST['giveout'])){
$name=$_POST['member_name'];
$initial=$_POST['initial'];
$username=$_POST['member_username'];
$code=$_POST['securitycode'];

$conn=mysqli_connect("localhost","root","123456");

$create="CREATE DATABASE IF NOT EXISTS familysacco";
$cre=mysqli_query($conn,$create);
mysqli_select_db($conn,"familysacco");
$table="CREATE TABLE IF NOT EXISTS members( `id` INT(3) NOT NULL AUTO_INCREMENT , `name` VARCHAR(20) NOT NULL ,intialcontribution DOUBLE NOT NULL, `username` VARCHAR(20) 
NOT NULL , `password` VARCHAR(10) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB";
$y=mysqli_query($conn,$table);
if(!empty($username) && !empty($code) && !empty($name)){
$insert="INSERT INTO members VALUES(NULL,'$name','$initial','$username','$code')";
mysqli_query($conn,$insert);
echo"Thanks for registering with Family Sacco<br>You are now a member";
}
else{
    ?>
    <script type="text/javascript">
           alert('Oops!! Please you have not been registered!\nEnter missing details to register');
               </script>
    <?php
    }
}
?>

<!--$do = $_POST['func_name'];
if (function_exists($do)) {
  register();
}-->

<div>
<br>
<div id="list">
<br><br><br>
<h5><i>Add members to family sacco</i></h5>
<form name="form1" id="mem" method="POST" action="<?php echo $form1 ?>">
<table id="hoho">
<tr>
<td><span id="nameput"></span></td>
</tr>
<tr>
<td><input type="text" name="member_name" placeholder="enter member's name" onmouseover="memn();" onblur="validate();"></td>
<td><span id="nameErr"></span></td>
</tr>
<tr>
<td><input type="text" name="initial" placeholder="Intitial contribution"/>
</tr>
<tr>
<td><input type="text" name="member_username" placeholder="enter username" onblur="username();">
<td><span id="usernameErr"></span></td>
</tr>


<tr>
<td><input type="password" name="securitycode" placeholder="enter password" onblur="passcode();"></td>
<td><span id="passcodeErr"></span></td>
</tr>


<tr>
<td><input type="submit" name="giveout" value="SUBMIT" id="sub" onclick="give();"/>
<input type="reset" value="RESET" id="res"/></td>
<td><span id="$Err"></span></td>
</tr>
</table>
</form>
</div>

<?php }?>
<?php
function logout() {
session_start();

if(session_destroy()) // Destroying All Sessions
{
header("Location: index.php"); // Redirecting To Home Page
}
}
?>

<?php
function approval(){
	session_start();
	$conn=mysqli_connect("localhost","root","123456");
mysqli_select_db($conn,"familysacco");

echo"<form action='' method='post'>";
	 echo"<h5><i>To accept or deny reports</i></h5>";
	  echo"<input type='submit' name='accept' value='Accept' onclick='return deleteRow('ac')'/>";
	  echo"<input type='submit' name='deny' value='Deny'/>";
	echo"<table class='ac'>";
 $f = fopen("/home/saidat/Desktop/recess/SACCODATA.txt", "r") or exit("Unable to open file!");

    //include your connection around here so it is included only once
   

    // Read line by line until end of file
    while (!feof($f)) { 

    // Make an array using comma as delimiter
       $arrM = explode(' ',fgets($f)); 
    // Write links (get the data in the array)
        echo '<tr name="sa">
        <td><input type="checkbox" value="yes" name="chk" checked/><td>        
        <td>'.$arrM[0].'</td>
        <td>'.$arrM[1].'</td>
        <td>'.$arrM[2].'</td>
        <td>'.$arrM[3].'</td>
        <td>'.$arrM[4].'</td>
       <td>'.$arrM[5].'</td>
        </tr>';
       if (isset($_POST['accept'])) { 
         $contr="contribution";
         $idea="idea";
         $loan="loan_request";
                 if($contr == $arrM[0]) {      
            $sq = "INSERT INTO contributions VALUES (NULL,'$arrM[1]','$arrM[2]','$arrM[3]','$arrM[4]','accepted','$arrM[5]')"; //here should be $arrM
           
            if (!mysqli_query($conn,$sq)) {
              die('Error: ' . mysqli_error());
            } 
            }else if($idea == $arrM[0]) {      
            $ql = "INSERT INTO ideas VALUES (NULL,'$arrM[1]','$arrM[2]','$arrM[3]','$arrM[4]','accepted','$arrM[5]')"; //here should be $arrM
            if (!mysqli_query($conn,$ql)) {
              die('Error: ' . mysqli_error());
            } 
            }else if($loan == $arrM[0]) {      
            $sl = "INSERT INTO loan_request VALUES (NULL,'$arrM[1]','$arrM[2]','$arrM[3]','accepted','$arrM[4]')"; //here should be $arrM
            if (!mysqli_query($conn,$sl)) {
              die('Error: ' . mysqli_error());
            } 
            }                                        
            
            
            
            
                   
        }elseif(isset($_POST['deny'])) {
        
        $contr="contribution";
        $idea="idea";
        $loan="loan_request";
                 if($contr == $arrM[0]) {      
            $sql = "INSERT INTO contributions VALUES (NULL,'$arrM[1]','$arrM[2]','$arrM[3]','$arrM[4]','denied','$arrM[5]')"; //here should be $arrM
            if (!mysqli_query($conn,$sql)) {
              die('Error: ' . mysqli_error());
            } 
            } else if($idea == $arrM[0]) {      
            $sql = "INSERT INTO ideas VALUES (NULL,'$arrM[1]','$arrM[2]','$arrM[3]','$arrM[4]','denied','$arrM[5]')"; //here should be $arrM
            if (!mysqli_query($conn,$sql)) {
              die('Error: ' . mysqli_error());
            } 
            } else{      
            $sql = "INSERT INTO loan_request VALUES (NULL,'$arrM[1]','$arrM[2]','$arrM[3]','denied','$arrM[4]')"; //here should be $arrM
            if (!mysqli_query($conn,$sql)) {
              die('Error: ' . mysqli_error());
            } 
            }                                        
        
 
        
        }
    }

    fclose($f);
    mysqli_close($conn); //close your database connection here
    echo"</table>";
    echo"</form>";
 }
  ?>
<?php
function login() {?>
<form id="myform" method="post" action="">
<table>
<tr>
	<caption><strong>LOG INTO SYSTEM NOW</strong></caption>
</tr>
<tr>
<th>Type</th>
<td>
<select name="who">
    <option value="type" selected>choose type</option>
	<option value="admin">Administrator</option>
	<option value="member">member</option>
</select>
</td>
</tr>
<tr>
<th>Username</th>
<td><input type="text" name="username" id="username" value="<?php echo $username;?>">
<span class="error"><?php echo $usernameErr;?></span>
</td>
</tr>
<tr>
<th>password</th>
<td>
<input type="password" name="password" id="password" value="<?php echo $password;?>">
<span class="error"><?php echo $passwordErr;?></span>
</td>
<td>
<span class="error"><?php echo $adminErr;?></span>
<span class="error"><?php echo $memErr;?></span>
<span class="error"><?php echo $typeErr;?></span>
</td>
</tr>
<tr>
	<td><input type="checkbox" name="remember"></td>
	<td>Remember me</td>
</tr>
</table>
<input type="submit" name="login" value="login" id="login"/>
<input type="reset" name="clear" value="Reset" id="reset"/>
</form>
<?php } ?>

<?php
session_start();
$adminErr= $memErr= $typeErr= $usernameErr=$passwordErr= "";
$username= $password= $type= "";
if(isset($_POST['login'])){
	$username=$_POST['username'];
	$password=$_POST['password'];
	$type=$_POST['who'];
		if(isset($_POST['who'])){
		  if($type=="admin"){
		  $conn=mysqli_connect("localhost","root","123456");
		  	mysqli_select_db($conn,"familysacco");


		  	$choose="SELECT * FROM admin";
		  	$get=mysqli_query($conn,$choose);
		  	$row=mysqli_fetch_row($get);
		  	$name=$row[0];
		  	$passcode=$row[1];
			if(empty($username)){
			$usernameErr="missing username";
			}
			elseif(empty($password)){
			$passwordErr="missing password";
			}
			elseif($username==$name && $password==$passcode){
		session_start();
		$_SESSION['username']=$username;
		$_SESSION['type']=$type;
		
	}
		else{
			$adminErr="Dear administrator,you have entered invalid username or password";
		}
	}


	elseif($type=="member"){  
	   $conn=mysqli_connect("localhost","root","123456");
	    mysqli_select_db($conn,"familysacco");
	    $mytab="SELECT *  FROM members";
	    $next=mysqli_query($conn,$mytab);
	    $myrows=mysqli_fetch_row($next);
	    $mem_username=$myrows[3];
	    $mem_password=$myrows[4]; 
             	if(empty($username)){
			$usernameErr="missing username";
			}
			elseif(empty($password)){
			$passwordErr="missing password";
			}		 
		elseif($username==$mem_username && $password==$mem_password){
	
		
		$_SESSION['username']=$mem_username;
		$_SESSION['type']=$type;
		
		// if success: sends it to calls.php (code below)
	}
	else{
		$memErr="Dear member,you have entered invalid username or password";
	}
	}
	else{
	$typeErr="no type selected";
}
}
}



?>

<?php
function investments(){ 
session_start();                //function for displaying webpage of entering investment details
$conn=mysqli_connect("localhost","root","123456");
mysqli_select_db($conn,"familysacco");

if(isset($_POST['giveme'])){          // php code for adding investment details into the system
$idea=$_POST['idea'];
$date=$_POST['dateinv'];
$price=$_POST['invprice'];
$amount=$_POST['money'];




$cre="CREATE TABLE `investments` ( `id` INT(3) NOT NULL AUTO_INCREMENT ,
 `idea` VARCHAR(20) NOT NULL , `investdate` DATE NOT NULL ,
 `price` INT(13) NOT NULL , `amount` INT(10) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB";
mysqli_query($conn,$cre); 

if(!empty($idea) && !empty($date) && !empty($price)){
	$p="INSERT INTO investments VALUES (NULL,'$idea','$date','$price','$amount')";
	mysqli_query($conn,$p);
}
else{
    ?>
    <script type="text/javascript">
           alert('Oop!! Impartial details not submitted\nEnter missing details to submit investment details');
               </script>
    <?php
}
  }                 
?>
<?php
if(isset($_POST['give'])){
        echo "
            <script type=\"text/javascript\">
            var e = document.getElementById('ideas'); e.action='better.php'; e.submit();
            </script>
        ";
     }
?>

<script type="text/javascript">    

function idea(){
	if(form2.idea.value.length==0){
           document.getElementById('ideaErr').innerHTML="idea must not be null!";
           form2.idea.focus();
           return false;
            
       }
        
        }
function when(){
       if(form2.dateinv.value.length==0){
           document.getElementById('dateErr').innerHTML="date of investment shouldn't empty";
           form2.dateinv.focus();
           return false;
            
       }
}
function price(){
            if(form2.invprice.value.length==0){
           document.getElementById('priceErr').innerHTML="Empty initial investment price";
             form2.invprice.focus();
             return false;
             
                   }	
}
function profit(){
            if(form2.profits.value.length==0){
           document.getElementById('profitsErr').innerHTML="Empty value of profits";
             form2.profits.focus();
             return false;
             
                   }	
}
function loss(){
            if(form2.losses.value.length==0){
           document.getElementById('lossesErr').innerHTML="Empty value of losses";
             form2.losses.focus();
             return false;}	
}
function give(){
if(form2.idea.value.length==0 && form2.dateinv.value.length==0 && form2.invprice.value.length==0 &&
    form2.profits.value.length==0 && form2.losses.value.length==0){
    document.getElementById('Errs').innerHTML="Enter missing information before submitting";
}
}
function deleteRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[0];
		if(chkbox !=null && chkbox.checked==true) {
			if(rowCount <= 2) {               // limit the user from removing all the fields
				alert("Cannot Remove all the items.");
				break;
			}
			else {
			table.deleteRow(i);
			rowCount--;
			i--;
		}
		}
	}
}
</script>
<div>
<br>
<div id="list">
<br><br>
<h5><i>Enter investment details</i></h5>
<form name="form2" method="post" action="" id="ideas">
<table id="tabs">
<tr>
</tr>
<tr>
<td><input type="text" name="idea" placeholder="enter investment idea" onblur="idea();"/></td>
<td><span id="ideaErr"></span></td>
</tr>
<tr>
<td><input type="date" name="dateinv" placeholder="enter date of investment" onblur="when();"/></td>
<td><span id="dateErr"></span></td>
</tr>
<tr>
<td><input type="text" name="invprice" placeholder="enter initial investment price" onblur="price();"/></td>
<td><span id="priceErr"></span></td>
</tr>
<tr>
<td>
<input type="text" name="money" placeholder="Enter value of profits(+)losses(-)"/>
</td>
</tr>
</table>
<input type="submit" name="giveme" value="submit" id="sub" onclick="return true" />
<input type="reset" value="reset" id="res"/>
<span id="Errs"></span>
<br/><br/>
</form>
</div></div>
</body>

<?php }?>


<?php
function reports(){              // function for displaying webpage for retrieving reports from the system

?>

<div>
<br>
<div id="retrieve">
<br><br>
<h5><i>Select a report</i></h5>
<form method="post" id="reports">
<table>
<tr>
<td>
<select name="report">
<option selected>select report to view</option>
<option value="members">list of regular members</option>
<option value ="benefits">Distribution of benefits</option>
<option value="approved_loans">Approved loans</option>
<option value="approved_contribution"> Approved contributions</option>
<option  value="loanees">members still paying loans</option>
<option value="credits">members defaulting from loans</option>
<option value="working">Best and worst performing ideas</option>
<option value="ideas">List of business ideas</option> 
</select>
</td>
<td><input type="submit" name="reports" value="view" id="see"/></td>
</tr>
<tr>
<td>

<?php    
session_start();             // php function for retrieving reports from the database
$view=$_POST['report'];
$conn=mysqli_connect("localhost","root","123456");
mysqli_select_db($conn,"familysacco");
if(isset($view)){


if($view=="members"){
$choose="SELECT * FROM members";
$result=mysqli_query($conn,$choose);
echo"<table border='1' cellspacing='0'style='margin-left:6%;color:black;text-align:center;font-size:10pt' ><caption style='color:white'><th style='color:green'>id</th><th style='color:green'>Name</th></caption>";
WHILE($rows=mysqli_fetch_array($result)):
$id=$rows['0'];
$name=$rows['1'];
echo"<tr><td>$id</td><td>$name</td></tr>";
endwhile;
echo"</table>";
}

else if($view=="ideas"){
$a="SELECT * FROM ideas";
$b=mysqli_query($conn,$a);
echo"<table border='1' cellspacing='0'style='margin-left:6%;color:black;text-align:center;font-size:10pt' >
<caption><th colspan='3' style='color:green;font-size:10pt'>List of investment ideas</th></caption>
<tr><td style='color:blue'>ID</td>
<td style='color:blue'>Name</td><td style='color:blue'>initial <br>capital</td></tr>";
WHILE($myrows=mysqli_fetch_array($b)):
$idea=$myrows[0];
$date=$myrows[2];
$price=$myrows[3];
echo"<tr><td>$idea</td><td>$date</td><td>$price</td></tr>";
endwhile;
echo"</table>";
}


else if($view=="credits"){
$a="SELECT * FROM creditors";
$b=mysqli_query($conn,$a);
echo"<table border='1' cellspacing='0'style='margin-left:6%;color:black;text-align:center;font-size:10pt' >
<caption><th colspan='3' style='color:green;font-size:8pt'>members defaulting from loans</th></caption>
<tr><td style='color:blue'>creditor's name</td><td style='color:blue'>unpaid Amount</td></caption>";
WHILE($myrows=mysqli_fetch_array($b)):
$creditors_name=$myrows[0];
$amount=$myrows[1];

echo"<tr><td>$creditors_name</td><td>$amount</td></tr>";
endwhile;
echo"</table>";
}

else if($view=="approved_loans"){
$a="SELECT * FROM loan_request WHERE status='accepted'";
$b=mysqli_query($conn,$a);
echo"<table border='1' cellspacing='0'style='margin-left:6%;color:black;text-align:center;font-size:10pt' >
<caption><th colspan='2' style='color:green;font-size:8pt'>Approved Loan Requests</th></caption>
<tr><td style='color:blue'>Member's name</td><td style='color:blue'>Loan Amount</td></tr>";
WHILE($myrows=mysqli_fetch_array($b)):
$name=$myrows[1];
$status=$myrows[2];
echo"<tr><td>$name</td><td>$status</td></tr>";
endwhile;
echo"</table>";
}

else if($view=="loanees"){
$a="SELECT*FROM Loanees";
$b=mysqli_query($conn,$a);
echo"<table border='1' cellspacing='0'style='margin-left:6%;color:black;text-align:center;font-size:10pt' >
<caption><th colspan='3' style='color:green;font-size:8pt'>members still paying loans</th></caption>
<tr><td style='color:blue'>Member's name</td><td style='color:blue'>unpaid amount</td><td style='color:blue'>paid amount</td></caption>";
WHILE($myrows=mysqli_fetch_array($b)):
$name=$myrows[0];
$paid=$myrows[1];
$unpaid=$myrows[2];
echo"<tr><td>$name</td><td>$paid</td><td>$unpaid</td></tr>";
endwhile;
echo"</table>";
}

else if($view=="approved_contribution"){
$a="SELECT*FROM contributions";
$b=mysqli_query($conn,$a);
echo"<table border='1' cellspacing='0'style='margin-left:6%;color:black;text-align:center;font-size:10pt' >
<caption><th colspan='3' style='color:green;font-size:8pt'>Approved contributions</th></caption>
<tr><td style='color:blue'>id</td><td style='color:blue'>Member Name</td><td style='color:blue'>Contribution Amount</td></tr>";
WHILE($myrows=mysqli_fetch_array($b)):
$name=$myrows[0];
$paid=$myrows[1];
$unpaid=$myrows[2];
echo"<tr><td>$name</td><td>$paid</td><td>$unpaid</td></tr>";
endwhile;
echo"</table>";
}


else if($view=="working"){
$a="SELECT * FROM investments WHERE profit >0";
$b=mysqli_query($conn,$a);
echo"<table><tr><td>";
echo"<table border='1' cellspacing='0'style='margin-left:6%;color:black;text-align:center;font-size:10pt' >
<caption><th colspan='2' style='color:green;font-size:8pt'>Best performing ideas</th></caption>
<tr><td style='color:blue'>Investment idea</td><td style='color:blue'>Financial result</td></tr>";
WHILE($myrows=mysqli_fetch_array($b)):
$idea_name=$myrows[1];
$type=$myrows[4];
echo"<tr><td>$idea_name</td><td>$type</td></tr>";
endwhile;
echo"</table>";
echo"</td><td>";

$a="SELECT * FROM investments WHERE profit<0";
$b=mysqli_query($conn,$a);
echo"<table border='1' cellspacing='0'style='margin-left:6%;color:black;text-align:center;font-size:10pt' >
<caption><th colspan='2' style='color:green;font-size:8pt'>Worst performing ideas</th></caption>
<tr><td style='color:blue'>Investment idea</td><td style='color:blue'>Financial result</td></tr>";
WHILE($myrows=mysqli_fetch_array($b)):
$idea_name=$myrows[1];
$type=$myrows[4];
echo"<tr><td>$idea_name</td><td>$type</td></tr>";
endwhile;
echo"</table>";
echo"</td></tr></table>";
}
else if($view=="return_on_investment"){
$a="SELECT * FROM investmentIdeas WHERE moneytype='profit'";
$b=mysqli_query($conn,$a);
$totalprofits=0;
WHILE($myrows=mysqli_fetch_array($b)):
$totalprofits+=$myrows[4];
endwhile;
$p="SELECT * FROM investment WHERE profit<0";
$q=mysqli_query($conn,$p);
$totallosses=0;
WHILE($myrows=mysqli_fetch_array($q)):
$totallosses+=$myrows[4];
endwhile;
echo"<table border='1' cellspacing='0'style='margin-left:6%;color:black;text-align:center;font-size:10pt' >
<caption><th colspan='2' style='color:green;font-size:8pt'>Income Statement</th></caption>
<tr><td style='color:blue'>Total profits</td><td style='color:red;font-size:10pt'>$totalprofits</td></tr>
<tr><td style='color:blue'>Total losses</td><td style='color:red;font-size:10pt'>$totallosses</td></tr>";
}

else if($view=="benefits"){
$a="SELECT * FROM investments WHERE profit>0";
$b=mysqli_query($conn,$a);
$totalprofits=0;
WHILE($myrows=mysqli_fetch_array($b)):
$totalprofits+=$myrows[4];
endwhile;
$savings=0.3*$totalprofits;
$shared_profits=0.65*$totalprofits;
echo"<p style='color:green;font-size:10pt'>Total profits made so far:
      <span style='color:red;font-size:10pt'>$totalprofits</span></p>";
echo"<p style='color:green;font-size:10pt'>Family Sacco savings made so far(30% of total profits):
           <span style='color:red;font-size:10pt'>$savings</span></p>";
echo"<p style='color:green;font-size:10pt'>65% of total profits to be shared amongst members:
           <span style='color:red;font-size:10pt'>$shared_profits</span></p>";

$x="SELECT * FROM contributions WHERE status='accepted'";
$y=mysqli_query($conn,$x);
$total_contributions=0;
WHILE($rows=mysqli_fetch_array($y)):
$d=$rows[2];
$total_contributions+=$d;
endwhile;
echo"<p style='color:green;font-size:10pt'>Total contributions made so far by all members:
           <span style='color:red;font-size:10pt'>$total_contributions</span></p>";

$l="SELECT name,amount FROM contributions WHERE status='accepted'";
$m=mysqli_query($conn,$l);
echo"<table border='1' cellspacing='0'style='margin-left:6%;color:black;text-align:center;font-size:10pt' >
<caption><th colspan='3' style='color:blue;font-size:8pt'>Members with their shares</th></caption>
<tr><td style='color:green'>Member's name</td><td style='color:green'>Shares(in %)</td><td style='color:green'>Benefits</td></tr>";
WHILE($rows=mysqli_fetch_array($m)):
$member_name=$rows['name'];
$f=$rows['amount'];
$share_precentage=($f/$total_contributions)*100;
$benefits=$share_precentage*$shared_profits;
/*$percent=$f / $total_contribution;*/
echo"<tr><td>$member_name</td><td>$share_precentage</td><td>$benefits</td></tr>";
endwhile;
}

else{
echo"<p style='color:red;font-size:10pt'>please select a report</p>";
}
}
?>
</td>
</tr>
</form>

</div>
</div>
<?php }?>


 
