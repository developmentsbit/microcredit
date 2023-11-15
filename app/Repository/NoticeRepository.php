<?php

namespace App\Repository;
use Illuminate\Http\Request;
use App\Models\notice;
use App\Models\User;

use App\Interfaces\NoticeInterface;

class NoticeRepository implements NoticeInterface{
    public $path;
    public function __construct()
    {
        $this->path = 'Backend.User.Notices.';
    }
    public function index()
    {
        $data = notice::all();
        $i = 1;
        return view($this->path.'index',compact('data','i'));
    }

    public function create()
    {
        return view($this->path.'create');
    }

    public function store($data){
        // dd($data);
        // return 1;
        $insert = notice::create($data);
        if($insert)
        {
            return redirect()->back()->with('success','নোটিশ যুক্ত করা হয়েছে');
        }
        else
        {
            return redirect()->back()->with('success','নোটিশ যুক্ত করা হয়নি');
        }
    }

    public function show($id)
    {
        $notice = notice::find($id);
        $publisher = User::find($notice->create_by);

        $data = array(
            'notice' => $notice,
            'publisher' => $publisher,
        );
        return view($this->path.'show',compact('data'));
    }

    public function edit($id){
        $data = notice::find($id);
        return view($this->path.'edit',compact('data'));
    }

    public function update(array $data, $id)
    {
        notice::find($id)->update($data);
        return redirect()->back()->with('success','নোটিশ আপডেট করা হয়েছে');
    }

    public function delete($id)
    {
        notice::find($id)->delete();

        return redirect()->back()->with('success','নোটিশ ডিলিট করা হয়েছে');
    }
}
