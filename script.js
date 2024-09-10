document.getElementById("loginForm").addEventListener("submit", function(event) {
  event.preventDefault();
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;

  // Simple validation - replace with your own authentication logic
  if (username === "user" && password === "password") {
    // Simulate a successful login
    alert("Login successful!");
    // Redirect to another page or do something else
  } else {
    document.getElementById("error-msg").innerText = "Invalid username or password";
  }
});
