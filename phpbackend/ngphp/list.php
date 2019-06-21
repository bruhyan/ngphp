<?php
/**
 * Returns the list of cars.
 */
require 'connect.php';
    
$users = [];
$sql = "SELECT * FROM users";

if($result = mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $users[$cr]['email']    = $row['email'];
    $users[$cr]['password'] = $row['password'];
    $users[$cr]['name'] = $row['name'];
    $users[$cr]['dropdown'] = $row['dropdown'];
    $cr++;
  }
    
  echo json_encode(['data'=>$users]);
}
else {
  http_response_code(404);
}