<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manage_role extends Model
{
    protected $table		=	'mange_roles';
    protected $primaryKey	=	'mange_role_id';
    protected $fillable		=	[
    								'admin_type',
									'admintype_view',
									'admintype_create',
									'admintype_update',
									'admintype_delete',
									'admins_user_view',
									'admins_user_create',
									'admins_user_update',
									'admins_user_delete',
									'company_view',  
				                    'company_create',      
				                    'company_update',
				                    'company_delete',
				                    'company_branch_view',
				                    'company_branch_create',
				                    'company_branch_update',
				                    'company_branch_delete',
				                    'company_branch_question_view',
				                    'company_branch_question_assign',
				                    'company_branch_question_delete',
				                    'company_user_view',
				                    'company_user_create',
				                    'company_user_update',
				                    'company_user_delete',
				                    'question_view',
				                    'question_create',
				                    'question_update',
				                    'question_delete',
				                    'question_options_view',
				                    'question_options_create',
				                    'question_options_update',
				                    'question_options_delete',
				                    'customer_review_view',
				                    'customer_review_mail',
									'customer_review_delete',
    							];
	protected $casts		=	[
									'admin_type'						=> 'integer',
									'admintype_view'					=> 'integer',
									'admintype_create'					=> 'integer',
									'admintype_update'					=> 'integer',
									'admintype_delete'					=> 'integer',
									'admins_user_view'					=> 'integer',
									'admins_user_create'				=> 'integer',
									'admins_user_update'				=> 'integer',
									'admins_user_delete'				=> 'integer',
									'company_view'                      => 'integer',  
                    				'company_create'                    => 'integer',      
				                    'company_update'                    => 'integer',
				                    'company_delete'                    => 'integer',
				                    'company_branch_view'               => 'integer',
				                    'company_branch_create'             => 'integer',
				                    'company_branch_update'             => 'integer',
				                    'company_branch_delete'             => 'integer',
				                    'company_branch_question_view'      => 'integer',
				                    'company_branch_question_assign'    => 'integer',
				                    'company_branch_question_delete'    => 'integer',
				                    'company_user_view'                 => 'integer',
				                    'company_user_create'               => 'integer',
				                    'company_user_update'               => 'integer',
				                    'company_user_delete'               => 'integer',
				                    'question_view'                     => 'integer',
				                    'question_create'                   => 'integer',
				                    'question_update'                   => 'integer',
				                    'question_delete'                   => 'integer',
				                    'question_options_view'             => 'integer',
				                    'question_options_create'           => 'integer',
				                    'question_options_update'           => 'integer',
				                    'question_options_delete'           => 'integer',
				                    'customer_review_view'           	=> 'integer',
				                    'customer_review_mail'           	=> 'integer',
				                    'customer_review_delete'           	=> 'integer',
								];
	public function type()
    {
        return $this->belongsTo('App\Admin_type','admin_type','admin_type_id');
    }
}
