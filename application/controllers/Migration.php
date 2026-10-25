<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

class Migration extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->dbforge();
    }

    public function index()
    {
        $target_dir = "./assets/images/document/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777);
        }
        // $this->dbforge->drop_column('report_transaction', 'created');
        $tables = $this->db->list_tables();
        foreach ($tables as $table) {
            $fields = $this->_getfield($table);
        }
        // cek showentri
        $other = $this->db->get('other')->row_array();
        if ($other['showentri'] == 0) {
            $this->db->set('showentri', 10);
            $this->db->update('other');
        }
        $this->session->set_flashdata('success-sweet', 'Billing berhasil diperbaharui');
        echo "<script>window.location='" . site_url('about/changelog') . "'; </script>";
    }
    public function database()
    {

        // $this->dbforge->drop_column('report_transaction', 'created');
        $tables = $this->db->list_tables();
        foreach ($tables as $table) {
            $fields = $this->_getfield($table);
        }

        $data['title'] = 'Database';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get('company')->row_array();
        $data['totaltable'] = count($tables);
        $data['tables'] = $tables;
        $this->template->load('backend', 'backend/migration/database', $data);
        // echo '<br>';
        // $fields = array(
        //     // 'created' => array('type' => 'int','null' => false,),
        //     'coverage' => array('type' => 'int','null' => false,),
        // );
        // $this->dbforge->add_column('income', $fields);
    }
    public function createtable($table)
    {
        if ($table == 'briva') {
            // define table fields
            $fields = array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 9,
                    'null' => false,
                    'auto_increment' => TRUE
                ),
                'is_active' => array(
                    'type' => 'INT',
                    'null' => false,

                ),
                'mode' => array(
                    'type' => 'INT',
                    'null' => false,

                ),
                'auto_pay' => array(
                    'type' => 'INT',
                    'null' => false,

                ),

                'account_number' => array(
                    'type' => 'text', 'null' => false,

                ),
                'consumer_key' => array(
                    'type' => 'text', 'null' => false,

                ),
                'consumer_secret' => array(
                    'type' => 'text', 'null' => false,

                ),
                'institution' => array(
                    'type' => 'text', 'null' => false,
                    'constraint' => 60,

                ),
                'briva' => array(
                    'type' => 'text', 'null' => false,
                    'constraint' => 40
                )
            );
            $this->dbforge->add_field($fields);

            // define primary key
            $this->dbforge->add_key('id', TRUE);

            // create table
            $this->dbforge->create_table('briva');
        }
        if ($table == 'olt') {
            // define table fields
            $fields = array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 9,
                    'null' => false,
                    'auto_increment' => TRUE
                ),
                'is_active' => array(
                    'type' => 'INT',
                    'null' => false,

                ),


                'ip_address' => array(
                    'type' => 'text', 'null' => false,

                ),
                'alias' => array(
                    'type' => 'text', 'null' => false,

                ),
                'vendor' => array(
                    'type' => 'text', 'null' => false,

                ),
                'username' => array(
                    'type' => 'text', 'null' => false,

                ),
                'password' => array(
                    'type' => 'text', 'null' => false,

                ),
                'value' => array(
                    'type' => 'text', 'null' => false,

                ),
                'token' => array(
                    'type' => 'text', 'null' => false,

                ),

            );
            $this->dbforge->add_field($fields);

            // define primary key
            $this->dbforge->add_key('id', TRUE);

            // create table
            $this->dbforge->create_table('olt');
        }
        if ($table == 'm_odc') {
            // define table fields
            $fields = array(
                'id_odc' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'null' => false,
                    'auto_increment' => TRUE
                ),
                'code_odc' => array(
                    'type' => 'text',
                    'null' => false,

                ),
                'coverage_odc' => array(
                    'type' => 'int',
                    'null' => false,

                ),
                'no_port_olt' => array(
                    'type' => 'int',
                    'null' => false,

                ),
                'color_tube_fo' => array(
                    'type' => 'text',
                    'null' => false,

                ),
                'no_pole' => array(
                    'type' => 'text',
                    'null' => false,

                ),
                'latitude' => array(
                    'type' => 'text',
                    'null' => false,

                ),
                'longitude' => array(
                    'type' => 'text',
                    'null' => false,

                ),
                'total_port' => array(
                    'type' => 'int',
                    'null' => false,

                ),
                'document' => array(
                    'type' => 'text',
                    'null' => false,

                ),
                'remark' => array(
                    'type' => 'text',
                    'null' => false,

                ),
                'created' => array(
                    'type' => 'int',
                    'null' => false,

                ),
                'create_by' => array(
                    'type' => 'int',
                    'null' => false,

                ),
            );
            $this->dbforge->add_field($fields);

            // define primary key
            $this->dbforge->add_key('id_odc', TRUE);

            // create table
            $this->dbforge->create_table('m_odc');
        }
        if ($table == 'm_odp') {
            // define table fields
            $fields = array(
                'id_odp' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'null' => false,
                    'auto_increment' => TRUE
                ),
                'code_odp' => array(
                    'type' => 'text',
                    'null' => false,

                ),
                'code_odc' => array(
                    'type' => 'int',
                    'null' => false,

                ),
                'coverage_odp' => array(
                    'type' => 'int',
                    'null' => false,

                ),
                'no_port_odc' => array(
                    'type' => 'int',
                    'null' => false,

                ),
                'color_tube_fo' => array(
                    'type' => 'text',
                    'null' => false,

                ),
                'no_pole' => array(
                    'type' => 'text',
                    'null' => false,

                ),
                'latitude' => array(
                    'type' => 'text',
                    'null' => false,

                ),
                'longitude' => array(
                    'type' => 'text',
                    'null' => false,

                ),
                'total_port' => array(
                    'type' => 'int',
                    'null' => false,

                ),
                'document' => array(
                    'type' => 'text',
                    'null' => false,

                ),
                'remark' => array(
                    'type' => 'text',
                    'null' => false,

                ),
                'created' => array(
                    'type' => 'int',
                    'null' => false,

                ),
                'create_by' => array(
                    'type' => 'int',
                    'null' => false,

                ),
            );
            $this->dbforge->add_field($fields);

            // define primary key
            $this->dbforge->add_key('id_odp', TRUE);

            // create table
            $this->dbforge->create_table('m_odp');
        }
        if ($table == 'moota') {
            // define table fields
            $fields = array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 9,
                    'null' => false,
                    'auto_increment' => TRUE
                ),
                'is_active' => array(
                    'type' => 'INT',
                    'null' => false,

                ),

                'token' => array(
                    'type' => 'text', 'null' => false,

                ),
                'send_whatsapp' => array(
                    'type' => 'text', 'null' => false,

                ),
                'send_telegram' => array(
                    'type' => 'text', 'null' => false,

                ),
                'secret' => array(
                    'type' => 'text', 'null' => false,

                ),
                'no_whatsapp' => array(
                    'type' => 'text', 'null' => false,

                ),
                'text_income' => array(
                    'type' => 'text', 'null' => false,

                ),
                'text_expend' => array(
                    'type' => 'text', 'null' => false,

                ),

            );
            $this->dbforge->add_field($fields);

            // define primary key
            $this->dbforge->add_key('id', TRUE);

            // create table
            $this->dbforge->create_table('moota');
        }
        if ($table == 'help_action') {
            // define table fields
            $fields = array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 9,
                    'null' => false,
                    'auto_increment' => TRUE
                ),

                'action' => array(
                    'type' => 'text', 'null' => false,

                ),

            );
            $this->dbforge->add_field($fields);

            // define primary key
            $this->dbforge->add_key('id', TRUE);

            // create table
            $this->dbforge->create_table('help_action');
        }
        if ($table == 'customer_status') {
            // define table fields
            $fields = array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 9,
                    'null' => false,
                    'auto_increment' => TRUE
                ),

                'status' => array(
                    'type' => 'text', 'null' => false,

                ),
                'remark' => array(
                    'type' => 'text', 'null' => false,

                ),
                'active_bill' => array(
                    'type' => 'INT',

                    'null' => false,

                ),

            );
            $this->dbforge->add_field($fields);

            // define primary key
            $this->dbforge->add_key('id', TRUE);

            // create table
            $this->dbforge->create_table('customer_status');
        }
        if ($table == 'role_group') {
            // define table fields
            $fields = array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 9,
                    'null' => false,
                    'auto_increment' => TRUE
                ),

                'role_name' => array(
                    'type' => 'text', 'null' => false,

                ),
                'remark' => array(
                    'type' => 'text', 'null' => false,

                ),


            );
            $this->dbforge->add_field($fields);

            // define primary key
            $this->dbforge->add_key('id', TRUE);

            // create table
            $this->dbforge->create_table('role_group');
        }
        redirect('migration');
    }
    public function fields()
    {

        $table = $this->input->get('table');
        $fields = $this->_getfield($table);
        // var_dump($fields);
        // die;
        $data['title'] = 'Database';
        $data['table'] = $table;
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get('company')->row_array();

        $data['fields'] = $fields;
        $this->template->load('backend', 'backend/migration/fields', $data);
    }

    private function _getfield($table)
    {
        // TABEL COMPANY
        if ($table == 'company') {
            if ($this->db->field_exists('watermark', $table)) {
            } else {
                $fields = array(
                    'watermark' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('speedtest', $table)) {
            } else {
                $fields = array(
                    'speedtest' => array(
                        'type' => 'text',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('tawk', $table)) {
            } else {
                $fields = array(
                    'tawk' => array(
                        'type' => 'text',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('expired', $table)) {
            } else {
                $fields = array(
                    'expired' => array(
                        'type' => 'text',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('maintenance', $table)) {
            } else {
                $fields = array(
                    'maintenance' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('import', $table)) {
            } else {
                $fields = array(
                    'import' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('cek_bill', $table)) {
            } else {
                $fields = array(
                    'cek_bill' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('cek_usage', $table)) {
            } else {
                $fields = array(
                    'cek_usage' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('version', $table)) {
            } else {
                $fields = array(
                    'version' => array(
                        'type' => 'text',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('last_update', $table)) {
            } else {
                $fields = array(
                    'last_update' => array(
                        'type' => 'text',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
        }

        // TABEL INVOICE
        if ($table == 'invoice') {
            if ($this->db->field_exists('inv_due_date', $table)) {
            } else {
                $fields = array(
                    'inv_due_date' => array(
                        'type' => 'text', 'null' => false,

                    )

                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('date_isolir', $table)) {
            } else {
                $fields = array(
                    'date_isolir' => array('type' => 'text', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('send_before_due', $table)) {
            } else {
                $fields = array(
                    'send_before_due' => array('type' => 'text', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }

            if ($this->db->field_exists('send_due', $table)) {
            } else {
                $fields = array(
                    'send_due' => array('type' => 'text', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }

            if ($this->db->field_exists('send_bill', $table)) {
            } else {
                $fields = array(
                    'send_bill' => array('type' => 'text', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('send_paid', $table)) {
            } else {
                $fields = array(
                    'send_paid' => array('type' => 'text', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('date_paid', $table)) {
            } else {
                $fields = array(
                    'date_paid' => array('type' => 'text', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('inv_ppn', $table)) {
            } else {
                $fields = array(
                    'inv_ppn' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('i_ppn', $table)) {
            } else {
                $fields = array(
                    'i_ppn' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
        }


        // TABEL ROLE_MANAGEMET
        if ($table == 'role_management') {
            if ($this->db->field_exists('edit_bill', $table)) {
            } else {
                $fields = array(
                    'edit_bill' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('coverage_operator', $table)) {
            } else {
                $fields = array(
                    'coverage_operator' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('confirm_bill', $table)) {
            } else {
                $fields = array(
                    'confirm_bill' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('add_odc', $table)) {
            } else {
                $fields = array(
                    'add_odc' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('edit_odc', $table)) {
            } else {
                $fields = array(
                    'edit_odc' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('del_odc', $table)) {
            } else {
                $fields = array(
                    'del_odc' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('add_odp', $table)) {
            } else {
                $fields = array(
                    'add_odp' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('edit_odp', $table)) {
            } else {
                $fields = array(
                    'edit_odp' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('del_odp', $table)) {
            } else {
                $fields = array(
                    'del_odp' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('add_midi', $table)) {
            } else {
                $fields = array(
                    'add_midi' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('edit_midi', $table)) {
            } else {
                $fields = array(
                    'edit_midi' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('del_midi', $table)) {
            } else {
                $fields = array(
                    'del_midi' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('add_voip', $table)) {
            } else {
                $fields = array(
                    'add_voip' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('edit_voip', $table)) {
            } else {
                $fields = array(
                    'edit_voip' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('del_voip', $table)) {
            } else {
                $fields = array(
                    'del_voip' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('add_gsm', $table)) {
            } else {
                $fields = array(
                    'add_gsm' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('edit_gsm', $table)) {
            } else {
                $fields = array(
                    'edit_gsm' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('del_gsm', $table)) {
            } else {
                $fields = array(
                    'del_gsm' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('add_item_inventori', $table)) {
            } else {
                $fields = array(
                    'add_item_inventori' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('edit_item_inventori', $table)) {
            } else {
                $fields = array(
                    'edit_item_inventori' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('del_item_inventori', $table)) {
            } else {
                $fields = array(
                    'del_item_inventori' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('add_vendor', $table)) {
            } else {
                $fields = array(
                    'add_vendor' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('edit_vendor', $table)) {
            } else {
                $fields = array(
                    'edit_vendor' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('del_vendor', $table)) {
            } else {
                $fields = array(
                    'del_vendor' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
        }




        // TABEL MENU
        if ($table == 'role_menu') {
            if ($this->db->field_exists('customer_isolir', $table)) {
            } else {
                $fields = array(
                    'customer_isolir' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('customer_free', $table)) {
            } else {
                $fields = array(
                    'customer_free' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('integration_briva', $table)) {
            } else {
                $fields = array(
                    'integration_briva' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('integration_moota', $table)) {
            } else {
                $fields = array(
                    'integration_moota' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('master_menu', $table)) {
            } else {
                $fields = array(
                    'master_menu' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('master_odc', $table)) {
            } else {
                $fields = array(
                    'master_odc' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('master_odp', $table)) {
            } else {
                $fields = array(
                    'master_odp' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
        }



        // TABEL OTHER
        if ($table == 'other') {
            if ($this->db->field_exists('code_otp', $table)) {
            } else {
                $fields = array(
                    'code_otp' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('sch_isolir', $table)) {
            } else {
                $fields = array(
                    'sch_isolir' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('sch_createbill', $table)) {
            } else {
                $fields = array(
                    'sch_createbill' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('sch_usage', $table)) {
            } else {
                $fields = array(
                    'sch_usage' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('sch_reset_usage', $table)) {
            } else {
                $fields = array(
                    'sch_reset_usage' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('sch_due', $table)) {
            } else {
                $fields = array(
                    'sch_due' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('sch_before_due', $table)) {
            } else {
                $fields = array(
                    'sch_before_due' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('sch_resend', $table)) {
            } else {
                $fields = array(
                    'sch_resend' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('inv_thermal', $table)) {
            } else {
                $fields = array(
                    'inv_thermal' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('checkout', $table)) {
            } else {
                $fields = array(
                    'checkout' => array('type' => 'text', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('create_help', $table)) {
            } else {
                $fields = array(
                    'create_help' => array('type' => 'text', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('create_help_customer', $table)) {
            } else {
                $fields = array(
                    'create_help_customer' => array('type' => 'text', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('add_customer', $table)) {
            } else {
                $fields = array(
                    'add_customer' => array('type' => 'text', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('frontend', $table)) {
            } else {
                $fields = array(
                    'frontend' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('showentri', $table)) {
            } else {
                $fields = array(
                    'showentri' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
        }

        // TABEL Whatsapp
        if ($table == 'whatsapp') {
            if ($this->db->field_exists('period', $table)) {
            } else {
                $fields = array(
                    'period' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('version', $table)) {
            } else {
                $fields = array(
                    'version' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('create_help', $table)) {
            } else {
                $fields = array(
                    'create_help' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('create_help_customer', $table)) {
            } else {
                $fields = array(
                    'create_help_customer' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('update_help', $table)) {
            } else {
                $fields = array(
                    'update_help' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('get_help', $table)) {
            } else {
                $fields = array(
                    'get_help' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('create_help_admin', $table)) {
            } else {
                $fields = array(
                    'create_help_admin' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('id_devices', $table)) {
            } else {
                $fields = array(
                    'id_devices' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
        }

        // TABEL CUSTOMER

        if ($table == 'customer') {
            if ($this->db->field_exists('connection', $table)) {
            } else {
                $fields = array(
                    'connection' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('level', $table)) {
            } else {
                $fields = array(
                    'level' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('max_due_isolir', $table)) {
            } else {
                $fields = array(
                    'max_due_isolir' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('cust_amount', $table)) {
            } else {
                $fields = array(
                    'cust_amount' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('olt', $table)) {
            } else {
                $fields = array(
                    'olt' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('type_payment', $table)) {
            } else {
                $fields = array(
                    'type_payment' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('mac_address', $table)) {
            } else {
                $fields = array(
                    'mac_address' => array('type' => 'text', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('cust_description', $table)) {
            } else {
                $fields = array(
                    'cust_description' => array(
                        'type' => 'text',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('type_ip', $table)) {
            } else {
                $fields = array(
                    'type_ip' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('id_odc', $table)) {
            } else {
                $fields = array(
                    'id_odc' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('id_odp', $table)) {
            } else {
                $fields = array(
                    'id_odp' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('no_port_odp', $table)) {
            } else {
                $fields = array(
                    'no_port_odp' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('month_due_date', $table)) {
            } else {
                $fields = array(
                    'month_due_date' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('month_due_date', $table)) {
            } else {
                $fields = array(
                    'month_due_date' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('send_bill', $table)) {
            } else {
                $fields = array(
                    'send_bill' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
        }

        // TABEL PAKET
        if ($table == 'package_item') {
            if ($this->db->field_exists('is_active', $table)) {
            } else {
                $fields = array(
                    'is_active' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('create_by', $table)) {
            } else {
                $fields = array(
                    'create_by' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('role_id', $table)) {
            } else {
                $fields = array(
                    'role_id' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
        }

        // TABEL user token
        if ($table == 'user_token') {
            if ($this->db->field_exists('type', $table)) {
            } else {
                $fields = array(
                    'type' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
        }
        // TABEL Logs
        if ($table == 'logs') {
            if ($this->db->field_exists('date_log', $table)) {
            } else {
                $fields = array(
                    'date_log' => array(
                        'type' => 'text',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
        }
        // TABEL Whatsapp
        if ($table == 'whatsapp') {
            if ($this->db->field_exists('id_devices', $table)) {
            } else {
                $fields = array(
                    'id_devices' => array(
                        'type' => 'text',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
        }

        // TABEL package

        if ($table == 'package') {
            if ($this->db->field_exists('coverage_operator', $table)) {
            } else {
                $fields = array(
                    'coverage_operator' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('coverage_package', $table)) {
            } else {
                $fields = array(
                    'coverage_package' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('modem', $table)) {
            } else {
                $fields = array(
                    'modem' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('olt', $table)) {
            } else {
                $fields = array(
                    'olt' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('count_olt', $table)) {
            } else {
                $fields = array(
                    'count_olt' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('briva', $table)) {
            } else {
                $fields = array(
                    'briva' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('sms_gateway', $table)) {
            } else {
                $fields = array(
                    'sms_gateway' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('moota', $table)) {
            } else {
                $fields = array(
                    'moota' => array('type' => 'int', 'null' => false,)
                );
                $this->dbforge->add_column($table, $fields);
            }
        }


        // TABEL Briva
        if ($table == 'briva') {
            if ($this->db->field_exists('account_number', $table)) {
            } else {
                $fields = array(
                    'account_number' => array(
                        'type' => 'text',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('auto_pay', $table)) {
            } else {
                $fields = array(
                    'auto_pay' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
        }

        // TABEL Help
        if ($table == 'help') {
            if ($this->db->field_exists('action', $table)) {
            } else {
                $fields = array(
                    'action' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
        }
        if ($table == 'help_timeline') {
            if ($this->db->field_exists('action', $table)) {
            } else {
                $fields = array(
                    'action' => array(
                        'type' => 'text',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
        }
        // tabel odp
        if ($table == 'm_odp') {
            if ($this->db->field_exists('create_by', $table)) {
            } else {
                $fields = array(
                    'create_by' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('role_id', $table)) {
            } else {
                $fields = array(
                    'role_id' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
        }
        // tabel odc
        if ($table == 'm_odc') {
            if ($this->db->field_exists('role_id', $table)) {
            } else {
                $fields = array(
                    'role_id' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
            if ($this->db->field_exists('create_by', $table)) {
            } else {
                $fields = array(
                    'create_by' => array(
                        'type' => 'int',
                        'null' => false,
                    )
                );
                $this->dbforge->add_column($table, $fields);
            }
        }
        $fields = $this->db->field_data($table);
        return $fields;
    }

    public function delfield()
    {
        $this->load->dbforge();
        $field = $this->input->get('column');
        $table = $this->input->get('table');

        $this->dbforge->drop_column($table, $field);
        redirect('migration/database');
    }
}
