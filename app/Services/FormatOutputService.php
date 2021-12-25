<?php

namespace App\Services;

class FormatOutputService
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

    public static function formatData($data): string
    {
        $output = '(';

        foreach ($data as $index => $item) {
            if (is_array($item)) {
                self::formatArrayValue($item, $output);
            }
            $output = self::getString($item, $output);
        }

        $output .= ')';

        return $output;
    }

    public static function formatArrayValue($arrayItems, &$output): string
    {
        $output .= '(';
        foreach ($arrayItems as $arrayIndex => $item) {
            $output = self::getString($item, $output);
            if (is_array($item)) {
                self::formatArrayValue($item, $output);
            }

        }
        $output .= ')';

        return $output;
    }

    public static function getString($item, string $output): string
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
