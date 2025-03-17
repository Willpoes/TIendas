
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<?php 
$token=$_GET["token"];
$monto=$_GET["monto"];
$correo=$_GET["correo"];
$monto=$monto*100;
?>
<script type="text/javascript">
	
var token = '<?=$token?>';
           
            $.ajax({
                url: 'https://api.culqi.com/v2/charges',
                data: JSON.stringify({
                    "source_id": token,
                    "amount": <?=$monto?>,
                    "currency_code": "PEN",
                    "email":"<?=$correo?>"
                }),
                contentType: "application/json",
                headers: {
                    "Accept": "application/json",
                    "authorization": "Bearer sk_test_3PIJCYT3vrE3tUG2"
                },
                error: function (err) {


                 // alert('Lo sentimos, a ocurrido un error');
                   document.write('{"m":"Lo sentimos, a ocurrido un error","p":0}');
                },

                dataType: 'json',
                success: function (data) {
                   // guardar_datos();
 					document.write('{"m":"Pago exitoso","p":1}');
				//alert("pago exitoso");
					// swal.fire({position:'top-end',type:'success',title:'Pago exitoso',showConfirmButton:false,timer: 1500});
					//swal("Confirmado!", "Pago exitoso " + contenidotext , "success");

                },
                type: 'POST'
            });

</script>
