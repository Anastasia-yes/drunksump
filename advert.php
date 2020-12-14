<?php
// Start the session
session_start();
include_once("head.php");
include_once("nav.php");
?>

    <div class="container">
        <div class="row mt-5" >
            <div class="alert alert-danger"  style="width: 100%" role="alert">
                Invalid advert id!
            </div>
            <div class="alert alert-success" id="successAlert" role="alert" style="width: 100%; display: none;">
                Message was sent successfully.
            </div>
            <div class="col-12 text-right">
                <button onclick="goBack()" class="btn btn-info"><i class="fas fa-undo"></i> Back</button>
            </div>
            <div id="demo" class="carousel slide" data-ride="carousel">

                <!-- Indicators -->
                <ul class="carousel-indicators">
                    <!-- <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                    <li data-target="#demo" data-slide-to="2"></li> -->
                </ul>
                
                <!-- The slideshow -->
                <div class="carousel-inner">
                    <!-- <div class="carousel-item active">
                    <img src="img/advert/1603372315___1.jpg" alt="Los Angeles" width="1100" height="500">
                    </div>
                    <div class="carousel-item">
                    <img src="img/advert/1606303144___2.jpg" alt="Chicago" width="1100" height="500">
                    </div>
                    <div class="carousel-item">
                    <img src="img/advert/1606302394___FL-29-05-2020-11-26-41.JPG" alt="New York" width="1100" height="500">
                    </div> -->
                </div>
                
                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
            <!-- <div class="col-2"></div> -->
            <div class="media col-12" id="advertContent">
                
            </div>
            <div class="text-center col-12">
                <input type="text" value="<?= $_SESSION["userid"]?>" id="userId" hidden/>
                <input type="text" id="receiverId" class="form-control" style="display: none" />
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModal">
                    Send Message to <span id="userNameSpan"></span>
                </button>
            </div>
        </div>
    </div>

<!-- modal for add new brand -->
<div class="modal fade bd-example-modal-lg" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Send Message</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <div class="input-group mb-3" id="emailMessageDiv">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="emailMessage">Message</label>
                </div>
                <textarea class="form-control" id="emailMessage" rows="7" name="emailMessage"></textarea>
                
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
            
            
            <?php
                if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true){
            ?>
            
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalBtn">Close</button>
            <button type="button" class="btn btn-primary" id="newBrandBtn" onclick="sendMessage()">Send</button>
            <?php
                }else{
            ?>
            <div class="alert alert-warning" role="alert" style="display: block!important">
                You are not logged in user, cannot send message. Please <a href="login">sign in</a> first!
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalBtn">Close</button>
            <?php
                }
            ?>
        </div>
        
      </div>
    </div>
</div>   
    

    <script src="../script.js"></script>
    <script>

        $(document).ready(function(){
            $(".alert.alert-danger").hide();
            var advertTypeArray=["Parts wanted", "Parts for sale", "Cars for sale"];

            //set brandType
            $.ajax({
                url: "inc/ajax.php",
                type: "post",
                data: {
                    action: "getAdvertWithId",
                    id:     findGetParameter("id")
                },
                success: function (response) {
                    response = JSON.parse(response);
                    console.log("getadvertWithId result",response.advertiserId);
                    if(response.notfound === true)$(".alert.alert-danger").show();
                    else{
                        // You will get response from your PHP page (what you echo or print)
                        var output= '<div class="media-body">'+
                                        '<h3 class="mt-0 text-center">'+advertTypeArray[response.advertType]+'</h3>'+
                                        '<div class="advertRow">'+
                                            '<label class="advertRowTitle">'+
                                                'Advertiser:'+
                                            '</label>'+
                                            '<label class="advertRowDescription">'+
                                                response.user+
                                            '</label>'+
                                        '</div>'+
                                        '<div class="advertRow">'+
                                            '<label class="advertRowTitle">'+
                                                'Brand:'+
                                            '</label>'+
                                            '<label class="advertRowDescription">'+
                                                response.idBrand+
                                            '</label>'+
                                        '</div>'+
                                        '<div class="advertRow">'+
                                            '<label class="advertRowTitle">Model:</label>'+
                                            '<label class="advertRowDescription">For '+
                                                response.idBrandType+
                                            '</label>'+
                                        '</div>'+
                                        '<div class="advertRow">'+
                                            '<label class="advertRowTitle">Year:</label>'+
                                            '<label class="advertRowDescription">'+
                                                response.year+
                                            '</label>'+
                                        '</div>'+
                                        '<div class="advertRow">'+
                                            '<label class="advertRowTitle">Details:</label>'+
                                            '<label class="advertRowDescription">'+
                                                response.details+
                                            '</label>'+
                                        '</div>'+
                                        '<div class="advertRow">'+
                                            '<label class="advertRowTitle">Advert time:</label>'+
                                            '<label class="advertRowDescription">'+
                                                response.time+
                                            '</label>'+
                                        '</div>'+
                                    '</div>';
                        

                        // var imgOutput='<img src="img/advert/'+(response.image===''?'default.jpeg':response.image)+'" class="mr-3 advertImg" alt="image for advert">';
                        var responseImages=response.image;
                        if(responseImages.substr(0,2)==", ")responseImages=responseImages.substr(2);
                        var imageList = responseImages.split(", ");
                        var liString='', imgString='';
                        for(var i=0; i<imageList.length; i++){
                            liString+='<li data-target="#demo" data-slide-to="'+i+'" '+(i==0?'class="active"':'')+'></li>';
                            imgString +='<div class="carousel-item '+(i==0?'active':'')+'">'+
                                            '<img src="'+
                                                (imageList[i]===''?
                                                    'img/advert/default.jpeg':
                                                    (imageList[i].substr(0,4)=="http"?imageList[i]:'img/advert/'+imageList[i])
                                                )+
                                            '" width="400" >'+
                                        '</div>'
                        }
                        $(".carousel-indicators").html(liString);
                        $(".carousel-inner").html(imgString);
                        $("#advertContent").html(output);
                        $("#userNameSpan").text(response.user);
                        $("#receiverId").val(response.advertiserId);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $(".alert.alert-danger").show();
                    console.log(textStatus, errorThrown);
                }
            });
        })
        
    </script>
</body>
</html>

