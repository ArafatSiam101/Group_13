document.addEventListener("DOMContentLoaded", () => {
    loginBtn.onclick = function () {
        let email = document.querySelector("input[type='email']").value.trim();
        let password = document.querySelector("input[type='password']").value.trim();
        let selectedRole = userRole.value;
      
        if (!email || !password || !selectedRole) {
          alert("Please fill in all fields and select a role.");
          return;
        }
      

      
        // Redirect based on role
        redirectToRolePage(selectedRole);
      };
      
      function validateEmail(email) {
        const emailRegex = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/;
        return emailRegex.test(email);
      }
      
      function redirectToRolePage(role) {
        if (role === "Customer") {
          window.location.href = "customer.html";
        } else if (role === "Nutritionists") {
          window.location.href = "Nutritionist/nutritionistDashboard.html";
        } else if (role === "TransportCoordinator") {
          window.location.href = "Transport Coordinator/transportCoordinatorDashboard.html";
        } else if (role === "Farmer") {
          window.location.href = "Farmer/farmerDashboard.html";
        } else if (role === "Admin") {
            window.location.href = "Admin/Dashboard.html"; 
        } else {
          alert("Invalid role selected.");
        }
      }
 
      
})