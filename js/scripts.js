$(document).ready(function(){

    function Buscardatos(){
        var nromatriculaIN = $("#nromatricula").val();
        var periomatriculaIN = $("#periodomatricula").val();
        var apellidosIN = $("#apellidos").val();
        var inputs = $(".form-control");
        var todosllenos = true;

        inputs.each(function(){
            if($(this).val() === ""){
                todosllenos = false;

                return false;
            }
        });
 
        if(todosllenos){
            $.ajax({
                url: 'controllers/alumno.controller.php',
                type: 'POST',
                data: { operacion : 'buscar',
                        nromatricula : nromatriculaIN,
                        periodomatricula : periomatriculaIN,
                        apellidos : apellidosIN
                    },
                dataType: 'JSON',
                success: function(result){
                    console.log(result);
                    if(result["status"]){

                        var url = "views/img/179662_104059769669882_100001975771947_26300_772872_n.jpg";
                        var a = $("<a>").attr("href",url).attr("download","archivo");
                        $("body").append(a);
                        a[0].click();
                        a.remove();

                    }else{
              Swal.fire({
                  icon: 'error',
                  title: (result["mensaje"]),
                  text: 'Has cometido un error!',
                  footer: '<a href="">¿Poqué sucedió esto?</a>'
                })
            }
          }
         }); 
        }else{
          Swal.fire({
            position: 'midle-center',
            icon: 'error',
            title: 'Llene todo los campos',
            showConfirmButton: false,
            timer: 1500
          });
        }
    }
    $("#download").click(Buscardatos);
});
/*document.getElementById("download").addEventListener("click",function(){

    var url = "../views/img/179662_104059769669882_100001975771947_26300_772872_n.jpg";
    var a = document.createElement("a");
    a.href = url;
    a.download = "archivo";
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
});*/

/*en el html name contiene la llave para acceder al valor de un campo de la tabla:
osea para eso sirve le name?
Answer :

Share icon
Sí, el atributo  name  en un elemento de formulario HTML es utilizado para identificar el nombre o la clave del campo cuando se envía el formulario al servidor. Cuando se envía el formulario, el valor del campo se envía en el array  $_POST  o  $_GET  en función del método de envío del formulario (POST o GET) y se puede acceder utilizando el nombre especificado en el atributo  name . 
 
En el ejemplo anterior, al hacer coincidir el  name  del input con el  id  del campo de la tabla, se asegura que el valor del input se envíe correctamente en  $_POST['apellido'] . Esto permite utilizar ese valor en el código PHP para realizar la búsqueda en la base de datos. 
 
Es importante tener en cuenta que el atributo  name  es diferente del atributo  id . El atributo  id  se utiliza para identificar de manera única un elemento HTML, mientras que el atributo  name  se utiliza para identificar el nombre del campo en el formulario y obtener su valor cuando se envía el formulario*/