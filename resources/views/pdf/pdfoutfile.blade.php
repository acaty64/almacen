<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
        <title>{{ $originalName }}</title>
    </head>
    <body>
        @foreach($images as $image)
            <img src="{{ asset($image) }}" width="100%" height="100%" />
        @endforeach
    </body>
</html>
<style>
    body {
      margin: 0;
      margin-top: 0;
      padding: 0;
/*      background-color: #FAFAFA;
      font: 12pt "Tahoma";*/
    }
    img {
        margin:0;
        padding: 0;
    }
    @page {
        size: 21cm 29.9cm;
        margin: 0;
/*        size: 21cm 29.7cm;
        margin: 0 0 0 0;*/
        /*margin: 3.0mm 4.5mm 3.0mm 4.5mm;*/
         /* change the margins as you want them to be. */
    }
    page-break-after:always;
</style>