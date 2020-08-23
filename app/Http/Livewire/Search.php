<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
	use WithPagination;

	public $searchTerm;
	// public $users;

    public function render()
    {
    	$searchTerm = '%' . $this->searchTerm . '%';

//     	$nn = User::where('name', 'like', $searchTerm)->get();
// // dd($nn);
//     	$this->users = $nn;
        return view('livewire.search', [
        	'users' => User::where('name', 'like', $searchTerm)->paginate(3),

        ]);

       //  return view('livewire.search', [
       //  	'users' => User::where('name', 'like', $searchTerm)
    			// ->paginate(3),
       //  ]);
    }
}

    		// ->appends('searchTerm', $this->searchTerm);