<?php

namespace App\Services;

use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Storage;

class CurriculumExtractor
{
    public static function extract(): string
    {
        $parser = new Parser();
        $pdf = $parser->parseFile(public_path('kurikulum/KurikulumMerdeka2025.pdf'));
        $text = $pdf->getText();
        $lines = explode("\n", $text);

        // Storage::put('kurikulum.json', json_encode($lines, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return json_encode($lines);
    }
}
