<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FetchOutputController extends Controller
{
    const API_NAME_PREFIX = [
        'property_name' => 'properties',
        'tenure_id' => 't',
        'property_category_id' => 'pc',
        'building_class_id' => 'bc'
    ];

    const API_NAME = [
        'tenure_id' => 'tenure_name',
        'property_category_id' => 'property_category_name',
        'building_class_id' => 'building_class_name',
    ];

    public function fetchDataForInput1()
    {
        $input1 = Storage::disk('public')->get('first_input.json');
        $data = json_decode($input1)[0];
        $output = '';
        foreach ($data as $key => $item) {
            if (is_array($item)) {
                $output .= '(';
                foreach ($item as $arrayKey => $arrayItem) {
                    $output .= '(';
                    if (is_array($arrayItem)) {
                        foreach ($arrayItem as $arrayItemKey => $finalItem) {
                            $output .= '(';
                            if (is_array($finalItem)) {
                                foreach ($finalItem as $itemIndex => $itemIndexValue) {
                                    if (is_object($itemIndexValue)) {
                                        $api_name_prefix = self::API_NAME_PREFIX[$itemIndexValue->api_name];
                                        $api_name = self::API_NAME[$itemIndexValue->api_name] ?? $itemIndexValue->api_name;

                                        $output .= $api_name_prefix . '.'  . $api_name . ' ' . $itemIndexValue->comparator;
                                    }

                                    if (is_string(($itemIndexValue)))
                                    {
                                        $output .=  ' ' .$itemIndexValue . ' ';
                                    }

                                }
                            }
                            $output .= ')';

                        }
                    }
                    if (is_object($arrayItem)) {
                        $api_name_prefix = self::API_NAME_PREFIX[$arrayItem->api_name];
                        $api_name = self::API_NAME[$arrayItem->api_name] ?? $arrayItem->api_name;

                        $output .= $api_name_prefix . '.'  . $api_name . ' ' . $arrayItem->comparator;
                    }

                    if (is_string(($arrayItem)))
                    {
                        $output .=  ' ' .$arrayItem . ' ';
                    }
                    $output .= ')';
                }
            }
            if (is_object($item)) {
                $api_name_prefix = self::API_NAME_PREFIX[$item->api_name];
                $api_name = self::API_NAME[$item->api_name] ?? $item->api_name;

                $output .= $api_name_prefix . '.'  . $api_name . ' ' . $item->comparator;
            }

            if (is_string(($item)))
            {
                $output .=  ' ' .$item . ' ';
            }
            $output .= ')';
        }

        return response()->json($output);
    }


}
