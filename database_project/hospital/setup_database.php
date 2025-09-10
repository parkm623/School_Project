<?php
// Database creation and setup script

// Connect without database first
$connection = mysqli_connect("localhost", "root", "");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "<h2>Database Setup Started</h2>";

// 1. Create database
$create_db = "CREATE DATABASE IF NOT EXISTS hospital_db";
if (mysqli_query($connection, $create_db)) {
    echo "✅ hospital_db database created successfully<br>";
} else {
    echo "❌ Database creation failed: " . mysqli_error($connection) . "<br>";
}

// 2. Select database
mysqli_select_db($connection, "hospital_db");

// 3. Create doctor table
$create_doctor_table = "
CREATE TABLE IF NOT EXISTS doctor (
    licensenum VARCHAR(10) PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    licensedate DATE NOT NULL,
    birthdate DATE NOT NULL,
    hosworksat VARCHAR(10),
    speciality VARCHAR(50) NOT NULL
)";

if (mysqli_query($connection, $create_doctor_table)) {
    echo "✅ doctor table created successfully<br>";
} else {
    echo "❌ doctor table creation failed: " . mysqli_error($connection) . "<br>";
}

// 4. Create hospital table
$create_hospital_table = "
CREATE TABLE IF NOT EXISTS hospital (
    hoscode VARCHAR(10) PRIMARY KEY,
    hosname VARCHAR(100) NOT NULL,
    city VARCHAR(50),
    prov VARCHAR(50),
    numofbed INT,
    headdoc VARCHAR(10)
)";

if (mysqli_query($connection, $create_hospital_table)) {
    echo "✅ hospital table created successfully<br>";
} else {
    echo "❌ hospital table creation failed: " . mysqli_error($connection) . "<br>";
}

// 5. Create patient table
$create_patient_table = "
CREATE TABLE IF NOT EXISTS patient (
    ohipnum VARCHAR(20) PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL
)";

if (mysqli_query($connection, $create_patient_table)) {
    echo "✅ patient table created successfully<br>";
} else {
    echo "❌ patient table creation failed: " . mysqli_error($connection) . "<br>";
}

// 6. Create looksafter table (doctor-patient relationship)
$create_looksafter_table = "
CREATE TABLE IF NOT EXISTS looksafter (
    licensenum VARCHAR(10),
    ohipnum VARCHAR(20),
    PRIMARY KEY (licensenum, ohipnum),
    FOREIGN KEY (licensenum) REFERENCES doctor(licensenum),
    FOREIGN KEY (ohipnum) REFERENCES patient(ohipnum)
)";

if (mysqli_query($connection, $create_looksafter_table)) {
    echo "✅ looksafter table created successfully<br>";
} else {
    echo "❌ looksafter table creation failed: " . mysqli_error($connection) . "<br>";
}

// 7. Insert sample data
echo "<h3>Inserting sample data...</h3>";

// Clear existing data first
echo "Clearing existing data...<br>";
mysqli_query($connection, "DELETE FROM looksafter");
mysqli_query($connection, "DELETE FROM patient");
mysqli_query($connection, "DELETE FROM doctor");
mysqli_query($connection, "DELETE FROM hospital");
echo "✅ Existing data cleared<br>";

// Hospital data
$hospital_data = [
    "INSERT INTO hospital VALUES ('HOS001', 'Seoul National Hospital', 'Seoul', 'Seoul', 1000, 'DOC001')",
    "INSERT INTO hospital VALUES ('HOS002', 'Yonsei University Hospital', 'Seoul', 'Seoul', 800, 'DOC003')",
    "INSERT INTO hospital VALUES ('HOS003', 'Samsung Seoul Hospital', 'Seoul', 'Seoul', 1200, 'DOC005')"
];

foreach ($hospital_data as $query) {
    if (mysqli_query($connection, $query)) {
        echo "✅ Hospital data added successfully<br>";
    } else {
        echo "❌ Hospital data addition failed: " . mysqli_error($connection) . "<br>";
    }
}

// Doctor data
$doctor_data = [
    "INSERT INTO doctor VALUES ('DOC001', 'John', 'Smith', '2020-01-15', '1985-03-20', 'HOS001', 'Internal Medicine')",
    "INSERT INTO doctor VALUES ('DOC002', 'Sarah', 'Johnson', '2019-05-10', '1988-07-12', 'HOS001', 'Surgery')",
    "INSERT INTO doctor VALUES ('DOC003', 'Michael', 'Brown', '2021-02-28', '1990-11-05', 'HOS002', 'Pediatrics')",
    "INSERT INTO doctor VALUES ('DOC004', 'Emily', 'Davis', '2018-09-03', '1983-12-18', 'HOS002', 'Internal Medicine')",
    "INSERT INTO doctor VALUES ('DOC005', 'David', 'Wilson', '2017-11-20', '1980-06-15', 'HOS003', 'Orthopedics')",
    "INSERT INTO doctor VALUES ('DOC006', 'Lisa', 'Anderson', '2022-03-10', '1992-09-25', 'HOS003', 'Obstetrics')"
];

foreach ($doctor_data as $query) {
    if (mysqli_query($connection, $query)) {
        echo "✅ Doctor data added successfully<br>";
    } else {
        echo "❌ Doctor data addition failed: " . mysqli_error($connection) . "<br>";
    }
}

// Patient data
$patient_data = [
    "INSERT INTO patient VALUES ('OHIP001', 'Alice', 'Johnson')",
    "INSERT INTO patient VALUES ('OHIP002', 'Bob', 'Smith')",
    "INSERT INTO patient VALUES ('OHIP003', 'Carol', 'Brown')",
    "INSERT INTO patient VALUES ('OHIP004', 'Daniel', 'Davis')"
];

foreach ($patient_data as $query) {
    if (mysqli_query($connection, $query)) {
        echo "✅ Patient data added successfully<br>";
    } else {
        echo "❌ Patient data addition failed: " . mysqli_error($connection) . "<br>";
    }
}

// Doctor-patient relationship data
$looksafter_data = [
    "INSERT INTO looksafter VALUES ('DOC001', 'OHIP001')",
    "INSERT INTO looksafter VALUES ('DOC001', 'OHIP002')",
    "INSERT INTO looksafter VALUES ('DOC003', 'OHIP003')",
    "INSERT INTO looksafter VALUES ('DOC004', 'OHIP004')"
];

foreach ($looksafter_data as $query) {
    if (mysqli_query($connection, $query)) {
        echo "✅ Doctor-patient relationship data added successfully<br>";
    } else {
        echo "❌ Doctor-patient relationship data addition failed: " . mysqli_error($connection) . "<br>";
    }
}

echo "<h3>✅ Database setup completed!</h3>";
echo "<p><a href='index.html'>Go to Main Application</a></p>";

mysqli_close($connection);
?>
