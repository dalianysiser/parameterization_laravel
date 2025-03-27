<?php
namespace App\Services;

class DynamicFieldService
{
    public function getDynamicFields(array $inputData): array
    {
        $pattern = '/^field_\d+_\d+$/';
        $dynamicFields = array_filter($inputData, function ($key) use ($pattern) {
            return preg_match($pattern, $key);
        }, ARRAY_FILTER_USE_KEY);

        return $dynamicFields;
    }
}
?>
