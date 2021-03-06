<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tabla
 *
 * @author IFE
 */ class Tabla 
{
   
    
   public function crearTabla($tickets , $dataLogin, $pagination)
    {
       
        echo "<caption><center>Resultados</center></caption></br>";
        if($dataLogin->id_perfil == 3)
        {
            echo "<table id='tablatickets' class ='table table-bordered table-hover table-condensed'>
              <thead><tr><th>ID Ticket</th><th>Fecha de creación</th><th>Tiempo transcurrido del ticket</th><th>Estatus del ticket</th></tr></thead>".
              "<tbody>";

        }
        elseif($dataLogin->id_perfil != 3)
        {
            echo "<table id='tablatickets' class ='table table-bordered table-hover table-condensed'>
            <thead><tr><th>ID Ticket</th><th>Empresa</th><th>Fecha de creación</th><th>Tiempo transcurrido del ticket</th><th>Estatus del ticket</th></tr></thead>".
            "<tbody>";
        }

       
            foreach($tickets->result() as $row)
          {    

                switch ($row->nombre_status) 
                {
                    case 'Abierto':

                    echo  $this->row($row, $dataLogin, 'warning');
                        break;
                    
                    case 'Cerrado':

                    echo  $this->row($row, $dataLogin, 'success');
                        break;
                    case 'En progreso':

                    echo  $this->row($row, $dataLogin, 'info');
                        break;
                }
                

        }
           echo "</tbody>".
           "</table>";
           if(!is_null($pagination))
           {
                echo  $pagination;
           }
    }

   private function row($row, $dataLogin, $class)
    {
      if($dataLogin->id_perfil == 3)
      {
            return "<tr class = '".$class."'><td>".$this->detallesTicket($row, $dataLogin->id_perfil)."</td>"
                    ."<td>".date('d/m/Y h:i A',strtotime($row->fecha_inicio))."</td>"
                    ."<td>".$this->tiempo($row->fecha_inicio, $row->nombre_status, $row->fecha_cerrado)."</td>"
                    ."<td>".$this->modalTicket($row->ticket, $row->nombre_status, $dataLogin, array('empTicketAbierto' => $row->empTicketAbierto, 
                    'fecha_abierto' => $row->fecha_abierto), array('empTicketCerrado' => $row->empTicketCerrado, 
                    'fecha_cerrado' => $row->fecha_cerrado, 'detalles_cerrado' => $row->detalles_cerrado))."</td></tr>"; 
            
           
      }
      
      else if($dataLogin->id_perfil != 3)
      {
          return "<tr class = '".$class."'><td>".$this->detallesTicket($row, $dataLogin->id_perfil)."</td>"
                  ."<td>".$this->detallesEmpresa($row, $dataLogin->id_perfil)."</td>"
                  ."<td>".date('d/m/Y h:i A',strtotime($row->fecha_inicio))."</td><td>".
                   $this->tiempo($row->fecha_inicio, $row->nombre_status, $row->fecha_cerrado)."</td>"
                  ."<td>".$this->modalTicket($row->ticket, $row->nombre_status, $dataLogin, array('empTicketAbierto' => $row->empTicketAbierto, 
                  'fecha_abierto' => $row->fecha_abierto), array('empTicketCerrado' => $row->empTicketCerrado, 
                   'fecha_cerrado' => $row->fecha_cerrado, 'detalles_cerrado' => $row->detalles_cerrado))."</td></tr>"; 
          
          
      }
    }

   private function formatFecha($fechaString)
    {
        $fechaFinal = '';
        $horaFecha= explode(' ', $fechaString);
        $fechaArray = explode('-', $horaFecha[0]);     
        $fecha = $fechaArray[2].'-'.$fechaArray[1].'-'.$fechaArray[0];      
        $fechaFinal = $fecha.' '.$horaFecha[1];

        return $fechaFinal;
    }
    
    private function detallesEmpresa($row, $perfil)
    {
        if($perfil != 3)
        {
            if(is_null($row->nomEmpTicket) && is_null($row->sucursal))
            {
                return "<a href= '#' detallesempresa3=''
                          data-dir = '".$row->dirCliente."' data-ciudad = '".$row->ciudad_cliente."'
                          data-colonia = '".$row->coloniaCliente."' data-cel = '".$row->celCliente."'
                          data-tel ='".$row->telCliente."' data-email = '".$row->emailCliente."'
                          >"
                          .$row->nomCliente."</a>" ;
            }

            else if(!is_null($row->nomEmpTicket) && is_null($row->sucursal))
            {
                return "<a href= '#' detallesempresa1='' data-dir = '".$row->dirCliente."' data-ciudad = '".$row->ciudad_cliente."'
                          data-colonia = '".$row->coloniaCliente."' data-cel = '".$row->celCliente."'
                          data-tel ='".$row->telCliente."' data-email = '".$row->emailCliente."'>"
                        .$row->nomCliente."</a>" ;
            }

            else if(is_null($row->nomEmpTicket) && !is_null($row->sucursal))
             {
                 return "<a href= '#' detallesempresa2='' data-sucursal = '".$row->sucursal."'
                   data-nomsuc='".$row->nombre_sucursal."'  data-ciudad = '".$row->ciudadSuc."'
                   data-colonia ='".$row->coloniaSuc."' data-cel = '".$row->celSuc."'
                  data-telsuc = '".$row->telSucursal."' data-dirsuc = '".$row->dirSuc."'>
                    ".$row->nomCliente."</a>" ;
             }
                
            else if(!is_null($row->sucursal) && !is_null($row->nomEmpTicket))
            {
                return "<a href= '#' detallesempresa='' data-sucursal = '".$row->sucursal."'
                   data-nomsuc='".$row->nombre_sucursal."'  data-ciudad = '".$row->ciudadSuc."'
                   data-colonia ='".$row->coloniaSuc."' data-cel = '".$row->celSuc."'
                  data-telsuc = '".$row->telSucursal."' data-dirsuc = '".$row->dirSuc."'>".$row->nomCliente."</a>" ;
            }
            
            
        }
    }

   private function detallesTicket($row, $perfil)
    {
       if($perfil != 3)
       {
            if(is_null($row->nomEmpTicket) && is_null($row->sucursal))
            {
                return "<a href= '#' detallesempleado3='' data-cliente ='".$row->nomCliente."'
                          data-dir = '".$row->dirCliente."'
                          data-tel ='".$row->telCliente."' data-email = '".$row->emailCliente."'
                          data-catalogo = '".$row->nombre_catalogo."' data-desc ='".$row->descripcion."' 
                          data-prio ='".$row->nombre_prioridad."' data-obs ='".$row->observaciones_tickets."'>"
                          .$row->ticket."</a>" ;
            }

            else if(!is_null($row->nomEmpTicket) && is_null($row->sucursal))
            {
                return "<a href= '#' detallesempleado1='' data-cliente ='".$row->nomCliente."'
                        data-dir = '".$row->dirCliente."' 
                        data-emp = '".$row->nomEmpTicket.' '.$row->apellido1emp.' '.$row->apellido2emp."'
                        data-tel ='".$row->telCliente."' data-email = '".$row->emailCliente."'
                        data-catalogo = '".$row->nombre_catalogo."' data-desc ='".$row->descripcion."' 
                        data-prio ='".$row->nombre_prioridad."' data-obs ='".$row->observaciones_tickets."'>"
                        .$row->ticket."</a>" ;
            }

            else if(is_null($row->nomEmpTicket) && !is_null($row->sucursal))
             {
                 return "<a href= '#' detallesempleado2='' data-cliente='".$row->nomCliente."'
                         data-sucursal = '".$row->sucursal."'
                  data-telsuc = '".$row->telSucursal."' data-dirsuc = '".$row->dirSuc."'
                 data-catalogo = '".$row->nombre_catalogo."' data-desc ='".$row->descripcion."'
                 data-prio ='".$row->nombre_prioridad."' data-obs ='".$row->observaciones_tickets."'>".$row->ticket."</a>" ;
             }
                
            else if(!is_null($row->sucursal) && !is_null($row->nomEmpTicket))
            {
                return "<a href= '#' detallesempleado='' data-emp = '".$row->nomEmpTicket.' '.$row->apellido1emp.' '.$row->apellido2emp."'      
               data-cliente ='".$row->nomCliente."' data-sucursal = '".$row->sucursal."' data-telsuc = '".$row->telSucursal."' data-dirsuc = '".$row->dirSuc."'
                 data-catalogo = '".$row->nombre_catalogo."' data-desc ='".$row->descripcion."'
                data-prio ='".$row->nombre_prioridad."' data-obs ='".$row->observaciones_tickets."'>".$row->ticket."</a>" ;
            }
            
            
       }
       
        if($perfil == 3) 
       {
            if(is_null($row->nomEmpTicket) && is_null($row->sucursal))
            {
                return "<a href= '#' detallesclientes=''   
                      data-catalogo = '".$row->nombre_catalogo."' data-desc ='".$row->descripcion."'
                      data-prio ='".$row->nombre_prioridad."' data-obs ='".$row->observaciones_tickets."'>".$row->ticket."</a>";
            }
            
            else if(!is_null($row->nomEmpTicket) && is_null($row->sucursal))
            {
                return "<a href= '#' detallesclientes1='' data-emp = '".$row->nomEmpTicket.' '.$row->apellido1emp.' '.$row->apellido2emp."'         
                      data-catalogo = '".$row->nombre_catalogo."' data-desc ='".$row->descripcion."'
                      data-prio ='".$row->nombre_prioridad."' data-obs ='".$row->observaciones_tickets."'>".$row->ticket."</a>" ;
            }
            
            else if(is_null($row->nomEmpTicket) && !is_null($row->sucursal))
            {
                return "<a href= '#' detallesclientes2=''   
                      data-sucursal = '".$row->sucursal."'
                      data-catalogo = '".$row->nombre_catalogo."' data-desc ='".$row->descripcion."'
                      data-prio ='".$row->nombre_prioridad."' data-obs ='".$row->observaciones_tickets."'>".$row->ticket."</a>" ;
            }
            
            else if(!is_null($row->nomEmpTicket) && !is_null($row->sucursal))
            {
                return "<a href= '#' detallesclientes3='' data-emp = '".$row->nomEmpTicket.' '.$row->apellido1emp.' '.$row->apellido2emp."'  
                      data-sucursal = '".$row->sucursal."'
                      data-catalogo = '".$row->nombre_catalogo."' data-desc ='".$row->descripcion."'
                      data-prio ='".$row->nombre_prioridad."' data-obs ='".$row->observaciones_tickets."'>".$row->ticket."</a>" ;
            }
       }
    }

   private function modalTicket($idTicket, $status, $dataUser, $dataProgreso = null, $dataCerrado=null)
    {
        if($dataUser->id_perfil != 3)
        {        
            switch ($status) 
            {
                case 'Abierto':

                    return '<a href="#myModalAbrir" data-toggle="modal" 
                        data-Aseguimiento="¿La información anterior es correcta?" tooltipemp ="" 
                        title="Ticket abierto"  data-idticket="'.$idTicket.'" data-user = "'.$dataUser->nombre_usuario.'"
                        data-idempleado = "'.$dataUser->id_empleado.'"
                        data-iduser ="'.$dataUser->idUser.'" > 
                        <i class="icon-folder-close"></i></a>' ;// comillas simples para funciones jquery evento onclick
                        break;

                case 'En progreso':

                    return "<a href = '#segConfirmModal' data-toggle ='modal' 
                        data-accion='' data-idticket='".$idTicket."' tooltipemp =''
                        data-iduser='".$dataUser->idUser."' data-idempleado = '".$dataUser->id_empleado."'
                        data-user = '".$dataUser->nombre_usuario."' data-empticketabierto ='".$dataProgreso['empTicketAbierto']."'
                        data-fechaabierto ='".$dataProgreso['fecha_abierto']."'title='Ticket en progreso'> 
                        <i  class='icon-folder-open'></i></a>";

                    break;

                case 'Cerrado':

                    return "<a  href= '#ticketCerradoModal' data-cerrado ='' data-toggle='modal'
                             tooltipemp ='' data-empticketcerrado ='".$dataCerrado['empTicketCerrado']."' 
                            data-fechacerrado ='".$dataCerrado['fecha_cerrado']."' data-user = '".$dataUser->nombre_usuario."'
                            data-detallescerrado = '".$dataCerrado['detalles_cerrado']."' 
                            data-idticket = '".$idTicket."' title = 'Ticket cerrado'> 
                            <i  class='icon-lock'></i></a>";

                    break;

            }
        }

        else
        {
            switch ($status)
            {
                case 'Abierto':

                    return "<a style = visibility:hidden href= '#' tooltipopen =''> 
                        <i style = visibility:visible class='icon-folder-close'></i>Creado</a>" ;// comillas simples para funciones jquery evento onclick
                        break;

                case 'En progreso':

                    return "<a style = visibility:hidden href= '#' comments='' tooltipcomments ='' data-empticketabierto ='".$dataProgreso['empTicketAbierto']."'
                        data-fechaabierto ='".$dataProgreso['fecha_abierto']."' data-idticket= '".$idTicket."'
                       > 
                        <i style = visibility:visible class='icon-folder-open'></i>Abierto</a>";

                    case 'Cerrado':

                    return "<a style = visibility:hidden href= '#ticketCerradoModal' data-cerrado =''data-toggle='modal'
                            tooltipclose ='' data-empticketcerrado ='".$dataCerrado['empTicketCerrado']."' 
                            data-fechacerrado ='".$dataCerrado['fecha_cerrado']."' data-user = '".$dataUser->nombre_usuario."'
                            data-detallescerrado = '".$dataCerrado['detalles_cerrado']."' 
                            data-idticket = '".$idTicket."'> 
                            <i style = visibility:visible class='icon-lock'></i>Cerrado</a>";

                    break;
            }
        }


     }


    private function tiempo($timeStringInicio, $status='', $timeStringFinal='')
    {
        if($status != 'Cerrado')
        {
            $tiempo_actual = time(); //tomamos el tiempo actual
            $tiempo = strtotime($timeStringInicio);//convertimos el string en formato timestamps
            $total_stamp = $tiempo_actual - $tiempo; // sacamos la diferencia entre la hora actual
            // y la hora registrada en la base de datos
            $dias_ = $total_stamp/(60*60*24);
            $dias = $dias_;
            settype($dias, 'integer'); // tenemos lo dias sin el punto decimal, 
            $horas_decimal =  $dias_ - $dias; // el residuo de la operacion, son las horas en integer
            $horas_ = $horas_decimal*24;
            $horas = $horas_;
            settype($horas, 'integer'); // sacamos las horas
            $minutos_decimal = $horas_ - $horas;
            $minutos_ = $minutos_decimal*60;
            settype($minutos_, 'integer'); // sacamos lo minutos

            if($dias == 0 && $horas ==0)
            {
                return $minutos_ ." "."mins";
            }

            if($dias != 0 && $horas ==0)
            {
                return $dias." "."dias"." ". $minutos_ ." "."mins";
            }

            if($dias == 0)
            {
                return $horas ." "."hrs"." ". $minutos_ ." "."mins";
            }



            return $dias." "."dias"." ". $horas ." "."hrs"." ". $minutos_ ." "."mins";
        }

        if($status =='Cerrado' && $timeStringFinal != '') // para los tickets cerrados, deja de contar el tiempo
        {
            $tiempoInicio =  strtotime($timeStringInicio);
            $tiempoFinal = strtotime($timeStringFinal);
            $tiempo = $tiempoFinal - $tiempoInicio;
            $dias_ = $tiempo/(60*60*24);
            $dias = $dias_;
            settype($dias, 'integer'); // tenemos lo dias sin el punto decimal, 
            $horas_decimal =  $dias_ - $dias; // el residuo de la operacion, son las horas en integer
            $horas_ = $horas_decimal*24;
            $horas = $horas_;
            settype($horas, 'integer'); // sacamos las horas
            $minutos_decimal = $horas_ - $horas;
            $minutos_ = $minutos_decimal*60;
            settype($minutos_, 'integer'); // sacamos lo minutos

            return $dias." "."dias"." ". $horas ." "."hrs"." ". $minutos_ ." "."mins";
        }
    }
}

?>
