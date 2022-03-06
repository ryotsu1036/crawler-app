<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Spatie\Browsershot\Browsershot;
use Symfony\Component\DomCrawler\Crawler;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = $request->url;
        $parse = parse_url($url);
        $host = $parse['host'];

        $response = Http::withOptions([
                'verify' => false,
            ])
            ->get($url);

        if ($response->ok() && $response->status() === 200) {
            $html = $response->body();
            $filename = "{$host}.png";

            Browsershot::url($url)
                ->save(storage_path("app/public/$filename"));

            $crawler = new Crawler();
            $crawler->addHtmlContent($html);
            $title = $crawler->filter("title");
            $title = count($title) ? $title->text() : 'No Title';
            $description = $crawler
                ->filterXpath("//meta[@name='description']")
                ->extract(['content']);
            $body = $crawler->filter("body")->text();

            Post::updateOrCreate([
                'url' => $url,
            ], [
                'title' => $title,
                'screen_shot' => asset("/storage/$filename"),
                'description' => count($description) ? implode('', $description) : null,
                'body' => $body,
            ]);

            return Post::latest()->get();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, $id)
    {
        return view('posts.show', [
            'post' => $post->find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
