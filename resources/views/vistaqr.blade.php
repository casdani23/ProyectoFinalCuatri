<head>
    <script>
        var qrEventSource = new EventSource('/qr-code-scanned');
        qrEventSource.addEventListener('message', function(event) {
            window.location.href = '/productos';
        });
    </script>
</head>