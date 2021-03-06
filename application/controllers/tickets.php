<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tickets extends Private_Controller {
    
    private $dataPost = array();
    private $dataUser = array();
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('email'); 
        $this->load->library('pagination');
        
    }
    
    
    public function index()
    {
        //$action = $this->input->post('submit');  
        if(!$this->user)
        {
            redirect('welcome');
        }

            $this->load->view('head');
            
            
            if($this->user->id_perfil == 3)
            {
                @$this->dataUser['lastTicket'] = $this->tickets_model
                        ->getLastTicketCreated($this->user->id_cliente)->fecha_inicio;
                $this->dataUser['cliente'] = TRUE;
                $this->_getTickets($this->user->id_cliente);
            }
            else
            {
            	@$this->dataUser['cliente'] = FALSE;
                @$this->dataUser['lastTicket'] = $this->tickets_model->getLastTicketCreated()->fecha_inicio;
                $this->_getTickets();
            }
            $this->load->view('footer');
        
    }
    
     private function _getTickets($cliente ='')
    {
         
         
       
        if($this->input->post('filtrarTickets')=='filtrar')
        {
            // parametros para la consulta a la base de datos, filtrado
            $this->dataPost['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            if($cliente == '')
            {
                $this->dataPost['empresa'] = $this->input->post('empresas') <> -1 ? $this->input->post('empresas'): -1;
            }
            $this->dataPost['sucursal'] = $this->input->post('sucursales') == " " ||  $this->input->post('sucursales') == "nada" ? " ": $this->input->post('sucursales') ;
            $this->dataPost['ticket'] = $this->input->post('tipoticket') <> 0 ? $this->input->post('tipoticket'):0;
            $this->dataPost['status'] = $this->input->post('status') <> 0 ? $this->input->post('status'):0;
            $this->dataPost['prioridad'] = $this->input->post('prioridad') <> 0 ? $this->input->post('prioridad'):0;
           
            // sirve para que tomen valores, los inputs de la vista, despues del post
            if($cliente == '')
            {
            $this->dataUser['empresaTipo'] = $this->dataPost['empresa'];
            }
            $this->dataUser['sucursalTipo'] = $this->dataPost['sucursal'];
            $this->dataUser['ticketTipo'] = $this->dataPost['ticket'];
            $this->dataUser['statusTipo'] = $this->dataPost['status'];
            $this->dataUser['prioridadTipo'] = $this->dataPost['prioridad'];
            
             
            $config['base_url'] = base_url().'index.php/tickets/index/';
            
            if($cliente == '')
            {
                $config['total_rows'] = $this->tickets_model->getNumRowsTickets('', $this->dataPost);
            
            }
            else 
            {
                $config['total_rows'] = $this->tickets_model->getNumRowsTickets($cliente, $this->dataPost);
            }
            
            $config['per_page'] = 10;
            $config['num_links'] = 5;
            $config['full_tag_open'] = '<div id="pagtickets" class="pagination pagination-centered"><ul>';
            $config['full_tag_close'] = '</ul></div>';  
           $config['next_link'] = FALSE;
            /*$config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';*/
            $config['cur_tag_open'] = '<li class="active"><a href="'.  base_url('/index.php/tickets/index/0').'">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="page">';
            $config['num_tag_close'] = '</li>';
            
            $this->dataUser['tickets'] = ($cliente =='') 
            ? $this->tickets_model->getTickets($config['per_page'],'', $this->dataPost): 
            $this->tickets_model->getTickets($config['per_page'], $cliente, $this->dataPost);
            
           $this->dataUser['clientes'] = $this->tickets_model->getClients();
           
            if($cliente != '')
            {
                $this->dataUser['sucursales'] = $this->tickets_model->getBranchesClient($cliente);
            }
            if($cliente == '')
            {
            $this->dataUser['sucursales'] = $this->tickets_model->getBranchesClient($this->dataPost['empresa']);
            
            }
            $this->dataUser['tipo'] = $this->tickets_model->getTypeTicket();
            $this->dataUser['status'] = $this->tickets_model->getTypeStatus();
            $this->dataUser['prioridad'] = $this->tickets_model->getTypePriorities();
            
            $this->load->view('tickets/tickets_view', $this->dataUser);// contenido, y/o controles de usuario
            
        
            if(!is_null($this->dataUser['tickets']))
            {

                $this->pagination->initialize($config);
                $this->dataUser['pagination'] = $this->pagination->create_links();
                $this->load->view('tickets/ticket_buscar_view', $this->dataUser);   


             }
            else
            {
                
               $this->load->view('tickets/tickets_no_view');

            }   
                 
         }
         
        else
        {
            $this->dataPost['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            
            if($cliente == '')
            {
                $this->dataPost['empresa'] =  -1;
            }
            $this->dataPost['sucursal'] = " ";
            $this->dataPost['ticket'] = 0;
            $this->dataPost['status'] = 0;
            $this->dataPost['prioridad'] = 0;
            
            $config['base_url'] = base_url().'index.php/tickets/index/';
            
            if($cliente == '')
            {
                $config['total_rows'] = $this->tickets_model->getNumRowsTickets('', $this->dataPost);
            
            }
            else 
            {
                $config['total_rows'] = $this->tickets_model->getNumRowsTickets($cliente, $this->dataPost);
            }
            
            $config['per_page'] = 10;
            $config['num_links'] = 5;
            $config['full_tag_open'] = '<div id="pagtickets" class="pagination pagination-centered"><ul>';
            $config['full_tag_close'] = '</ul></div>';  
           $config['next_link'] = FALSE;
            /*$config['next_tag_open'] = '<li style="display:none" class="next page">';
            $config['next_tag_close'] = '</li>';*/
            $config['cur_tag_open'] = '<li class="active"><a href="'.  base_url('/index.php/tickets/index/0').'">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li class="page">';
            $config['num_tag_close'] = '</li>';
            
            if($cliente != '')
            {
                $this->dataUser['sucursales'] = $this->tickets_model->getBranchesClient($cliente);
            }
            
            $this->dataUser['tickets'] = ($cliente =='') 
            ? $this->tickets_model->getTickets($config['per_page'],'', $this->dataPost): 
            $this->tickets_model->getTickets($config['per_page'], $cliente, $this->dataPost);
            
            
            $this->dataUser['clientes'] = $this->tickets_model->getClients();
            $this->dataUser['tipo'] = $this->tickets_model->getTypeTicket();
            $this->dataUser['status'] = $this->tickets_model->getTypeStatus();
            $this->dataUser['prioridad'] = $this->tickets_model->getTypePriorities();
            $this->load->view('tickets/tickets_view', $this->dataUser);// contenido, y/o controles de usuario
            
            
            if(!is_null($this->dataUser['tickets']))
            {

                $this->pagination->initialize($config);
                $this->dataUser['pagination'] = $this->pagination->create_links();
                $this->load->view('tickets/ticket_buscar_view', $this->dataUser);   


             }
            else
            {
                
               $this->load->view('tickets/tickets_no_view');

            }
            
        }
             
            
    } 
    
    public function getTicketsAjax()
    {
        
        if($this->input->is_ajax_request())   
        {
            $tickets = null;
            // parametros para la consulta a la base de datos, filtrado
            $this->dataPost['page'] = $this->input->post('url');
            
            
                $this->dataPost['empresa'] = $this->input->post('empresa');
            
            
            $this->dataPost['sucursal'] = $this->input->post('sucursal');
            $this->dataPost['ticket'] = $this->input->post('ticket');
            $this->dataPost['status'] = $this->input->post('status');
            $this->dataPost['prioridad'] = $this->input->post('prioridad');
            
            if($this->user->id_perfil != 3)
            {
                if( $this->tickets_model->getTickets(10,'', $this->dataPost))
                {
                    require ($_SERVER['DOCUMENT_ROOT']."/application/core/Tabla.php");
                    $tickets = $this->tickets_model->getTickets(10,'', $this->dataPost);

                    $tabla = new Tabla();
                     echo $tabla->crearTabla($tickets, $this->user, null);
                }
            }
            
            if($this->user->id_perfil == 3)
            {
                if($this->tickets_model->getTickets(10, $this->user->id_cliente, $this->dataPost))
                {
                    require ($_SERVER['DOCUMENT_ROOT']."/application/core/Tabla.php");
                    $tickets = $this->tickets_model->getTickets(10, $this->user->id_cliente, $this->dataPost);

                    $tabla = new Tabla();
                     echo $tabla->crearTabla($tickets, $this->user, null);
                }
            }
           
            
        } 
    }
    
    public function lastTicketCreated()
    {
        if($this->user->id_perfil == 3)
        {
            $timeDb = date_create($this->tickets_model->getLastTicketCreated($this->user->id_cliente)->fecha_inicio);
        }
        else
        {
            $timeDb = date_create($this->tickets_model->getLastTicketCreated()->fecha_inicio);
        }
        
        
        $timeView = date_create($this->input->post('ticketLastTime'));
        
            if(!$this->_time($timeDb, $timeView))
            {
                
                $data = $this->tickets_model->getNewsticketsByDate($this->input->post('ticketLastTime'));
                $nums = (int) $this->input->post('nums');
                
                if($nums == $data)
                {
                    sleep(10);
                    echo $nums;
                }
                else
                {
                    echo $data;
                }
                
                
            }
            else
            {
                echo 0;
                
            }
            
                 
    }
    
    private function _time($timeDb, $timeView)
    {
        if($timeDb <= $timeView)
        {
            sleep(10);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
        
    }
    
    public function abrirTicket()
    {
	
        if(!$this->user )
        {
            redirect('welcome');
        }
        $action = $this->input->post('submitAbrirTicket');
        
        if($action == 'abrirTicket')
        {
            $idTicket = $this->input->post('idTicket');
            $data = array('id_ticket' => $this->input->post('idTicket'), 
                'id_empleado' => $this->input->post('idEmpleado'),
             'fecha_abierto' =>$this->input->post('fechaAbierto'));
            
            if($this->tickets_model->openticket($data) === true)
            {
                $this->session->set_flashdata('status_abierto', 
                        '<center><p class ="alert alert-success span12"><a class="close" 
                            data-dismiss="alert">x</a>Se ha abierto satisfactoriamente el ticket '.$idTicket.'.</p></center>');
                redirect('tickets', 'refresh');
            }
            
            else
            {
                $this->session->set_flashdata('status_error_abierto',
                        '<p class ="alert alert-error span5"><a class="close" 
                            data-dismiss="alert">x</a>Hubo un error con su petición,
                    favor de contactar al programador</p>');
                redirect('tickets', 'refresh');
            }
        }
        else
        {
            redirect('tickets');
        }
         
    }
    
    public function actualizarticket()
    {
	
		if(!$this->user )
		{
			redirect('welcome');
		}
		
        $action = $this->input->post('submitActualizarTicket');
        
        if($action == 'actualizarTicket')
        {
            $this->form_validation->set_rules('seguimientoNota','Detalles',
                       'trim|required|xss_clean');
            
            $this->form_validation->set_message('required', 'El campo detalles de seguimiento del ticket,
                debe agregarse información');
            
            if($this->form_validation->run() == FALSE)
            {
                    $this->session->set_flashdata('detalles_seguimiento_requerido',  
                            validation_errors('<p class ="alert alert-error span6"><a class="close" data-dismiss="alert">x</a>','</p>'));
                    redirect('tickets');
            }
            else
            {
                $idTicket = $this->input->post('idTicketSeg');
                
                $data = array('id_ticket' => $this->input->post('idTicketSeg'), 'id_empleado' => $this->input->post('idEmpleadoSeg'),
                 'fecha_seguimiento' =>$this->input->post('fechaSeguimiento'), 
                    'detalles_seguimiento' => $this->input->post('seguimientoNota'));

                if($this->tickets_model->updateticket($data) === true)
                {
                    $this->session->set_flashdata('status_seguimiento', 
                            '<center><p class ="alert alert-success span12"><a class="close" 
                            data-dismiss="alert">x</a>Se ha actualizado correctamente el seguimiento del ticket '.$idTicket.'</p></center>');
                    
                    redirect('tickets');
                }

                else
                {
                    $this->session->set_flashdata('status_error_seguimiento', 
                            '<p class ="alert alert-error span5"><a class="close" 
                            data-dismiss="alert">x</a>Hubo un error con su petición,
                        favor de contactar al programador</p>');
                    redirect('tickets');
                }
            }
        }
        else
        {
            redirect('tickets');
        }
    }

    
    // funcion que obtiene las notas de seguimiento
    public function notasSeguimientoTickets()
    {
        if($this->input->is_ajax_request())   
        {
            if($this->input->post('idticket'))
            {
               $idTicket = $this->input->post('idticket');
    
              if($this->tickets_model->getNotasSeguimiento($idTicket))
               { 
                  $notasSeguimiento = $this->tickets_model->getNotasSeguimiento($idTicket);
                   echo json_encode($notasSeguimiento);
               }   
               
            }   
         }
        else 
       {
            redirect('tickets');
       }
         
    }
    
   public function cerrarTicket()
   {  
   
		if(!$this->user )
		{
			redirect('welcome');
		}
		
       $action = $this->input->post('submitCerrarTicket');
       
       if($action == 'cerrarTicket')
       {
           $this->form_validation->set_rules('notaConclusion','Nota de conclusión',
                       'trim|required|xss_clean');
            
            $this->form_validation->set_message('required', 'Debe agregar una nota de conclusión para
                poder cerrar el ticket');
            
            if($this->form_validation->run() == FALSE)
            {
                    $this->session->set_flashdata('nota_conclusion_requerido',  
                            validation_errors('<p class ="alert alert-error span5"><a class="close" data-dismiss="alert">x</a>','</p>'));
                    redirect('tickets');
            }
            else
            {  
                $idTicket = $this->input->post('idTicketCer');
                $data = array('id_ticket' => $this->input->post('idTicketCer'), 'id_empleado' => $this->input->post('idEmpleadoCer'),
                'fecha_cerrado' =>$this->input->post('fechaCerrar'), 
                 'detalles_cerrado' => $this->input->post('notaConclusion'));
                
                if($this->tickets_model->closeticket($data) === true)
                {
                    $this->session->set_flashdata('ticket_cerrado', 
                            '<center><p class ="alert alert-success span12"><a class="close" 
                            data-dismiss="alert">x</a>Se ha cerrado exitosamente el ticket '.$idTicket.'</p><center>');
                    
                    redirect('tickets');
                }

                else
                {
                    $this->session->set_flashdata('ticket_error_cerrado', 
                            '<p class ="alert alert-error span5"><a class="close" 
                            data-dismiss="alert">x</a>Hubo un error con su petición,
                        favor de contactar al programador</p>');
                    redirect('tickets');
                }
                
                
            }
       }
   }
   
    
    public function crearTicket()
    {
        if(!$this->user)
        {
            redirect('welcome');
        }
        
            $action = $this->input->post('submit');

            if($action == "")
            {
                 // se cargo los datos del usuario
                // con la clase session para poder usarlo dentro de la aplicacion, la carga se hizo en el controlador
                //login
                if($this->user->id_perfil == 3)
                {
                    // sucursales para los clientes
                    $ticket['sucursales'] = $this->tickets_model->getBranchesClient($this->user->id_cliente);
                }

                if($this->user->id_perfil <> 3)
                {
                    // clientes para los empleados
                    $ticket['clientes'] = $this->tickets_model->getClients();
                }
                $ticket['tipoTicket'] = $this->tickets_model->getTypeTicket();
                $ticket['prioridad'] = $this->tickets_model->getTypePriorities();
                $this->load->view('head'); // head y menu
                $this->load->view('tickets/crear_tickets_view',$ticket);// contenido, y/o controles de usuario
                $this->load->view('footer');// footer

            }


            if($action == 'Crear ticket')
            {
				if($this->user->id_perfil <> 3)
				{
					$this->form_validation->set_rules('clientes', 'empresa',
                           'trim|xss_clean|is_natural_no_zero');
				}
				
				// borrar esta validacion.
                                
				$this->form_validation->set_rules('catalogo', 'tipo',
                           'trim|xss_clean|is_natural_no_zero');
				$this->form_validation->set_rules('subTicket','problema',
                           'trim|xss_clean|required');
				$this->form_validation->set_rules('observacionesTickets','Campo Descripción',
                           'trim|xss_clean|max_length[80]');

				$this->form_validation->set_message('is_natural_no_zero', 'El campo %s es requerido.');
				$this->form_validation->set_message('required', 'El campo %s es requerido.');
				$this->form_validation->set_message('max_length', 'El campo %s no debe ser mayor a 80 caracteres.');
                 if ($this->form_validation->run() === FALSE)
				{
					$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">x</a>', '</div>');
					$this->session->set_flashdata('error_validation', validation_errors());
					redirect(current_url());
				}
				else
				{
				   $timestamp = time();
				   
					
					//$idTicket= random_string('nozero',6); // creamos el id del ticket
					$fecha_inicio = date('Y/m/d H:i:s',$timestamp); // creamos la fecha en que se hizo el ticket
					
					$idCliente = $this->user->id_perfil <> 3 ? $this->input->post('clientes') 
					 : $this->user->id_cliente;
					
					$idEmpleado = $this->user->id_perfil <> 3 ?  $this->user->id_empleado : null ;
					
					$idSucursal = ($this->input->post('sucursal') <> " ") ? $this->input->post('sucursal') : null;
					
					$clienteData = $this->tickets_model->getClientInfoByTicketCreated($this->input->post('sucursal'), $idCliente);
					
					$dataTicket = array( 'id_cliente' => $idCliente,
						'id_sucursal' => $idSucursal,'id_empleado' => $idEmpleado, 
						'id_catalogo' => $this->input->post('catalogo'),'id_subcatalogo' => $this->input->post('subTicket') ,
						'id_prioridad' => $this->input->post('prioridadTicket'),
						'observaciones_tickets' => $this->input->post('observacionesTickets'), 
						'fecha_inicio' => $fecha_inicio);
					
					
					$tipoTicket = $this->tickets_model->getTypeTicketById($this->input->post('catalogo'))->tipoTicket;
					$subTipoTicket = $this->tickets_model->getSubTypeTicketById($this->input->post('subTicket'))->tipoSubTicket;
					$idTicket=$this->tickets_model->createticket($dataTicket);
					if($idTicket > 0)
					{
					
						if($this->user->id_perfil === 3)
						{
						
						
					$this->_sendMail($idTicket, $this->user->email, $tipoTicket, $subTipoTicket, $fecha_inicio, $clienteData); 
						// mandamos el correo al cliente
							//$this->_sendMail($idTicket); // mandamos al administrador
						}
						else
						{	
							$emailCliente =	$this->tickets_model->getEmailForClient($idCliente);
					$this->_sendMail($idTicket, $emailCliente->email, $tipoTicket, $subTipoTicket, $fecha_inicio, $clienteData);
						 // mandamos el correo al cliente
							//$this->_sendMail($idTicket); // mandamos al administrador
							//$this->_sendMail($idTicket, $this->user->email); // mandamos a quien creo la solicitud
							// por parte del cliente
						}
						
						$this->session->set_flashdata('correcto_ticket',
								'<center><p class ="alert alert-success">
								<a class="close" data-dismiss="alert">x</a>Se creó satisfactoriamente el ticket con el número: '.$idTicket.'</p></center>');

					  redirect('/index.php/tickets');
                                        }

					else
					{
						 $this->session->set_flashdata('incorrecto_ticket', 'No se ha registrado su ticket
							 , contacte al programador');
					  //redirect(current_url());
					}


                    }
           }
        
        
        
        
    }
    
	private function _sendMail($id_ticket, $email, $tipoTicket, $subTipoTicket, $fecha, $clienteData)
    {
		$config = array(
			        'protocol' => 'smtp',
			        'smtp_host' => 'smtp.soporte-soluciones.com.mx',
			        'smtp_port' => 25,
			        'smtp_user' => 'tickets@soporte-soluciones.com.mx',
			        'smtp_pass' => '.t1ck3ts.',
			        'mailtype'  => 'text',
			        'charset'   => 'utf-8',
			        'wordwrap'  => true            
		);

		//$this->load->library('email');
		$this->load->library('email', $config);

        $this->email->set_newline("\r\n"); 
        $this->email->from('tickets@soporte-soluciones.com.mx', 'Soporte y Soluciones');
        
                
       /* if($email == "" && $status="")
        {
            $this->email->to('ss@tecnologia-softia.com');
            $this->email->subject('Ticket '.$id_ticket.);
            $this->email->message("Se ha creado el ticket ".$id_ticket.", entrar 
                al sistema para su seguimiento");  
        }*/
        
        if($email != "" )
        {
            $message = "Se ha creado el ticket ".$id_ticket." con fecha de ".date('d/m/Y h:i A',strtotime($fecha))." con los siguientes datos: \r\n";
            $message .= "Cliente: ".$clienteData->nombreCliente.". \r\n";
            $message .= (isset($clienteData->sucursal)) ? "Sucursal: ".$clienteData->sucursal.".\r\n" : "";
            $message .= "Direccion: ".$clienteData->direccion.".\r\n";
            $message .= "Ciudad: ".$clienteData->ciudad.".\r\n";
            $message .= "Tenemos el problema del tipo: ".$tipoTicket.". \r\n";
            $message .= "Con la siguiente caracteristica: ".$subTipoTicket.". \r\n";
            $message .= "Para verificar su status puede visitar nuestra pagina de soporte: ".base_url().".";
            
            $this->email->to($email);
            $this->email->cc('ricardo.torres@soporte-soluciones.com.mx, soporteysoluciones@yahoo.com.mx');
            $this->email->subject('Creacion del Ticket '.$id_ticket);
            /*$this->email->message("Se ha creado el ticket ".$id_ticket.", para verificar su status
                puede visitar nuestra pagina de soporte: ".base_url()."");*/
                
              $this->email->message($message);  
        }
                
        if($this->email->send())
         {

             $this->session->set_flashdata('email', 'Se mando el correo');

                       redirect(current_url());
                       return true;
         }

         else
         {
             $this->session->set_flashdata('error_email',  show_error($this->email->print_debugger()));
                       redirect(current_url());
                       return false;
         };
    } 
	
    public function sucursalesEmpleado()
    {
        if($this->input->is_ajax_request())   
        {
            
            $sucursales = null;
            
            if($this->input->post('cliente'))
            {
                if($this->input->post('cliente') == -1)
                {
                    echo '<option value=" "></option>';
                }
                else 
                {
                    $sucursales = $this->tickets_model->getBranchesClient($this->input->post('cliente'));
                    $this->_sucursales($sucursales);
                
                }
            }
             
            else if ($this->input->post('clienteticket'))
            {
                
                if($this->input->post('clienteticket') == -1)
                {
                    echo '<option value=" "></option>';
                }
                else
                {
                    $sucursales = $this->tickets_model->getBranchesClient($this->input->post('clienteticket'));
                    $this->_sucursales($sucursales, false);
            
                }
            }
                       
        }  
    }
    
    private function _sucursales($sucs, $matriz=true)
    {
       if($sucs)
        {
           if($matriz == true)
           {
            ?>
             <option value=" ">Matriz - La empresa</option>
          <?php
           }
          ?>
           <?php
           
           if($matriz == false)
           {
               echo '<option value=" ">--Escoja una sucursal--</option>';
           }
            foreach($sucs->result() as $value)
            {
            ?>
                <option value="<?php echo $value->id_sucursal ?>">
                                <?php echo $value->id_sucursal ?></option>
            <?php
            }
        }

        else{
            ?>
                <option value=" ">Sin sucursales</option>
        <?php }
        
    }
    
    
    // funcion que obtiene los subcatalogos
    public function subTiposTickets()
    {
        if($this->input->is_ajax_request())   
        {
          if($this->input->post('ticket'))
           {
                $subTickets = $this->tickets_model->getSubTypeTicket($this->input->post('ticket'));
                foreach($subTickets->result() as $value)
                {
                ?>
                    <option value="<?php echo $value->id_subcatalogo ?>">
                                    <?php echo $value->descripcion ?></option>
                <?php
                }
           } 
        }
       else 
       {
            redirect('tickets/crearticket');
       }
    }
    
    

}

?>