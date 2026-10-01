<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizQuestion;
use App\Models\QuizSubmission;

class QuizController extends Controller
{
    public function submit(Request $request)
    {
        $answers = $request->input('answers', []);
        $visitorName = trim($request->input('visitor_name', ''));
        if (empty($visitorName)) {
            $visitorName = 'Pengunjung Posyandu';
        }

        $questions = QuizQuestion::all();

        $score = 0;
        $total = count($questions);
        $results = [];

        foreach ($questions as $q) {
            $userAns = strtolower($answers[$q->id] ?? '');
            $isCorrect = ($userAns === strtolower($q->correct_option));
            if ($isCorrect) {
                $score++;
            }
            $results[$q->id] = [
                'question' => $q->question,
                'correct' => $isCorrect,
                'user_ans' => $userAns,
                'correct_ans' => $q->correct_option,
                'explanation' => $q->explanation,
            ];
        }

        $percentage = $total > 0 ? round(($score / $total) * 100) : 0;

        $submission = QuizSubmission::create([
            'game_type' => 'quiz',
            'visitor_name' => $visitorName,
            'score' => $score,
            'total_questions' => $total,
            'percentage' => $percentage,
            'answers_json' => $results,
        ]);

        return response()->json([
            'score' => $score,
            'total' => $total,
            'percentage' => $percentage,
            'visitor_name' => $submission->visitor_name,
            'results' => $results,
        ]);
    }

    public function logGame(Request $request)
    {
        $gameType = $request->input('game_type', 'piring');
        $visitorName = trim($request->input('visitor_name', ''));
        if (empty($visitorName)) {
            $visitorName = 'Pengunjung Posyandu';
        }

        $score = (int) $request->input('score', 0);
        $total = (int) $request->input('total', 1);
        $percentage = $total > 0 ? round(($score / $total) * 100) : 0;
        $details = $request->input('details', []);

        $submission = QuizSubmission::create([
            'game_type' => $gameType,
            'visitor_name' => $visitorName,
            'score' => $score,
            'total_questions' => $total,
            'percentage' => $percentage,
            'answers_json' => $details,
        ]);

        return response()->json(['status' => 'success', 'submission_id' => $submission->id]);
    }
}
