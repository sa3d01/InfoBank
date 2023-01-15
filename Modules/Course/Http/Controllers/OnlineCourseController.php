<?php

namespace Modules\Course\Http\Controllers;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use Modules\Course\Http\Services\OnlineCourseService;

class OnlineCourseController extends BaseApiController
{
    protected OnlineCourseService $courseService;

    public function __construct()
    {
        $this->courseService = new OnlineCourseService();
    }

    function getStatisticsCourses(){
        return $this->courseService->getStatisticsCourses();
    }
    function listOnlineCourses(Request $request)
    {
        return $this->courseService->listOnlineCourses($request);
    }
    function showOnlineCourse($course_id)
    {
        return $this->courseService->showOnlineCourse($course_id);
    }
    function subscribeOnlineCourse($course_id)
    {
        return $this->courseService->subscribeOnlineCourse($course_id);
    }
    function commentOnlineCourse($course_id)
    {
        return $this->courseService->commentOnlineCourse($course_id);
    }
    function listSubscribedOnlineCourses(Request $request)
    {
        return $this->courseService->listSubscribedOnlineCourses($request);
    }

}
