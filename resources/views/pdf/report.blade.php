@extends('layouts.A4_PDF')
@section('title')
    Reporte de Documentos.
@endsection
@section('content')
  <header>
      <h4>Reporte de Documentos</h4>
      <h6>{!! $filters !!}</h6>
  </header>
  <main>
	{{-- <div class="container"> --}}
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Fecha</th>
          <th scope="col">Tipo</th>
          <th scope="col">Número</th>
          <th scope="col">Descripción</th>
          <th scope="col">Archivo</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $item)
        <tr>
          <td>{{ $item->id }}</td>
          <td>{{ Carbon\Carbon::parse($item->fecha)->format('d-m-Y') }}</td>
          <td>{{ $item->tdoc }}</td>
          <td>{{ $item->numero }}</td>
          <td>{{ substr($item->descripcion,0,50) }}</td>
          <td>{{ $item->filename }}</td>
          <td>{{ $item->status->status }}</td>
        </tr>      
        {{-- <p style="page-break-before: always;">  --}}
        @endforeach
      </tbody>
  </main>
	{{-- </div> --}}
  {{-- <footer> --}}
    {{-- <h4>www.ucss.edu.pe</h4> --}}
  {{-- </footer> --}}
@endsection
@section('script')
  <script type="text/php">
    if ( isset($pdf) ) {
      $pdf->page_script('
          $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
        $pdf->text(270, 780, "Página $PAGE_NUM de $PAGE_COUNT", $font, 10);
      ');
    }
  </script>
@endsection
@section('style')
  <style>
    .th {
      font-size: 9px;
    }
  	.body {
/*      margin-top: 5%;
      margin-bottom: 1cm;
  		margin-left: 1%;*/
  		background-color: white;
      font-size: 8px;
  	}
    .page-break {
      page-break-after: always;
    }
    @page {
        margin: 2cm 0cm;
        font-family: Arial;
    }

    table {
        margin-top: 3cm;
        margin-left:  2cm;
        margin-right: 2cm;
        margin-bottom: 1cm;
    }

    header {
        position: fixed;
        top: 0cm;
        left: 1cm;
        right: 1cm;
        height: 2.5cm;
        background-color: DodgerBlue;
        color: white;
        text-align: center;
        line-height: 30px;
    }

    footer {
        position: fixed;
        bottom: 2cm;
        left: 1cm;
        right: 1cm;
        height: 1cm;
        background-color: DodgerBlue;
        color: white;
        text-align: center;
        line-height: 35px;
    }    
/*    footer .page:after { 
      content: counter(page, upper-roman); 
    }*/
  </style>
@endsection