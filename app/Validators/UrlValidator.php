<?php

namespace App\Validators;

class UrlValidator
{
    /**
     * @param $data
     * @return mixed
     */
    public static function storeValidator($data)
    {
        $rules = [
            'url' => 'required|string|url'
        ];

        $validator = \Validator::make($data, $rules);
        return $validator;
    }
}