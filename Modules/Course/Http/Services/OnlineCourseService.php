<?php

namespace Modules\Course\Http\Services;

use App\Traits\ApiResponseTrait;
use App\Traits\ClientRequestTrait;
use Exception;
use Modules\Course\Entities\Comment;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\Subscribe;
use Modules\Course\Transformers\CommentOfflineCourseCollectionDto;
use Modules\Course\Transformers\OfflineCourseCollectionDto;
use Modules\Course\Transformers\OfflineCourseShowDto;
use Modules\Course\Transformers\Online\OnlineCourseCollectionDto;

class OnlineCourseService
{
    use ApiResponseTrait,ClientRequestTrait;


    protected function listCourses($query,$request){
        if ($request->has('for') && $request->input('for')!=null && $request->input('for')!='') {
            $query = $query->where('for', $request['for']);
        }
        if ($request->has('sub')) {
            $query = $query->where('title', 'like', '%' . $request['sub'] . '%')
                ->orWhere('company_name', 'like', '%' . $request['sub'] . '%');
        }
        return $query;
    }
    public function listOnlineCourses($request)
    {
        $query = Course::whereBanned(false)->where('type','online');
        $rows = $this->listCourses($query, $request);
        $data=$rows->latest()->paginate();
        try{
            $client=$this->getUserIdByToken(request()->header("Authorization"));
            $client_id = $client['profile_client']['id'];
        }catch(Exception $e){
            $client_id = null;
        }
        $data->client_id=$client_id;
        return new OnlineCourseCollectionDto($data);
    }
    // public function showOfflineCourse($course_id)
    // {
    //     $course=Course::find($course_id);
    //     return new OfflineCourseShowDto($course);
    // }

    // public function subscribeOfflineCourse($course_id)
    // {
    //     $course=Course::find($course_id);
    //     $client=$this->getUserIdByToken(request()->header("Authorization"));
    //     $old_subscription=Subscribe::where([
    //         'client_id'=>$client['profile_client']['id'],
    //         'course_id'=>$course_id
    //     ])->first();
    //     if($old_subscription){
    //         $this->errorResponse("already subscribed");
    //     }
    //     Subscribe::create([
    //         'client_id'=>$client['profile_client']['id'],
    //         'course_id'=>$course_id
    //     ]);
    //     return new OfflineCourseShowDto($course);
    // }

    // public function commentOfflineCourse($course_id)
    // {
    //     $course=Course::find($course_id);
    //     return new CommentOfflineCourseCollectionDto(Comment::where('course_id',$course->id)->latest()->paginate());
    // }

}
