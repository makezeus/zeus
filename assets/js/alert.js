document.addEventListener("DOMContentLoaded", function () {
 
  const alertElement = document.createElement("div");
  alertElement.className = "alert";
  alertElement.style.display = "none";


  const alertIcon = document.createElement("img");
  alertIcon.className = "alert-icon";
  alertIcon.src = "../assets/img/logo.svg";

  
  const alertBody = document.createElement("div");
  alertBody.className = "alert-body";


  const alertTitle = document.createElement("p");
  alertTitle.id = "alert-title";


  const alertMessage = document.createElement("p");
  alertMessage.id = "alert-message";


  alertElement.appendChild(alertIcon);
  alertElement.appendChild(alertBody);
  alertBody.appendChild(alertTitle);
  alertBody.appendChild(alertMessage);

  document.body.appendChild(alertElement);

});

function showAlert(title, message) {
  const alertElement = document.querySelector(".alert");
  const alertTitle = document.getElementById("alert-title");
  const alertMessage = document.getElementById("alert-message");

  alertTitle.textContent = title;
  alertMessage.textContent = message;
  // alertElement.className = `alert ${type}`;

  alertElement.style.display = "flex";
  
  setTimeout(function () {
    alertElement.style.display = "none";
  }, 4000);
}