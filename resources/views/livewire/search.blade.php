<div>
    <input type="text" wire:model="searchTerm" />
	{{-- {{ $users->links() }} --}}
	{{ $users->onEachSide(1)->links() }}
    <ul>
    	@foreach($users as $user)
			<li>
				<p>
					{{ $user->name }}
				</p>
			</li>

    	@endforeach
    </ul>
</div>
