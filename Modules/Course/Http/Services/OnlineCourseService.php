<?php

namespace Modules\Course\Http\Services;

use App\Traits\ApiResponseTrait;
use App\Traits\ClientRequestTrait;
use Exception;
use Modules\Course\Entities\Comment;
use Modules\Course\Entities\Course;
use Modules\Course\Entities\Subscribe;
use Modules\Course\Transformers\Online\CommentOnlineCourseCollectionDto;
use Modules\Course\Transformers\Online\OnlineCourseCollectionDto;
use Modules\Course\Transformers\Online\OnlineCourseShowDto;

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
    public function showOnlineCourse($course_id)
    {
        $course=Course::find($course_id);
        return new OnlineCourseShowDto($course);
    }

    public function subscribeOnlineCourse($course_id)
    {
        $client=$this->getUserIdByToken(request()->header("Authorization"));
        $old_subscription=Subscribe::where([
            'client_id'=>$client['profile_client']['id'],
            'course_id'=>$course_id
        ])->first();
        if($old_subscription){
            $this->errorResponse("already subscribed");
        }
        Subscribe::create([
            'client_id'=>$client['profile_client']['id'],
            'course_id'=>$course_id,
            'status'=>'in_progress'
        ]);
        return $this->successResponse();
    }

    public function commentOnlineCourse($course_id)
    {
        $course=Course::find($course_id);
        return new CommentOnlineCourseCollectionDto(Comment::where('course_id',$course->id)->latest()->paginate());
    }

    public function listSubscribedOnlineCourses($request)
    {
        $client=$this->getUserIdByToken(request()->header("Authorization"));
        $client_id = $client['profile_client']['id'];

        $subscribed_courses_q=Subscribe::where('client_id',$client_id);
        if($request->has('progress_status')){
            if($request['progress_status']=='completed'){
                $subscribed_courses_q=$subscribed_courses_q->where('status','completed');
            }elseif($request['progress_status']=='in_progress'){
                $subscribed_courses_q=$subscribed_courses_q->where('status','in_progress');
            }
        }
        $subscribed_courses_id=$subscribed_courses_q->pluck('course_id')->toArray();
        $query = Course::whereIn('id',$subscribed_courses_id)->whereBanned(false)->whereType('online');
        $rows = $this->listCourses($query, $request);
        $data=$rows->latest()->paginate();
        $data->client_id=$client_id;
        return new OnlineCourseCollectionDto($data);
    }

    public function getStatisticsCourses(){
        $online_courses=Course::where('type','online')->whereBanned(false)->count();
        $offline_courses=Course::where('type','offline')->whereBanned(false)->count();
        $subscriptions=Subscribe::count();
        $res=[
            'online_courses'=>$online_courses,
            'offline_courses'=>$offline_courses,
            'subscriptions'=>$subscriptions
        ];
        return $this->successResponse($res);
    }
}
