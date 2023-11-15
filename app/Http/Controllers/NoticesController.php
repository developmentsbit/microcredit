<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\NoticeInterface;
use Auth;
use App\Models\notice;

class NoticesController extends Controller
{
    public $path;

    public $notice;

    public function __construct(NoticeInterface $notice)
    {
        $this->path = 'Backend.User.Notices.';
        $this->notice = $notice;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->notice->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->notice->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'published_date'         => $request->published_date,
            'title'         => $request->title,
            'description'   => $request->description,
            'status'        => $request->status,
            'file'          => '0',
            'create_by'     => Auth::user()->id,
        );
        if($request->file('file'))
        {
            $imageName = rand().'.'.$request->file('file')->getClientOriginalExtension();

            $request->file('file')->move(base_path().'/Backend/Notices/',$imageName);

            $data['file'] = $imageName;
        }

        $output = $this->notice->store($data);
        return $output;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->notice->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->notice->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $id;
        $data = array(
            'published_date'         => $request->published_date,
            'title'         => $request->title,
            'description'   => $request->description,
            'status'        => $request->status,
            'create_by'     => Auth::user()->id,
        );

        $file = $request->file('file');

        if($file)
        {
            $pathImage = notice::find($id);
            $path = base_path().'/Backend/Notices/'.$pathImage->file;
            if(file_exists($path))
            {
                unlink($path);
            }
        }

        if($file)
        {
            $imageName = rand().'.'.$file->getClientOriginalExtension();

            $file->move(base_path().'/Backend/Notices/',$imageName);

            $data['file'] = $imageName;
        }


        return $this->notice->update($data,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pathImage = notice::find($id);
        $path = base_path().'/Backend/Notices/'.$pathImage->file;
        if(file_exists($path))
        {
            unlink($path);
        }
        return $this->notice->delete($id);
    }
}
