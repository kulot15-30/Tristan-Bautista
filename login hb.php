<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images/house blend logo.png" type="image/png">
    <title>Login Page</title>
</head>
<body>
    
    <div class="login-section">
        <div class="login-box">
            <div class="logo-image">
                <img src="images/house blend logo.png" alt="House Blend Logo">
            </div>
            <h2>HOUSE BLEND</h2>
            
            <div class="input-container">
                <i class="fas fa-user"></i>
                <input type="text" id="username" placeholder="Username">
            </div>

            <div class="input-container">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" placeholder="Password">
                <i class="fas fa-eye" id="togglePassword"></i>
            </div>
            
            <button onclick="login()">Login</button>
            
            <div class="msg" id="message"></div>
        </div>
    </div>
    
  <script>
    // Define users
    const users = [
      {
        username: "tristan bautista",
        password: "HouseBlendTheBest",
        name: "Tristan Bautista",
        redirect: "index.html"
      }
    ];

    function login(){
      const username = document.getElementById("username").value.trim().toLowerCase();
      const password = document.getElementById("password").value;
      const messageEl = document.getElementById("message");

      // Clear previous message
      messageEl.textContent = "";
      messageEl.style.color = "#ff0000";

      // Check credentials
      const user = users.find(u => {
        // Check for both "tristan" and "tristan bautista"
        if (username === "tristan bautista") {
          return u.username === "tristan bautista" && u.password === password;
        }
        return u.username.toLowerCase() === username && u.password === password;
      });

      if (user) {
        // ✅ CRITICAL: Save authentication data to localStorage
        localStorage.setItem('houseblend_logged_in', 'true');
        localStorage.setItem('houseblend_user', JSON.stringify({
          name: user.name,
          username: user.username
        }));
        localStorage.setItem('houseblend_login_time', Date.now().toString());
        
        // Show success message
        messageEl.textContent = `Welcome, ${user.name}!`;
        messageEl.style.color = "#4CAF50";
        
        // Redirect to POS page
        setTimeout(() => {
          window.location.href = user.redirect;
        }, 500);
      } else {
        // Failed login
        messageEl.textContent = "Invalid username or password";
      }
    }
    
    // Add enter key support
    document.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        login();
      }
    });
    
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    
    togglePassword.addEventListener('click', function() {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });

    // Auto-focus username field
    document.getElementById("username").focus();

    // Check if already logged in (redirect to POS if already logged in)
    if (localStorage.getItem('houseblend_logged_in') === 'true') {
      window.location.href = "index.html";
    }
  </script>

</body>
</html>