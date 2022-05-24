<?php
include('../organizer/partials/database.php'); 
$searchTerm = $_GET['term'];
$sql = "SELECT compName FROM competition WHERE compName LIKE '%".$searchTerm."%'"; 
$result = $conn->query($sql); 
if ($result->num_rows > 0) {
  $tutorialData = array(); 
  while($row = $result->fetch_assoc()) {
   $data['id']    = $row['id']; 
   $data['value'] = $row['tutorial_name'];
   array_push($tutorialData, $data);
} 
}
 echo json_encode($tutorialData);
?>