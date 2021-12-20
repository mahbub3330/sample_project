<?php

namespace App\Http\Controllers;

use App\Models\ScheduleOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ScheduleOptionController extends Controller
{
    public function create()
    {
        return view('schedule-option.create');
    }

    public function store(Request $request)
    {
        $request->validate(['interval_option' => 'required']);
        try {

            $option_first = ScheduleOption::query()->first();

            if (!$option_first) {
                $option = new ScheduleOption();
            } else {
                $option = $option_first;
            }

            $option->interval_option = $request->get('interval_option');
            $option->save();

            Session::flash('alert-success', 'Option Store For Scheduling Successfully');

            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('alert-danger', 'Something went wrong'. $e->getMessage());

            return redirect()->back();
        }

    }
}
