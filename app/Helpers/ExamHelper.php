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
  public static function generateSummary($prompt)
  {
    // Step 1: Send prompt to Replicate
    $response = Http::withHeaders([
      'Authorization' => 'Bearer ' . env('REPLICATE_API_TOKEN'),
      'Content-Type' => 'application/json',

    ])->post(env('REPLICATE_MODEL_URL', 'https://api.replicate.com/v1/models/ibm-granite/granite-3.3-8b-instruct/predictions'), [
      'input' => [
        'prompt' => $prompt,
        'top_p' => 0.9,
        'top_k' => 50,
        'temperature' => 0.5,
        'presence_penalty' => 0,
        'frequency_penalty' => 0,
        env('REPLICATE_MAX_TOKEN', 10_000) => 10_000_000
      ]
    ]);

    $prediction = $response->json();
    $url = $prediction['urls']['get'] ?? null;

    if (!$url) {
      Log::error('🛑 Failed to get prediction URL.', ['response' => $prediction]);
      return false;
    }

    // Step 2: Wait until complete
    do {
      sleep(1);
      $check = Http::withToken(env('REPLICATE_API_TOKEN'))->get($url)->json();
    } while (in_array($check['status'], ['starting', 'processing']));

    // Step 3: Clean and parse the result
    $botReply = implode('', $check['output'] ?? []);
    Log::info('[AI Summary RAW]', ['raw' => $botReply]);

    $raw = trim($botReply);
    $clean = preg_replace_callback("/'([^']*?)'/", fn($m) => '"' . addslashes($m[1]) . '"', $raw);
    $clean = preg_replace('/,\s*([\]}])/', '$1', $clean);

    $parsed = json_decode($clean, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
      Log::error('🛑 JSON Decode Error: ' . json_last_error_msg(), ['json' => $clean]);
      return false;
    }

    // Step 4: Extract summary message
    if (isset($parsed[0]['summary_message'])) {
      return $parsed[0]['summary_message'];
    }

    Log::warning('⚠️ No summary_message found in response.', ['parsed' => $parsed]);
    return false;
  }


  public static function generateExam($prompt)
  {
    // Step 1: Make prediction request
    $response = Http::withHeaders([
      'Authorization' => 'Bearer ' . env('REPLICATE_API_TOKEN'),
      'Content-Type' => 'application/json',

    ])->post(env('REPLICATE_MODEL_URL', 'https://api.replicate.com/v1/models/ibm-granite/granite-3.3-8b-instruct/predictions', 'https://api.replicate.com/v1/models/ibm-granite/granite-3.3-8b-instruct/predictions'), [
      'input' => [
        'prompt' => $prompt,
        'top_p' => 0.9,
        'top_k' => 100,
        'temperature' => 0.5,
        'presence_penalty' => 0.3,
        'frequency_penalty' => 0.5,
        env('REPLICATE_MAX_TOKEN', 10_000) => 10_000_000
      ]
    ]);

    $prediction = $response->json();
    $url = $prediction['urls']['get'] ?? null;

    if (!$url) {
      Log::error('🛑 Replicate failed to return prediction URL.', ['response' => $prediction]);
      return false;
    }

    // Step 2: Poll until status is done
    do {
      sleep(1);
      $check = Http::withToken(env('REPLICATE_API_TOKEN'))->get($url)->json();
    } while (in_array($check['status'], ['starting', 'processing']));

    $botReply = implode('', $check['output'] ?? []);
    Log::info('[AI RAW]', ['raw' => $botReply]);

    // Step 3: Fix JSON issues (single quote, trailing commas)
    $raw = trim($botReply);

    $clean = preg_replace_callback("/'([^']*?)'/", function ($m) {
      return '"' . addslashes($m[1]) . '"';
    }, $raw);

    $clean = preg_replace('/,\s*([\]}])/', '$1', $clean);

    $parsed = json_decode($clean, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
      Log::error('🛑 JSON Decode Error: ' . json_last_error_msg(), ['json' => $clean]);
      return false;
    }

    // Step 4: Normalize malformed `choices` if needed
    foreach ($parsed as &$q) {
      if (
        isset($q['choices']) &&
        is_array($q['choices']) &&
        count($q['choices']) === 1 &&
        str_contains($q['choices'][0], ',')
      ) {
        $q['choices'] = array_map('trim', explode(',', $q['choices'][0]));
      }

      // Optional: Ensure correct_answer is inside choices
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
