<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;   //Import the Post model 

class PostController extends Controller
{
    public function __construct(Post $post){
        $this->model = $post;
    }

    public function view(){
        return view('posts.list', [
            'posts' => Post::all(),
        ]);
    }

    public function create(){
        return view('posts.create');
    }
    
    public function store(Request $request){
        $request->validate([
            'title'=> ['required' ,'min:5'],
            'description'=>['required', 'min:10'],
        ]);
        try{
            $this->model->create([   
                'title' => $request ->title,
                'description' => $request ->description,
        ]);
        return redirect()->route('post.view')->with('success', 'Post added successfully');
    }catch(\Exception $e){
        return redirect()->back()-> withInput()->withErrors(['error' => 'There is an issue making post. Please contact admin']);
    }
}

    public function edit($postid){
        $post = Post::find($postid);
        if(!$post){
            return redirect()->route('post.view')->with('error', 'Post not found');
        }
        return view('posts.edit',[
            'post' =>  $post,
        ]);
    }

    public function update(Request $request, $postid){
        $post = Post::find($postid);
        if(!$post){
            return redirect()->route('post.view')->with('error', 'Validation Error');
        }
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $post->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('post.view')->with('success', 'Post Edit Successfully');
    }

    public function destroy($postid){
        $deleted = Post::find($postid)->delete();
        if ($deleted){
            $msg = array (
                'status' => true,
                'message' => 'Post deleted'
            );
        }else{
            $msg = array (
                'status' => false,
                'message' => 'Post cannot be deleted. Please contact admin'
            );
        }
       
        return json_encode($msg);
    }

    public function viewpost($postid){
        // print_r($this->model->with('comment')->get());die();
        // $post = Post::find($postid);
        $post = $this->model->where('id',$postid)->with('comment')->get();
        if(!$post){
            return redirect()->route('post.view')->with('error', 'Post not found');
        }
        return view('posts.comment',[
            'post' =>  $post[0],
        ]);

    }

    public function commentStore(Request $request){
        $request->validate([
            'comment' =>['required'],
        ]);
        try{
            Comment::create([
                'comment' => $request->comment,
                'post_id' => $request->post_id,
            ]);
            return redirect()->route('post.viewpost')->with('success', 'Commented successfully');
        }catch(\Exception $e){
            return redirect()->back()->withInput()->withErrors(['error' => 'There is an issue making post. Please contact admin']);
        }
    }



}