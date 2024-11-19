<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Services\ShareService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $awards = Award::query();
        $awards->orderBy('award_date', 'desc');
        $perPage = $request->has('perPage') ? $request->perPage : 10;

        return Inertia::render('Award/Index', [
            'title' => '獎補助專區',
            'award_list' => $awards->paginate($perPage),
            'perPage' => (int) $perPage
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
        $award = Award::findOrFail($id);

        ShareService::addViewData($award);

        $award->award_folder = '/img/award/' . $award->award_folder . '/';

        $award->file1 = $award->award_folder . $award->award_file;

        return Inertia::render('Award/Detail', [
            'title' => '獎補助專區',
            'award' => $award,
        ]);
    }
}
