<?php

namespace App\Http\Controllers;

use App\Models\Dead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeadController extends Controller
{
    private $dead;

    public function __construct(Dead $dead) {

        $this->dead = $dead;
    }

    public function store(Request $request)
    {
        $request->validate([
            'dead' => 'required', 'numeric', 'min:0',
            'dead_created_at' => 'required'
        ]);

        $this->dead->user_id = Auth::user()->id;
        $this->dead->dead = $request->dead;
        $this->dead->created_at = $request->dead_created_at;

        $this->dead->save();

        return redirect()->route('bigthree.index');
    }
}
