<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />



        <nav class="navbar navbar-dark bg-primary navbar-expand-lg">
            <a class="navbar-brand" href="index.php">
                <img src="<?=$rootDir?>img/logo-img.gif" class="d-inline-block align-top drunksump_logo" alt="" loading="lazy">
                DrunkSump
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="./">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <!-- <form class="form-inline my-2 my-lg-0 mr-2"> -->
                <div class="dropdown-search">
                    <div id="myDropdown" class="dropdown-content">
                        <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
                        <!-- <a href="#about">About</a> -->
                        <?php
                            include_once("config.php");
                            $sql = "SELECT id, name FROM brand";
                            $result = $conn->query($sql);
                                            
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<a href='/".$row["name"]."-parts'>".$row["name"]."</a>";
                                }
                            } else {
                                echo "Have no brand in database!";
                            }
                        ?>
                    </div>
                </div>

                <?php
                include("config.php");
                if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true){
                ?>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?=$_SESSION["username"]?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php echo $_SESSION["usertype"]=='1'?
                                        '<a class="dropdown-item" href="'.$rootDir.'/admin">Goto Admin</a>':
                                        ''; 
                            ?>
                            
                            <a class="dropdown-item" href="admin/advert.php">My Adverts</a>
                            <a class="dropdown-item" href="admin/chat.php">Messages</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" id="logoutButton"><i class="fas fa-sign-out-alt" ></i> Logout</a>
                        </div>
                </div>
                <?php 
                }else{
                ?>
                    <a href="<?=$rootDir?>login">
                        <button class="btn btn-outline-dark my-2 my-sm-0 ml-3">
                            Login <i class="fas fa-sign-in-alt" ></i>
                        </button>
                    </a>
                <?php
                }
                ?>
            </div>
        </nav>