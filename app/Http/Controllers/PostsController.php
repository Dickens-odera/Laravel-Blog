<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Posts;
use DB;
class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=> ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
            USE OF ELOQUENT TO ACCESS THE DATABASE
            ONE CAN ALSO NATIVE SQL STATEMENTS BUT ELOQUENT IS MUCH BETTER
            #$posts = DB::select("SELECT * FROM posts ORDERBY id LIMIT 4 DESC");

        */
        #$posts =  Posts::all(); //get all the posts wihtout specifying the order
        #$posts = Posts::orderBy('id', 'desc')->get(); //get the posts by ordering them by the most recently posted
        #$posts = Posts::orderBy('id','desc')->take(4)->get();#Limit the number of posts to 4
        $posts = Posts::orderBy('id','desc')->take(4)->paginate(2);#View 2 posts per pagination
        return view('posts.index')->with('posts', $posts);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
        //Handle the file upload
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
            //$imagePathToBoBeStored = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
            $pathToFile = Storage::disk('public')->put('uploads/', $fileNameToStore);

        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }
        //create posts
        $posts = new Posts;
        $posts->title = $request->input('title');
        $posts->body = $request->input('body');
        $posts->cover_image = $fileNameToStore;
        $posts->user_id = auth()->user()->id;
        $posts->save();
        
        return redirect('/posts')->with('success','Post Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =  Posts::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Posts::find($id);
        //check the user's id
        if(auth()->user()->id !== $posts->user_id){
            return redirect('posts')->with('error', 'Action not allowed');
        }
        return view('posts.edit')->with('post', $posts);
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
            'body'=>'required'
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
        $posts = Posts::find($id);
        $posts->title = $request->input('title');
        $posts->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $posts->cover_image = $fileNameToStore;
        }
        $posts->save();

        return redirect('/posts')->with('success','Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Posts::find($id);
        if(auth()->user()->id !== $posts->user_id){
            return redirect('posts')->with('error', 'Action not allowed');
        }
        if($posts->cover_image !== 'noimage.jpg'){
            Storage::delete('/public/cover_images/'.$posts->cover_image);
        }
        $posts->delete();
        return redirect('/posts')->with('success',"Post Deleted Successfully");
    }
}
