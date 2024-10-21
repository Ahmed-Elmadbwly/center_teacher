<?php

namespace App\Services\Teacher;

use App\Models\Teacher\Assignment;
use Illuminate\Support\Facades\Storage;

class AssignmentServices
{
    public function allAssignments()
    {
        return Assignment::all();
    }

    public function getAssignmentById($id){
        return Assignment::find($id);
    }
    public function createAssignment($data){
        if ($data->hasFile('file')) {
            $file = $data->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('files', $fileName, 'public');
            $lesson = array_merge($data->toArray(), ['file' => $fileName] );
            return Assignment::create($lesson);
        }
        return  Assignment::create($data->toArray());
    }
    public function updateAssignment($id,$data){
        $assignment = $this->getAssignmentById($id);
        if ($data->hasFile('file')) {
            if (Storage::disk('public')->exists('files/' . $assignment->file)) {
                Storage::disk('public')->delete('files/' . $assignment->file);
            }
            $file = $data->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('files', $fileName, 'public');

            $assignment->update(array_merge($data->toArray(), ['file' => $fileName]));
            return $assignment;
        }
        $assignment->update($data->toArray());
        return $assignment;
    }
    public function deleteAssignment($id)
    {
        $assignment = $this->getAssignmentById($id);
        if (Storage::disk('public')->exists('files/' . $assignment->video)) {
            Storage::disk('public')->delete('files/' . $assignment->video);
        }
        $assignment->delete();
        return 'Deleted Successfully';
    }

}
