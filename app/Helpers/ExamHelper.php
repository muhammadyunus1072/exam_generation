<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExamHelper
{

  public static function getCurriculum()
  {
    return json_decode(
      '[
  {
    "level": "SD",
    "grades": [
      {
        "grade_name": "1",
        "subjects": [
          { "subject_name": "Pendidikan Agama dan Budi Pekerti" },
          { "subject_name": "Pendidikan Pancasila" },
          { "subject_name": "Bahasa Indonesia" },
          { "subject_name": "Matematika" },
          { "subject_name": "Pendidikan Jasmani Olahraga dan Kesehatan" },
          { "subject_name": "Seni dan Budaya" },
          { "subject_name": "Muatan Lokal" }
        ]
      },
      {
        "grade_name": "2",
        "subjects": [
          { "subject_name": "Pendidikan Agama dan Budi Pekerti" },
          { "subject_name": "Pendidikan Pancasila" },
          { "subject_name": "Bahasa Indonesia" },
          { "subject_name": "Matematika" },
          { "subject_name": "Pendidikan Jasmani Olahraga dan Kesehatan" },
          { "subject_name": "Seni dan Budaya" },
          { "subject_name": "Muatan Lokal" }
        ]
      },
      {
        "grade_name": "3",
        "subjects": [
          { "subject_name": "Pendidikan Agama dan Budi Pekerti" },
          { "subject_name": "Pendidikan Pancasila" },
          { "subject_name": "Bahasa Indonesia" },
          { "subject_name": "Matematika" },
          { "subject_name": "Ilmu Pengetahuan Alam dan Sosial" },
          { "subject_name": "Pendidikan Jasmani Olahraga dan Kesehatan" },
          { "subject_name": "Seni dan Budaya" },
          { "subject_name": "Bahasa Inggris" },
          { "subject_name": "Muatan Lokal" }
        ]
      },
      {
        "grade_name": "4",
        "subjects": [
          { "subject_name": "Pendidikan Agama dan Budi Pekerti" },
          { "subject_name": "Pendidikan Pancasila" },
          { "subject_name": "Bahasa Indonesia" },
          { "subject_name": "Matematika" },
          { "subject_name": "Ilmu Pengetahuan Alam dan Sosial" },
          { "subject_name": "Pendidikan Jasmani Olahraga dan Kesehatan" },
          { "subject_name": "Seni dan Budaya" },
          { "subject_name": "Bahasa Inggris" },
          { "subject_name": "Muatan Lokal" }
        ]
      },
      {
        "grade_name": "5",
        "subjects": [
          { "subject_name": "Pendidikan Agama dan Budi Pekerti" },
          { "subject_name": "Pendidikan Pancasila" },
          { "subject_name": "Bahasa Indonesia" },
          { "subject_name": "Matematika" },
          { "subject_name": "Ilmu Pengetahuan Alam dan Sosial" },
          { "subject_name": "Pendidikan Jasmani Olahraga dan Kesehatan" },
          { "subject_name": "Seni dan Budaya" },
          { "subject_name": "Bahasa Inggris" },
          { "subject_name": "Koding dan Kecerdasan Artifisial" },
          { "subject_name": "Muatan Lokal" }
        ]
      },
      {
        "grade_name": "6",
        "subjects": [
          { "subject_name": "Pendidikan Agama dan Budi Pekerti" },
          { "subject_name": "Pendidikan Pancasila" },
          { "subject_name": "Bahasa Indonesia" },
          { "subject_name": "Matematika" },
          { "subject_name": "Ilmu Pengetahuan Alam dan Sosial" },
          { "subject_name": "Pendidikan Jasmani Olahraga dan Kesehatan" },
          { "subject_name": "Seni dan Budaya" },
          { "subject_name": "Bahasa Inggris" },
          { "subject_name": "Koding dan Kecerdasan Artifisial" },
          { "subject_name": "Muatan Lokal" }
        ]
      }
    ]
  },
  {
    "level": "SMP",
    "grades": [
      {
        "grade_name": "7",
        "subjects": [
          { "subject_name": "Pendidikan Agama dan Budi Pekerti" },
          { "subject_name": "Pendidikan Pancasila" },
          { "subject_name": "Bahasa Indonesia" },
          { "subject_name": "Matematika" },
          { "subject_name": "Ilmu Pengetahuan Alam" },
          { "subject_name": "Ilmu Pengetahuan Sosial" },
          { "subject_name": "Bahasa Inggris" },
          { "subject_name": "Pendidikan Jasmani Olahraga dan Kesehatan" },
          { "subject_name": "Informatika" },
          { "subject_name": "Seni, Budaya, dan Prakarya" },
          { "subject_name": "Koding dan Kecerdasan Artifisial" },
          { "subject_name": "Muatan Lokal" }
        ]
      },
      {
        "grade_name": "8",
        "subjects": [
          { "subject_name": "Pendidikan Agama dan Budi Pekerti" },
          { "subject_name": "Pendidikan Pancasila" },
          { "subject_name": "Bahasa Indonesia" },
          { "subject_name": "Matematika" },
          { "subject_name": "Ilmu Pengetahuan Alam" },
          { "subject_name": "Ilmu Pengetahuan Sosial" },
          { "subject_name": "Bahasa Inggris" },
          { "subject_name": "Pendidikan Jasmani Olahraga dan Kesehatan" },
          { "subject_name": "Informatika" },
          { "subject_name": "Seni, Budaya, dan Prakarya" },
          { "subject_name": "Koding dan Kecerdasan Artifisial" },
          { "subject_name": "Muatan Lokal" }
        ]
      },
      {
        "grade_name": "9",
        "subjects": [
          { "subject_name": "Pendidikan Agama dan Budi Pekerti" },
          { "subject_name": "Pendidikan Pancasila" },
          { "subject_name": "Bahasa Indonesia" },
          { "subject_name": "Matematika" },
          { "subject_name": "Ilmu Pengetahuan Alam" },
          { "subject_name": "Ilmu Pengetahuan Sosial" },
          { "subject_name": "Bahasa Inggris" },
          { "subject_name": "Pendidikan Jasmani Olahraga dan Kesehatan" },
          { "subject_name": "Informatika" },
          { "subject_name": "Seni, Budaya, dan Prakarya" },
          { "subject_name": "Koding dan Kecerdasan Artifisial" },
          { "subject_name": "Muatan Lokal" }
        ]
      }
    ]
  },
  {
    "level": "SMA",
    "grades": [
      {
        "grade_name": "10",
        "subjects": [
          { "subject_name": "Pendidikan Agama dan Budi Pekerti" },
          { "subject_name": "Pendidikan Pancasila" },
          { "subject_name": "Bahasa Indonesia" },
          { "subject_name": "Matematika" },
          { "subject_name": "Ilmu Pengetahuan Alam" },
          { "subject_name": "Ilmu Pengetahuan Sosial" },
          { "subject_name": "Bahasa Inggris" },
          { "subject_name": "Pendidikan Jasmani Olahraga dan Kesehatan" },
          { "subject_name": "Informatika" },
          { "subject_name": "Seni, Budaya, dan Prakarya" },
          { "subject_name": "Koding dan Kecerdasan Artifisial" },
          { "subject_name": "Muatan Lokal" }
        ]
      },
      {
        "grade_name": "11",
        "subjects": [
          { "subject_name": "Pendidikan Agama dan Budi Pekerti" },
          { "subject_name": "Pendidikan Pancasila" },
          { "subject_name": "Bahasa Indonesia" },
          { "subject_name": "Matematika" },
          { "subject_name": "Bahasa Inggris" },
          { "subject_name": "Pendidikan Jasmani Olahraga dan Kesehatan" },
          { "subject_name": "Sejarah" },
          { "subject_name": "Seni dan Budaya" },
          { "subject_name": "Muatan Lokal" }
        ]
      },
      {
        "grade_name": "12",
        "subjects": [
          { "subject_name": "Pendidikan Agama dan Budi Pekerti" },
          { "subject_name": "Pendidikan Pancasila" },
          { "subject_name": "Bahasa Indonesia" },
          { "subject_name": "Matematika" },
          { "subject_name": "Bahasa Inggris" },
          { "subject_name": "Seni dan Budaya" },
          { "subject_name": "Pendidikan Jasmani Olahraga dan Kesehatan" },
          { "subject_name": "Sejarah" },
          { "subject_name": "Muatan Lokal" }
        ]
      }
    ]
  }
]',
      true
    );
  }

  public static function generate($prompt)
  {
    // Step 1: Make prediction request
    $response = Http::withHeaders([
      'Authorization' => 'Bearer ' . env('REPLICATE_API_TOKEN'),
      'Content-Type' => 'application/json',
      'Prefer' => 'wait',
    ])->post(env('REPLICATE_MODEL_URL', 'https://api.replicate.com/v1/models/ibm-granite/granite-3.3-8b-instruct/predictions'), [
      'input' => [
        'prompt' => $prompt,
        'top_p' => 0.9,
        'top_k' => 100,
        'temperature' => 0.5,
        'presence_penalty' => 0.3,
        'frequency_penalty' => 0.5,
        'max_tokens' => 100000
      ]
    ]);

    $prediction = $response->json();
    $url = $prediction['urls']['get'] ?? null;

    if (!$url) {
      Log::error('🛑 Replicate failed to return prediction URL.', ['response' => $prediction]);
      return false;
    } else {
      Log::info('✅ Replicate success to return prediction URL.', ['url' => $url]);
    }

    // Step 2: Polling until ready
    do {
      sleep(1);
      $check = Http::withToken(env('REPLICATE_API_TOKEN'))->get($url)->json();
    } while (in_array($check['status'], ['starting', 'processing']));

    // Step 3: Get & clean raw output
    $botReply = implode('', $check['output'] ?? []);
    Log::info('[AI RAW]', ['raw' => $botReply]);

    $raw = trim($botReply);

    // Normalize smart quotes to standard double quote
    $raw = str_replace(['“', '”', '‘', '’'], '"', $raw);

    // Replace invalid curly quotes accidentally escaped
    $raw = preg_replace('/[\x{2018}-\x{201F}]/u', '"', $raw);

    // Remove tabs and non-breaking spaces and invisible Unicode control chars
    $raw = str_replace(["\t", "\u{00a0}", "\u{200b}", "\u{200c}", "\u{200d}", "\u{FEFF}"], '', $raw);
    $raw = preg_replace('/[\x00-\x1F\x7F]/u', '', $raw);

    // Convert single quotes around keys/values into double quotes
    $raw = preg_replace_callback("/'([^']*?)'/", function ($m) {
      return '"' . addslashes($m[1]) . '"';
    }, $raw);

    // Remove trailing commas
    $raw = preg_replace('/,\s*([\]}])/', '$1', $raw);

    // Optional: remove backslashes before math notation (optional)
    $raw = str_replace(['\\(', '\\)', '\\^'], '', $raw);


    // Optional: Debug output yang sudah dibersihkan
    Log::debug('[AI CLEANED]', ['cleaned' => $raw]);

    // Step 4: Decode JSON
    $parsed = json_decode($raw, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
      Log::error('🛑 JSON Decode Error', [
        'error' => json_last_error_msg(),
        'json' => $raw
      ]);
      return false;
    }

    return $parsed;
  }



  public static function generateExam($prompt)
  {

    $parsed = self::generate($prompt);
    // Step 5: Normalize malformed `choices`
    foreach ($parsed as &$q) {
      if (
        isset($q['choices']) &&
        is_array($q['choices']) &&
        count($q['choices']) === 1 &&
        str_contains($q['choices'][0], ',')
      ) {
        $q['choices'] = array_map('trim', explode(',', $q['choices'][0]));
      }

      if (
        isset($q['correct_answer']) &&
        isset($q['choices']) &&
        !in_array($q['correct_answer'], $q['choices'])
      ) {
        Log::warning('⚠️ correct_answer not found in choices', ['question' => $q['question']]);
      }
    }

    return $parsed;
  }


  public static function generateSummary($prompt)
  {
    $parsed = self::generate($prompt);

    // Step 4: Extract summary message
    if (isset($parsed[0]['summary_message'])) {
      return $parsed[0]['summary_message'];
    }

    Log::warning('⚠️ No summary_message found in response.', ['parsed' => $parsed]);
    return false;
  }


  public static function imaskToValue($data)
  {
    return str($data)->replace('.', '')->replace(',', '.')->toFloat();
  }


  public static function valueToImask($data)
  {
    return str($data)->replace('.', ',')->toString();
  }

  public static function simple_encrypt($value)
  {
    $key = hash('sha256', env('APP_KEY'), true);
    $iv = substr($key, 0, 16); // Fixed IV
    return base64_encode(openssl_encrypt($value, 'aes-256-cbc', $key, 0, $iv));
  }

  public static function simple_decrypt($encryptedValue)
  {
    $key = hash('sha256', env('APP_KEY'), true);
    $iv = substr($key, 0, 16);
    return openssl_decrypt(base64_decode($encryptedValue), 'aes-256-cbc', $key, 0, $iv);
  }
}
