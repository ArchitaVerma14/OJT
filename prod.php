<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Page</title>
  <link rel="stylesheet" href="prod.css">
</head>
<body>

  <div class="navbarnew">
    <div class="logonew">
        <img src="images/logo.png" alt="Logo">
        <span>Pet Pantry</span>
    </div>
    <div class="nav-linksnew">
        <a href="home.html"><i class="fas fa-home"></i> Home</a>
        <a href="about.html"><i class="fas fa-info-circle"></i> About</a>
        <a href="product.html"><i class="fas fa-box"></i> Products</a>
        <a href="accessories.html"><i class="fas fa-cogs"></i> Accessories</a>
        <a href="review.html"><i class="fas fa-comments"></i> Review</a>
        <div class="dropdownnew">
            <a href="#shop"><i class="fas fa-shopping-cart"></i> Shop <i class="fas fa-chevron-down"></i></a>
            <div class="dropdown-menunew">
                <a href="#shop-cat">Cat</a>
                <a href="#shop-dog">Dog</a>
                <a href="#shop-bird">Bird</a>
                <a href="#shop-turtle">Turtle</a>
                <a href="#shop-rabbit">Rabbit</a>
            </div>
        </div>
    </div>
    <div class="account-linksnew">
        <button onclick="login()"><i class="fas fa-sign-in-alt"></i> Login</button>
        <button onclick="signup()"><i class="fas fa-user-plus"></i> Sign Up</button>
        <div class="cartnew">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-countnew">0</span>
        </div>
    </div>
</div>
<!--dog food-->

  <main class="product-page">
    <div class="product">
      <img src="images/dog1.jpg" alt="Product Image" class="product-image">
      <div class="product-details">
        <h2 class="product-title">Premium Dog Food</h2>
        <p class="product-description">This premium dog food is packed with nutrients and flavors your pet will love.</p>
        <p class="product-price">$29.99</p>
        <button class="view-more" onclick="location.href='dog_page.php';">View More</button>

      </div>
    </div>
  </main>

  <!--cat food-->

  <main class="product-page">
    <div class="product">
      <img src="images/cat1.jpg" alt="Product Image" class="product-image">
      <div class="product-details">
        <h2 class="product-title">Premium Cat Food</h2>
        <p class="product-description">This premium cat food is packed with nutrients and flavors your pet will love.</p>
        <p class="product-price">$29.99</p>
        <button class="view-more" onclick="location.href='cat_page.php';">View More</button>

      </div>
    </div>
  </main>

<!--bird food-->

  <main class="product-page">
    <div class="product">
      <img src="images/bird1.jpg" alt="Product Image" class="product-image">
      <div class="product-details">
        <h2 class="product-title">Premium Bird Food</h2>
        <p class="product-description">This premium bird food is packed with nutrients and flavors your pet will love.</p>
        <p class="product-price">$29.99</p>
        <button class="view-more" onclick="location.href='bird_page.php';">View More</button>

      </div>
    </div>
  </main>

<!--fish food-->

  <main class="product-page">
    <div class="product">
      <img src="images/fish1.jpg" alt="Product Image" class="product-image">
      <div class="product-details">
        <h2 class="product-title">Premium Fish Food</h2>
        <p class="product-description">This premium fish food is packed with nutrients and flavors your pet will love.</p>
        <p class="product-price">$29.99</p>
        <button class="view-more" onclick="location.href='fish_page.php';">View More</button>
      </div>
    </div>
  </main>

  <!--rabbit food-->

  <main class="product-page">
    <div class="product">
      <img src="images/rabbit1.jpg" alt="Product Image" class="product-image">
      <div class="product-details">
        <h2 class="product-title">Premium Rabbit Food</h2>
        <p class="product-description">This premium rabbit food is packed with nutrients and flavors your pet will love.</p>
        <p class="product-price">$29.99</p>
        <button class="view-more" onclick="location.href='rabbit_page.php';">View More</button>
      </div>
    </div>
  </main>

  <!--turtle-->
  <main class="product-page">
    <div class="product">
      <img src="images/dog1.jpg" alt="Product Image" class="product-image">
      <div class="product-details">
        <h2 class="product-title">Premium turtle Food</h2>
        <p class="product-description">This premium turtle food is packed with nutrients and flavors your pet will love.</p>
        <p class="product-price">$29.99</p>
        <button class="view-more" onclick="location.href='turtle_page.php';">View More</button>

      </div>
    </div>
  </main>



  <footer class="footer">
    <p>&copy; 2025 Pet Food Shop. All Rights Reserved.</p>
  </footer>
</body>
</html>
