$(document).ready(function () { 
   $("#loginBtn").click(function (e) { 
      e.preventDefault();
      var userCredentials = new FormData
      var user = $("#username").val()
      var password =  $("#password").val()
      userCredentials.append('accion', "login")
      userCredentials.append('user', user)
      userCredentials.append('pass', password)
      
      fetch('../sesion/validate.php',{

         method: 'POST',
         body: userCredentials

      }).then((response) => response.json()).then((response => {

         switch(response){
            case "login_success":
               window.location.href = "../../views/index.php";
               break;
            case "login_error":
               alert("verifica tus credenciales de inicio");
               break;
            default:
               alert("verifica tus credenciales");
               break;
         }
      }))
   })
});