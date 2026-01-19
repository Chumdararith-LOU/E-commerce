<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Article;
use App\Models\Audience;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LabController extends Controller
{
    public function createAuthors() {
        $create = function($name, $username) {
            $user = User::firstOrCreate(
                ['name' => $username], 
                [
                    'email' => $username . '@test.com', 
                    'password' => Hash::make('password')
                ]
            );
            
            Author::firstOrCreate(
                ['user_id' => $user->id],
                ['name' => $name]
            );
        };

        $create('Author Sok', 'sok123');
        $create('Author Sao', 'sao');
        $create('Author Dara', 'd.dara');

        return response()->json(['message' => 'Authors created successfully']);
    }

    public function createArticles() {
        $sok = Author::where('name', 'Author Sok')->firstOrFail();
        $sao = Author::where('name', 'Author Sao')->firstOrFail();
        $dara = Author::where('name', 'Author Dara')->firstOrFail();

        $add = fn($author, $title) => Article::firstOrCreate(['name' => $title, 'author_id' => $author->id]);

        $add($sok, "Climate changes in the last 3 years");
        $add($sok, "Global warming is in its critical stage");
        $add($sao, "Computers in the next generation");
        $add($sao, "Quantum computers, is it coming?");
        $add($dara, "Chemistry in nature form");
        $add($dara, "The origin of water");

        return response()->json(['message' => 'Articles created successfully']);
    }

    public function createAudienceUsers() {
        $create = function($username) {
            User::firstOrCreate(
                ['name' => $username],
                [
                    'email' => $username . '@test.com', 
                    'password' => Hash::make('password')
                ]
            );
        };

        $create('veasna');
        $create('samnang');
        $create('ratana');

        return response()->json(['message' => 'Audience Users created successfully']);
    }

    public function subscribeArticles() {
        $subscribe = function($username, $audienceName, $articleTitles) {
            $user = User::where('name', $username)->firstOrFail();
            
            foreach ($articleTitles as $title) {
                $article = Article::where('name', $title)->first();
                if ($article) {
                    Audience::create([
                        'name' => $audienceName, 
                        'user_id' => $user->id,
                        'article_id' => $article->id
                    ]);
                }
            }
        };

        $subscribe('samnang', 'Audience Samnang', [
            "Computers in the next generation",
            "Chemistry in nature form",
            "The origin of water"
        ]);

        $subscribe('veasna', 'Audience Veasna', [
            "Climate changes in the last 3 years",
            "The origin of water",
            "Quantum computers, is it coming?"
        ]);

        $subscribe('ratana', 'Audience Ratana', [
            "Climate changes in the last 3 years",
            "Global warming is in its critical stage"
        ]);

        return response()->json(['message' => 'Subscriptions created successfully']);
    }

    public function createComments() {
        $sokUser = User::where('name', 'sok123')->firstOrFail();
        $article1 = Article::where('name', 'LIKE', '%Climate change%')->firstOrFail(); 
        
        Comment::create([
            'name' => "Thank you to all the subscribers",
            'user_id' => $sokUser->id,
            'commentable_id' => $article1->id,
            'commentable_type' => Article::class,
        ]);

        $samnangUser = User::where('name', 'samnang')->firstOrFail();
        $authorSao = Author::where('name', 'Author Sao')->firstOrFail();

        Comment::create([
            'name' => "Your article is amazing",
            'user_id' => $samnangUser->id,
            'commentable_id' => $authorSao->id,
            'commentable_type' => Author::class,
        ]);

        $saoUser = User::where('name', 'sao')->firstOrFail();
        $samnangAudienceRecord = Audience::where('name', 'Audience Samnang')->firstOrFail();

        Comment::create([
            'name' => "Welcome to read my article",
            'user_id' => $saoUser->id,
            'commentable_id' => $samnangAudienceRecord->id,
            'commentable_type' => Audience::class,
        ]);

        $veasnaUser = User::where('name', 'veasna')->firstOrFail();
        $article2 = Article::where('name', 'LIKE', '%Quantum%')->firstOrFail();

        Comment::create([
            'name' => "I can't wait this thing happening",
            'user_id' => $veasnaUser->id,
            'commentable_id' => $article2->id,
            'commentable_type' => Article::class,
        ]);

        return response()->json(['message' => 'Comments created successfully']);
    }

    public function getSaoArticles() {
        $author = Author::where('name', 'Author Sao')->with('articles')->first();
        return $author ? $author->articles : [];
    }

    public function getClimateAudiences() {
        $article = Article::where('name', "Climate changes in the last 3 years")
                          ->with('audiences')
                          ->first();
        return $article ? $article->audiences : [];
    }

    public function getSokAudiences() {
        $author = Author::where('name', 'Author Sok')->first();
        return $author ? $author->audiences : [];
    }

    public function getSamnangComments() {
        $user = User::where('name', 'samnang')->with('comments')->first();
        return $user ? $user->comments : [];
    }

    public function getAllCommentsWithTopic() {
        return Comment::with('commentable')->get();
    }
}
