<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasUuid;
use OwenIt\Auditing\Auditable;

class User extends Authenticatable implements AuditableContract
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasUuid, HasRoles, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid', 
        'first_name', 
        'last_name', 
        'email', 
        'phone',
        'country',
        'city',
        'birthdate',
        'photo', 
        'gender_id', 
        'document_type_id', 
        'user_type_id',
        'document_number',
        'institution_name',
        'academic_program',
        'modality_id',
        'modality',
        'university',
        'company_name',
        'company_position',
        'company_address',
        'entrepreneur_name',
        'product_type',
        'occupation',        
        'status',
        'accepted_terms', 
        'is_admin',
        'is_invited',
        'is_paid',
        'is_downloaded',
        'kit_confirmed',
        'password'
    ];

    /**
     * Relación: Un usuario puede tener muchas asistencias a eventos ojo este diploma.
     */
    public function eventAttendances()
    {
        return $this->hasMany(EventAttendance::class);
    }

    /**
     * Obtener la URL de la foto de perfil del usuario.
     * @param string $photo
     * @return string
     */
    public function getPhotoAttribute()
    {
        $photo = $this->attributes['photo'] ?? null;

        return $photo 
            ? route('file', ['path' => $photo]) 
            : null;
    }

    /**
     * Obtener las inscripciones del usuario.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Obtener el género del usuario.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * relacion de eventos con los task
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'event_tag');
    }

    /**
     * Obtener el tipo de documento del usuario.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    /**
     * Obtener el tipo de persona del usuario.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function UserType()
    {
        return $this->belongsTo(UserType::class);
    }

    /**
     * Obtener el programa académico del usuario.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function academicProgram()
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Obtener la configuración del usuario.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function setting()
    {
        return $this->hasOne(Setting::class);
    }

     /**
    * Relación: Un usuario pertenece a una modalidad.
    */
    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }


    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'accepted_terms' => 'boolean',
        'status' => 'boolean',
        'is_paid' => 'boolean',
    ];

    /**
     * Mutador para formatear el campo first_name antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo last_name antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo country antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setCountryAttribute($value)
    {
        $this->attributes['country'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo city antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setCityAttribute($value)
    {
        $this->attributes['city'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el nombre de la institución educativa
     * Esto asegura que el nombre de la institución tenga formato legible.
     */
    public function setInstitutionNameAttribute($value)
    {
        $this->attributes['institution_name'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo academic_program antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setAcademicProgramAttribute($value)
    {
        $this->attributes['academic_program'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo university antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setUniversityAttribute($value)
    {
        $this->attributes['university'] = ucwords(strtolower(trim($value)));
    }   

     /**
     * Mutador para formatear el campo company_name antes de guardar.
     * Esto asegura que el nombre de la empresa tenga formato legible.
     */
    public function setCompanyNameAttribute($value)
    {
        $this->attributes['company_name'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo company_position antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setCompanyPositionAttribute($value)
    {
        $this->attributes['company_position'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo company_address antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setCompanyAddressAttribute($value)
    {
        $this->attributes['company_address'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo entrepreneur_name antes de guardar.
     * Aplica trim y minúsculas.
     */
    public function setEntrepreneurNameAttribute($value)
    {
        $this->attributes['entrepreneur_name'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo product_type antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setProductTypeAttribute($value)
    {
        $this->attributes['product_type'] = ucwords(strtolower(trim($value)));
    }

    /**
     * Mutador para formatear el campo occupation antes de guardar.
     * Aplica trim, minúsculas y capitaliza las palabras.
     */
    public function setOccupationAttribute($value)
    {
        $this->attributes['occupation'] = ucwords(strtolower(trim($value)));
    }

}
