<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['username', 'password', 'nama_lengkap', 'email', 'role', 'foto_profil', 'whatsapp', 'alamat', 'bio', 'aktif', 'approval_status'])]
#[Hidden(['password', 'remember_token', 'reset_token', 'registration_key'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_users';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_admin';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the primary key.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'created_at';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'updated_at';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'last_login' => 'datetime',
            'reset_token_expires' => 'datetime',
            'approved_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'registered_at' => 'datetime',
            'aktif' => 'boolean',
        ];
    }

    /**
     * Get the user's avatar URL.
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->foto_profil && $this->foto_profil !== '0' && $this->foto_profil !== 'null') {
            if (filter_var($this->foto_profil, FILTER_VALIDATE_URL)) {
                return $this->foto_profil;
            }
            return asset('uploads/admin/' . $this->foto_profil);
        }
        
        $name = urlencode($this->nama_lengkap ?? $this->username ?? 'User');
        return "https://ui-avatars.com/api/?name={$name}&background=059669&color=fff&size=100&bold=true";
    }

    /**
     * Get the user's role badge.
     */
    public function getRoleBadgeAttribute(): string
    {
        $badges = [
            'super_admin' => '<span class="badge badge-danger">Super Admin</span>',
            'admin' => '<span class="badge badge-primary">Admin</span>',
            'desainer' => '<span class="badge badge-info">Desainer</span>',
            'marketing' => '<span class="badge badge-success">Marketing</span>',
            'cs' => '<span class="badge badge-warning">CS</span>',
        ];
        
        return $badges[$this->role] ?? '<span class="badge badge-secondary">' . $this->role . '</span>';
    }

    /**
     * Get the user's status badge.
     */
    public function getStatusBadgeAttribute(): string
    {
        if (!$this->aktif) {
            return '<span class="badge badge-danger">Nonaktif</span>';
        }
        
        $badges = [
            'pending' => '<span class="badge badge-warning">Pending</span>',
            'approved' => '<span class="badge badge-success">Approved</span>',
            'rejected' => '<span class="badge badge-danger">Rejected</span>',
        ];
        
        return $badges[$this->approval_status] ?? '<span class="badge badge-secondary">' . $this->approval_status . '</span>';
    }

    /**
     * Check if user is super admin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Check if user is admin or super admin.
     */
    public function isAdmin(): bool
    {
        return in_array($this->role, ['super_admin', 'admin']);
    }

    /**
     * Check if user is approved and active.
     */
    public function isActive(): bool
    {
        return $this->aktif && $this->approval_status === 'approved';
    }

    /**
     * Get the activities for the admin user.
     */
    public function aktivitas()
    {
        return $this->hasMany(AktivitasAdmin::class, 'id_admin');
    }

    /**
     * Get the notifications for the admin user.
     */
    public function notifikasi()
    {
        return $this->hasMany(NotifikasiAdmin::class, 'id_admin');
    }

    /**
     * Get the sessions for the admin user.
     */
    public function sessions()
    {
        return $this->hasMany(AdminSession::class, 'admin_id');
    }

    /**
     * Get the approvals performed by this user.
     */
    public function approvalsPerformed()
    {
        return $this->hasMany(ApprovalLog::class, 'performed_by');
    }
}