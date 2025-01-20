<?php

namespace App\Http\Controllers;

use App\Models\AboutEdit;
use App\Models\Web;
use App\Services\ShareService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ComputeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $array_answer = [];

        $my_ip = ShareService::getUserIp();

        $web = Web::where('my_ip', $my_ip)->where('type', 'compute')->orderBy('id', 'desc')->first();
        if ($web) {
            $end_time = strtotime('+2 seconds');
            $start_time = strtotime($web->updated_at);
            if (($end_time - $start_time) < 120) {
                $array_answer += ['error' => true];
                $array_answer += ['error_data' => 4029];

                return $array_answer;
            }
        }

        $url = htmlspecialchars($request->url);
        if (parse_url($url)) {
            $uuid = Str::uuid();

            $healthy = array("https://", "http://");
            $green_url = str_replace($healthy, '', $url);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, 'https://api.thegreenwebfoundation.org/api/v3/greencheck/' . $green_url);
            $result = curl_exec($ch);
            curl_close($ch);

            $obj = json_decode($result);
            if(isset($obj->green)){
                $green = $obj->green;
            }else{
                $green = false;
            }

            $css_size = 0;
            $img_size = 0;
            $js_size = 0;
            $other_size = 0;
            $video_size = 0;

            $temp_total = 0;

            if (strpos($url, 'https') !== false || strpos($url, 'http') !== false) {
            } else {
                $url = 'https://' . $url;
            }

            $about_edit = AboutEdit::findOrFail(2);

            views($about_edit)->record();

            $array_answer += ['url' => $url];

            // $command = implode(' ', [\escapeshellarg('/usr/local/bin/php'), escapeshellarg(base_path('artisan')), 'app:execute-lighthouse', $url]);
            $command = implode(' ', [\escapeshellarg('/usr/bin/php'), escapeshellarg(base_path('artisan')), 'app:execute-lighthouse', $url]);
            $result = shell_exec($command);

            $json_result = json_decode($result);
            if ($json_result) {
                // result['audits']['network-requests']['details']['items'];
                $keyName = 'network-requests';
                $json_result = $json_result->audits->$keyName->details->items;

                foreach ($json_result as $resource) {
                    $type = $resource->mimeType;
                    $url = $resource->url;
                    $transferSize = $resource->transferSize;

                    $temp_total += $transferSize;
                    if ($transferSize > 0) {
                        if ($type == 'text/css') {
                            $css_size += $transferSize;
                        } elseif ($type == 'application/javascript') {
                            $js_size += $transferSize;
                        } elseif (strpos($type, 'image') !== false) {
                            $img_size += $transferSize;
                        } elseif (strpos($type, 'video') !== false) {
                            $video_size += $transferSize;
                        } elseif ($type == 'text/javascript') {
                            $js_size += $transferSize;
                        } elseif ($type == 'application/x-javascript') {
                            $js_size += $transferSize;
                        } elseif ($type == 'text/html') {
                            if (strpos($type, 'analytics.google') !== true && strpos($type, 'jpg') !== true && strpos($type, 'png') !== true) {
                                $css_size += $transferSize;
                            } else {
                                $other_size += $transferSize;
                            }
                        } elseif ($type == 'text/plain' || $type == 'application/json' || $type == 'application/json+protobuf') {
                            $js_size += $transferSize;
                        } else {
                            $other_size += $transferSize;
                        }
                    }
                }
            }

            $array_answer += ['error' => false];
            $array_answer += ['css' => $css_size];
            $array_answer += ['js' => $js_size];
            $array_answer += ['img' => $img_size];
            $array_answer += ['other' => $other_size];
            $array_answer += ['video' => $video_size];
            $array_answer += ['uuid' => $uuid];
            $array_answer += ['green' => $green];

            Web::create([
                'my_ip' => ShareService::getUserIp(),
                'url' => $array_answer['url'],
                'type' => 'compute',
                'content' => $array_answer,
                'my_uuid' => $uuid,
            ]);

            $about_edit = AboutEdit::findOrFail(2);

            ShareService::addViewData($about_edit);
        } else {
            $array_answer += ['error' => true];
        }

        return $array_answer;
    }

    public function compute_result(Request $request)
    {
        $uuid = $request->uuid;

        $web = Web::where('my_uuid', $uuid)->first();

        if ($web) {
            $content = $web->content;

            return Inertia::render('Compute/Index', [
                'title' => '碳排計算結果',
                'css' => $content['css'],
                'js' => $content['js'],
                'url' => $content['url'],
                'img' => $content['img'],
                'green' => $content['green'],
                'other' => $content['other'],
                'video' => $content['video'],
                'uuid' => $uuid
            ]);
        } else {
            return Inertia::render('Welcome', [
                'title' => '首頁',
            ]);
        }
    }

    public function isUrlValid($url)
    {
        $headers = @get_headers($url);

        if ($headers && strpos($headers[0], '200')) {
            return true;
        } else {
            return false;
        }
    }
}
