<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenolakanReimbursement extends Model
{
    use HasFactory;
    protected $table = 'penolakan_reimbursements';
    protected $primarykey = 'id';
    protected $fillable = ['reimbursement_id', 'alasan_penolakan'];

    public function reimbursement() {
        return $this->belongsTo(Reimbursement::class);
    }
}
