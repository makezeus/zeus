<?php
class Table_generator
{
    public function generate($columns, $data, $hiddenHeader = false)
    {
        // Tabela de carregamento
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

        // Tabela gerada
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
}