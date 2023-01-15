<?php

namespace Modules\Course\Http\Controllers;

use App\Http\Controllers\BaseApiController;
use Illuminate\Http\Request;
use Modules\Course\Http\Services\OfflineCourseService;

class OfflineCourseController extends BaseApiController
{
    protected OfflineCourseService $courseService;

    public function __construct()
    {
        $this->courseService = new OfflineCourseService();
    }

    function listOfflineCourses(Request $request)
    {
        return $this->courseService->listOfflineCourses($request);
    }
    function showOfflineCourse($course_id)
    {
        return $this->courseService->showOfflineCourse($course_id);
    }
    function subscribeOfflineCourse($course_id)
    {
        return $this->courseService->subscribeOfflineCourse($course_id);
    }
    function commentOfflineCourse($course_id)
    {
        return $this->courseService->commentOfflineCourse($course_id);
    }

    function listSubscribedOfflineCourses(Request $request)
    {
        return $this->courseService->listSubscribedOfflineCourses($request);
    }
}
