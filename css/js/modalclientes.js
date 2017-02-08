$(document).ready(function()   
    {
      
        $('a[iduserdel]').click(function() 
        {
 
            modalEliminarCliente($(this));
        });
        
        $('a[editar]').click(function() 
        {
 
           modalEditarCliente($(this));
        });
        
   });
        function modalEliminarCliente(data)
        {
            
            $('#modalEliminarCliente').find('.modal-body')
            .append('<label>Si elimina la empresa, se eliminaran tambien todas las sucursales.</label>');
            $('#modalEliminarCliente').find('.modal-body')
            .append('<label>¿Desea eliminar la empresa '+data.attr('empresa')+'?</label>');
    
           $('#modalEliminarCliente').find('.modal-body')
            .append('<input type="hidden" name="idUser" value="'+data.attr('iduserdel')+'"> </input>');
            $('#modalEliminarCliente').find('.modal-body')
            .append('<input type="hidden" name="cliente" value="'+data.attr('empresa')+'"> </input>');
            
            $('#modalEliminarCliente').on('hidden', function()
            {
                $(this).find('input').remove();
                $(this).find('label').remove();
            });      
            
        }
        
        function modalEditarCliente(data)
        {
           
            $('#modalEditarCliente').find('#idcliente').val(data.attr('idcliente'));
            $('#modalEditarCliente').find('#clienteempresa').val(data.attr('cliente'));
            $('#modalEditarCliente').find('#clientefracc').val(data.attr('fracc'));
            $('#modalEditarCliente').find('#clientecalle').val(data.attr('direccion'));
            
            $('#modalEditarCliente').find('#clienteciudad > option').each(function()
            { 
                if($(this).text() === data.attr('ciudad'))
                {
                    $(this).prop('selected', true);
                }
                
            });
            $('#modalEditarCliente').find('#clientetel').val(data.attr('telefono'));
             $('#modalEditarCliente').find('#clientecel').val(data.attr('cel'));
            $('#modalEditarCliente').find('#clienteemail').val(data.attr('email'));
            
            
               
            
        }
        
   

