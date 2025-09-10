<?php
include "connecttodb.php";

echo "<h2>Database Test</h2>";

// 1. Check table existence
$tables = mysqli_query($connection, "SHOW TABLES");
echo "<h3>1. Table List:</h3>";
while ($table = mysqli_fetch_array($tables)) {
    echo "- " . $table[0] . "<br>";
}

// 2. Check doctor table structure
echo "<h3>2. Doctor Table Structure:</h3>";
$columns = mysqli_query($connection, "DESCRIBE doctor");
while ($column = mysqli_fetch_assoc($columns)) {
    echo "- " . $column['Field'] . " (" . $column['Type'] . ")<br>";
}

// 3. Check doctor table data count
$count = mysqli_query($connection, "SELECT COUNT(*) as total FROM doctor");
$count_result = mysqli_fetch_assoc($count);
echo "<h3>3. Doctor Table Data Count: " . $count_result['total'] . "</h3>";

// 4. Check specialties list
echo "<h3>4. Specialties List:</h3>";
$specialties = mysqli_query($connection, "SELECT DISTINCT speciality FROM doctor");
if ($specialties) {
    while ($specialty = mysqli_fetch_assoc($specialties)) {
        echo "- " . $specialty['speciality'] . "<br>";
    }
} else {
    echo "Specialties query failed: " . mysqli_error($connection);
}

// 5. Add sample data (if no data exists)
if ($count_result['total'] == 0) {
    echo "<h3>5. Adding sample data...</h3>";
    
    // Add sample doctor data
    $sample_doctors = [
        "INSERT INTO doctor VALUES ('DOC001', 'John', 'Smith', '2020-01-15', '1985-03-20', 'HOS001', 'Internal Medicine')",
        "INSERT INTO doctor VALUES ('DOC002', 'Sarah', 'Johnson', '2019-05-10', '1988-07-12', 'HOS001', 'Surgery')",
        "INSERT INTO doctor VALUES ('DOC003', 'Michael', 'Brown', '2021-02-28', '1990-11-05', 'HOS002', 'Pediatrics')",
        "INSERT INTO doctor VALUES ('DOC004', 'Emily', 'Davis', '2018-09-03', '1983-12-18', 'HOS002', 'Internal Medicine')"
    ];
    
    foreach ($sample_doctors as $query) {
        if (mysqli_query($connection, $query)) {
            echo "Sample data added successfully<br>";
        } else {
            echo "Sample data addition failed: " . mysqli_error($connection) . "<br>";
        }
    }
}

mysqli_close($connection);
?>
