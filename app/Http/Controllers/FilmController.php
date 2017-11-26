<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;

use Request;
use App\Film;
use App\Comment;
class FilmController extends Controller
{

	public function getAllFilms()
	{
	   $films=Film::all();
		 $result=true;
		 if (is_null($films)) {
			$result=true;
		 }
		return response()->json([
				'success'=>true,
				'result'=>$result,
				'films' => $films
			]);
	}

	public function getFilmWithSlug($slug)
	{

		  $film = Film::where('name', $slug)->first();
		  $result=true;
		  if (is_null($film)) {
			$result=true;
		  }
		 return response()->json([
				 'status'=>'success',
				 'result'=>$result,
				'film' => $film
			]);
	}
   public function addFilm(Request $request)
   {


	$validation = \Validator::make($request::all(),[
		'name' => 'required|max:20',
		'description'=>'required',
		'release_year'=>'required|date',
		'ticket_price'=>'required|numeric',
		'categories'=>'required|numeric',
		'rating'=>'required|numeric|min:1|max:5',
		'picture'=>'required|image',
		'country_id' => 'required|numeric'
	]);

	if($validation->fails()){
		$errors = $validation->errors();
		return response()->json([
				 'status'=>'fail',
				 'result'=>false,
				 'film'=>null,
			     'message' => 'Validation failed',
			     'error'=>$errors
				 ]);


	} else{
		 $file=Request::file('picture');;
		// dd($file);
		 $ext=$file->getClientOriginalExtension();
		 $random=rand(11111,99999);

		 $path=$file->move(public_path("/uploads"), "{$random}.{$ext}");

			$film = new Film;
			$film->name =Request::get('name');
			$film->description =Request::get('description');
			$film->ticket_price =Request::get('ticket_price');
			$film->rating =Request::get('rating');
			$film->picture =$path;
			$film->release_year =Request::get('release_year');

            $film->country_id=Request::get('country_id');
            $film->save();
            //$film->categories()->attach(Request::get('categories'));


			return response()->json([
							 'status'=>'success',
							 'result'=>true,
							 'film'=>$film,
							'message' => 'Films has been successfully added'
						]);
	}



   }



   public function addComment(Request $request,$film_id){
       $validation = \Validator::make($request::all(),[
            'comment_body' => 'required',
            'user_id'=>'required|numeric'
        ]);

        if($validation->fails()){
                $errors = $validation->errors();
                return response()->json([
                         'status'=>'fail',
                         'result'=>false,
                         'film'=>null,
                         'message' => 'Validation failed',
                         'error'=>$errors
                         ]);


        } else{
                $comment = new Comment;
                $comment->comment_body =Request::get('comment_body');
                $comment->user_id =Request::get('user_id');
                $comment->film_id =$film_id;
                $comment->save();
                return response()->json([
                     'status'=>'success',
                     'result'=>true,
                     'comment'=>$comment,
                    'message' => 'Comment has been successfully added'
                ]);
        }

   }


   public function getComments($film_id)
   	{

   		  $comments = Comment::where('id', $film_id)->get();
   		  $result=true;
   		  if (is_null($comments)) {
   			$result=true;
   		  }
   		 return response()->json([
   				 'status'=>'success',
   				 'result'=>$result,
   				'comments' => $comments
   			]);
   	}


   public function showDetail(Request $request){


	 $film=film::where('id','=',$film_id)->first();
	 $users = DB::table('users')
					 ->where('name', 'like', 'T%')
					 ->get();
	 return $film;

   }

}
