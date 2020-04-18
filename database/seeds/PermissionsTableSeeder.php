<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'content_management_access',
            ],
            [
                'id'    => '18',
                'title' => 'content_category_create',
            ],
            [
                'id'    => '19',
                'title' => 'content_category_edit',
            ],
            [
                'id'    => '20',
                'title' => 'content_category_show',
            ],
            [
                'id'    => '21',
                'title' => 'content_category_delete',
            ],
            [
                'id'    => '22',
                'title' => 'content_category_access',
            ],
            [
                'id'    => '23',
                'title' => 'content_tag_create',
            ],
            [
                'id'    => '24',
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => '25',
                'title' => 'content_tag_show',
            ],
            [
                'id'    => '26',
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => '27',
                'title' => 'content_tag_access',
            ],
            [
                'id'    => '28',
                'title' => 'content_page_create',
            ],
            [
                'id'    => '29',
                'title' => 'content_page_edit',
            ],
            [
                'id'    => '30',
                'title' => 'content_page_show',
            ],
            [
                'id'    => '31',
                'title' => 'content_page_delete',
            ],
            [
                'id'    => '32',
                'title' => 'content_page_access',
            ],
            [
                'id'    => '33',
                'title' => 'basic_c_r_m_access',
            ],
            [
                'id'    => '34',
                'title' => 'crm_status_create',
            ],
            [
                'id'    => '35',
                'title' => 'crm_status_edit',
            ],
            [
                'id'    => '36',
                'title' => 'crm_status_show',
            ],
            [
                'id'    => '37',
                'title' => 'crm_status_delete',
            ],
            [
                'id'    => '38',
                'title' => 'crm_status_access',
            ],
            [
                'id'    => '39',
                'title' => 'crm_customer_create',
            ],
            [
                'id'    => '40',
                'title' => 'crm_customer_edit',
            ],
            [
                'id'    => '41',
                'title' => 'crm_customer_show',
            ],
            [
                'id'    => '42',
                'title' => 'crm_customer_delete',
            ],
            [
                'id'    => '43',
                'title' => 'crm_customer_access',
            ],
            [
                'id'    => '44',
                'title' => 'crm_note_create',
            ],
            [
                'id'    => '45',
                'title' => 'crm_note_edit',
            ],
            [
                'id'    => '46',
                'title' => 'crm_note_show',
            ],
            [
                'id'    => '47',
                'title' => 'crm_note_delete',
            ],
            [
                'id'    => '48',
                'title' => 'crm_note_access',
            ],
            [
                'id'    => '49',
                'title' => 'crm_document_create',
            ],
            [
                'id'    => '50',
                'title' => 'crm_document_edit',
            ],
            [
                'id'    => '51',
                'title' => 'crm_document_show',
            ],
            [
                'id'    => '52',
                'title' => 'crm_document_delete',
            ],
            [
                'id'    => '53',
                'title' => 'crm_document_access',
            ],
            [
                'id'    => '54',
                'title' => 'court_date_create',
            ],
            [
                'id'    => '55',
                'title' => 'court_date_edit',
            ],
            [
                'id'    => '56',
                'title' => 'court_date_show',
            ],
            [
                'id'    => '57',
                'title' => 'court_date_delete',
            ],
            [
                'id'    => '58',
                'title' => 'court_date_access',
            ],
            [
                'id'    => '59',
                'title' => 'court_case_create',
            ],
            [
                'id'    => '60',
                'title' => 'court_case_edit',
            ],
            [
                'id'    => '61',
                'title' => 'court_case_show',
            ],
            [
                'id'    => '62',
                'title' => 'court_case_delete',
            ],
            [
                'id'    => '63',
                'title' => 'court_case_access',
            ],
            [
                'id'    => '64',
                'title' => 'courthouse_create',
            ],
            [
                'id'    => '65',
                'title' => 'courthouse_edit',
            ],
            [
                'id'    => '66',
                'title' => 'courthouse_show',
            ],
            [
                'id'    => '67',
                'title' => 'courthouse_delete',
            ],
            [
                'id'    => '68',
                'title' => 'courthouse_access',
            ],
            [
                'id'    => '69',
                'title' => 'post_create',
            ],
            [
                'id'    => '70',
                'title' => 'post_edit',
            ],
            [
                'id'    => '71',
                'title' => 'post_show',
            ],
            [
                'id'    => '72',
                'title' => 'post_delete',
            ],
            [
                'id'    => '73',
                'title' => 'post_access',
            ],
            [
                'id'    => '74',
                'title' => 'attorney_create',
            ],
            [
                'id'    => '75',
                'title' => 'attorney_edit',
            ],
            [
                'id'    => '76',
                'title' => 'attorney_show',
            ],
            [
                'id'    => '77',
                'title' => 'attorney_delete',
            ],
            [
                'id'    => '78',
                'title' => 'attorney_access',
            ],
            [
                'id'    => '79',
                'title' => 'employee_create',
            ],
            [
                'id'    => '80',
                'title' => 'employee_edit',
            ],
            [
                'id'    => '81',
                'title' => 'employee_show',
            ],
            [
                'id'    => '82',
                'title' => 'employee_delete',
            ],
            [
                'id'    => '83',
                'title' => 'employee_access',
            ],
            [
                'id'    => '84',
                'title' => 'audit_log_show',
            ],
            [
                'id'    => '85',
                'title' => 'audit_log_access',
            ],
            [
                'id'    => '86',
                'title' => 'faq_management_access',
            ],
            [
                'id'    => '87',
                'title' => 'faq_category_create',
            ],
            [
                'id'    => '88',
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => '89',
                'title' => 'faq_category_show',
            ],
            [
                'id'    => '90',
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => '91',
                'title' => 'faq_category_access',
            ],
            [
                'id'    => '92',
                'title' => 'faq_question_create',
            ],
            [
                'id'    => '93',
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => '94',
                'title' => 'faq_question_show',
            ],
            [
                'id'    => '95',
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => '96',
                'title' => 'faq_question_access',
            ],
            [
                'id'    => '97',
                'title' => 'service_create',
            ],
            [
                'id'    => '98',
                'title' => 'service_edit',
            ],
            [
                'id'    => '99',
                'title' => 'service_show',
            ],
            [
                'id'    => '100',
                'title' => 'service_delete',
            ],
            [
                'id'    => '101',
                'title' => 'service_access',
            ],
            [
                'id'    => '102',
                'title' => 'account_create',
            ],
            [
                'id'    => '103',
                'title' => 'account_edit',
            ],
            [
                'id'    => '104',
                'title' => 'account_show',
            ],
            [
                'id'    => '105',
                'title' => 'account_delete',
            ],
            [
                'id'    => '106',
                'title' => 'account_access',
            ],
            [
                'id'    => '107',
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);

    }
}
