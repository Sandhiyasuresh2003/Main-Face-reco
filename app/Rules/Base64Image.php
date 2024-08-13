<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Base64Image implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the value is a valid base64 string
        if (base64_decode($value, true) === false) {
            return false;
        }

        // Decode the image
        $decodedImage = base64_decode($value);
        $finfo = finfo_open();
        $mimeType = finfo_buffer($finfo, $decodedImage, FILEINFO_MIME_TYPE);

        // Check if it's a valid image MIME type
        return in_array($mimeType, ['image/jpeg', 'image/png', 'image/gif']);
    }

    public function message()
    {
        return 'The :attribute must be a valid base64-encoded image.';
    }
}
