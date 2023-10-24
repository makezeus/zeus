<?php
class Table_generator
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model('generic_model');
        $this->CI->load->library('pagination');
    }

    public function generate($columns, $data, $hiddenHeader = false)
    {
        $loadingTable = '<table id="loading-indicator" class="loading-table table hidden">';
        if (!$hiddenHeader) {
            $loadingTable .= '<thead><tr>';
            foreach ($columns as $column_name => $column_key) {
                $loadingTable .= '<th>' . $column_name . '</th>';
            }
            $loadingTable .= '</tr></thead>';
        }

        $loadingTable .= '<tbody>';

        if (!$data) {
            for ($i = 0; $i < 10; $i++) {
                $loadingTable .= '<tr class="loading-row">';
                foreach ($columns as $column_key) {
                    $loadingTable .= '<td class="loading-cell"><div class="loading-cell"></div></td>';
                }
                $loadingTable .= '</tr>';
            }
        } else {
            foreach ($data as $row) {
                $loadingTable .= '<tr class="loading-row">';
                foreach ($columns as $column_key) {
                    $loadingTable .= '<td class="loading-cell"><div class="loading-cell"></div></td>';
                }
                $loadingTable .= '</tr>';
            }
        }

        $loadingTable .= '</tbody></table>';

        $generatedTable = '<table id="generated_table" class="table">';
        if (!$hiddenHeader) {

            $generatedTable .= '<thead><tr>';

            foreach ($columns as $column_name => $column_key) {
                $generatedTable .= '<th>' . $column_name . '</th>';
            }
            $generatedTable .= '</tr></thead>';
        }
        $generatedTable .= '<tbody>';

        if (!$data) {
            $generatedTable .= '<tr><td colspan="' . count($columns) . '">Que pena, não encontramos nada aqui!</td></tr>';
        } else {
            foreach ($data as $row) {
                $generatedTable .= '<tr>';
                foreach ($columns as $column_key) {
                    $generatedTable .= '<td>' . $row->$column_key . '</td>';
                }
                $generatedTable .= '</tr>';
            }
        }

        $generatedTable .= '</tbody></table>';
        return $loadingTable . $generatedTable;
    }


    public function _generate($table, $fields, $searchField, $orderBy, $columns, $customFields)
    {
        $search = '';
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
        }
        $offset = 0;
        if (isset($_GET['per_page'])) {
            $offset = $_GET['per_page'];
        }
        $data = $this->setupTableData($table, $fields, $search, $searchField, $offset, $orderBy, $customFields);

        $this->setupPagination($table, $searchField);

        $container = '<div id="table-container"><div class="panel-body">
        <div>';
        $loadingTable = '<table id="loading-indicator" class="loading-table table hidden">';
        if (!isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/mobile|android|iphone|ipad|phone|iemobile/i', $_SERVER['HTTP_USER_AGENT'])) {
            $loadingTable .= '<thead><tr>';
            foreach ($columns as $column_name => $column_key) {
                $loadingTable .= '<th>' . $column_name . '</th>';
            }
            $loadingTable .= '</tr></thead>';
        }

        $loadingTable .= '<tbody>';

        if (!$data) {
            for ($i = 0; $i < 10; $i++) {
                $loadingTable .= '<tr class="loading-row">';
                foreach ($columns as $column_key) {
                    $loadingTable .= '<td class="loading-cell"><div class="loading-cell"></div></td>';
                }
                $loadingTable .= '</tr>';
            }
        } else {
            foreach ($data as $row) {
                $loadingTable .= '<tr class="loading-row">';
                foreach ($columns as $column_key) {
                    $loadingTable .= '<td class="loading-cell"><div class="loading-cell"></div></td>';
                }
                $loadingTable .= '</tr>';
            }
        }

        $loadingTable .= '</tbody></table>';

        $generatedTable = '<table id="generated_table" class="table">';
        if (!(isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/mobile|android|iphone|ipad|phone|iemobile/i', $_SERVER['HTTP_USER_AGENT']))) {

            $generatedTable .= '<thead><tr>';

            foreach ($columns as $column_name => $column_key) {
                $generatedTable .= '<th>' . $column_name . '</th>';
            }
            $generatedTable .= '</tr></thead>';
        }
        $generatedTable .= '<tbody>';

        if (!$data) {
            $generatedTable .= '<tr><td colspan="' . count($columns) . '">Que pena, não encontramos nada aqui!</td></tr>';
        } else {
            foreach ($data as $row) {
                $generatedTable .= '<tr>';
                foreach ($columns as $column_key) {
                    if (!empty($row->$column_key)) {
                        $generatedTable .= '<td>' . $row->$column_key . '</td>';
                    }
                }
                $generatedTable .= '</tr>';
            }

        }

        $generatedTable .= '</tbody></table>';

        $container .= $loadingTable . $generatedTable;


        $container .= '</div>';

        $container .= '</div>';
        if ($data) {
            $container .= $this->CI->pagination->create_links();
        }
        ;
        $container .= '</div>';

        return $container;
    }


    private function setupTableData($table, $fields, $search, $searchField, $offset, $orderBy, $customFields)
    {
        $data = $this->CI->generic_model->get($table, array_column($fields, 'field'), $searchField, $search, 10, $offset, $orderBy);

        foreach ($data as $field => $row) {
            foreach ($fields as $obj) {
                $fieldName = $obj['field'];
                $formatterFunction = $obj['formatter'];

                if (function_exists($formatterFunction) && isset($row->$fieldName)) {
                    $row->$fieldName = $formatterFunction($row->$fieldName);
                }
            }
        }

        foreach ($data as $field => $row) {
            foreach ($customFields as $fieldData) {
                $field = $fieldData['field'];
                $value = $fieldData['value'];
                $value = preg_replace_callback('/\$\$(\w+)\$\$/', function ($match) use ($row) {
                    $chave = $match[1];
                    if (isset($row->$chave)) {
                        return $row->$chave;
                    }
                    return $match[0];
                }, $value);

                $row->$field = $value;
            }
        }

        return $data;
    }

    private function setupPagination($table, $searchField)
    {
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        $config['base_url'] = base_url() . '/' . $this->CI->uri->segment(1);
        $config['reuse_query_string'] = true;
        $config['page_query_string'] = true;
        $config['total_rows'] = $this->CI->generic_model->count($table, $search, $searchField);
        $this->CI->pagination->initialize($config);
    }
}
