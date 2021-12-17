<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FetchOutputController extends Controller
{
    const API_NAME_PREFIX = [
        'property_name' => 'properties',
        'property_address' => 'properties',
        'tenure_id' => 't',
        'property_category_id' => 'pc',
        'building_class_id' => 'bc'
    ];

    const API_NAME = [
        'tenure_id' => 'tenure_name',
        'property_category_id' => 'property_category_name',
        'building_class_id' => 'building_class_name',
    ];


    public function fetchDataForInput(): string
    {
        if (request('input')) {
            $input1 = Storage::disk('public')->get('first_input.json');
            $data = json_decode($input1);
        } else {
            $input = Storage::disk('public')->get('second_input.json');
            $data = json_decode($input);
        }

        $data = collect($data)->collapse();

        $output = '(';

        foreach ($data as $index => $item) {
            if (is_array($item)) {
                $this->formatArrayValue($item, $output);
            }
            $output = $this->getString($item, $output);
        }

        $output .= ')';

        return $output;

    }

    public function formatArrayValue($arrayItems, &$output): string
    {
        $output .= '(';
        foreach ($arrayItems as $arrayIndex => $item) {
            $output = $this->getString($item, $output);
            if (is_array($item)) {
                $this->formatArrayValue($item, $output);
            }

        }
        $output .= ')';

        return $output;
    }


    public function getString($item, string $output): string
    {
        if (is_string($item)) {
            $output .= ' ' . $item . ' ';
        }
        if (is_object($item)) {
            $api_name_prefix = self::API_NAME_PREFIX[$item->api_name] ?? $item->api_name;
            $api_name = self::API_NAME[$item->api_name] ?? $item->api_name;
            $value = $item->comparator == 'contains' ? ' ' . '\'%' . $item->value . '%\'' : '';

            $output .= $api_name_prefix . '.' . $api_name . ' ' . $item->comparator . $value;
        }
        return $output;
    }


}
