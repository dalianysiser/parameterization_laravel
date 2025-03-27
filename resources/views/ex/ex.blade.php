
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="max-w-4xl mx-auto px-4">
        <h1>holaaaa ex {{$var}}</h1>
        <x-alert2 type="success" class="mb-5">
            <x-slot name="title">Tipo:</x-slot>
            contenido de la alerta
        </x-alert2>
        @if(true)
            <p>parrafo</p>
        @endif   
    </div>
    
   
</body>
</html>