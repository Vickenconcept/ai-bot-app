<?php

use App\Models\User;



if (!function_exists('preprocessContent')) {
    function preprocessContent($content)
    {
        // Tokenize the content into words (you may need a more sophisticated tokenizer)
        $words = str_word_count($content, 1);

        // Lemmatize each word (for simplicity, we'll convert to lowercase)
        $processedWords = array_map(function ($word) {
            return lemmatizeWord($word);
        }, $words);

        // Join the lemmatized words back into a processed content
        $processedContent = implode(' ', $processedWords);

        return $processedContent;
    }
}

if (!function_exists('lemmatizeWord')) {
    function lemmatizeWord($word)
    {
        // Convert the word to lowercase (a basic form of lemmatization)
        $processedDocument =  strtolower($word);
        $processedDocument = preg_replace('/[^a-z0-9\s]/', '', $processedDocument);

        return $processedDocument;
    }
}

function get_location(){
    
}
