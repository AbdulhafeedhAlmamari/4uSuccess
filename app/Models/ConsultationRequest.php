<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'consultant_id',
        'specialization',
        'subject',
        'type',
        'gender',
        'description',
        'status',
        'request_date',
        'reply',
    ];

    /**
     * Get the student that owns the consultation request.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get the consultant that owns the consultation request.
     */
    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }

    /**
     * Get the gender as a string.
     *
     * @return string
     */
    public function getGenderNameAttribute()
    {
        return $this->gender === 1 ? 'ذكر' : 'أنثى';
    }

    /**
     * Get the status as a formatted string.
     *
     * @return string
     */
    public function getStatusNameAttribute()
    {
        switch ($this->status) {
            case 'pending':
                return 'قيد الانتظار';
            case 'accepted':
                return 'مقبول';
            case 'rejected':
                return 'مرفوض';
            case 'completed':
                return 'مكتمل';
            default:
                return $this->status;
        }
    }

    /**
     * Get the status color for display.
     *
     * @return string
     */
    public function getStatusColorAttribute()
    {
        switch ($this->status) {
            case 'pending':
                return 'warning';
            case 'accepted':
                return 'success';
            case 'rejected':
                return 'danger';
            case 'completed':
                return 'info';
            default:
                return 'secondary';
        }
    }
}
