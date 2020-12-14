<?php
// Start the session
session_start();

include("config.php");
$partName=$_GET["part"];
// echo $partName;
$sql = "SELECT id FROM brand WHERE name='".$partName."' LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$partId = $row['id'];

$userId = (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true)?$_SESSION["userid"]:0;
$userEmail = (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true)?$_SESSION["useremail"]:0;
$userPhone = (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true)?$_SESSION["userphone"]:0;
if($partId==""){
    header('Location:/');
}

include_once("head.php");
include_once("nav.php");
?>

    <div class="container">
        <h2 class="mt-5 text-center"><?=$partName?> Parts</h2>
        <div class="input-group mb-3 showYearSelectorDiv">
            <div class="input-group-prepend">
                <label class="input-group-text" for="showYearSelector">Select by Year</label>
            </div>
            <select class="custom-select" id="showYearSelector" name="showYearSelector">

            </select>
        </div>
        <div class="alert alert-danger fade show" id="alertInfoDiv" role="alert">
            <strong id="alertInfo"></strong>
            <button type="button" class="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="row">
            <div class="col-1">
                <div class="row_heading">
                    &nbsp;<!-- ADVERTS -->
                </div>
            </div>
            <div class="col-3">
                <div class="row_heading">
                    PARTS WANTED
                </div>
                <div class="button_row">
                    <button type="button" class="btn btn-outline-primary add_advert_btn" data-toggle="modal" data-target="#formModal" data-whatever="wanted">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Add Your's
                    </button>
                </div>
                <div class="row_content" id="parts_wanted_div">
                    
                </div>
            </div>
            <div class="col-3">
                <div class="row_heading">
                    PARTS FOR SALE
                </div>
                <div class="button_row">
                    <button type="button" class="btn btn-outline-primary add_advert_btn" data-toggle="modal" data-target="#formModal" data-whatever="parts_sale">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Add Your's
                    </button>
                </div>
                <div class="row_content" id="parts_sale_div">
                    
                </div>
            </div>
            <div class="col-3">
                <div class="row_heading">
                    CAR FOR SALE
                </div>
                <div class="button_row">
                    <button type="button" class="btn btn-outline-primary add_advert_btn" data-toggle="modal" data-target="#formModal" data-whatever="cars_sale">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Add Your's
                    </button>
                </div>
                <div class="row_content" id="cars_sale_div">
                    
                </div>
            </div>
            <div class="col-2">
                <div class="row_heading">
                    Brand List
                </div>
                <div id="brandList">
                <?php
                    $sql = "SELECT id, name, shortName FROM brand";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<a href='/".$row["name"]."-parts'>".$row["name"]." Parts</a><br/>";
                        }
                    } else {
                        echo "Have no brands in database!";
                    }
                ?>
                </div>
            </div>
        </div>
    </div>

<?php
    //only logged in user can post advert
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true){
?>
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="advertForm">
                    <input type="text" name="action" value="postAdvert" hidden>
                    <input type="number" name="brand" value="<?=$partId?>" hidden>
                    <input type="number" name="userId" value="<?=$userId?>" hidden>
                    <input type="text" name="advertType" id="advertType" hidden>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="brandTypeSelector">Car Model</label>
                        </div>
                        <select class="custom-select" id="brandTypeSelector" name="brandTypeSelector">
                          
                        </select>
                    </div>
                    <div class="input-group mb-3" id="newModelInputDiv">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="brandTypeSelector">Name of New Model</label>
                        </div>
                        <input type="text" class="form-control" id="newModelInput" name="newModelInput">
                        <button type="button" class="btn btn-secondary" id="newModelBtn" onclick="addNewModel()">Add New Model</button>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="yearSelector">Year</label>
                        </div>
                        <select class="custom-select" id="yearSelector" name="yearSelector">
                          
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Email</span>
                        </div>
                        <input type="text" class="form-control" value="<?=$userEmail?>" placeholder="test@example.com" id="email" name="email" aria-describedby="Email" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="phone">Phone Number</span>
                        </div>
                        <input type="number" class="form-control" value="<?=$userPhone?>" name="phone">
                    </div>

                    <!-- <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="phone">Timestamp</span>
                        </div>
                        <input type="number" class="form-control" placeholder="01234567" name="timestamp">
                    </div> -->

                    <div class="form-group">
                        <label for="details" class="col-form-label" id="detail_label">Details</label>
                        <textarea class="form-control" id="details" name="details" rows="5" required></textarea>
                    </div>

                    <div style="padding: 20px">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="validatedCustomFile" name="validatedCustomFile" accept="image/*" multiple>
                            <label class="custom-file-label" for="validatedCustomFile" id="fileNameLabel">Choose Image...</label>
                            <div class="invalid-feedback"></div>
                        </div>
                        <input type="text" name="uploadedImageName" id="uploadedImageName" hidden>
                        <div id="progress-wrp">
                            <div class="progress-bar"></div>
                            <div class="status">0%</div>
                        </div>
                        <!-- image link input -->
                        <div class="form-group">
                            <label for="imageLink" class="col-form-label">Or add Image Links</label>
                            <div class="input-group mb-3 col-12">
                                            
                                <input type="text" name="uploadedImageUrl" id="uploadedImageUrl" hidden>
                                <input type="text" class="form-control" id="imagelinkInput" placeholder="https://.....">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-primary" type="button" onclick="addMoreImgLink()">Add more</button> 
                                </div>
                                
                            </div>
                            <div id="img_link_list">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalBtn">Close</button>
                <button type="button" class="btn btn-primary" id="sendForm">Send</button>
            </div>
        </div>
      </div>
    </div>

<?php
    }
    echo "<script> 
            var partId='".$partId."';
            var loggedIn=".((isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true)?"true":"false").";
            var ajaxurl='".$rootDir."inc/ajax.php';
        </script>";
?>
    <script src="<?=$rootDir?>script.js"></script>
    <script>
/*************************Add new model while posting new advert******************* */
function addNewModel(){
    if($("#newModelInput").val()==""){
        alert("Please input the new model name");
    }else{
        // /set advert detail columns
        $.ajax({
            type:"POST",
            url:ajaxurl,
            data:{
                "action":"addNewModel",
                "id":   partId,
                "name": $("#newModelInput").val()
            },
            success: function(data)
            {
                response = JSON.parse(data);
                if(response.success==true){
                    $("#brandTypeSelector").html(response.txt);
                    $("#newModelInputDiv").css("display","none");
                }else alert(response.txt)
                
            }
        })
    }
    
}

        $(document).ready(function(){
            
            //set brandType
            $.ajax({
                url: ajaxurl,
                type: "post",
                data: {
                    action: "getBrandModel",
                    id:     partId
                },
                success: function (response) {
                    // You will get response from your PHP page (what you echo or print)
                    $("#brandTypeSelector").html(response);
                    console.log(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
            
            //set year in form
            var html_content = "";
            for(i=1930;i<2000;i++){
                // if(i==1968)html_content += "<option value='"+i+"' selected>"+i+"</option>";
                // else 
                html_content += "<option value='"+i+"'>"+i+"</option>";
            }
            $("#yearSelector").html(html_content);
            html_content="<option value='0' selected>All</option>"+html_content;
            $("#showYearSelector").html(html_content);

            // /set advert detail columns
            $.ajax({
                type:   "POST",
                url:    ajaxurl,
                data:{
                    "action":"getAdverts",
                    "id":   partId,
                    "year": 0
                },
                success: function(data)
                {
                    console.log(data);
                    response=JSON.parse(data);
                    $("#parts_wanted_div").html(response[0]);
                    $("#parts_sale_div").html(response[1]);
                    $("#cars_sale_div").html(response[2]);
                }
            })

            //submit form
            $("#sendForm").on('click', function(e) {
                //validate form
                if($("#email").val()===''){
                    alert("Email input is a required field!");
                    $("#email").focus();
                }else if($("#brandTypeSelector").val()===''){
                    alert("Car model is a required field!");
                    $("#brandTypeSelector").focus();
                }else if($("#details").val()===''){
                    alert("Detail text is a required field!");
                    $("#details").focus();
                }else{
                    $("#closeModalBtn").click();
                    var form = $("#advertForm");
                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: form.serialize(), // serializes the form's elements.
                        success: function(data)
                        {
                            response=JSON.parse(data);
                            console.log(response);
                            console.log($("#advertType").val());
                            switch (parseInt($("#advertType").val())) {
                                case 0:
                                    $("#parts_wanted_div").prepend(response.content);
                                    break;
                                case 1:
                                    $("#parts_sale_div").prepend(response.content);
                                    break;
                                default:
                                    $("#cars_sale_div").prepend(response.content);
                                    break;
                            }

                            if(response.error==false){
                                $("#alertInfoDiv").css("display","block");
                                $("#alertInfoDiv").removeClass("alert-danger").addClass("alert-primary");
                                $("#alertInfo").html("Successfully Added Your Advert!");
                            }else{
                                $("#alertInfoDiv").css("display","block");
                                $("#alertInfoDiv").addClass("alert-danger").removeClass("alert-primary");
                                $("#alertInfo").html("Error Occured while adding advert: "+response.infoMsg); // show response from the php script.
                            }
                        }
                    });
                }
            });

            $('.add_advert_btn').on('click', function (event) {
                console.log(loggedIn);
                if(loggedIn==true){
                    var button = $(event.target) // Button that triggered the modal
                    var formType = button.data('whatever') // Extract info from data-* attributes
                    
                    var modal = $("#formModal")
                    var modalTitle = 'Parts wanted';
                    var advertType = 0;
                    if(formType=='cars_sale') {
                        modalTitle = 'Cars for sale';
                        advertType = 2;
                    }else if(formType == 'parts_sale') {
                        modalTitle = 'Parts for sale';
                        advertType = 1;
                    }
                    modal.find('.modal-title').text(modalTitle);
                    $("#advertType").val(advertType);
                }else{
                    $("#alertInfoDiv").css("display","block");
                    $("#alertInfo").html("You are not a loggedin user, please login first!");
                    setTimeout(() => {
                        window.location.href="/login";
                    }, 2000);
                }
                
            })

            $("#brandTypeSelector").on("change", function(e){
                if($("#brandTypeSelector").val()=="addNewModel")
                    $("#newModelInputDiv").css("display","flex");
                else $("#newModelInputDiv").css("display","none");
            })

            $("#showYearSelector").on("change", function(){

                $.ajax({
                    type:   "POST",
                    url:    ajaxurl,
                    
                    data:{
                        "action":   "getAdverts",
                        "id":       partId,
                        "year":     $("#showYearSelector").val()
                    },
                    success: function(data)
                    {
                        console.log(data);
                        response=JSON.parse(data);
                        $("#parts_wanted_div").html(response[0]);
                        $("#parts_sale_div").html(response[1]);
                        $("#cars_sale_div").html(response[2]);
                    }
                })

            })
            

        })
    </script>
</body>
</html>

