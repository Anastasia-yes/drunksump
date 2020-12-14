<?php
// Start the session
session_start();
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <!-- <base href="//localhost/drunk-sump" /> -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

        
        <title>DrunkSump</title>
<style>
    .detail_link {
        width: 24%;
        display: inline-block;
        font-size: 12px;
        margin: 0;
    }
    .detail_link a {
        color: #6633cc;
    }
    .right_block {
        border: 1px dotted gray;
        background: #eee;
        margin-top: 30px;
        border-radius: 5px;
        padding: 15px;
    }
    .right_block p{
        color:  #804000;
        font-size: 12px;
    }
    .detail_time{
        color: black;
        font-weight: 800;
    }
    .right_block h5 {
        margin-bottom: 15px;
    }
    .form-check {
        width: 24%;
    }
</style>
    </head>
    <body>

<?php
include("config.php");
include("nav.php");
?>

        <div class="container">
            <div class="alert alert-danger fade show mt-3" id="alertInfoDiv" role="alert">
                <strong id="alertInfo"></strong>
                <button type="button" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="row">
                
                <div class="col-2">
                    <div class="polaroid">
                        <img src="img/model/img1.gif" style="width:100%">
                        <div class="imgtext_container">
                            <p>Capricornia Historical Motor Club</p>
                        </div>
                    </div>
                    <div class="polaroid">
                        <img src="img/model/img2.gif" style="width:100%">
                        <div class="imgtext_container">
                            <p>The Brisbane Vintage Auto Club Inc</p>
                        </div>
                    </div>
                    <div class="polaroid">
                        <img src="img/model/img3.gif" alt="Norther Lights" style="width:100%">
                        <div class="imgtext_container">
                            <p>The Bundaberg Vintage Vehicle Club</p>
                        </div>
                    </div>
                    <div class="polaroid">
                        <img src="img/model/img4.gif" style="width:100%">
                        <div class="imgtext_container">
                            <p>The Gladstone Vintage and Classic Carriage Club</p>
                        </div>
                    </div>
                    <div class="polaroid">
                        <img src="img/model/img5.gif" style="width:100%">
                        <div class="imgtext_container">
                            <p>The Queensland Jaguar Drivers Club(Capricornia)</p>
                        </div>
                    </div>
                    <div class="polaroid">
                        <img src="img/model/img6.gif" style="width:100%">
                        <div class="imgtext_container">
                            <p>The Dales Historic Vehicle Society</p>
                        </div>
                    </div>
                    <div class="polaroid">
                        <img src="img/model/img7.gif" style="width:100%">
                        <div class="imgtext_container">
                            <p>The Surrey Vintage Vehicle Society</p>
                        </div>
                    </div>
                    <div class="polaroid">
                        <img src="img/model/img8.gif" style="width:100%">
                        <div class="imgtext_container">
                            <p>Stationary Engines</p> 
                            <p>We would like your Classic car Club to be a part of Drump-sump.com</p>
                        </div>
                    </div>
                    <div class="polaroid">
                        <div class="imgtext_container">
                            <p>Classic Car Insurance</p>
                        </div>
                        <img src="img/model/imgLast.gif" style="width:100%">
                        <div class="imgtext_container">
                            <p>Who you gonna call?</p>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <form class="contact_form">
                        <h3 class="text-center mb-5">Contact Us</h3>
                        <!-- <div class="alert alert-primary" role="alert">
                            <p>
                                Yes, It is free for non Members to place an Advert.
                                We want to list all the parts you have ..or need.
                            </p>
                            <label class="form_description">
                                list your advert  as wish it to appear -  'think'  before adding your email address
                            </label>
                        </div> -->


                        <input type="text" name="action" value="postAdvert" hidden>
                        <input type="text" name="advertType" id="advertType" hidden>
                        


                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="test@example.com" id="email" name="email" value="<?=$_SESSION['useremail']?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">Phone Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="12345678" id="phone" name="phone" value="<?=$_SESSION['userphone']?>">
                                <label class="form_description">
                                    Place a phone  number or email address on this form - or nobody can contact you!
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail2" class="col-sm-4 col-form-label">Email(Not for publication)</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail2">
                                <label class="form_description">
                                    Members only can contact you!
                                </label>
                            </div>
                        </div>

                        <fieldset class="form-group mb-3">
                            <div class="row">
                                <label class="col-form-label col-sm-2 pt-0">Type</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="advertType" id="gridRadios1" value="0" checked>
                                        <label class="form-check-label" for="gridRadios1">
                                            Ask a Question
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="advertType" id="gridRadios2" value="1">
                                        <label class="form-check-label" for="gridRadios2">
                                            Cars for Sale
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="advertType" id="gridRadios3" value="2">
                                        <label class="form-check-label" for="gridRadios3">
                                            Parts for Sale
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="advertType" id="gridRadios4" value="3">
                                        <label class="form-check-label" for="gridRadios4">
                                            Parts Wanted
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <div id="advertDetails">
                            <div class="form-group row mb-3">
                                <label for="carBrandSelector" class="col-sm-4 col-form-label">Make of Car</label>
                                <div class="col-sm-8">
                                    <select class="custom-select" id="carBrandSelector" name="carBrandSelector">
                                    
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="brandTypeSelector" class="col-sm-4 col-form-label">Car Model</label>
                                <div class="col-sm-8">
                                    <select class="custom-select" id="brandTypeSelector" name="brandTypeSelector">
                                    
                                    </select>
                                </div>
                            </div>
                            <div class="input-group mb-3" id="newModelInputDiv">
                                <div class="input-group-prepend">
                                <label class="input-group-text" for="brandTypeSelector">Name of New Model</label>
                                </div>
                                <input type="text" class="form-control" id="newModelInput" name="newModelInput">
                                <button type="button" class="btn btn-secondary" id="newModelBtn" onclick="addNewModel()">Add New Model</button>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-4 col-form-label" for="yearSelector">Year</label>
                                <div class="col-sm-8">
                                    <select class="custom-select" id="yearSelector" name="yearSelector">
                                    
                                    </select>
                                </div>
                            </div>
                            <label >Image</label>
                            <div class="bordered_section">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="validatedCustomFile" name="validatedCustomFile" accept="image/*" multiple>
                                    <label class="custom-file-label" for="validatedCustomFile" id="fileNameLabel">Choose Image...</label>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <input type="text" name="uploadedImageName" id="uploadedImageName" hidden>
                                <div id="progress-wrp" class="mb-3">
                                    <div class="progress-bar"></div>
                                    <div class="status" id="statusPercent">0%</div>
                                </div>

                                <!-- image link input -->
                                <div class="form-group row">
                                    <label for="imageLink" class="col-form-label">Or add Image Links</label>
                                    <div class="input-group mb-3 col-12">
                                        
                                        <input type="text" name="uploadedImageUrl" id="uploadedImageUrl" hidden>
                                        <input type="text" class="form-control" id="imagelinkInput" placeholder="https://.....">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-primary" type="button" onclick="addMoreImgLink()">Add more</button> 
                                        </div>
                                    </div>
                                </div>
                                <div id="img_link_list" class="row">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="details">Message</label>
                            <textarea class="form-control" id="details" rows="3" name="details"></textarea>
                        </div>

                        

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="memberFlag" onchange="toggleMemberArea()">
                                    <label class="form-check-label" for="memberFlag">
                                        I am a Member
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form_member_area">
                            <label class="member_area_title">
                                Member Area
                            </label>
                            <div class="form-group row">
                                <label for="imageLink" class="col-sm-4 col-form-label">Image Link</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="imageLink">
                                    <label class="form_description">
                                        Please ad this image link to the advert . . . 
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="password">
                                    <label class="form_description">
                                        place member password here - this will ensure non members can contact you via pod .. .
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <button type="button" id="sendForm" class="btn btn-primary">Send</button>
                                <button type="button" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </form>

                    <div class="list_link">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Make
                                        </button>
                                    </h2>
                                    
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <?php
                                            if($_SESSION["usertype"]=='1')
                                                    echo '<button class="btn btn-link btn-block text-right" type="button" data-toggle="modal" data-target="#myModal">
                                                            + Add New
                                                        </button>';
                                            
                                        ?>
                                        <div id="brandList">

                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseAccessories" aria-expanded="false" aria-controls="collapseTwo">
                                            Accessories
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseAccessories" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p class="detail_link"><a href="accessories/wheels/">Lights - Lamps</a></p>
                                        <p class="detail_link"><a href="accessories/carpet"> carpet</a></p>
                                        <p class="detail_link"><a href="accessories/carburetors"> carburetors</a></p>
                                        <p class="detail_link"><a href="accessories/dynamo">Dynamo.</a></p>
                                        <p class="detail_link"><a href="accessories/magneto">Magneto</a></p>
                                        <p class="detail_link"><a href="accessories/speedometers">Speedometers e</a></p>
                                        <p class="detail_link"><a href="wheels/">Tyres.</a> - <a href="wheels/">Wheels.</a></p>
                                        
                                        <p class="detail_link"><a href="stationary-parts/index.html"> Stationary Engines</a></p>
                                        <p class="detail_link"><a href="">Southern Cross Registry</a></span><span id="PubSt23F"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTractor" aria-expanded="false" aria-controls="collapseTractor">
                                            Tractor Parts
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTractor" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    <p class="detail_link"><a href="tractor-parts/index.html">Alice Chalmers</a></p>
                                    <p class="detail_link"><a href="">Minneapolis Moline</a></p>
                                </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseCountry" aria-expanded="false" aria-controls="collapseCountry">
                                            Country, Land
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseCountry" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p class="detail_link"><a href="australia/index.html">AUSTRALIA</a></p>
                                        <p class="detail_link"><a href="australia/queensland/index.html">Queensland</a></p>
                                        <p class="detail_link"><a href="australia/victoria/index.html">Victoria</a></p>
                                        <p class="detail_link"><a href="australia/nsw/index.html">NSW</a></p>
                                        <p class="detail_link"><a href="australia/south-australia/index.html">South Aust</a></p>
                                        <p class="detail_link"><a href="australia/tasmania/index.html">Tasmania</a></p>
                                        <p class="detail_link"><a href="australia/nt/index.html">NT</a></p>
                                        <p class="detail_link"><a href="canada/index.html">Canada</a></p>
                                        <p class="detail_link"><a href="new-zealand/index.html">New Zealand</a></p>
                                        <p class="detail_link"><a href="uk/index.html">UK</a></p>
                                        <p class="detail_link"><a href="norway/index.html">Norway</a></p>
                                        <p class="detail_link"><a href="norway/sweden.html">Sweden</a></p>
                                        <p class="detail_link"><a href="norway/denmark.html">Denmark</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingLocal">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseLocal" aria-expanded="false" aria-controls="collapseLocal">
                                            Local Navigation
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseLocal" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p class="detail_link"><a href="alabama/index.html">Alabama</a></p>
                                        <p class="detail_link"><a href="alaska/index.html">Alaska</a></p>
                                        <p class="detail_link"><a href="arizona/index.html">Arizona</a></p>
                                        <p class="detail_link"><a href="arkansas/index.html">Arkansas</a></p>
                                        <p class="detail_link"><a href="">California</a></p>
                                        <p class="detail_link"><a href="colorado/index.html">Colorado</a></p>
                                        <p class="detail_link"><a href="connecticut/index.html">Connecticut</a></p>
                                        <p class="detail_link"><a href="delaware/index.html">Delaware</a></p>
                                        <p class="detail_link"><a href="florida/index.html">Florida</a></p>
                                        <p class="detail_link"><a href="georgia/index.html">Georgia</a></p>
                                        <p class="detail_link"><a href="idaho/index.html">Idaho</a></p>
                                        <p class="detail_link"><a href="illinois/index.html">Illinois</a></p>
                                        <p class="detail_link"><a href="indiana/index.html">Indiana</a></p>
                                        <p class="detail_link"><a href="iowa/index.html">Iowa</a></p>
                                        <p class="detail_link"><a href="kansas/index.html">Kansas</a></p>
                                        <p class="detail_link"><a href="kentucky/index.html">Kentucky</a></p>
                                        <p class="detail_link"><a href="louisiana/index.html">Louisiana</a></p>
                                        <p class="detail_link"><a href="maryland/index.html">Maryland</a></p>
                                        <p class="detail_link"><a href="maine/index.html">Maine</a></p>
                                        <p class="detail_link"><a href="massachusetts/index.html">Massachusetts</a></p>
                                        <p class="detail_link"><a href="mexico/index.html">Mexico</a></p>
                                        <p class="detail_link"><a href="michigan/index.html">Michigan</a></p>
                                        <p class="detail_link"><a href="minnesota/index.html">Minnesota</a></p>
                                        <p class="detail_link"><a href="mississippi/index.html">Mississippi</a></p>
                                        <p class="detail_link"><a href="missouri/index.html">Missouri</a></p>
                                        <p class="detail_link"><a href="montana/index.html">Montana</a></p>
                                        <p class="detail_link"><a href="north-carolina/index.html">N Carolina</a></p>
                                        <p class="detail_link"><a href="south-dakota/index.html">N Dakota</a></p>
                                        <p class="detail_link"><a href="nebraska/index.html">Nebraska</a></p>
                                        <p class="detail_link"><a href="new-hampshire/index.html">N Hampshire</a></p>
                                        <p class="detail_link"><a href="new-jersey/index.html">N Jersey</a></p>
                                        <p class="detail_link"><a href="new-mexico/index.html">N Mexico</a></p>
                                        <p class="detail_link"><a href="nevada/index.html">Nevada</a></p>
                                        <p class="detail_link"><a href="">New York</a></p>
                                        <p class="detail_link"><a href="ohio/index.html">Ohio</a></p>
                                        <p class="detail_link"><a href="oklahoma/index.html">Oklahoma</a></p>
                                        <p class="detail_link"><a href="oregon/index.html">Oregon</a></p>
                                        <p class="detail_link"><a href="pennsylvania/index.html">Pennsylvania</a></p>
                                        <p class="detail_link"><a href="rhode-island/index.html">Rhode Island</a></p>
                                        <p class="detail_link"><a href="south-dakota/index.html">South Dakota</a></p>
                                        <p class="detail_link"><a href="south-carolina/index.html">South Carolina</a></p>
                                        <p class="detail_link"><a href="tennessee/index.html">Tennessee</a></p>
                                        <p class="detail_link"><a href="texas/index.html">Texas</a></p>
                                        <p class="detail_link"><a href="utah/index.html">Utah</a></p>
                                        <p class="detail_link"><a href="vermont/index.html">Vermont</a></p>
                                        <p class="detail_link"><a href="virginia/index.html">Virginia</a></p>
                                        <p class="detail_link"><a href="washington/index.html">Washington</a></p>
                                        <p class="detail_link"><a href="west-virginia/index.html">West Virginia</a></p>
                                        <p class="detail_link"><a href="wisconsin/index.html">Wisconsin</a></p>
                                        <p class="detail_link"><a href="wyoming/index.html">Wyoming</a></p>
                                        <p class="detail_link"><a href="puerto-rico/index.html">Puerto Rico</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-2 right_block">

                    <h6>Some of many 1000's of classic car parts wanted</h6>

                    <p class="right_detail"><span class="detail_time">1953 Willys question</span> - Looking for tail light lens (rear) for 1953 Willys Aero Ace. Mine are cracked and faded would like to replace with new (?) lens. Can anyone supply me a contact? </p>
                    <p class="right_detail"><span class="detail_time">1933 Chevrolet Master</span> 5 window coupe. parts wanted -Hood vent door and finger pull Texas; Sugar Land </p>
                    <p class="right_detail"><span class="detail_time">1940 Chevy</span> i need the crest or shield - It is between the flags on the hood closest to the grill. - Clarksville Michigan - </p>
                    <p class="right_detail"><span class="detail_time">1928 Hupmobile Century Six </span>A6 part wanted: Rear bumper with mounting brackets, gas cap and radiator cap. Salinas, CA Jim 831-455-5105.</p>
                    <p class="right_detail"><span class="detail_time">1929 Chev Coupe</span> - Looking for a fuel pump - Alberta Canada </p>
                    <p class="right_detail"><span class="detail_time">1936 chevy coupe</span> looking for front fenders and running boards. Pascoag, RI<br/>ph 401-710-7645</p>
                    <p class="right_detail"><span class="detail_time">1971 Chevrolet impala</span> or caprice project. wanted demotte, in </p>
                    <p class="right_detail"><span class="detail_time">1948 Hudson</span> - Looking for a hood Tracy Stevens </p>
                    <p class="right_detail"><span class="detail_time">1939 Chevy Coupe</span> - parts wanted - Deluxe 85 Seat Track Ashland (Ohio) </p>
                    <p class="right_detail"><span class="detail_time">1940 plymouth p10</span> - wanted glove box door button - Chambly (Quebec) </p>
                    <p class="right_detail"><span class="detail_time">1939 Chevrolet sedan</span> - parts wanted delivery body, rough, rusty, possibly in california.. thanks, Citrus Heights; California</p>
                    <p class="right_detail"><span class="detail_time">1970 Oldsmobile 442</span> - parts wanted Kick panels for non A/C car. Looking for black, drivers and passenger side. Boston (Massachusetts)</p>
                           
                </div>
            </div>
        </div>

<!-- modal for add new brand -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Make</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <div class="input-group mb-3" id="newBrandInputDiv">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="brandTypeSelector">Name of New Make</label>
                </div>
                <input type="text" class="form-control" id="newBrandInput" name="newBrandInput">
                
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeAddBrandModalBtn">Close</button>
          <button type="button" class="btn btn-primary" id="newBrandBtn" onclick="addNewBrand()">Add</button>
        </div>
        
      </div>
    </div>
</div>

        <?php
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true)
                echo "<script> var loggedin=true;
                                var userId=".$_SESSION["userid"].";</script>";
            else echo "<script> var loggedin=false;</script>";
        ?>
        <script src="script.js"></script>
<script>
/*************************Add new model while posting new advert******************* */
function addNewModel(){
    if($("#newModelInput").val()==""){
        alert("Please input the new model name");
    }else{
        // /set advert detail columns
        $.ajax({
            type:   "POST",
            url:    "inc/ajax.php",
            data:{
                "action":"addNewModel",
                "id":   $("#carBrandSelector").val(),
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
getAllBrands();
getBrandModelWithId(1);
    $(document).ready(function(){

        //set year in form
        var html_content = "";
        for(i=1930;i<2000;i++){
            html_content += "<option value='"+i+"' selected>"+i+"</option>";
        }
        $("#yearSelector").html(html_content);

        //if select parts wanted, cars for sale, parts for sale, then check login status
        $('form.contact_form input[type="radio"]').on('click', function(e) {
            if(e.target.value>0 && !loggedin){
                var r = confirm("You have to login for post adverts!");
                if (r == true) {
                    $("#gridRadios1").prop('checked', true);
                    window.location.href="login/"
                } else{//not want to login
                    $("#gridRadios1").prop('checked', true);
                }
            }else if(e.target.value>0 && loggedin){//show details for select car brand, model...
                $("#advertDetails").css("display","block");
                
            }else $("#advertDetails").css("display","none");//simeple ask a question, then hide details form
        });

        $("#carBrandSelector").on("change", function(){
            console.log(this.value);
            getBrandModelWithId(this.value);
        })

        $("#brandTypeSelector").on("change", function(e){
                if($("#brandTypeSelector").val()=="addNewModel")
                    $("#newModelInputDiv").css("display","flex");
                else $("#newModelInputDiv").css("display","none");
        })

        $('#sendForm').on("click", function(){
            var advertEmail = $("#email").val();
            var advertPhone = $("#phone").val();
            var advertMessage = $("#details").val();

            if($("#gridRadios1").prop('checked')===true){
                $.ajax({
                    url: "/inc/ajax.php",
                    type: "post",
                    data: {
                        action: "sendQuestionEmail",
                        email:  advertEmail,
                        phone:  advertPhone,
                        message:advertMessage
                    },
                    success: function (response) {
                        $("#email").val("");
                        $("#phone").val("");
                        $("#details").val("");

                        $("#alertInfoDiv").css("display","block");
                        $("#alertInfoDiv").removeClass("alert-danger").addClass("alert-primary");
                        $("#alertInfo").html("Successfully sent your question to the Administrator!");
                        console.log("send email successfully");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }else{
                var advertType=2;
                if($("#gridRadios3").prop('checked')===true)advertType=1;
                else if($("#gridRadios4").prop('checked')===true)advertType=0;
                $.ajax({
                        type: "POST",
                        url: "/inc/ajax.php",
                        data: {
                            action:             "postAdvert",
                            advertType:         advertType,
                            userId:             userId,
                            brand:              $("#carBrandSelector").val(),
                            brandTypeSelector:  $("#brandTypeSelector").val(),
                            yearSelector:       $("#yearSelector").val(),
                            email:              advertEmail,
                            phone:              advertPhone,
                            details:            advertMessage,
                            uploadedImageName:  $("#uploadedImageName").val(),
                            uploadedImageUrl:   $("#uploadedImageUrl").val()
                        },
                        success: function(data)
                        {
                            console.log("created successfully");
                            $("form.contact_form")[0].reset();
                            $("#statusPercent").text("0%");
                            $("#progress-wrp .progress-bar").css("width", "0%");
                            $("#validatedCustomFile").val("");
                            $("#img_link_list").html("");
                            $("#uploadedImageUrl").val("");
                            $("#uploadedImageName").val("");
                            $("#fileNameLabel").text("Choose Image...");

                            $("#alertInfoDiv").css("display","block");
                            $("#alertInfoDiv").removeClass("alert-danger").addClass("alert-primary");
                            $("#alertInfo").html("Successfully Added your Advert!");
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                });
            }

        })
    })

</script>
    </body>
</html>