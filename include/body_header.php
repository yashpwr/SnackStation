<?php
$email = $_SESSION['email'];
$queryshow = "SELECT * from users WHERE email='" . $email . "'";
$result = mysqli_query($db, $queryshow);
$row = mysqli_fetch_assoc($result);
$id = $row['id'];
?>
<!-- Navigation -->
<div class="header">
    <header class="full-width">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mainNavCol">
                    <!-- logo -->
                    <div class="logo mainNavCol">
                        <a href="index.php">
                            <img src="assets/img/logo.png" class="img-fluid" alt="Logo">
                        </a>
                    </div>
                    <!-- logo -->
                    <div class="main-search mainNavCol">
                        <form class="main-search search-form full-width">
                            <div class="row">
                                <!-- search -->
                                <div class="col-lg-6 col-md-7">

                                </div>
                                <!-- search -->
                            </div>
                        </form>
                    </div>
                    <div class="right-side fw-700 mainNavCol">
                        <!-- <div class="gem-points">
                                <a href="#"> <i class="fas fa-concierge-bell"></i>
                                    <span>Order Now</span>
                                </a>
                            </div> -->
                        <div class="gem-points">
                            <a href="order-details.php">
                                <span>My Order</span>
                            </a>
                        </div>
                        <div class="gem-points">
                            <a href="about.php">
                                <span>About Us</span>
                            </a>
                        </div>

                        <!-- user account -->
                        <div class="user-details p-relative">
                            <a href="javascript:void(0)" class="text-light-white fw-500">
                                <img src="/SnacksStation/uploads/user-profile-img/<?php echo $row['img']; ?>" style="height: 30px; width: 30px;" class="rounded-circle" alt="userimg"> <span>Hi, <?php echo $row['fname']; ?></span>
                            </a>
                            <div class="user-dropdown">
                                <ul>
                                    <li>
                                        <a href="order-details.php">
                                            <div class="icon"><i class="flaticon-rewind"></i>
                                            </div> <span class="details">Past Orders</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="profile.php">
                                            <div class="icon"><i class="flaticon-user"></i>
                                            </div> <span class="details">Profile</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="user-footer"> <span class="text-light-black">Not <?php echo $row['fname']; ?>?</span> <a href="logout.php">Sign Out</a>
                                </div>
                            </div>
                        </div>
                        <!-- mobile search -->
                            
                        <!-- user cart -->
                        <div class="cart-btn cart-dropdown">
                            <a href="#" class="text-light-green fw-700"> <i class="fas fa-shopping-bag"></i>
                            </a>
                            <div class="cart-detail-box">
                                <?php
                                $q = "SELECT * FROM `cart` WHERE user_id =  $id";
                                $ress = mysqli_query($db, $q);
                                if (mysqli_num_rows($ress) == 0) {
                                ?>
                                 <div class="card">
                                    <div class="card-footer padding-15"> <a href="index.php" class="btn-first green-btn text-custom-white full-width fw-500">Please add some food in cart</a>
                                </div>
                            </div>
                            <?php } else { ?>
                            <div class="card">
                                    <div class="card-header padding-15">Your Order</div>
                                    <div class="card-body no-padding">
                                        <?php
                                        $user_id = $row['id'];
                                        $query = "SELECT snacks.id as ID, snacks.name, snacks.price, cart.id as cid FROM cart 
                                        LEFT JOIN snacks ON snacks.id = cart.snacks_id WHERE cart.user_id='$user_id'";
                                        $result = mysqli_query($db, $query)or die( mysqli_error($db));
                                        $count = 1;
                                        while ($r = mysqli_fetch_array($result)) {
                                        ?>
                                            <div class="cat-product-box">
                                                <div class="cat-product">
                                                    <div class="cat-name">
                                                        <a href="product_details.php?id=<?php echo $r["ID"]; ?>">
                                                            <p class="text-light-green"> <?php echo $r['name']; ?></p>
                                                        </a>
                                                    </div>
                                                    <div class="delete-btn">
                                                        <a href="delete_order.php?id=<?php echo $r['cid']; ?>" class="text-dark-white"> <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                    <div class="price"> <a href="product_details.php?id=<?php echo $r["ID"]; ?>" class="text-dark-white fw-500">
                                                    <?php echo $r['price']; ?> RS
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php $count++;
                                        } ?>
                                    </div>
                                    <div class="card-footer padding-15"> <a href="checkout.php" class="btn-first green-btn text-custom-white full-width fw-500">Proceed to Checkout</a>
                                    </div>
                                </div>
                            <?php }  ?>
                        </div>
                        <!-- user cart -->
                    </div>
                </div>

            </div>
        </div>
    </header>
</div>
<!-- Navigation -->