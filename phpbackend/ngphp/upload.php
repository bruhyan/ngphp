<?php 
require 'connect.php';

$response;
$upload_dir = 'uploads/';
$server_url = 'http://127.0.0.1:8008';
$title = '';
if($_FILES['avatar'])
{
    $avatar_name = $_FILES["avatar"]["name"];
    $ext = substr($avatar_name, strrpos($avatar_name, '.') + 1);
    // echo $ext;
    $avatar_tmp_name = $_FILES["avatar"]["tmp_name"];
    $error = $_FILES["avatar"]["error"];
    if($error > 0 ||  ($ext != "jpg" && $ext != "jpeg" && $ext != "pdf" && $ext != "docx" && $ext != "png" && $ext != "xls" && $ext != "xlsx" && $ext != "csv")){
        $response = [ 
            'status' => "error",
            'error' => true,
            'message' => "Error uploading the file!",
            'info' => $ext
            ];
        
    }else 
    {
        $title = $avatar_name;
        $random_name = rand(1000,1000000)."-".$avatar_name;
        $upload_name = $upload_dir.strtolower($random_name);
        $upload_name = preg_replace('/\s+/', '-', $upload_name);

        move_uploaded_file($avatar_tmp_name , $upload_name);

        $sql = "INSERT into `fileup`(`title`, `image`) VALUES('$title', '$upload_name')";
        if(mysqli_query($con, $sql)) {
            $response = [ 
                        'status' => "success",
                        'error' => false,
                        'message' => "File uploaded successfully",
                        // "info" => $ext
                        ];
        }else
        {
            $response = [
                'status' => "error",
                'error' => true,
                'message' => "Error uploading the file!"
            ];
        }
    }
    
}else{
    $response = [
        'status' => "error",
        'error' => true,
        'message' => "No file was sent!"
    ];
}
echo json_encode(['data' => $response]);




?>
