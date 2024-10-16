<?php

namespace App\Services\Admin;

use App\Models\Admin\Classes;

class ClassesServices
{

    public function allClasses()
    {
        return Classes::all();
    }
    public function getClassesById($id)
    {
        return Classes::find($id);
    }

    public function createClasses($data)
    {
        return Classes::create($data->toArray());
    }
    public function updateClasses($data, $id){
        $class = $this->getClassesById($id);
        $class->update($data->toArray());
        return $class;
    }
    public function showClasses($id)
    {
        return $this->getClassesById($id);
    }
    public function deleteClasses($id){
        $class = $this->getClassesById($id);
        $class->delete();
        return 'Deleted Successfully';
    }
}
