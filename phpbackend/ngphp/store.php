<?php
require 'connect.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);
	

  // Validate.
//   if(trim($request->data->model) === '' || (int)$request->data->price < 1)
//   {
//     return http_response_code(400);
//   }
	
  // Sanitize.
  $name = mysqli_real_escape_string($con, $request->data->name);
  $password = mysqli_real_escape_string($con, $request->data->password);
  $email = mysqli_real_escape_string($con, $request->data->email);
  $dropdown = mysqli_real_escape_string($con, $request->data->dropdown);
    

  // Store.
  $sql = "INSERT INTO `users`(`email`,`name`,`password`, `dropdown`) VALUES ('$email','$name','$password', '$dropdown' )";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $user = [
      'email' => $email,
      'password' => $password,
      'name'    => $name,
      'dropdown' => $dropdown
    ];
    echo json_encode(['data'=>$user]);
  }
  else
  {
    http_response_code(422);
  }
}