<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Blogs\BlogRequest;
use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends BaseController
{

    protected $blog = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Blog $blog)
    {
        $this->middleware('auth:api');
        $this->blog = $blog;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = $this->blog->latest()->with('category', 'tags')->paginate(10);

        return $this->sendResponse($blogs, 'Blog list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Blogs\BlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $blog = $this->blog->create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'category_id' => $request->get('category_id'),
        ]);

        // update pivot table
        $tag_ids = [];
        foreach ($request->get('tags') as $tag) {
            $existingtag = Tag::whereName($tag['text'])->first();
            if ($existingtag) {
                $tag_ids[] = $existingtag->id;
            } else {
                $newtag = Tag::create([
                    'name' => $tag['text']
                ]);
                $tag_ids[] = $newtag->id;
            }
        }
        $blog->tags()->sync($tag_ids);

        return $this->sendResponse($blog, 'Blog Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = $this->blog->with(['category', 'tags'])->findOrFail($id);

        return $this->sendResponse($blog, 'Blog Details');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
    {
        $blog = $this->blog->findOrFail($id);

        $blog->update($request->all());

        // update pivot table
        $tag_ids = [];
        foreach ($request->get('tags') as $tag) {
            $existingtag = Tag::whereName($tag['text'])->first();
            if ($existingtag) {
                $tag_ids[] = $existingtag->id;
            } else {
                $newtag = Tag::create([
                    'name' => $tag['text']
                ]);
                $tag_ids[] = $newtag->id;
            }
        }
        $blog->tags()->sync($tag_ids);

        return $this->sendResponse($blog, 'Blog Information has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $blog = $this->blog->findOrFail($id);

        $blog->delete();

        return $this->sendResponse($blog, 'Blog has been Deleted');
    }

    public function upload(Request $request)
    {
        $fileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('upload'), $fileName);

        return response()->json(['success' => true]);
    }
}
