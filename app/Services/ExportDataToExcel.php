<?php

namespace App\Services;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class ExportDataToExcel implements FromQuery, WithHeadings
{
    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function query()
    {
        return DB::table('form_submissions as fs')
            ->select(
                'fs.id',
                'fs.user_id',
                'u.first_name',
                'u.last_name',
                'u.npm',
                'u.gender',
                'u.phone',
                'u.email',
                'u.img_url',
                'u.role_id',
                'rm.name AS role_name',
                'fs.form_status',
                'u.department_id',
                'd.department_name',
                'u.study_program_id',
                'sp.study_program_name',
                'fs.form_template_id',
                'ft.template_name',
                'fs.size_file',
                'fs.url_file',
                'fs.signed_file',
                'fs.signed_size_file',
                'fs.submission_date',
                'fs.processed_date',
                'fs.keterangan',
                'fs.komentar',
                'fs.created_by',
                'fs.updated_by',
                'fs.created_at',
                'fs.updated_at'
            )
            ->join('users as u', 'fs.user_id', '=', 'u.id')
            ->join('departments as d', 'u.department_id', '=', 'd.id')
            ->join('study_programs as sp', 'u.study_program_id', '=', 'sp.id')
            ->join('role_memberships as rm', 'u.role_id', '=', 'rm.id')
            ->join('form_templates as ft', 'fs.form_template_id', '=', 'ft.id')
            ->where(DB::raw("DATE_FORMAT(fs.created_at, '%Y-%m')"), '=', $this->date)
            ->orderBy('fs.created_at', 'desc');
    }

    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'First Name',
            'Last Name',
            'NPM',
            'Gender',
            'Phone',
            'Email',
            'Image URL',
            'Role ID',
            'Role Name',
            'Form Status',
            'Department ID',
            'Department Name',
            'Study Program ID',
            'Study Program Name',
            'Form Template ID',
            'Template Name',
            'Size File',
            'URL File',
            'Signed File',
            'Signed Size File',
            'Submission Date',
            'Processed Date',
            'Keterangan',
            'Komentar',
            'Created By',
            'Updated By',
            'Created At',
            'Updated At',
        ];
    }
}
