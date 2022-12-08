<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checklist extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['checklist_group_id', 'nom', 'user_id', 'checklist_id'];

    public function taches (){
        
        return $this->hasMany(Tache::class);
    }

    public function user_taches (){
        
        return $this->hasMany(Tache::class)->where('user_id', auth()->id());
    }

    public function user_completed_taches()
    {
        return $this->hasMany(Tache::class)
        ->where('user_id', auth()->id())
        ->whereNotNull('completed_at');
    }
   
}
