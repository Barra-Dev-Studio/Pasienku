<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendNotificiation($icon = null, $title = null, $text = null)
    {
        $send =  [
            'icon' => $icon,
            'title' => $title,
            'text' => $text,
        ];

        return response()->json($send);
    }

    public function toSelect2Format($data = [], $column = 'name')
    {
        $formatedSelect2 = [];

        for ($indexData = 0, $countData = count($data); $indexData < $countData; $indexData++) {
            $formatedSelect2[$indexData] = ['id' => $data[$indexData]['id'], 'text' => $data[$indexData][$column]];
        }

        return $formatedSelect2;
    }
}
