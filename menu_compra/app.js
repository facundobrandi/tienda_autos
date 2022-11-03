
$(document).ready(function ()
{
    cargaTabla();
    let i = 0;
    let carrito = [];
    let cart =[];
    let total = 0;
    let mail;

    $('#Email_send').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            type     : "POST",
            url      : "./enviar_mail.php",
            data     :{
                nombre : $("#nombre").val(),
                total : total,
                email : $("#email").val()
                },
            success  : function(respuestaDelServer) {
                Swal.fire("Estado del Email",`${respuestaDelServer}`);
                $("#myModal").modal('hide');
            }
        });
    
    });

    $("#Comprar_2").click(function()
    {

        if (cart.length == 0)
        {
            Swal.fire("No hay items en el carrito", "Agrega items en el carrito para poder comprar", "error");
            return
        }
        Swal.fire({
            title: 'Confirmar Compra',
            text: `Estas seguro que quieres comprar estos autos por un total de ${total} $`,
            showDenyButton: true,
            confirmButtonText: 'Comprar',
            denyButtonText: `Todavia No`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $("#myModal").modal('show');

            } else if (result.isDenied) {
              Swal.fire('Compra Cancelada', '', 'danger')
            }
          })
    })





    
    $("#ver").click(function()
        {
            cargaTabla();
        });
    $("#ver_carrito").click(function()
        {
            if (cart.length ==0)
            {
                Swal.fire("No hay items en el carrito", "Agrega items en el carrito para poder comprar", "error");
                return
            }
            actualizar_carrito();
        });

    function actualizar_carrito()
    {
        $(".page-content").empty();
        let objTbDatos = document.getElementById("tabla")
        cart.forEach(function(Valor){
            let div = document.createElement("div");
            div.setAttribute("class","product-container");

            let h1 = document.createElement("h1");
            h1.innerHTML = Valor.MODELO;

            let h3 = document.createElement("h3");
            h3.innerHTML = "$" + Valor.PRECIO;

            let h3_2 = document.createElement("h3");
            h3_2.innerHTML = Valor.PATENTE;

            let img = document.createElement("img");
            img.setAttribute("src",Valor.RUTA);

            let button_2 = document.createElement("button");
            button_2.setAttribute("class","sacar-del-carrito button-take");
            button_2.innerHTML = "Eliminar del carrito"
            button_2.setAttribute("value",i);
            i++;

            div.appendChild(h1);
            div.appendChild(img);
            div.appendChild(h3);
            div.appendChild(h3_2);
            div.appendChild(button_2)

            objTbDatos.appendChild(div);
        })

        i = 0;

        $(".sacar-del-carrito").click(function()
        {

            let val = $(this).attr("value");
            sacar(val);
            
        });


    }

    function sacar(val)
    {
        console.log(cart[val].PRECIO)
        total = total - cart[val].PRECIO;
        $("#total").text("Total = $"+total);
        cart.splice(val,1);
        
        Toastify({
            text: "Producto Eliminado",
            duration: 3000
            }).showToast();
        if (cart.length == 0)
        {  
            cargaTabla();
            return;
        }
        actualizar_carrito();
    }

    function agregar(val)
    {
        //alert(parseInt(val));
        cart.push(carrito[val]);
        total = total + carrito[val].PRECIO;
        $("#total").text("Total = $"+total);

        Toastify({
            text: "Producto agregado",
            duration: 3000
            }).showToast();
    }

    function cargaTabla(){

        $(".page-content").empty();
        $(".page-content").html("<p>Esperando respuesta ....</p>");
        
            let objAjax = $.ajax({
            type:"get",
            url:"respuesta.php",
                data: {},
                success: function(respuestaDelServer,estado) {
                    let objTbDatos = document.getElementById("tabla")
                        $(".page-content").empty();
                        objJson=JSON.parse(respuestaDelServer);
                        objJson.articulos.forEach(function(argValor,argIndice) {

                            let div = document.createElement("div");
                            div.setAttribute("class","product-container");

                            let h1 = document.createElement("h1");
                            h1.innerHTML = argValor.MODELO;

                            let h3 = document.createElement("h3");
                            h3.innerHTML = "$" + argValor.PRECIO;

                            let h3_2 = document.createElement("h3");
                            h3_2.innerHTML = argValor.PATENTE;

                            let img = document.createElement("img");
                            img.setAttribute("src",argValor.RUTA);

                            let button_1 = document.createElement("button");
                            button_1.setAttribute("class","agregar_al_carrito button-add");
                            button_1.innerHTML = "Agregar"
                            button_1.setAttribute("value",i);
                            i++;

                            div.appendChild(h1);
                            div.appendChild(img);
                            div.appendChild(h3);
                            div.appendChild(h3_2);
                            div.appendChild(button_1);

                            objTbDatos.appendChild(div);

                });//cierra el forEach
            
                carrito = objJson.articulos;
                i =0;
                //console.log(carrito);

                    $(".agregar_al_carrito").click(function()
                        {

                            let val = $(this).attr("value");
                            console.log(val);

                            agregar(val);
                            
                        });
                

            }//cierra funcion asignada al success

        }); //cierra objeto de parametros y funcion ajax

    }//cierra funcion cargaTabla
});