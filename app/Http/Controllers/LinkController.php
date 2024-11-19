<?php

namespace App\Http\Controllers;

use App\Models\AboutEdit;
use App\Models\Link;
use App\Models\LinkType;
use App\Services\ShareService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result_array = [];

        $link_type_list = LinkType::all();

        $about_edit = AboutEdit::findOrFail(5);

        ShareService::addViewData($about_edit);

        $i = 0;

        foreach ($link_type_list as $link_type) {
            $link_type_id = $link_type->id;

            $link_total = Link::where('link_type_id', $link_type_id)->count();

            $links = Link::where('link_type_id', $link_type_id)->orderBy('id')->get();

            $link_array = [];
            foreach ($links as $link) {
                array_push($link_array, $link);
            }

            array_push($result_array, [$link_type->name, $link_array]);
            $i++;
        }

        return Inertia::render('Link/Index', [
            'title' => '相關連結',
            'result_array' => $result_array,
        ]);
    }
}
