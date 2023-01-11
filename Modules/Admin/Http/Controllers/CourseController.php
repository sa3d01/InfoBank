<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\CreateCourseRequest;
use Modules\Course\Entities\Attachment;
use Modules\Course\Entities\Course;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $rows = Course::all();
        return view('admin::course.index', compact('rows'));
    }

    public function create()
    {
        return view('admin::course.create');
    }


    function addAttachments($request,$course_id){
        if ($request->has('image')){
            Attachment::create([
                'course_id'=> $course_id,
                'type'=> 'photo',
                'title'=>$request['image_title'],
                'file'=>$request['image']
            ]);
        }
        if ($request->has('pdf')){
            Attachment::create([
                'course_id'=> $course_id,
                'type'=> 'pdf',
                'title'=>$request['pdf_title'],
                'file'=>$request['pdf']
            ]);
        }
        if ($request->has('excel')){
            Attachment::create([
                'course_id'=> $course_id,
                'type'=> 'excel',
                'title'=>$request['excel_title'],
                'file'=>$request['excel']
            ]);
        }
        if ($request->has('word')){
            Attachment::create([
                'course_id'=> $course_id,
                'type'=> 'word',
                'title'=>$request['word_title'],
                'file'=>$request['word']
            ]);
        }
    }
    public function store(CreateCourseRequest $request)
    {
        $course=Course::create($request->validated());
        $this->addAttachments($request,$course->id);
        return redirect()->route('admin.course.index');
    }


    public function show($id)
    {
        $row = Course::findOrFail($id);
        return view('admin::course.show', compact('row'));
    }


    public function edit($id)
    {
        $row = Course::findOrFail($id);
        return view('admin::course.edit', compact('row'));
    }


    public function update(CreateCourseRequest $request, $id)
    {
        $row = Course::findOrFail($id);
        $input=$request->validated();
        $row->update($input);
        return redirect()->route('admin.course.index');
    }


    public function destroy($id)
    {
        $row = Course::findOrFail($id);
        $row->delete();
        return redirect()->back()->with('deleted', 'تم الحذف بنجاح');
    }

    public function ban($id): object
    {
        $row = Course::find($id);
        $row->update(
            [
                'banned' => 1,
            ]
        );
        $row->refresh();
        $row->refresh();
        return redirect()->back()->with('updated');
    }

    public function activate($id): object
    {
        $row = Course::find($id);
        $row->update(
            [
                'banned' => 0,
            ]
        );
        $row->refresh();
        $row->refresh();
        return redirect()->back()->with('updated');
    }
}
