<?php

namespace App\Http\Controllers;

use App\Models\Squat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SquatController extends Controller
{
    private $squat;

    public function __construct(Squat $squat) {

        $this->squat = $squat;
    }

    public function store(Request $request)
    {
        $request->validate([
            'squat' => 'required', 'numeric', 'min:0',
            'squat_created_at' => 'required'
        ]);

        $this->squat->user_id = Auth::user()->id;
        $this->squat->squat = $request->squat;
        $this->squat->created_at = $request->squat_created_at;

        $this->squat->save();

        return redirect()->route('bigthree.index');
    }
}
