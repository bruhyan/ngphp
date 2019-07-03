<?php
/**
 * Returns the list of cars.
 */
require 'connect.php';
    
$files = [];
$sql = "SELECT * FROM fileup";

if($result = mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $files[$cr]['title']    = $row['title'];
    $files[$cr]['image'] = $row['image'];
    $cr++;
  }
    
  echo json_encode(['data'=>$files]);
}
else {
  http_response_code(404);
}