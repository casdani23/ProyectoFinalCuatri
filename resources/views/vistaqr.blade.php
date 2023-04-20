 <div style="text-align: center; margin-top: 120px"> {{$qrCode}} </div>


@vite(['resources/css/app.css', 'resources/js/app.js'])
    <script type="module"> // the change is here
        Echo.channel('qr').listen('qrValidate',(e)=>{
            console.log(e.message)
        })
    </script>