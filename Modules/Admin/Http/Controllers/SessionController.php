<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Course\Entities\Session;
use Modules\Course\Entities\Course;
use Modules\Admin\Http\Requests\SessionUpdateRequest;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function showCourseSessions($id)
    {
        $course=Course::find($id);
        $rows = $course->sessions()->get();
        return view('admin::session.index', compact('rows','course'));
    }
    public function editCourseSession($id)
    {
        $row=Session::find($id);
        $course=$row->chapter->course;
        $chapters=$course->chapters;
        return view('admin::session.edit', compact('course','chapters','row'));
    }
    public function update($id,SessionUpdateRequest $request)
    {
        $session=Session::find($id);
        $session->update($request->validated());
        $session->chapter->update();
        $session->chapter->course->update();
        return redirect()->back();
    }

    public function addCourseSession($id)
    {
        $course=Course::find($id);
        $chapters=$course->chapters;
        return view('admin::session.create', compact('course','chapters'));
    }

    public function store(SessionUpdateRequest $request)
    {
        $data=$request->validated();
        $session=Session::create($data);
        return redirect()->route('admin.course.sessions',$session->chapter->course_id)->with('created');
    }

    public function destroy($id)
    {
        $model=Session::findOrFail($id);
        $model->delete();
        return redirect()->back()->with('deleted', 'تم الحذف بنجاح');
    }
}

