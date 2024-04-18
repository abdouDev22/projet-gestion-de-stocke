<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="imge/svg+xml" href="store-svgrepo-com.svg">
  <link rel="stylesheet" href="asset/coment.css">
  <link rel="stylesheet" href="asset/index.css">
  <link rel="icon" type="imge/svg+xml" href="store-svgrepo-com.svg">
  
  <title>Document</title>
</head>
<body>
  <nav>
    <a href="index.php">
      <div class="logo">
        <strong>MATA</strong>
        <span>Company</span>
      </div>
    </a>
    
    
    <ul>
      <li><a href="login.php">login</a> </li>
    </ul>

  </nav>
  
  <div class="wrapper">
    <svg>
      <text x="50%" y="50%" dy=".35em" text-anchor="middle">
        Welcome
      </text>
    </svg>
  </div>

    <div class="image-human">
      <span><img src="Humaaans - 1 Character.png" alt=""></span>
      <span><img src="Humaaans - Friend Meeting.png" alt=""></span>
      <span><img src="Humaaans - 1 Character (3).png" alt=""></span>
      
    </div>
    
  

  </div>
  <script>
    function transitionToLogin() {
      document.querySelector('.wrapper').style.opacity = 0;
      setTimeout(function() {
        window.location.href = 'login.html';
      }, 2000);
    }
    </script>
    
</body>
</html>