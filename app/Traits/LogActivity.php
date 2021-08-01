<?php 

namespace App\Traits;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

trait LogActivity{
    public static function bootLogActivity() {
        try {
            //Check enable log in config
            if(!config('stableweb.enable_log')){
                return;
            }
                
            static::saved(function (Model $model){
                // create or update?
                if($model->wasRecentlyCreated) {
                    static::logChange($model, 'created');
                } else {
                    if(!$model->getChanges()){
                        return;
                    }
                    static::logChange($model, 'updated');
                }
            });

            static::deleted(function(Model $model){
                static::logChange($model, 'deleted');
            });
        } catch (\Throwable $th) {
            return;
        }
    }

    public static function logChange( Model $model, string $action ) {
        // dump($model->getOriginal('name'));
        // dump($model->getAttributes('name'));
        // dd($model->getChanges('name'));
        Log::create([
            'user_id'      => Auth::check() ? Auth::user()->id : null,
            'logable_type' => static::class,
            'logable_id'   => $model->id ?? null,
            'action'       => $action,
            'ip'           => request()->ip(),
            'old'          => $action !== 'created' ? $model->getOriginal() : null,
            'new'          => $action !== 'deleted' ? $model->getAttributes() : null,
            'changed'      => $action === 'updated' ? $model->getChanges() : null
        ]);
    }
}