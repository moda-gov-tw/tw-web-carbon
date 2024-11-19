<?php

namespace App\Http\Controllers;

use App\Models\AboutEdit;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $about_edit = AboutEdit::findOrFail(3);

        return Inertia::render('About/Index', [
            'title' => '關於本站',
            'detail' => $about_edit->detail,
        ]);
    }
}
