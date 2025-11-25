<?php

namespace App\Rules\Api\Profile;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Exception;

class UserProfilePhotoRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
       // Validar que sea string
        if (!is_string($value)) {
            $fail('El campo :attribute debe ser una cadena base64 válida.');
            return;
        }

        // Validar que no esté vacío
        if (empty(trim($value))) {
            $fail('El campo :attribute no puede estar vacío.');
            return;
        }

        // Validar formato base64 de imagen
        if (!preg_match('/^data:image\/(jpeg|png|jpg);base64,/', $value)) {
            $fail('El campo :attribute debe ser una imagen JPEG, PNG o JPG en formato base64.');
            return;
        }

        // Validar tamaño (5MB máximo)
        $base64Data = substr($value, strpos($value, ',') + 1);
        $sizeInBytes = (int) (strlen(rtrim($base64Data, '=')) * 3 / 4);
        $sizeInKB = $sizeInBytes / 1024;

        if ($sizeInKB > 5120) {
            $fail('El campo :attribute no debe ser mayor a 5MB.');
            return;
        }

        // Validar que sea una imagen válida
        if (!$this->isValidImage($value)) {
            $fail('El campo :attribute no es una imagen válida o está corrupta.');
            return;
        }
    }

    protected function isValidImage(string $base64String): bool
    {
        try {
            $base64Data = substr($base64String, strpos($base64String, ',') + 1);
            $imageData = base64_decode($base64Data);
            return @imagecreatefromstring($imageData) !== false;
        } catch (\Exception $e) {
            return false;
        }
    }
}
