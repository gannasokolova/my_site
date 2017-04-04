<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CommentsArticle;
use Illuminate\Support\Facades\DB;
use App\Article;
use Illuminate\Support\Facades\Auth;
use App\Settings;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class CommentsController extends Controller
{
    public function saveComment(Request $request, $slug)
    {
        if ($request->ajax()){

            $validator = Validator::make($request->all(), [
                'content' => 'required'
            ]);

            if ($validator->fails()) {
                return Response::json(['success' => false, 'errors' => "Заполните поле Комментарий"], 400);
            }

            DB::beginTransaction();
            try {
                $formData = $request->except('_token');
                $formData['article_id'] = Article::findBySlug($slug)->id;
                $formData['author']     = Auth::user()->id;
                $formData['public']     = (Settings::first()->approve_comments == 'YES') ? 'NO' : 'YES';
                if (!empty ($formData['parent_id'])) {
                    $parentComment = CommentsArticle::find($formData['parent_id']);
                }
                $formData ['order_parent'] = isset($parentComment) ? $parentComment->order_parent : null;
                $formData ['parent_id']    = isset($parentComment) ? $parentComment->id : null;
                $formData['level']         = isset($parentComment) ? $parentComment->level + 1 : 0;
                $formData['path']          = isset($parentComment) ? $parentComment->getChildPath() : CommentsArticle::getParentPath($formData['article_id']);
                $formData['created_at']    = Carbon::now();

                $newModel = CommentsArticle::create($formData);

                if (isset($newModel) && $newModel->order_parent == NULL) {
                    $newModel->order_parent = $newModel->id;
                    $newModel->update();
                }
                DB::commit();

                if (isset($newModel)) {
                    if($newModel->public == 'NO'){
                        return Response::json([
                            'success' => true,
                            'public'  => 'no',
                            'level'   => $newModel->level,
                            'message' =>'Спасибо за комментарий. После проверки он будет опубликован'
                        ], 200);
                    }else{
                        return Response::json([
                            'success'   => true,
                            'public'    => 'yes',
                            'level'     => $newModel->level,
                            'created_at'=> $newModel->created_at->format('d.m.y H:i:s'),
                            'comment'   => $newModel->toArray()
                        ], 200);
                    }
                } else {
                    return Response::json(['success' => false], 400);
                }
            } catch (Exception $e) {
                DB::rollback();
            }
        }
    }
}

