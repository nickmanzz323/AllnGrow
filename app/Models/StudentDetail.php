<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentDetail extends Model
{
    use HasFactory;

    protected $table = 'student_details';
    
    // studentID adalah PK sekaligus FK
    protected $primaryKey = 'studentID';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'studentID',
        'fullname',
        'phone',
        'bio',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'studentID');
    }
}