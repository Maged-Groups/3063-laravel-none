<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentCollection;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::all();

        $comments = CommentResource::collection($comments);

        return $comments;
    }

    /**
     * Display the comments of the loggd in user.
     */
    public function my_comments()
    {
        $user_id = auth()->user()->id;

        $comments = Comment::where('user_id', $user_id)->get();

        return CommentCollection::make($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;

        $comment = Comment::create($data);

        return CommentResource::make($comment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        Gate::authorize('view', $comment);
        
        $comment = CommentResource::make($comment);

        return $comment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $new_comment = $request->validated()['comment'];

        $comment->comment = $new_comment;

        $saved = $comment->save();

        return $saved ? 'Updated Successfully' : 'Not Updated';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $deleted = $comment->delete();

        return $deleted ? 'Comment Deleted Successfully' : 'You cannot delete the comment at the moment, please try again later';
    }

    public function deleted()
    {
        $deleted_comments = Comment::onlyTrashed()->get();

        return $deleted_comments;
    }

    public function restore($id)
    {

        $comment = Comment::where('id', $id)->onlyTrashed()->first();

        if ($comment) {
            Gate::authorize('restore', $comment);
         
            $restored = $comment->restore();

            return $restored ? 'Comment Restored Successfully' : 'Cannot restore the comment as the moment';
        }

        return 'No comments with this id found in the database!!!';
    }

    public function hard_delete($id)
    {
        $comment = Comment::where('id', $id)->onlyTrashed()->first();

        if ($comment) {
            $deleted = $comment->forceDelete();

            if ($deleted) {
                return 'Comment Destroyed from the database';
            }

            return 'Cannot delete your comment';
        }

        return 'No comments with this id found in the database!!!';
    }

    public function permanent_delete(Comment $comment)
    {

        Gate::authorize('forceDelete', $comment);

        if ($comment) {
            $deleted = $comment->forceDelete();

            if ($deleted) {
                return 'Comment Destroyed from the database';
            }

            return 'Cannot delete your comment';
        }
    }
}
