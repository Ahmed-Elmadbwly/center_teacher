<?php

namespace App\Services\Teacher;

use App\Models\Teacher\Option;
use App\Models\Teacher\Question;
use App\Models\Teacher\Quiz;

class QuizServices
{
    public function allQuizzes()
    {
        return Quiz::all();
    }
    public function getQuiz($id)
    {
        return  Quiz::with('questions.options')->find($id);
    }
    // Create or update a quiz, its questions, and options
    public function saveQuiz(array $data, $quizId = null)
    {
        // If a quiz ID is provided, find it, otherwise create a new one
        $quiz = Quiz::updateOrCreate(
            ['id' => $quizId], // If quizId is null, it will create a new quiz
            [
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'time'=>$data['time']
            ]
        );

        // Loop through the questions and handle them
        foreach ($data['questions'] as $questionData) {
            $this->saveQuestion($quiz->id, $questionData);
        }

        return $quiz;
    }

    // Create or update a question for the quiz
    public function saveQuestion($quizId, array $questionData)
    {
        // If a question ID exists, update it, otherwise create a new question
        $question = Question::updateOrCreate(
            ['id' => $questionData['id'] ?? null, 'quizId' => $quizId], // If questionId is null, it will create
            ['questionText' => $questionData['questionText']]
        );

        // Loop through the options and handle them
        foreach ($questionData['options'] as $optionData) {
            $this->saveOption($question->id, $optionData);
        }

        return $question;
    }

    // Create or update an option for the question
    public function saveOption($questionId, array $optionData)
    {
        // If an option ID exists, update it, otherwise create a new option
        return Option::updateOrCreate(
            ['id' => $optionData['id'] ?? null, 'questionId' => $questionId], // If optionId is null, it will create
            ['optionText' => $optionData['optionText'], 'isCorrect' => $optionData['isCorrect']]
        );
    }
    public function deleteQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return 'Deleted successfully';
    }

}
