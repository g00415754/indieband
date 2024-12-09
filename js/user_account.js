// Handle SignUp
document.getElementById("signupForm").addEventListener("submit", function(e) {
    e.preventDefault();
  
    const username = document.getElementById("signupUsername").value;
    const email = document.getElementById("signupEmail").value;
    const password = document.getElementById("signupPassword").value;
  
    // Send data to server using Fetch API
    fetch("signup.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ username, email, password })
    })
    .then(response => response.json())
    .then(data => {
      const messageBox = document.getElementById("signupMessage");
      if (data.success) {
        messageBox.textContent = data.message;
        messageBox.className = "success-msg";
      } else {
        messageBox.textContent = data.message;
        messageBox.className = "error-msg";
      }
      messageBox.style.display = "block"; // Show message
    })
    .catch(error => console.error("Error:", error));
  });
  
  // Handle Login
  document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();
  
    const email = document.getElementById("loginEmail").value;
    const password = document.getElementById("loginPassword").value;
  
    // Send data to server using Fetch API
    fetch("login.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ email, password })
    })
    .then(response => response.json())
    .then(data => {
      const messageBox = document.getElementById("loginMessage");
      if (data.success) {
        messageBox.textContent = data.message;
        messageBox.className = "success-msg";
      } else {
        messageBox.textContent = data.message;
        messageBox.className = "error-msg";
      }
      messageBox.style.display = "block"; // Show message
    })
    .catch(error => console.error("Error:", error));
  });
  