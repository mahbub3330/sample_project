<?php

namespace App\Http\Controllers;

use App\Services\FormatOutputService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FetchOutputController extends Controller
{

    public function fetchDataForInput(): string
    {
        if (request('input') == 1) {
            $input1 = Storage::disk('public')->get('first_input.json');
            $data = json_decode($input1);
        } else {
            $input = Storage::disk('public')->get('second_input.json');
            $data = json_decode($input);
        }

        $data = collect($data)->collapse();



        return FormatOutputService::formatData($data);

    }

//    public function formatArrayValue($arrayItems, &$output): string
//    {
//        $output .= '(';
//        foreach ($arrayItems as $arrayIndex => $item) {
//            $output = $this->getString($item, $output);
//            if (is_array($item)) {
//                $this->formatArrayValue($item, $output);
//            }
//
//        }
//        $output .= ')';
//
//        return $output;
//    }
//
//
//    public function getString($item, string $output): string
//    {
//        if (is_string($item)) {
//            $output .= ' ' . $item . ' ';
//        }
//        if (is_object($item)) {
//            $api_name_prefix = self::API_NAME_PREFIX[$item->api_name] ?? $item->api_name;
//            $api_name = self::API_NAME[$item->api_name] ?? $item->api_name;
//            $value = $item->comparator == 'contains' ? ' ' . '\'%' . $item->value . '%\'' : '';
//
//            $output .= $api_name_prefix . '.' . $api_name . ' ' . $item->comparator . $value;
//        }
//        return $output;
//    }


}
