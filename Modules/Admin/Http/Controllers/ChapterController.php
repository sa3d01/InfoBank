<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Course\Entities\Chapter;
use Modules\Course\Entities\Course;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function showCourseChapters($id)
    {
        $rows = Chapter::where('course_id', $id)->get();
        $course=Course::find($id);
        return view('admin::chapter.index', compact('rows','id'));
    }

    public function editCourseChapter($id)
    {
        $row=Chapter::find($id);
        return view('admin::chapter.edit', compact('row'));
    }

    public function update($id,Request $request)
    {
        $row=Chapter::find($id);
        $row->update($request->only('title'));
        return redirect()->route('admin.course.chapters',$row->course_id)->with('updated');
    }

    public function addCourseChapter($id)
    {
        $row=Course::find($id);
        return view('admin::chapter.create', compact('row'));
    }

    public function store(Request $request)
    {
        Chapter::create($request->only('title','course_id'));
        return redirect()->route('admin.course.chapters',$request['course_id'])->with('created');
    }

    public function destroy($id)
    {
        $row=Chapter::findOrFail($id);
        $row->delete();
        return redirect()->back()->with('deleted', 'تم الحذف بنجاح');
    }

}

