<?php

namespace App\Services\Teacher;

use App\Models\Teacher\Lesson;
use Illuminate\Support\Facades\Storage;

class LessonServices
{
    public function allLessons()
    {
        return Lesson::all();
    }
    public function getLesson($id){
        return Lesson::find($id);
    }
    public function createLesson($data){
        if ($data->hasFile('video')) {
            $file = $data->file('video');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('videos', $fileName, 'public');
            $lesson = array_merge($data->toArray(), ['video' => $fileName] );
              return Lesson::create($lesson);
        }
        return  Lesson::create($data->toArray());
    }
    public function updateLesson($data,$id)
    {
       $lesson = $this->getLesson($id);
        if ($data->hasFile('video')) {
            if (Storage::disk('public')->exists('videos/' . $lesson->video)) {
                Storage::disk('public')->delete('videos/' . $lesson->video);
            }
            $file = $data->file('video');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('videos', $fileName, 'public');

            $lesson->update(array_merge($data->toArray(), ['video' => $fileName]));
            return $lesson;
        }
        $lesson->update($data->toArray());
        return $lesson;
    }

    public function deleteLesson($id)
    {
        $lesson = $this->getLesson($id);
        if (Storage::disk('public')->exists('videos/' . $lesson->video)) {
            Storage::disk('public')->delete('videos/' . $lesson->video);
        }
        $lesson->delete();
        return 'Deleted Successfully';
    }
}
