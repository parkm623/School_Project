<!DOCTYPE html>
<html>
<head>
        <title>Hospital Database</title>
        <link rel="stylesheet" type="text/css" href="hospital.css">
        <link href="https://fonts.googleapis.com/css?family=Mali" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<?php
  include "connecttodb.php";
 ?>
 <h1 class="text-center">Hospital Database </h1>
 <br><br><hr>

 <body>
<div class="container">
        <form action method="post">
            <div class="row">
                <div class="col">
                    <button type="btnApply" class="btn btn-success btn-lg" name="apply" value ="apply">Apply</button>
                </div>
                <div class="col">
                    <h4>Check Field</h4>
                    <div class="form-check">
                                          <input class="form-check-input" type="radio" name="radioField" value="lastname" id="radioFieldlastname" checked>
                                          <label class="form-check-label" for="radioFieldlastname">
                                            Last Name
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="radioField" value="birthdate" id="radioFieldbirthdate">
                                          <label class="form-check-label" for="radioFieldbirthdate">
                                            Birthdate
                                          </label>
                                        </div>
                                </div>
                <div class="col">
                    <h4>Check Order</h4>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radioOrder" value="ascending" id="radioOrderascending" checked>
							<label class="form-check-label" for="radioOrderascending">
                            Ascending
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="radioOrder" value="descending" id="radioOrderdescending">
                        <label class="form-check-label" for="radioOrderdescending">
                            Descending
                        </label>
                    </div>
                </div>
                                <div class="col">
                    <h5>Check Specialties</h5>
                    <select class="form-select" name="specialties" aria-label="specialties">
                        <option value="">Select speciality</option>
                                                <?php
                                                   $query = "SELECT DISTINCT speciality FROM doctor;";
                                                   $result = mysqli_query($connection,$query);
                                                   if (!$result) {
                                                    die("databases query failed.");
                                                   }
                                                   while ($row = mysqli_fetch_assoc($result)) {
                                                   echo "<option>";
                                                   echo $row["speciality"] ;
                                                   echo "</option>";
                                                   }
                                                    mysqli_free_result($result);
                                                ?>
                                                </select>
                </div>
            </div>
        </form>
        <div class="row mt-4 mb-2">
            <h2>Table</h2>
			<hr>
         </div>
        <div class="row">
                <table class="table">
                    <tr>
                        <th>License Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>License Date</th>
                        <th>Birth Date</th>
                        <th>Works At</th>
                        <th>Speciality</th>
                    </tr>
                    <tr>
						<?php
						     if(isset($_POST['apply'])){
                                 if(isset($_POST["radioField"])&& ($_POST["radioField"] == "lastname")){
                                    if(isset($_POST["radioOrder"]) && ($_POST["radioOrder"] == "ascending")){
                                        if(!empty($_POST['specialties'])) {
                                                $selected = $_POST['specialties'];
                                                $query = "SELECT * FROM doctor WHERE speciality = '$selected' ORDER BY lastname ASC;";}
                                        else{
                                                $query = "SELECT * FROM doctor ORDER BY lastname ASC;";}
                                        }
                                    else if(isset($_POST["radioOrder"]) && ($_POST["radioOrder"] == "descending")){
                                        if(!empty($_POST['specialties'])) {
                                                $selected = $_POST['specialties'];
                                                $query = "SELECT * FROM doctor WHERE speciality = '$selected' ORDER BY lastname DESC;";}
                                        else{
                                                $query = "SELECT * FROM doctor ORDER BY lastname DESC;";}
                                        }
                                }else if(isset($_POST["radioField"])&& ($_POST["radioField"] == "birthdate")){
                                    if(isset($_POST["radioOrder"]) && ($_POST["radioOrder"] == "ascending")){
                                        if(!empty($_POST['specialties'])) {
                                                $selected = $_POST['specialties'];
                                                $query = "SELECT * FROM doctor WHERE speciality = '$selected' ORDER BY birthdate ASC;";}
                                        else{
                                                $query = "SELECT * FROM doctor ORDER BY birthdate ASC;";}
                                        }
                                    else if(isset($_POST["radioOrder"]) && ($_POST["radioOrder"] == "descending")){
                                        if(!empty($_POST['specialties'])) {
                                                $selected = $_POST['specialties'];
                                                $query = "SELECT * FROM doctor WHERE speciality = '$selected' ORDER BY birthdate DESC;";}
                                        else{
                                                $query = "SELECT * FROM doctor ORDER BY birthdate DESC;";}
                                                           }
                                                }
							}
							if(isset($query)){
								$result = mysqli_query($connection,$query);
							 if (!$result) {
							  die("databases query failed.");
							 }
							 while ($row = mysqli_fetch_assoc($result)) {
							 echo "<tr>";
							 echo "<td>" . (isset($row["licensenum"]) ? $row["licensenum"] : "") . "</td>";
							 echo "<td>" . (isset($row["firstname"]) ? $row["firstname"] : "") . "</td>";
							 echo "<td>" . (isset($row["lastname"]) ? $row["lastname"] : "") . "</td>";
							 echo "<td>" . (isset($row["licensedate"]) ? $row["licensedate"] : "") . "</td>";
							 echo "<td>" . (isset($row["birthdate"]) ? $row["birthdate"] : "") . "</td>";
							 echo "<td>" . (isset($row["hosworksat"]) ? $row["hosworksat"] : "") . "</td>";
							 echo "<td>" . (isset($row["speciality"]) ? $row["speciality"] : "") . "</td>";
							 echo "</tr>";	
							 }
							  mysqli_free_result($result);
							}
						?>
					
					
                    </tr>
                                </table>
        </div>
    </div>
	 <div class="container">
        <div class="row mt-2">
          <h2>Insert Doctor</h2>
		  <hr>
        </div>
        <form action method="post">
                <div class="row">
                    <h5>Doctor Information</h5>
                    <div class="col-3 mt-2">
                        <div class="input-group flex-nowrap">
                             <input type="text" class="form-control" placeholder="Firstname" aria-label="Firstname" name="Firstname">
                        </div>
                    </div>
                    <div class="col-3 mt-2">
                        <div class="input-group flex-nowrap">
                             <input type="text" class="form-control" placeholder="Lastname" aria-label="Lastname" name="Lastname">
                        </div>
                    </div>
                    <div class="col-3 mt-2">
                        <div class="input-group flex-nowrap">
                             <input type="date" class="form-control" placeholder="Birthdate" aria-label="Birthdate" name="Birthdate">
                        </div>
                    </div>
					<div class="col-3 mt-2">
                        <div class="input-group flex-nowrap">
                             <input type="text" class="form-control" placeholder="Specialty" aria-label="Specialty" name="Specialty">
                        </div>
                    </div>
                <div class="row">
                    <h5>License Information</h5>
                    <div class="col-3 mt-2">
                        <div class="input-group flex-nowrap">
                             <input type="text" class="form-control" placeholder="License Number" aria-label="License Number" name="LicenseNumber">
                        </div>
                    </div>
                    <div class="col-3 mt-2">
                        <div class="input-group flex-nowrap">
                             <input type="date" class="form-control" placeholder="License Date" aria-label="License Date" name="LicenseDate">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h5>Hospital Information</h5>
                    <div class="col-3 mt-2">
                        <select class="form-select" name="hoscode" aria-label="hoscode">
                        <option value="">Select Hospital</option>
                                                <?php
                                                   $query = "SELECT hoscode FROM hospital;";
                                                   $result = mysqli_query($connection,$query);
                                                   if (!$result) {
                                                    die("databases query failed.");
                                                   }
                                                   while ($row = mysqli_fetch_assoc($result)) {
                                                   echo "<option>";
                                                   echo $row["hoscode"];
                                                   echo "</option>";
                                                   }
                                                    mysqli_free_result($result);
                                                ?>
                                               
						 </select>
                    </div>
                </div>
                <div class="col mt-2">
                    <button type="btnInsert" class="btn btn-success btn-lg" name="insert" value ="insert">Insert</button>
                </div>
            </div>
        </form>
		<?php
                $licensenum =  isset($_POST['LicenseNumber']) ? $_POST['LicenseNumber'] : '';
                $firstname = isset($_POST['Firstname']) ? $_POST['Firstname'] : '';
                $lastname =  isset($_POST['Lastname']) ? $_POST['Lastname'] : '';
                $licensedate = isset($_POST['LicenseDate']) ? $_POST['LicenseDate'] : '';
                $birthdate = isset($_POST['Birthdate']) ? $_POST['Birthdate'] : '';
                $hosworksat = isset($_POST['hoscode']) ? $_POST['hoscode'] : '';
                $speciality = isset($_POST['Specialty']) ? $_POST['Specialty'] : '';
                        if(isset($_POST['insert'])){
                                $test = "SELECT * FROM doctor WHERE licensenum = '$licensenum';";
                                $testResult = mysqli_query($connection,$test);
                                $row = mysqli_fetch_array($testResult);
                                if ($row != NULL){
                                        echo '<script>alert("The license number is already existed.")</script>';
                                }
                                else {
                                        $query = "INSERT INTO doctor VALUES ('$licensenum', '$firstname','$lastname','$licensedate','$birthdate','$hosworksat','$speciality');";
                                        $result = mysqli_query($connection,$query);
                                        if (!$result) {
                                         die("databases query failed.");
                                        }
                                        else{
                                                echo '<script>alert("You add a new doctor successfully.")</script>';
                                        }
                                mysqli_free_result($testResult);
                        }
                }
        ?>

    </div>
	 <div class="container">
        <div class="row mt-2">
          <h2>Delete Doctor</h2>
		  <hr>
        </div>
		<div class="row">
		 <form action method="post">
                <table class="table">
                    <tr>
                        <th>License Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>License Date</th>
                        <th>Birth Date</th>
                        <th>Works At</th>
                        <th>Speciality</th>
						<th>Remove</th>
                    </tr>
                    <tr>
						<?php
						$query = "SELECT * FROM doctor;";
						$result = mysqli_query($connection,$query);
							 if (!$result) {
							  die("databases query failed.");
							 }
							 while ($row = mysqli_fetch_assoc($result)) {
							 echo "<tr>";
							 echo "<td>" . $row["licensenum"] . "</td>";
							 echo "<td>" . $row["firstname"] . "</td>";
							 echo "<td>" . $row["lastname"] . "</td>";
							 echo "<td>" . $row["licensedate"] . "</td>";
							 echo "<td>" . $row["birthdate"] . "</td>";
							 echo "<td>" . $row["hosworksat"] . "</td>";
							 echo "<td>" . $row["speciality"] . "</td>";
							 $licensenum =  $row["licensenum"];
							 echo "<td><input class=\"form-check-input\" type=\"radio\" name=\"radioRemove\" value=\"$licensenum\" /></td>";
							 echo "</tr>";	
							 }
							  mysqli_free_result($result);
						?>
					</tr>
			</table>
			<div class="col">
                    <button type="btnRemove" class="btn btn-success btn-lg" name="remove" value ="remove">Remove</button>
            </div>
			<?php
				if(isset($_POST['remove'])){
                	if(isset($_POST["radioRemove"])){
						$licensenum =  $_POST["radioRemove"];
						$query = "DELETE FROM doctor WHERE licensenum = '$licensenum';";
                        $result = mysqli_query($connection,$query);
                        if (!$result) {
                        	die("databases query failed.");}
						else{
							echo '<script>alert("You remove a doctor successfully.")</script>';}
                    }
				}
				?>
			</form>
		</div>
	</div>
	<div class="container">
        <div class="row mt-2">
          <h2>Assign a doctor to a patient</h2>
		  <hr>
        </div>
		<form action method="post">
                <div class="row">
                    <div class="col-4 mt-2">
                        <select class="form-select" name="doctor" aria-label="doctor">
                        <option value="">Select Doctor</option>
                                                <?php
                                                   $query = "SELECT firstname, lastname, licensenum FROM doctor;";
                                                   $result = mysqli_query($connection,$query);
                                                   if (!$result) {
                                                    die("databases query failed.");
                                                   }
                                                   while ($row = mysqli_fetch_assoc($result)) {
                                                   echo "<option value=\"" . $row["licensenum"] . "\">";
                                                   echo $row["firstname"] . " " . $row["lastname"];
                                                   echo "</option>";
                                                   }
                                                    mysqli_free_result($result);
                                                ?>
                                                </select>
                    </div>
                    <div class="col-4 mt-2">
                        <select class="form-select" name="patient" aria-label="patient">
                        <option value="">Select Patient</option>
                                                <?php
                                                   $query = "SELECT firstname, lastname, ohipnum FROM patient;";
                                                   $result = mysqli_query($connection,$query);
                                                   if (!$result) {
                                                    die("databases query failed.");
                                                   }
                                                   while ($row = mysqli_fetch_assoc($result)) {
                                                   echo "<option value=\"" . $row["ohipnum"] . "\">";
                                                   echo $row["firstname"] . " " . $row["lastname"];
                                                   echo "</option>";
                                                   }
                                                    mysqli_free_result($result);
                                                ?>
                                                </select>
                    </div>
                    <div class="col">
                    <button type="btnAssign" class="btn btn-success btn-lg" name="assign" value="assign">Assign</button>
            		</div>
			</form>
			<?php
				if(isset($_POST['assign'])){
                	if(isset($_POST["doctor"]) && isset($_POST["patient"])){
								$licensenum =  $_POST["doctor"];
								$ohipnum = $_POST["patient"];
								$test = "SELECT * FROM looksafter WHERE licensenum = '$licensenum' AND ohipnum = '$ohipnum';";
                                $testResult = mysqli_query($connection,$test);
                                $row = mysqli_fetch_array($testResult);
                                if ($row != NULL){
                                        echo '<script>alert("Patient already assigned to this doctor.")</script>';
                                }
                                else {
									$query = "INSERT INTO looksafter VALUES ('$licensenum','$ohipnum')";
			                        $result = mysqli_query($connection,$query);
			                        if (!$result) {
			                        	die("databases query failed.");}
									else{
										echo '<script>alert("You assign a doctor with a patient successfully.")</script>';}
			                    }
								mysqli_free_result($testResult);
							}
						}
				?>
	</div>
	<div class="container">
        <div class="row mt-2">
          <h2>View patient </h2>
		  <hr>
        </div>
		<form action method="post">
                <div class="row">
                    <div class="col-4 mt-2">
                        <select class="form-select" name="doctor" aria-label="doctor">
                        <option value="">Select Doctor</option>
                                                <?php
                                                   $query = "SELECT firstname, lastname, licensenum FROM doctor;";
                                                   $result = mysqli_query($connection,$query);
                                                   if (!$result) {
                                                    die("databases query failed.");
                                                   }
                                                   while ($row = mysqli_fetch_assoc($result)){
                                                   $licensenum =  $row["licensenum"];
                                                   echo "<option value=\"$licensenum\">";
                                                   echo $row["firstname"] . " " . $row["lastname"];
                                                   echo "</option>";
                                                   }
                                                    mysqli_free_result($result);
                                                ?>
                                                </select>
                    </div>
					<div class="col">
                    <button type="btnView" class="btn btn-success btn-lg" name="view" value ="view">View assigned patient</button>
            		</div>
		</form>
		<table class="table">
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Ohip Number</th>
                    </tr>
                    <tr>
						<?php
							if(isset($_POST['view'])){
								$licensenum =  $_POST["doctor"];
								$query = "SELECT lastname, firstname, ohipnum FROM patient WHERE ohipnum IN (SELECT ohipnum FROM looksafter WHERE licensenum = '$licensenum');";
								$result = mysqli_query($connection,$query);
									 if (!$result) {
									  die("databases query failed.");
									 }
									 while ($row = mysqli_fetch_assoc($result)) {
									 echo "<tr>";
									 echo "<td>" . $row["firstname"] . "</td>";
									 echo "<td>" . $row["lastname"] . "</td>";
									 echo "<td>" . $row["ohipnum"] . "</td>";
									 echo "</tr>";	
									 }
									  mysqli_free_result($result);
									  }
						?>
					</tr>
			</table>
		
	</div>
	<div class="container">
        <div class="row mt-2">
          <h2>Hospital Information</h2>
		  <hr>
        </div>
		<form action method="post">
                <div class="row">
                    <div class="col-4 mt-2">
                        <select class="form-select" name="hospital" aria-label="hospital">
                        <option value="">Select Hospital</option>
                                                <?php
                                                   $query = "SELECT hosname FROM hospital;";
                                                   $result = mysqli_query($connection,$query);
                                                   if (!$result) {
                                                    die("databases query failed.");
                                                   }
                                                   while ($row = mysqli_fetch_assoc($result)) {
                                                   $hoscode =  $row["hoscode"];
                                                   echo "<option value=\"$hoscode\">";
                                                   echo $row["hosname"];
                                                   echo "</option>";
                                                   }
                                                    mysqli_free_result($result);
                                                ?>
                                                </select>
					<div class="col mt-2">
                    <button type="btnHospital" class="btn btn-success btn" name="btnHospital" value ="btnHospital">View assigned patient</button>
            		</div>
					</form>		
					</div>
					<table class="table">
                    <tr>
                        <th>Hospital Name</th>
                        <th>City</th>
                        <th>Province</th>
						<th>Number of Bed</th>
						<th>Headdoc First Name</th>
						<th>Last Name</th>
                    </tr>
                    <tr>					
					<?php
					if(isset($_POST['btnHospital'])){
								$query = "SELECT h.hosname, h.city, h.prov, h.numofbed, d.firstname, d.lastname from hospital h JOIN doctor d ON d.licensenum = h.headdoc;";
								$result = mysqli_query($connection,$query);
									 if (!$result) {
									  die("databases query failed.");
									 }
									 while ($row = mysqli_fetch_assoc($result)) {
									 echo "<tr>";
									 echo "<td>" . $row["hosname"] . "</td>";
									 echo "<td>" . $row["city"] . "</td>";
									 echo "<td>" . $row["prov"] . "</td>";
									 echo "<td>" . $row["numofbed"] . "</td>";
									 echo "<td>" . $row["firstname"] . "</td>";
									 echo "<td>" . $row["lastname"] . "</td>";
									 echo "</tr>";	
									 }
									  mysqli_free_result($result);
									  }
					?>				
					</tr>							
					</table>						
                    </div>
					<table class="table">
                    <tr>
                        <th>List of Doctors</th>
                    </tr>
                    <tr>					
					<?php
					if(isset($_POST['btnHospital'])){
								$hoscode =  isset($_POST["hospital"]) ? $_POST["hospital"] : '';
								$query = "SELECT firstname, lastname FROM doctor WHERE hosworksat = '$hoscode';";
								$result = mysqli_query($connection,$query);
									 if (!$result) {
									  die("databases query failed.");
									 }
									 while ($row = mysqli_fetch_assoc($result)) {
									 echo "<tr>";
									 echo "<td>" . $row["firstname"] . "</td>";
									 echo "<td>" . $row["lastname"] . "</td>";
									 echo "</tr>";	
									 }
									  mysqli_free_result($result);
									  }
					?>				
					</tr>
					</table>		
					</div>
		<div class="container">
        <div class="row mt-2">
          <h2>Upadte Number of Beds</h2>
		  <hr>
        </div>
		<form action method="post">
                <div class="row">
                    <div class="col-3 mt-2">
                        <select class="form-select" name="hospital" aria-label="hospital">
                        <option value="">Select Hospital</option>
                                                <?php
                                                   $query = "SELECT hosname, hoscode FROM hospital;";
                                                   $result = mysqli_query($connection,$query);
                                                   if (!$result) {
                                                    die("databases query failed.");
                                                   }
                                                   while ($row = mysqli_fetch_assoc($result)) {
                                                   $hoscode =  $row["hoscode"];
                                                   echo "<option value=\"$hoscode\">";
                                                   echo $row["hosname"];
                                                   echo "</option>";
                                                   }
                                                    mysqli_free_result($result);
                                                ?>
                                                </select>
					</div>
                    <div class="col-3 mt-2">
                        <div class="input-group flex-nowrap">
                             <input type="text" class="form-control" placeholder="Number of Beds" aria-label="Number of Beds" name="numofbeds">
                        </div>
                    </div>
					<div class="col-3 mt-2">
                    <button type="btnBeds" class="btn btn-success btn" name="btnBeds" value ="btnBeds">Update</button>
            		</div>
			</div>		
		</form>
		<?php
			if(isset($_POST['btnBeds'])){
                	if(isset($_POST["hospital"]) && (!empty($_POST["numofbeds"]))){
						$hoscode =  $_POST["hospital"];
						$numofbeds = $_POST["numofbeds"];
						$query = "UPDATE hospital SET numofbed = '$numofbeds' WHERE hoscode = '$hoscode';";
                        $result = mysqli_query($connection,$query);
                        if (!$result) {
                        	die("databases query failed.");}
						else{
							echo '<script>alert("You update number of beds successfully.")</script>';}
                    }
				}
		?>
		</div>
 </body>
 </html>
