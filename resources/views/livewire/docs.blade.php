<div>
	<div class="header">
		<br>
		<div class="row">
			<div class="col col-md-6">
				{{ $docs->onEachSide(1)->links() }}
			</div>
			<div class="col col-md-6">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">
							FILTRO &nbsp&nbsp
							<select name="field" wire:model="field">
								@foreach($fields as $item)
								<option value="{{ $item }}" {{ ($field == $item ? 'selected="selected"' : '') }}>{{ $item }}</option>
								@endforeach
							</select>
						</span> 
					</div>
					@switch($field)
					@case('numero')
					<input type="text" wire:model.debounce.150ms="numero"/>
					@break
					@case('tipo')
					<select name="" id="" wire:model="tipo_id">
						@foreach($tipos as $tipo)
						<option value="{{ $tipo->id }}" {{ ($tipo_id == $tipo->id ? 'selected="selected"' : '') }}>{{ $tipo->name }}</option>
						@endforeach
					</select>
					@break
					@case('status')
					<select id="" wire:model="status_id">
						@foreach($statuses as $status)
						<option value="{{ $status->id }}" {{ ($status_id == $status->id ? 'selected="selected"' : '') }}>{{ $status->status }}</option>
						@endforeach
					</select>
					@break
					@case('fecha')
					<input name="fecha" wire:model="fecha" type="date" class="form-control" aria-describedby="basic-addon1">
					@break
					@endswitch
				</div>
			</div>
		</div>
	</div>	
	<div class="body">
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
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($docs as $item)
				<tr>
					<td>{{ $item->id }}</td>
					<td>{{ Carbon\Carbon::parse($item->fecha)->format('d-m-Y') }}</td>
					<td>{{ $item->tdoc }}</td>
					<td>{{ $item->numero }}</td>
					<td>{{ substr($item->descripcion,0,50) }}</td>
					<td>{{ $item->filename }}</td>
					<td>{{ $item->status->status }}</td>
					<td>
						<a type="button" class="btn btn-primary" href="{{ route('docs.show',$item->id) }}" target=”_blank”>Ver</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
