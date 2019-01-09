<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contents;

class ContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Contents::orderBy('created_at', 'asc')->take(4)->paginate(2);
        return view('pages.contents')->with('content', $contents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);
        if($request->hasFile('cover_image')){
            //get file name with extension
            $fileNameWithExtension = $request->file('cover_image')->getClientOriginalName();
            //get just the file name
            $filename = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            //get just the file extension
            $fileExtension = $request->file('cover_image')->getClientOriginalExtension();
            //file name to store to the database
            $fileNameToStore = $filename.'_'.time().'.'.$fileExtension; 
            //upload the image
            $imagePathToBoBeStored = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
            //$pathToFile = Storage::disk('public')->put('uploads/', $fileNameToStore);

        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }
        $content = new Contents;
        $content->title = $request->input('title');
        $content->body = $request->input('body');
        $content->cover_image = $fileNameToStore;
        $content->user_id = auth()->user()->id ;
        $content->save();

        return redirect('/news')->with('success','News Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contents = Contents::find($id);
        return view('pages.list_contents')->with('contents',$contents);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = Contents::find($id);
        if(auth()->user()->id !== $content->user_id){
            return redirect('news')->with('error', 'You are not allowed to perform this action');

        }else{
            return view('contents.edit')->with('contents',$content);
        }
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
        $this->validate($request,
        [
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);
        if($request->hasFile('cover_image')){
            //get file name with extension
            $fileNameWithExtension = $request->file('cover_image')->getClientOriginalName();
            //get just the file name
            $filename = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            //get just the file extension
            $fileExtension = $request->file('cover_image')->getClientOriginalExtension();
            //file name to store to the database
            $fileNameToStore = $filename.'_'.time().'.'.$fileExtension; 
            //upload the image
            $imagePathToBoBeStored = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);

        }
        $content = Contents::find($id);
        $content->title = $request->input('title');
        $content->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $content->cover_image = $fileNameToStore;
        }
        $content->save();
        return redirect('/news')->with('success','News Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
