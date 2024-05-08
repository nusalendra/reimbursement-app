<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimbursement extends Model
{
    use HasFactory;
    protected $table = 'reimbursements';
    protected $primarykey = 'id';
    protected $fillable = ['user_id', 'tanggal', 'nama', 'deskripsi', 'file_pendukung', 'status_pengajuan'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
