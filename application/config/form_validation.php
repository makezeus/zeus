<?php
$config = array('clientes' => array(array(
                                	'field'=>'nomeCliente',
                                	'label'=>'Nome',
                                	'rules'=>'required|trim'
                                ),
								array(
                                	'field'=>'documento',
                                	'label'=>'CPF/CNPJ',
                                	'rules'=>'required|trim'
                                ),
								array(
                                	'field'=>'telefone',
                                	'label'=>'Telefone',
                                	'rules'=>'required|trim'
                                ),
								array(
                                	'field'=>'email',
                                	'label'=>'Email',
                                	'rules'=>'required|trim|valid_email'
                                ),
								array(
                                	'field'=>'rua',
                                	'label'=>'Rua',
                                	'rules'=>'required|trim'
                                ),
								array(
                                	'field'=>'numero',
                                	'label'=>'Número',
                                	'rules'=>'required|trim'
                                ),
								array(
                                	'field'=>'bairro',
                                	'label'=>'Bairro',
                                	'rules'=>'required|trim'
                                ),
								array(
                                	'field'=>'cidade',
                                	'label'=>'Cidade',
                                	'rules'=>'required|trim'
                                ),
								array(
                                	'field'=>'estado',
                                	'label'=>'Estado',
                                	'rules'=>'required|trim'
                                ),
								array(
                                	'field'=>'cep',
                                	'label'=>'CEP',
                                	'rules'=>'required|trim'
                                ))
                ,
                'servicos' => array(array(
                                    'field'=>'nome',
                                    'label'=>'Nome',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'descricao',
                                    'label'=>'',
                                    'rules'=>'trim'
                                ),
                                array(
                                    'field'=>'preco',
                                    'label'=>'',
                                    'rules'=>'required|trim'
                                ))
                ,
                'produtos' => array(array(
                                    'field'=>'descricao',
                                    'label'=>'',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'unidade',
                                    'label'=>'Unidade',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'precoCompra',
                                    'label'=>'Preo de Compra',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'precoVenda',
                                    'label'=>'Preo de Venda',
                                    'rules'=>'required|trim'
                                ),
                                )
                ,
                'usuarios' => array(array(
                                    'field'=>'nome',
                                    'label'=>'Nome',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'rg',
                                    'label'=>'RG',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'cpf',
                                    'label'=>'CPF',
                                    'rules'=>'required|trim|is_unique[usuarios.cpf]'
                                ),
                                array(
                                    'field'=>'rua',
                                    'label'=>'Rua',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'numero',
                                    'label'=>'Numero',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'bairro',
                                    'label'=>'Bairro',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'cidade',
                                    'label'=>'Cidade',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'estado',
                                    'label'=>'Estado',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'email',
                                    'label'=>'Email',
                                    'rules'=>'required|trim|valid_email'
                                ),
                                array(
                                    'field'=>'senha',
                                    'label'=>'Senha',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'telefone',
                                    'label'=>'Telefone',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'situacao',
                                    'label'=>'Situacao',
                                    'rules'=>'required|trim'
                                ))
                ,      
                'os' => array(array(
                                    'field'=>'dataInicial',
                                    'label'=>'DataInicial',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'dataFinal',
                                    'label'=>'DataFinal',
                                    'rules'=>'trim'
                                ),
                                array(
                                    'field'=>'garantia',
                                    'label'=>'Garantia',
                                    'rules'=>'trim'
                                ),
                                array(
                                    'field'=>'descricaoProduto',
                                    'label'=>'DescricaoProduto',
                                    'rules'=>'trim'
                                ),
                                array(
                                    'field'=>'defeito',
                                    'label'=>'Defeito',
                                    'rules'=>'trim'
                                ),
                                array(
                                    'field'=>'status',
                                    'label'=>'Status',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'observacoes',
                                    'label'=>'Observacoes',
                                    'rules'=>'trim'
                                ),
                                array(
                                    'field'=>'clientes_id',
                                    'label'=>'clientes',
                                    'rules'=>'trim|required'
                                ),
                                array(
                                    'field'=>'usuarios_id',
                                    'label'=>'usuarios_id',
                                    'rules'=>'trim|required'
                                ),
                                array(
                                    'field'=>'laudoTecnico',
                                    'label'=>'Laudo Tecnico',
                                    'rules'=>'trim'
                                ))

                  ,
				'tiposUsuario' => array(array(
                                	'field'=>'nomeTipo',
                                	'label'=>'NomeTipo',
                                	'rules'=>'required|trim'
                                ),
								array(
                                	'field'=>'situacao',
                                	'label'=>'Situacao',
                                	'rules'=>'required|trim'
                                ))

                ,
                'receita' => array(array(
                                    'field'=>'descricao',
                                    'label'=>'Descrição',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'valor',
                                    'label'=>'Valor',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'vencimento',
                                    'label'=>'Data Vencimento',
                                    'rules'=>'required|trim'
                                ),
                        
                                array(
                                    'field'=>'cliente',
                                    'label'=>'Cliente',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'tipo',
                                    'label'=>'Tipo',
                                    'rules'=>'required|trim'
                                ))
                ,
                'despesa' => array(array(
                                    'field'=>'descricao',
                                    'label'=>'Descrição',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'valor',
                                    'label'=>'Valor',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'vencimento',
                                    'label'=>'Data Vencimento',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'fornecedor',
                                    'label'=>'Fornecedor',
                                    'rules'=>'required|trim'
                                ),
                                array(
                                    'field'=>'tipo',
                                    'label'=>'Tipo',
                                    'rules'=>'required|trim'
                                ))
                ,
                'vendas' => array(array(

                                    'field' => 'dataVenda',
                                    'label' => 'Data da Venda',
                                    'rules' => 'required|trim'
                                ),
                                array(
                                    'field'=>'clientes_id',
                                    'label'=>'clientes',
                                    'rules'=>'trim|required'
                                ),
                                array(
                                    'field'=>'usuarios_id',
                                    'label'=>'usuarios_id',
                                    'rules'=>'trim|required'
                                ))
                ,
                 'recibos' => array(array(

                                    'field' => 'dataRecibo',
                                    'label' => 'Data',
                                    'rules' => 'required|trim'
                                ),
                                  array(
                                    'field'=>'valorRecibo',
                                    'label'=>'Valor do Recibo',
                                    'rules'=>'required|trim'
                                ))
                
        );
	
			   