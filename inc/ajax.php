<?php
session_start();
include("../config.php");
$o='';

$action = isset($_POST['action']) ? $_POST['action'] : '';
if($action =='getAllBrands'){
    $sql = "SELECT * FROM brand WHERE 1";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $o.="<option value='".$row["id"]."'>".$row["name"]."</option>";
            $o1.="<p class='detail_link'><a href='/".$row["name"]."-parts'>".$row["name"]." Parts</a></p>";
        }
    } else {
        $o.="Have no brand in database!";
        $o1.="Have no brand in database!";
    }
    echo json_encode(array(
        'success' =>true,
        'brandOption'=>$o,
        'brandList'=>$o1
    ));
}else if($action =='getBrandModel'){
    $sql = "SELECT * FROM brandType WHERE idBrand=".$_POST['id'];
    $result = $conn->query($sql);
    $o.="<option></option>";
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $o.="<option value='".$row["id"]."'>".$row["name"]."</option>";
        }
        $o.="<option value='addNewModel'>+ Add New Model</option>";
    } else {
        $o.="<option value='addNewModel'>+ Add New Model</option>";
    }
    echo $o;
}else if($action == 'postAdvert'){
    $sql = "INSERT INTO advert (advertType, userId, idBrand, idBrandType, year, email, phone, details, image, time)
    VALUES ('".$_POST['advertType']."', 
        '".$_POST['userId']."',
        '".$_POST['brand']."',
        '".$_POST['brandTypeSelector']."', 
        ".$_POST['yearSelector'].", 
        '".$_POST['email']."',
        '".$_POST['phone']."', 
        '".$_POST['details']."', 
        '".$_POST['uploadedImageName'].($_POST['uploadedImageUrl']!=""?$_POST['uploadedImageUrl']:"")."',
        ".time().")";
        // ".$_POST['timestamp'].")";
        

    if ($conn->query($sql) === TRUE) {
        $date = date("F j, Y", time()); 
        $content = '<p class="content_time">
                        '.$date.' 
                    </p>
                    <div class="NormalP newAdvert">
                        <p class="content_bold content_red_title">New Advert</p>
                        <span class="content_bold">
                            '.$_POST['yearSelector'].' Chevrolet '.$_POST['brandTypeSelector'].'
                        </span>
                        <span class="content_text">
                            -'.$_POST['details']
                            .($_POST['email']==''?'':(', <br/>Email:'.$_POST['email']))
                            .($_POST['phone']==''?'':(', <br/>Phone:'.$_POST['phone'])).' 
                        </span>
                        <a href="../advert.php?id='.$conn->insert_id.'"> More...</a>
                    </div>';

        echo json_encode(array(
            'error' =>false,
            'infoMsg'=>$sql,
            'content'=>$content
        ));
    } else {
        echo json_encode(array(
            'error' => true,
            'infoMsg' => $conn->error,
            'content'=>''
        ));
    }
}else if($action=='advertImageUpload'){
    $fileName = $_FILES['file']['name'];
    $fileRealName = time()."___".$fileName;
    $fileType = $_FILES['file']['type'];
    $fileError = $_FILES['file']['error'];
    $fileContent = file_get_contents($_FILES['file']['tmp_name']);

    if($fileError == UPLOAD_ERR_OK){
        //Processes your file here
        if (move_uploaded_file($_FILES['file']['tmp_name'], '../img/advert/'.$fileRealName)) {
            echo json_encode(array(
                'error' => false,
                'fileName' => $fileName,
                'fileRealName'=>$fileRealName
            ));
        } else {
            echo "Possible file upload attack!\n";
        }
    }else{
        switch($fileError){
            case UPLOAD_ERR_INI_SIZE:   
                $message = 'Error ini size.';
                break;
            case UPLOAD_ERR_FORM_SIZE:  
                $message = 'Error from size.';
                break;
            case UPLOAD_ERR_PARTIAL:    
                $message = 'Error load partial';
                break;
            case UPLOAD_ERR_NO_FILE:    
                $message = 'Error: no file';
                break;
            case UPLOAD_ERR_NO_TMP_DIR: 
                $message = 'Error: no temp dir.';
                break;
            case UPLOAD_ERR_CANT_WRITE: 
                $message= 'Error: cant write.';
                break;
            case  UPLOAD_ERR_EXTENSION: 
                $message = 'Error: error extension.';
                break;
            default: $message = 'Error: cannot upload general error.';
                    break;
        }
        echo json_encode(array(
                'error' => true,
                'message' => $message
                ));
    }
    
}else if($action=='getAdverts'){
    for($type =0;$type<3;$type++){ 
        $o='';
        $tempDate='';
        $sql = "SELECT * 
                FROM advert 
                WHERE idBrand=".$_POST["id"]." AND advertType = $type ".($_POST["year"]==0?"":"AND year=".$_POST["year"]." ").
                "ORDER BY time DESC";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $date = date("F j, Y", $row["time"]); 
                if($tempDate != $date){
                    $tempDate = $date;
                    $o .= '<p class="content_time">
                                '.$date.' 
                            </p>';
                }
                $subSql = "SELECT name FROM brandType WHERE id=".$row['idBrandType']." LIMIT 1";
                $subResult = $conn->query($subSql);
                $subRow = $subResult->fetch_assoc();
                $brandTypeName = $subRow['name'];

                $o.='<div class="NormalP mb-5">
                        <span class="content_bold">
                            '.$row['year'].' Chevrolet '.$brandTypeName.'
                        </span>
                        <span class="content_text">
                            -'.$row['details'].
                            // .($row['email']==''?'':(', <br/>Email:'.$row['email']))
                            // .($row['phone']==''?'':(', <br/>Phone:'.$row['phone'])).' 
                        '</span>
                        <br/>
                        <a href="../advert.php?id='.$row["id"].'"> More...</a>
                    </div>';
            }
        } else {
            $o.="Have no adverts in database!";
        }
        $outputArray[]=$o;
    }
    echo json_encode($outputArray);             
}else if($action == 'getAdvertWithId'){
    $sql = "SELECT * FROM advert WHERE id=".$_POST['id']." LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if($row['id']===null) echo json_encode(array(
                                'notfound' =>    true,
                                'id'=>''
                            ));

    
    else{
        $sqlBrand="SELECT * FROM brand WHERE id=".$row['idBrand']." LIMIT 1";
        $resultBrand = $conn->query($sqlBrand);
        $rowBrand = $resultBrand->fetch_assoc();

        $sqlModel="SELECT * FROM brandType WHERE id=".$row['idBrandType']." LIMIT 1";
        $resultModel = $conn->query($sqlModel);
        $rowModel = $resultModel->fetch_assoc();

        $sqlUser="SELECT * FROM users WHERE id=".$row['userId']." LIMIT 1";
        $resultUser = $conn->query($sqlUser);
        $rowUser = $resultUser->fetch_assoc();

        echo json_encode(array(
            'notfound'=>    false,
            'idBrand' =>    $rowBrand['name'],
            'advertType'=>  $row['advertType'],
            'idBrandType'=> $rowModel['name'],
            'year'=>        $row['year'],
            'user'=>        $rowUser['name'],
            'advertiserId'=>$row['userId'],
            // 'email'=>       $row['email'],
            // 'phone'=>       $row['phone'],
            'details'=>     $row['details'],
            'image'=>       $row['image'],
            'time'=>        date('F j, Y',$row['time']),
        ));
    }
    
}else if($action == 'signup'){
    $sql = "SELECT * FROM users WHERE name='".$_POST['name']."'";
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) > 0) {
        echo json_encode(array(
            'success'=>    false,
            'txt' =>    'Exists same username, please select another!'
        ));
    }else{
        $sql = "INSERT INTO users (name, email, phone, created, type, password, ismember, status)
        VALUES ('".$_POST['name']."', '".$_POST['email']."', '".$_POST['phone']."', ".time().", 0, '".$_POST['pass']."', '".$_POST['ismember']."', 1)";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(array(
                'success' =>    true,
                'txt'=>      $sql
            ));
        }else{
            echo json_encode(array(
                'success'=>    false,
                'txt' =>    $sql
            ));
        }
    }
    
}else if($action == 'login'){
    $sql = "SELECT * FROM users WHERE name='".$_POST['email']."' AND password='".$_POST['pass']."' LIMIT 1";
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $row["name"];
        $_SESSION["useremail"] = $row["email"];
        $_SESSION["userphone"] = $row["phone"];
        $_SESSION["userid"] = $row["id"];
        $_SESSION["userLogo"] = $row["logo"];
        $_SESSION["usertype"] = $row["type"];
        echo json_encode(array(
            'success' =>    true,
            'member'=>      $sql
        ));
    }else{
        echo json_encode(array(
            'success'=>    false,
            'member' =>    false
        ));
    }
    
}else if($action == 'logout'){
   
    session_unset(); 
    echo json_encode(array(
        'success' =>    true
    ));
    
}else if($action=='sendMessage'){
    $sql = "INSERT INTO messages (sender, receiver, message, created)
        VALUES ('".$_POST['userId']."', '".$_POST['receiverId']."', '".$_POST['message']."', '".time()."')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array(
            'success' =>    true,
            'txt'=>         "Sent message successfully!"
        ));
    }else{
        echo json_encode(array(
            'success' =>    false,
            'txt'=>         "Error occured while sending a new message!"
        ));
    }

              
}else if($action=='addNewBrand'){
    $sql = "INSERT INTO brand (name, shortName)
        VALUES ('".$_POST['name']."', '".strtolower($_POST['name'])."')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array(
            'success' =>    true,
            'txt'=>         "Added new brand successfully"
        ));
    }else{
        echo json_encode(array(
            'success' =>    false,
            'txt'=>         "Error occured while adding a new Brand!"
        ));
    }

              
}else if($action=='addNewModel'){
    $sql = "INSERT INTO brandType (idBrand, name)
        VALUES ('".$_POST['id']."', '".$_POST['name']."')";

    if ($conn->query($sql) === TRUE) {
        $sql = "SELECT * FROM brandType WHERE idBrand=".$_POST['id'];
        $result = $conn->query($sql);
        $o.="<option></option>";
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $o.="<option value='".$row["id"]."'>".$row["name"]."</option>";
            }
            $o.="<option value='addNewModel'>+ Add New Model</option>";
        } else {
            $o.="<option value='addNewModel'>+ Add New Model</option>";
        } 

        echo json_encode(array(
            'success' =>    true,
            'txt'=>         $o
        ));
    }else{
        echo json_encode(array(
            'success' =>    false,
            'txt'=>         "Error occured while adding a new Model!"
        ));
    }

              
}else if($action=="sendQuestionEmail"){
    $to = "cristianr909090@gmail.com,paddy3@mail.com";
    $subject = "Question from DrunkSump";

    $message = "
    <html>
    <head>
    <title>HTML email</title>
    <style>
    th {
        width: 110px;
    }
    h2{
        text-align: center
    }
    </style>
    </head>
    <body style='font-family:HelveticaNeue-Light,Arial,sans-serif;background-color:#eeeeee;padding: 10px 30px 30px;'>
        <h2>New Question</h2>
        <table>
            <tr>
                <th>User Email</th>
                <td>".$_POST["email"]."</td>
            </tr>
            <tr>
                <th>User Phone</th>
                <td>".$_POST["phone"]."</td>
            </tr>
            <tr>
                <th>Question</th>
                <td>".$_POST["message"]."</td>
            </tr>
        </table>
    </body>
    </html>
    ";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <Question@drunksump.com>' . "\r\n";

    mail($to,$subject,$message,$headers);

    //add question to table
    $sql = "INSERT INTO questions (email, phone, question, created)
        VALUES ('".$_POST['email']."', '".$_POST['phone']."', '".$_POST['message']."', ".time().")";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(array(
                'success' =>    true,
                'txt'=>      $sql
            ));
        }else{
            echo json_encode(array(
                'success'=>    false,
                'txt' =>    $sql
            ));
        }
}
$conn->close();

?>