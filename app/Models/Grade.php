<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function getAllGrade(){
       $user = Members::all(); 
        for($i=0;$i<count($user);$i++){
            $id = $user[$i]->id;
            $gradeId = MembersGrade::where('members_id',$id)->first(['grade_id']);
            // dd($membersId);
            if($gradeId) {
                // dd($membersId);
                $grade = Grade::where('id',$gradeId->grade_id)->first(['grade'])->grade;
                $user[$i]['grade'] = $grade;
                // dd($user);
            }
        }
        return $user;
    }
}
