<?php

namespace App\Http\Controllers;

use App\Models\Bench;
use App\Models\Category;
use App\Models\Dead;
use App\Models\Record;
use App\Models\Squat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    private $bench;
    private $dead;
    private $squat;
    private $record;
    private $category;

    public function __construct(Record $record, Category $category, Bench $bench, Dead $dead, Squat $squat) {

        $this->middleware('auth');
        $this->record = $record;
        $this->category = $category;
        $this->bench = $bench;
        $this->dead = $dead;
        $this->squat = $squat;
    }

    public function index() {

        $user = Auth::user();

        $home_records = $this->getRecords();
        $all_categories = $this->category->all();

        $latestBench = $this->bench->where('user_id', Auth::user()->id)->latest()->first();
        $latestDead = $this->dead->where('user_id', Auth::user()->id)->latest()->first();
        $latestSquat = $this->squat->where('user_id', Auth::user()->id)->latest()->first();

        return view('records.index')

                ->with('home_records', $home_records)
                ->with('user',$user)
                ->with('all_categories',$all_categories)

                ->with('latestBench', $latestBench)
                ->with('latestDead', $latestDead)
                ->with('latestSquat', $latestSquat);
    }

    private function getRecords() {
        $all_records = $this->record->where('user_id', Auth::user()->id)->orderBy('date', 'desc')->get();
        $latest_records = [];

        foreach($all_records as $record) {
            $latest_records[] = $record;
        }

        return array_slice($latest_records, 0, 8);
    }

    public function update() {

        $all_categories = $this->category->all();
        return view('records.update')
            ->with('all_categories',$all_categories);
    }

    public function records() {
        $all_categories = $this->category->all();
        $all_records = $this->record->where('user_id', Auth::user()->id)->orderBy('date', 'desc')->paginate(8);
        return view('records.records')
                ->with('all_records', $all_records)
                ->with('all_categories',$all_categories);
    }

    public function store(Request $request) {

        $request->validate([
            'date' => 'required',
        ]);

        $this->record->user_id = Auth::user()->id;
        $this->record->date = $request->date;

        if($request->memo) {
            $this->record->memo = $request->memo;
        }

        $this->record->save();

        if ($request->has('category')) {
            $category_record = [];
            foreach ($request->category as $category_id) {
                $category_record[] = ['category_id' => $category_id];
            }
            $this->record->categoryRecord()->createMany($category_record);
        }

        return redirect()->route('record.index');

    }

    public function updateDetail(Request $request, $id) {

        $request->validate([
            'date' => 'required',
            'category' => 'nullable|array|between:0,6',
        ]);

        $record = $this->record->findOrFail($id);
        $record->date = $request->date;

        if($request->memo) {

            $record->memo = $request->memo;
        }

        $record->save();

        $record->categoryRecord()->delete();

        $category_record = [];

        if ($request->has('category')) {

            foreach ($request->category as $category_id) {
                $category_record[] = ['category_id' => $category_id];
            }
        }

        $record->categoryRecord()->createMany($category_record);

        return redirect()->route('record.index');

    }

    public function destroy($id)
    {
        $post = $this->record->findOrFail($id);
        $post->delete();

        return redirect()->back();
    }
}
