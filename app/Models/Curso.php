<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class curso extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    // adicione outros campos aqui, se necessário
  ];

  /**
   * Get the users for the curso.
   */
  public function users()
  {
    return $this->hasMany(User::class);
  }
}
