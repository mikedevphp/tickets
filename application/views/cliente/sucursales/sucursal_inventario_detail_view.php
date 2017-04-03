<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="row-fluid">
    <div class="span10 offset1">
    <table class="table">
        <thead>
        
        <th>
            Componente
        </th>
        <th>
            Placa Activo
        </th>
        <th>
            Status
        </th>
        <th>
            Fecha
        </th>
        <th>
            Comentarios
        </th>
        </thead>
        <tbody>
            
                <?php
                foreach($rows as $row)
                {
                ?>
            <tr class="<?php echo ($row->status_mov == 'alta') ? '' : 'warning'?>">
                <td><?php echo ($row->componente != '') ? $row->componente : 'Ninguno';?></td>
                <td><?php echo $row->placa_activo;?></td>
                <td><?php echo $row->status_mov;?></td>
                <td><?php echo date('d/m/Y H:i',strtotime($row->fecha_mov));?></td>
                <td><?php echo $row->comentarios;?></td>
                </tr>
                <?php
                }
                ?>
            
        </tbody>
    </table>
        </div>
</div>

<div class="row-fluid">
    <div class="span6 offset5">
        <a class="btn btn-link" href="<?php echo base_url('index.php/inventario/sucursal') . '/' . $sucursal;?>">Regresar</a>
    </div>
</div>