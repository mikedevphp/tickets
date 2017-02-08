$(document).ready(function()   
    {
      
        $('a[iduserdel]').click(function() 
        {
 
            modalEliminarEmpleado($(this));
        });
        
        $('a[editar]').click(function() 
        {
 
           modalEditarEmpleado($(this));
        });
        
   });
        function modalEliminarEmpleado(data)
        {
            
           
            $('#modalEliminarEmpleado').find('.modal-body')
            .append('<label>¿Desea eliminar el empleado '+data.attr('empleado')+'?</label>');
    
           $('#modalEliminarEmpleado').find('.modal-body')
            .append('<input type="hidden" name="idUserEmp" value="'+data.attr('iduserdel')+'"> </input>');
            $('#modalEliminarEmpleado').find('.modal-body')
            .append('<input type="hidden" name="empleado" value="'+data.attr('empleado')+'"> </input>');
            
            $('#modalEliminarEmpleado').on('hidden', function()
            {
                $(this).find('input').remove();
                $(this).find('label').remove();
            });      
            
        }
        
        function modalEditarEmpleado(data)
        {
            
           
            $('#modalEditarEmpleado').find('#idempleado').val(data.attr('idempleado'));
            $('#modalEditarEmpleado').find('#nombreempleado').val(data.attr('nombres'));
            $('#modalEditarEmpleado').find('#apellidopatemp').val(data.attr('paterno'));
            $('#modalEditarEmpleado').find('#apellidomatemp').val(data.attr('materno'));
            $('#modalEditarEmpleado').find('#clientefracc').val(data.attr('fracc'));
            $('#modalEditarEmpleado').find('#clientecalle').val(data.attr('direccion'));
            
            $('#modalEditarEmpleado').find('#empleadociudad > option').each(function()
            { 
                if($(this).text() === data.attr('ciudad'))
                {
                    $(this).prop('selected', true);
                }
                
            });
            
            $('#modalEditarEmpleado').find('#empleadofracc').val(data.attr('fracc'));
            $('#modalEditarEmpleado').find('#empleadocalle').val(data.attr('calle'));
            $('#modalEditarEmpleado').find('#empleadotel').val(data.attr('telefono'));
            $('#modalEditarEmpleado').find('#empleadocel').val(data.attr('cel'));
            $('#modalEditarEmpleado').find('#empleadoemail').val(data.attr('email'));
            
            
               
            
        }


