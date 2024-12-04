<?php

namespace App\Helpers;


use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationHelper
{
    public static function translateText($text, $targetLanguage = 'id')
    {
        $translator = new GoogleTranslate();
        $translator->setTarget($targetLanguage);

        try {
            return $translator->translate($text);
        } catch (\Exception $e) {
            // Handle error if translation fails
            return $text;
        }
    }
}
