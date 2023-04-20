 <div style="text-align: center; margin-top: 120px"> {{$qrCode}} </div>


@vite(['resources/css/app.css', 'resources/js/app.js'])
  

<script>
    //        Echo.channel('my-channel')
    // .listen('MyEvent', (event) => {
    //     console.log(event);
    // });
        </script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // Conectarse a Pusher
    var pusher = new Pusher(('2b67b15a01669d19aaba'), {
        cluster: ('us2'),
        encrypted: true
    });
	$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    // Escuchar el evento "qr" en el canal "qr-channel"
    var channel = pusher.subscribe('my-channel');
    channel.bind('qr-event', function(data) {
		
   
    console.log(data);
	location.reload();
	window.location.href = '/Dashboard/User';
        }  );
/*
		$.ajax({
    type: 'GET',
    url: '/mi-ruta',
    dataType: 'json',
    success: function(response) {
        var miDato = response.miDato;
		document.cookie = "qr=" + miDato;
        // Haz algo con el valor de la cookie
    }
});
*/
		///datosJson = json_encode(data.message);
		//document.cookie = "qr=data;"
		//console.log("data",data)
		//document.cookie = "qr=" + data;
        // Actualizar la vista con los nuevos datos de la tabla QR
        //
		//document.cookie = "qr=eyJpdiI6InVFWUIwNEhiUk12RkloNVpxMXNRSnc9PSIsInZhbHVlIjoibTg3RmlPR0UwbUhrbHhYRVlJVGh0NHpmUGFhdFNtdEJ2UG9pcmN2bm5sYzQ5N1NCeGpiYjF4b0cwMHdJK3UycEpCYUhyZkRtNHp4QVRERnlVYWNLYk1vQ3pKRWRuTTA3cktmbmwrRmJXUUExejdHOHFqUGNEMXl4c2FqRjRuRG8iLCJtYWMiOiJjZjY5MWViMmM4MDcyYzcyMjU4N2MzMGM2ZWRkMTc3OThkZWIwMjI1MzdkN2RhMDdmOTI4ZWYzYmZhMjVlZWI3IiwidGFnIjoiIn0%3M;";
		//document.cookie = "miCooqrkie=" + nuevoValor
		//
		//document.cookie = "qr=eyJpdiI6InVFWUIwNEhiUk12RkloNVpxMXNRSnc9PSIsInZhbHVlIjoibTg3RmlPR0UwbUhrbHhYRVlJVGh0NHpmUGFhdFNtdEJ2UG9pcmN2bm5sYzQ5N1NCeGpiYjF4b0cwMHdJK3UycEpCYUhyZkRtNHp4QVRERnlVYWNLYk1vQ3pKRWRuTTA3cktmbmwrRmJXUUExejdHOHFqUGNEMXl4c2FqRjRuRG8iLCJtYWMiOiJjZjY5MWViMmM4MDcyYzcyMjU4N2MzMGM2ZWRkMTc3OThkZWIwMjI1MzdkN2RhMDdmOTI4ZWYzYmZhMjVlZWI3IiwidGFnIjoiIn0%3M;";
		//document.cookie = "qr=eyJpdiI6InVFWUIwNEhiUk12RkloNVpxMXNRSnc9PSIsInZhbHVlIjoibTg3RmlPR0UwbUhrbHhYRVlJVGh0NHpmUGFhdFNtdEJ2UG9pcmN2bm5sYzQ5N1NCeGpiYjF4b0cwMHdJK3UycEpCYUhyZkRtNHp4QVRERnlVYWNLYk1vQ3pKRWRuTTA3cktmbmwrRmJXUUExejdHOHFqUGNEMXl4c2FqRjRuRG8iLCJtYWMiOiJjZjY5MWViMmM4MDcyYzcyMjU4N2MzMGM2ZWRkMTc3OThkZWIwMjI1MzdkN2RhMDdmOTI4ZWYzYmZhMjVlZWI3IiwidGFnIjoiIn0%3M;";
		//document.cookie = "qr=eyJpdiI6InVFWUIwNEhiUk12RkloNVpxMXNRSnc9PSIsInZhbHVlIjoibTg3RmlPR0UwbUhrbHhYRVlJVGh0NHpmUGFhdFNtdEJ2UG9pcmN2bm5sYzQ5N1NCeGpiYjF4b0cwMHdJK3UycEpCYUhyZkRtNHp4QVRERnlVYWNLYk1vQ3pKRWRuTTA3cktmbmwrRmJXUUExejdHOHFqUGNEMXl4c2FqRjRuRG8iLCJtYWMiOiJjZjY5MWViMmM4MDcyYzcyMjU4N2MzMGM2ZWRkMTc3OThkZWIwMjI1MzdkN2RhMDdmOTI4ZWYzYmZhMjVlZWI3IiwidGFnIjoiIn0%3M;";
		//document.cookie = "qr=eyJpdiI6InVFWUIwNEhiUk12RkloNVpxMXNRSnc9PSIsInZhbHVlIjoibTg3RmlPR0UwbUhrbHhYRVlJVGh0NHpmUGFhdFNtdEJ2UG9pcmN2bm5sYzQ5N1NCeGpiYjF4b0cwMHdJK3UycEpCYUhyZkRtNHp4QVRERnlVYWNLYk1vQ3pKRWRuTTA3cktmbmwrRmJXUUExejdHOHFqUGNEMXl4c2FqRjRuRG8iLCJtYWMiOiJjZjY5MWViMmM4MDcyYzcyMjU4N2MzMGM2ZWRkMTc3OThkZWIwMjI1MzdkN2RhMDdmOTI4ZWYzYmZhMjVlZWI3IiwidGFnIjoiIn0%3M;";
		//window.location.href = "/admin/dashboard?qr=qr=eyJpdiI6InVFWUIwNEhiUk12RkloNVpxMXNRSnc9PSIsInZhbHVlIjoibTg3RmlPR0UwbUhrbHhYRVlJVGh0NHpmUGFhdFNtdEJ2UG9pcmN2bm5sYzQ5N1NCeGpiYjF4b0cwMHdJK3UycEpCYUhyZkRtNHp4QVRERnlVYWNLYk1vQ3pKRWRuTTA3cktmbmwrRmJXUUExejdHOHFqUGNEMXl4c2FqRjRuRG8iLCJtYWMiOiJjZjY5MWViMmM4MDcyYzcyMjU4N2MzMGM2ZWRkMTc3OThkZWIwMjI1MzdkN2RhMDdmOTI4ZWYzYmZhMjVlZWI3IiwidGFnIjoiIn0%3M";
    
</script>