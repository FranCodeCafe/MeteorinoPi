    //////////////// FUNCIONES ///////////////
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();

    function mostrarClave() {
    var x = document.getElementById("clave");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    }

 
    function validarClave(){
    var clave = document.getElementById("clave");
    var repiteclave = document.getElementById("repiteclave");
      if(clave.value != repiteclave.value) {
        repiteclave.setCustomValidity("Las claves no coinciden.");
      } else {
        repiteclave.setCustomValidity('');
      }
    }

