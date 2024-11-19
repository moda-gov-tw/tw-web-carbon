<?php

namespace App\Http\Controllers;

use App\Models\AboutEdit;
use App\Services\ShareService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $outArr = [];

        $about_edit = AboutEdit::findOrFail(1);

        ShareService::addViewData($about_edit);

        return Inertia::render('Welcome', [
            'title' => '首頁',
        ]);
    }
}
