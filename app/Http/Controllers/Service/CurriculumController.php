<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Services\CurriculumExtractor;
use Illuminate\Support\Facades\Storage;

class CurriculumController extends Controller
{
  public function index()
  {
    return CurriculumExtractor::extract();
  }
  public function ask()
  {
    $question = "sebutkan seluruh jenjang sekolah yang ada pada data dalam bahasa indonesia";
    $context = '
[
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
]
';
    $prompt = "
Gunakan data berikut untuk menjawab pertanyaan dari user.

Data kurikulum (format JSON):
$context

Pertanyaan:
$question

Jawaban harus dalam format JSON tanpa penjelasan, tanpa komentar, tanpa tambahan teks apapun. Format JSON sebagai berikut:

[
  {
    'answer': 'Teks di sini...',
  }
]";

    $response = Http::withHeaders([
      'Authorization' => 'Bearer ' . env('REPLICATE_API_TOKEN'),
      'Content-Type' => 'application/json',
      'Prefer' => 'wait', // <== This makes the call synchronous
    ])->post('https://api.replicate.com/v1/models/ibm-granite/granite-3.3-8b-instruct/predictions', [

      'input' => [
        'prompt' => $prompt,
        'top_p' => 0.9,
        'top_k' => 50,
        'temperature' => 0.2,
        'presence_penalty' => 0,
        'frequency_penalty' => 0,
        'max_tokens' => 10_000_000
      ]
    ]);

    $prediction = $response->json();
    $url = $prediction['urls']['get'] ?? null;

    if (!$url) {
      return back()->with('error', 'Prediction request failed.');
    }

    do {
      sleep(1);
      $check = Http::withToken(env('REPLICATE_API_TOKEN'))->get($url)->json();
    } while (in_array($check['status'], ['starting', 'processing']));

    $output = $check['output'] ?? [];
    $botReply = implode('', $output);
    return response()->json($botReply);
  }
}
