<?php

namespace App\Http\Controllers;

use App\Models\Gain;
use App\Models\GainType;
use App\Services\ShareService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->type;
        $gain_type_s = GainType::query();
        $gain_type_list = $gain_type_s->get();

        if ($type == '') {
            $gain_type = $gain_type_s->first();
            $type = $gain_type->id;
        }

        $gains = Gain::query();
        $gains->where('gain_type_id', $type);
        $gains->orderBy('gain_date', 'desc');
        $perPage = $request->has('perPage') ? $request->perPage : 10;

        return Inertia::render('Gain/Index', [
            'title' => '成果專區',
            'gain_list' => $gains->paginate($perPage),
            'perPage' => (int) $perPage,
            'gain_type_list' => $gain_type_list
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $gain = Gain::findOrFail($id);

        ShareService::addViewData($gain);

        $gain->gain_folder = '/img/gain/' . $gain->gain_folder . '/';

        $gain->file1 = $gain->gain_folder . $gain->gain_file;

        return Inertia::render('Gain/Detail', [
            'title' => '成果專區',
            'gain' => $gain,
        ]);
    }

    public function gainTypeList()
    {
        $gain_type_list = GainType::all();

        $type_arr = collect();

        foreach ($gain_type_list as $gain_type) {
            $type_arr->push((object) ['id' => $gain_type->id, 'name' => $gain_type->name]);
        }

        return $type_arr;
    }
}
