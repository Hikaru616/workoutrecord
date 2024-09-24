<?php

namespace App\Http\Controllers;

use App\Models\Bench;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BenchController extends Controller
{
    private $bench;

    public function __construct(Bench $bench) {

        $this->bench = $bench;
    }

    public function store(Request $request)
    {
        $request->validate([
            'bench' => 'required', 'numeric', 'min:0',
            'bench_created_at' => 'required'
        ]);

        $this->bench->user_id = Auth::user()->id;
        $this->bench->bench = $request->bench;
        $this->bench->created_at = $request->bench_created_at;

        $this->bench->save();

        return redirect()->route('bigthree.index');
    }

}
