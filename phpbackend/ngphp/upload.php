<!-- <!DOCTYPE html>
<html>
    <head>
        <title>File upload</title>
    </head>

    <body>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="title">
            <input type="File" name="file">
            <input type="submit" name="submit">
        </form>
    </body>
</html> -->

<?php 
require 'connect.php';

$response = array();
$upload_dir = 'uploads/';
$server_url = 'http://127.0.0.1:8008';
$title = '';
if($_FILES['avatar'])
{
    $avatar_name = $_FILES["avatar"]["name"];
    $avatar_tmp_name = $_FILES["avatar"]["tmp_name"];
    $error = $_FILES["avatar"]["error"];
    if($error > 0){
        $response = array(
            "status" => "error",
            "error" => true,
            "message" => "Error uploading the file!"
        );
    }else 
    {
        $title = $avatar_name;
        $random_name = rand(1000,1000000)."-".$avatar_name;
        $upload_name = $upload_dir.strtolower($random_name);
        $upload_name = preg_replace('/\s+/', '-', $upload_name);

        move_uploaded_file($avatar_tmp_name , $upload_name);

        $sql = "INSERT into `fileup`(`title`, `image`) VALUES('$title', '$upload_name')";
    
        // if(move_uploaded_file($avatar_tmp_name , $upload_name)) {
        //     $response = array(
        //         "status" => "success",
        //         "error" => false,
        //         "message" => "File uploaded successfully",
        //         "url" => $server_url."/".$upload_name
        //       );
        if(mysqli_query($con, $sql)) {
            $response = array(
                        "status" => "success",
                        "error" => false,
                        "message" => "File uploaded successfully",
                        "url" => $server_url."/".$upload_name
            );
        }else
        {
            $response = array(
                "status" => "error",
                "error" => true,
                "message" => "Error uploading the file!"
            );
        }
    }
    
}else{
    $response = array(
        "status" => "error",
        "error" => true,
        "message" => "No file was sent!"
    );
}
echo json_encode($response);


// if (isset($_POST["submit"])) {

// }

if(isset($_POST["submit"])) {
    $title = $_POST["title"];

    //file name with a random number so that similar dont get replaced
    $pname = rand(1000, 10000)."-".$_FILES["file"]["name"];

    //temporary file name to store file
    $tname = $_FILES["file"]["tmp_name"];

    //upload directory
    $upload_dir = "../ngphp/uploads";
    // $dir = "../ngphp/"

    #To move the uploaded files to specific location
    move_uploaded_file($tname, $upload_dir.'/'.$pname);

    #sql query to insert into database
    $sql = "INSERT into `fileup`(`title`, `image`) VALUES('$title', '$pname')";

    if(mysqli_query($con, $sql)) {
        echo "File Successfully Uploaded";
    }else {
        echo "Error";
    }

}

$postdata = file_get_contents("php://input"); //apparently this does not work for multipart

if(isset($postdata) && !empty($postdata)) {

    // $request = json_decode($postdata);

    // $title = $_POST["title"];

    // //file name with a random number so that similar dont get replaced
    // $pname = rand(1000, 10000)."-".$_FILES["file"]["name"];

    // //temporary file name to store file
    // $tname = $_FILES["file"]["tmp_name"];

    // //upload directory
    // $upload_dir = "../ngphp/uploads";
    // // $dir = "../ngphp/"

    // #To move the uploaded files to specific location
    // move_uploaded_file($tname, $upload_dir.'/'.$pname);

    // #sql query to insert into database
    // $sql = "INSERT into `fileup`(`title`, `image`) VALUES('$title', '$pname')";

    if(mysqli_query($con, $sql)) {
        http_response_code(201);
    }else {
        http_response_code(422);
    }

}


?>
