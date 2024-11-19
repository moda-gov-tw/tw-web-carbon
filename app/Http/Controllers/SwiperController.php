<?php

namespace App\Http\Controllers;

use App\Models\Swiper;
use Illuminate\Http\Request;

class SwiperController extends Controller
{
    public function swiper_name(Request $request)
    {
        $swipers = Swiper::where('orderNum', '>', 0)->orderBy('orderNum')->get();

        $swiper_arr = collect();

        foreach ($swipers as $swiper) {
            $swiper_arr->push((object) ['id' => $swiper->id, 'title' => $swiper->title, 'pic' => "/img/home/".$swiper->pic, 'url' => $swiper->url]);
        }

        return $swiper_arr;
    }
}
