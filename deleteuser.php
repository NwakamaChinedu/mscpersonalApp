<?php

/* Reference

Hill, J. (2020). window.location.href and window.open () methods in JavaScript. [online] Stack Overflow. Available at: 
https://stackoverflow.com/questions/7077770/window-location-href-and-window-open-methods-in-javascript [Accessed 25 Mar. 2023]. */

include_once 'assets/sql/connect.php';

$id = $_GET['id'];

$delsql = "SELECT COUNT(*) AS count FROM allstories WHERE id = $id";
$stmt = $conn->prepare($delsql);
//$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

// Fetch the count of rows in the child_table tied to the user account
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $result['count'];

// Check if there are any rows in the child_table tied to the user account
if ($count > 0) {
    
    echo '<script>alert("There is atleast one story tied to this user, user can not be  deleted"); window.location.href = "admin.php";</script>';
    
} else {
    // Prepare a DELETE query to delete the user account
    $sql = "DELETE FROM users WHERE id = $id";
    $stmt = $conn->prepare($sql);
   // $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    header("location: admin.php");

}
?>
