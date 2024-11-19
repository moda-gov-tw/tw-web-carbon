<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Gain;
use App\Models\Link;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result_array = [];

        $keywords = filter_var($request->keywords, FILTER_SANITIZE_STRING);

        $awards = Award::where(function ($query) use ($keywords) {
            $query->where('title', 'like', '%' . $keywords . '%')->orWhere('detail', 'like', '%' . $keywords . '%');
        })->get();
        if ($awards->count() > 0) {
            foreach ($awards as $row) {
                $pos = mb_strpos($row->detail, $keywords) - 50;
                $content = '';
                if ($pos < 0) {
                    $content = str_replace($keywords, '<span class="highlight">' . $keywords . '</span>', mb_substr($row->detail, 0, 100));
                } else {
                    $content = str_replace($keywords, '<span class="highlight">' . $keywords . '</span>', mb_substr($row->detail, $pos, 100));
                }
                $result_array[] = (object) [
                    'link' => route('award', ['id' => $row->id]),
                    'title' => str_replace($keywords, '<span class="highlight">' . $keywords . '</span>', strip_tags(htmlspecialchars_decode($row->title))),
                    'content' => $content,
                ];
            }
        }

        $gains = Gain::where(function ($query) use ($keywords) {
            $query->where('title', 'like', '%' . $keywords . '%')->orWhere('detail', 'like', '%' . $keywords . '%');
        })->get();
        if ($gains->count() > 0) {
            foreach ($gains as $row) {
                $pos = mb_strpos($row->detail, $keywords) - 50;
                $content = '';
                if ($pos < 0) {
                    $content = str_replace($keywords, '<span class="highlight">' . $keywords . '</span>', mb_substr($row->detail, 0, 100));
                } else {
                    $content = str_replace($keywords, '<span class="highlight">' . $keywords . '</span>', mb_substr($row->detail, $pos, 100));
                }
                $result_array[] = (object) [
                    'link' => route('gain.detail', ['type' => $row->gain_type_id, 'id' => $row->id]),
                    'title' => str_replace($keywords, '<span class="highlight">' . $keywords . '</span>', strip_tags(htmlspecialchars_decode($row->title))),
                    'content' => $content,
                ];
            }
        }

        $links = Link::where(function ($query) use ($keywords) {
            $query->where('name', 'like', '%' . $keywords . '%')->orWhere('url', 'like', '%' . $keywords . '%');
        })->get();
        if ($links->count() > 0) {
            foreach ($links as $row) {
                $pos = mb_strpos($row->url, $keywords) - 50;
                $content = '';
                if ($pos < 0) {
                    $content = str_replace($keywords, '<span class="highlight">' . $keywords . '</span>', mb_substr($row->url, 0, 100));
                } else {
                    $content = str_replace($keywords, '<span class="highlight">' . $keywords . '</span>', mb_substr($row->url, $pos, 100));
                }

                $result_array[] = (object) [
                    'link' => route('link'),
                    'title' => str_replace($keywords, '<span class="highlight">' . $keywords . '</span>', strip_tags(htmlspecialchars_decode($row->name))),
                    'content' => $content,
                ];
            }
        }

        return Inertia::render('KeyWord/Index', [
            'title' => '關鍵字搜尋',
            'result_array' => $result_array,
        ]);
    }
}
