var interval;
var regresa_arriba;
$(document).ready(function () {
//  $('.tooltipped').tooltip({delay:50});
  interval= setInterval(cerrarSesion, timesession * 1000);
  $('#regresa_arriba').fadeOut();
  regresa_arriba=false;

});

/*
Function: cerrarSesion()
Params: Ninguno
Action: Pregunta si se desea continuar capturando, 
en caso contrario se cierra la sesión*/
function scrollToTop() { 
  // window.scrollTo(0, 0); 

  
      console.log(regresa_arriba);
        $("html, body").animate({
          scrollTop: 0
      }, 1000);
   
} 

/*************************************
        Function: togglePassword(e)
        Params: e - objeto que detono el evento
        Action: Cambia el tipo de campo a la contraseña para poder alternar entre carácteres visibles y ocultos
        Return: 
  **************************************/
 function togglePassword(e) {

  var icon_target=$(e).find("i")[0];
  var input_target=icon_target.closest("div").children[1];
  console.log(input_target.getAttribute('type'));
  // var inputField = document.querySelector(input_target);
  if (input_target.getAttribute('type') == "password") {
      input_target.setAttribute('type', 'text');
      icon_target.innerHTML = "visibility_off";
      
  } else if (input_target.getAttribute('type') == "text") {
      input_target.setAttribute('type', 'password');
      icon_target.innerHTML = "visibility";
  }
}

$(window).scroll(function() {
  if ($(this).scrollTop() > 0) {
   
    if(!regresa_arriba)
    {
      $('#regresa_arriba').fadeIn();
      regresa_arriba=true;
      $("#regresa_arriba").bind("onclick", null);
    }
   
  } else {
    regresa_arriba=false;
    $('#regresa_arriba').fadeOut();
    $("#regresa_arriba").bind("onclick", scrollToTop);
  }
});

function cerrarSesion()
{
 
    var url = serverurl + "ajax/checkaccessAjax.php";
    // console.log(url);
   
        
    $.ajax({
  
      url: serverurl + "ajax/checkaccessAjax.php",
      data:{"accion":"BUSCAR"},
      method: "post",
      success: function (res) {
         res=JSON.parse(res);
        if(res.access==0)
        {
          swal({
            title: '¿Deseas continuar editando?',
            text:'En caso de no continuar se cerrara la sesión',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Salir',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuar',
            allowOutsideClick: false
          }).then(function () {
            $.ajax({
  
              url: serverurl + "ajax/checkaccessAjax.php",
              data:{"accion":"REFRESCAR"},
              method: "post",
              success: function (res) {
                clearInterval(interval);
               interval=setInterval(cerrarSesion,timesession * 1000)
              }
            });
          }).catch(function()
            {
              $.ajax({
  
                url: serverurl + "ajax/checkaccessAjax.php",
                data:{"accion":"CERRAR"},
                method: "post",
                success: function (res) {
                   res=JSON.parse(res);
                  if(res.access==0)
                  {
                    window.location.href = serverurl + 'login';
                  }
                }
              });
             
            }
          );
        }
      }
    });
}


