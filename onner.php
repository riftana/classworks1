!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 

<?php
class User
 {
  
  public $name;
  public $gender;
  public $blood;
  public $degree;
  public $email;
  public $date;
  
   function __construct($name,$email,$date,$gender,$degree,$blood) 
   {
	   
    $this->name = $name;
	
	$this->email = $email;
	
	$this->gender = $gender;
	
    $this->blood = $blood;
	
	$this->degree = $degree;
	
	$this->date = $date;
	
   }
  

  
  function set_name($name) {
    $this->name = $name;
  }
  
  function get_name() 
  {
    return $this->name;
  }
   function set_email($email)
   {
    $this->email = $email;
  }
  function get_email()
  {
    return $this->email;
  }
  function set_gender($gender)
  {
    $this->gender = $gender;
  }
  function get_gender()
  {
    return $this->gender;
  }
  function set_blood($blood)
  {
    $this->blood = $blood;
  }
  function get_blood() 
  {
    return $this->blood;
  }
  function set_degree($degree)
  {
    $this->degree = $degree;
  }
  function get_degree()
  {
    return $this->degree;
  }
  function set_date($date)
  {
    $this->date = $date;
  }
  function get_date()
  {
    return $this->date;
  }
  
}
?>


<?php
$nameErr = $emailErr = $genderErr = $dateErr =$degreeErr= $bloodErr="";
$name = $email = $gender = $degree = $date = $blood="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }


  if (empty($_POST["degree"]))
  {
    $degreeErr = "Degree is required";
  }
  else
  {
    $degree = $_POST["degree"];
  }

  if (empty($_POST["gender"]))
  {
    $genderErr = "Gender is required";
  }
  else 
  {
    $gender = $_POST["gender"];
  }
  if (empty($_POST["blood"])) 
  {
    $bloodErr = "blood is required";
  } 
  else
  {
    $blood = $_POST["blood"];
  }


if (empty($_POST["date"])) 
  {
    $dateErr = "date is required";
  } 
  else
  {
    $date = $_POST["date"];
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<h2>Lab Task</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars ($_SERVER["PHP_SELF"]);?>">  
 <tr>
    <td><h4>
        Name:
      </h4> 

    </td>
    
    <td>
      <input type="text" name="name" value="<?php echo $name;?>">
      <span class="error">* <?php echo $nameErr;?></span>

    </td>
  </tr>
  <br><br>

  <tr>
    <td>
      <h4>
        Email:
      </h4>
    </td>
<td>
  <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
</td>
  </tr>
<br><br>
<tr>
  <td>
    Date of birth:
  </td>

  <td>
     <input type="date" name="date" value="<?php echo $date;?>">
<span class="error">* <?php echo $dateErr;?></span>
  </td>




</tr>
<br><br>

<tr>
  <td>
    Gender:
  </td>

  <td>
    
    <input type="radio" name="gender"<?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
    <input type="radio" name="gender"<?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  </td>
</tr>
<br><br>
<tr>
  <td>
    Degree:
  </td>
  <td>
    <input type="checkbox" name="degree" <?php if (isset($degree) && $degree=="Bsc") echo "checked";?> value="Bsc">Bsc
    <input type="checkbox" name="degree" <?php if (isset($degree) && $degree=="msc") echo "checked";?> value="msc">msc
    <input type="checkbox" name="degree" <?php if (isset($degree) && $degree=="phd") echo "checked";?> value="phd">phd
  </td>
</tr>
<br><br>
<tr>
  <td>
    Blood Group:
  </td>
  <td>
    
    <select name="Blood">
        <option <?php if (isset($blood) && $blood=="B+") echo "checked";?> value="B+">B+</option>
        <option <?php if (isset($blood) && $blood=="c+") echo "checked";?> value="c+">c+</option>
        <option <?php if (isset($blood) && $blood=="d+") echo "checked";?> value="d+">d+</option>
        <option <?php if (isset($blood) && $blood=="e+") echo "checked";?> value="e+">e+</option>
      </select>
  </td>
</tr>
<tr>
<td><input name="submit" type="submit" /></td></tr> 
</form>




<?php
echo "<h2>"." data for : ".$name.":</h2>";

$user = new User($name,$email,$date,$gender,$degree,$blood);

echo $user->get_name();

echo "<br>";

echo $user->get_email();

echo "<br>";

echo $user->get_date();

echo "<br>";

echo $user->get_degree();

echo "<br>";

echo $user->get_gender();

echo "<br>";

echo $user->get_blood();
?>

<?php

$file = fopen("User Info.txt", "w") or die("Unable to open file!");

$data = $user->get_name()."\n";

fwrite($file, $data);

$data = $user->get_email()."\n";

fwrite($file, $data);

$data = $user->get_date()."\n";

fwrite($file, $data);

$data = $user->get_gender()."\n";

fwrite($file, $data);

$data = $user->get_degree()."\n";

fwrite($file, $data);

$data = $user->get_blood()."\n";

fwrite($file, $data);

fclose($file);


?>




</body>
</html>



<?php

	$dom = new DOMDocument();

		$dom->encoding = 'utf-8';

		$dom->xmlVersion = '1.0';

		$dom->formatOutput = true;

	$xml_file_name = 'user_list.xml';

		$root = $dom->createElement('Users');

		$user_node = $dom->createElement('User');

		$attr_name = new DOMAttr('Name', $user->name);

		$user_node->setAttributeNode($attr_name);

	$child_node_email = $dom->createElement('Email',$user->email);

		$user_node->appendChild($child_node_email);

		$child_node_date = $dom->createElement('Year',$user->date);

		$user_node->appendChild($child_node_date);

	$child_node_blood = $dom->createElement('Blood',$user->blood);

		$user_node->appendChild($child_node_blood);

		$child_node_degree = $dom->createElement('Degree', $user->degree);

		$user_node->appendChild($child_node_degree);

		$root->appendChild($user_node);

		$dom->appendChild($root);

	$dom->save($xml_file_name);

	echo "$xml_file_name has been successfully created";
?>
