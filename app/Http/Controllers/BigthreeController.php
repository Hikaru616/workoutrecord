<?php

namespace App\Http\Controllers;

use App\Models\Bench;
use App\Models\Bigthree;
use App\Models\Dead;
use App\Models\Squat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BigthreeController extends Controller
{
    private $bench;
    private $dead;
    private $squat;

    public function __construct(Bench $bench, Dead $dead, Squat $squat)
    {
        $this->bench = $bench;
        $this->dead = $dead;
        $this->squat = $squat;
    }

    public function index() {

        $user = Auth::user();

        $all_bench = $this->bench->all();
        $all_dead = $this->dead->all();
        $all_squat = $this->squat->all();

        $latestBench = $this->bench->where('user_id', Auth::user()->id)->latest()->first();
        $latestDead = $this->dead->where('user_id', Auth::user()->id)->latest()->first();
        $latestSquat = $this->squat->where('user_id', Auth::user()->id)->latest()->first();

        $benchRecords = Bench::select('bench', 'created_at')
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'asc')
            ->get();

        $deadRecords = Dead::select('dead', 'created_at')
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'asc')
            ->get();

        $squatRecords = Squat::select('squat', 'created_at')
            ->where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'asc')
            ->get();

        $benchPressData = [
            'dates' => $benchRecords->pluck('created_at')->filter(function ($benchDate) {
                return $benchDate;
            })->map(function($benchDate) {
                return $benchDate->format('Y-m-d H:i');
            }),
            'bench' => $benchRecords->pluck('bench')->filter(function ($bench) {
                return $bench;
            })
        ];

        $deadData = [
            'dates' => $deadRecords->pluck('created_at')->filter(function ($deadDate) {
                return $deadDate;
            })->map(function($deadDate) {
                return $deadDate->format('Y-m-d H:i');
            }),
            'dead' => $deadRecords->pluck('dead')->filter(function ($dead) {
                return $dead;
            })
        ];

        $squatData = [
            'dates' => $squatRecords->pluck('created_at')->filter(function ($squatDate) {
                return $squatDate;
            })->map(function($squatDate) {
                return $squatDate->format('Y-m-d H:i');
            }),
            'squat' => $squatRecords->pluck('squat')->filter(function ($squat) {
                return $squat;
            })
        ];


        return view('records.bigthree')

                ->with('user', $user)

                ->with('all_bench', $all_bench)
                ->with('all_dead', $all_dead)
                ->with('all_squat', $all_squat)

                ->with('latestBench', $latestBench)
                ->with('latestDead', $latestDead)
                ->with('latestSquat', $latestSquat)

                ->with('benchPressData', $benchPressData)
                ->with('deadData', $deadData)
                ->with('squatData', $squatData);

    }

}
