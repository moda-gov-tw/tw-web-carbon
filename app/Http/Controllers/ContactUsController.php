<?php

namespace App\Http\Controllers;

use App\Models\AboutEdit;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $about_edit = AboutEdit::findOrFail(4);

        return Inertia::render('ContactUs/Index', [
            'title' => '聯絡我們',
            'detail' => $about_edit->detail,
        ]);
    }
}
