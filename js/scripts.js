$(document).ready(function(){

    function Buscardatos(){
        var emisor_rucIN = $("#emisor_ruc").val();
        var emisor_docIN = $("input[name='emisor_doc']:checked").val();
        var emisor_serieIN = $("#emisor_serie").val();
        var emisor_numeroIN = $("#emisor_numero").val();
        var emisor_fechaIN = $("#emisor_fecha").val();
        var cliente_rucIN = $("#cliente_ruc").val();

        var fecha_parts = emisor_fechaIN.split("/");
        if (fecha_parts.length === 3){
            emisor_fechaIN = fecha_parts[2]+"/"+fecha_parts[1]+"/"+fecha_parts[0]
        }


        var campos_vacios = [];

        if(emisor_rucIN === "") campos_vacios.push("Ruc emisor");
        if(!$("input[name='emisor_doc']").is(":checked")) campos_vacios.push("Tipo de documento");
        if(emisor_serieIN === "") campos_vacios.push("Número de serie");
        if(emisor_numeroIN === "") campos_vacios.push("Número de emisor");
        if(emisor_fechaIN === "") campos_vacios.push("Fecha de emisión");
        if(cliente_rucIN === "") campos_vacios.push("Ruc del cliente");
 
        if(campos_vacios.length === 0){
            $.ajax({
                url: 'controllers/cliente.controller.php',
                type: 'POST',
                data: { operacion: 'buscar',
                        emisor_ruc: emisor_rucIN,
                        emisor_doc: emisor_docIN,
                        emisor_serie: emisor_serieIN,
                        emisor_numero: emisor_numeroIN,
                        emisor_fecha: emisor_fechaIN,
                        cliente_ruc: cliente_rucIN
                    },
                dataType: 'JSON',
                success: function(result){
                    console.log(result);
                    if(result["status"]){

                        //descarga del archivo base64
                        var base64_file_data = result["datos"]["file_zip"];
                        var file_name = 'nombreZip';

                        //Crear y simular el enlace de descarga
                        var a = document.createElement("a");

                        a.href = "data:application/octet-stream;base64," + base64_file_data;
                        a.download = file_name;
                        a.style.display = 'none';

                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);

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
            title: 'Llene todo los campos: '+ campos_vacios.join(", "),
            showConfirmButton: false,
            timer: 5500
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