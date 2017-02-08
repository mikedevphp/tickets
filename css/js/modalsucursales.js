$(document).ready(function()   
    {
      
        $('a[eliminarsuc]').click(function() 
        {
 
            modalEliminarSuc($(this));
        });
        
        $('a[editarsuc]').click(function() 
        {
 
           modalEditarSuc($(this));
        });
        
   });
   
   function modalEliminarSuc(data)
   {
       $('#modalEliminarSucursal').find('#idclientesuc').val(data.attr('idcliente'));
       $('#modalEliminarSucursal').find('#idsuc').val(data.attr('idsuc'));
       $('#modalEliminarSucursal').find('#empresa').val(data.attr('empresa'));
   }

    function modalEditarSuc(data)
    {
        $('#modalEditarSucursal').find('#numsucursal').val(data.attr('numsuc'));
        $('#modalEditarSucursal').find('#empresaeditar').val(data.attr('empresa'));
        $('#modalEditarSucursal').find('#idempresaeditar').val(data.attr('idcliente'));
        $('#modalEditarSucursal').find('#nomsucursal').val(data.attr('nomsuc'));
        $('#modalEditarSucursal').find('#sucursalfracc').val(data.attr('fraccsuc'));
        $('#modalEditarSucursal').find('#sucursalcalle').val(data.attr('callesuc'));
        $('#modalEditarSucursal').find('#sucursalciudad > option').each(function()
        { 
            if($(this).text() === data.attr('ciudadsuc'))
            {
                $(this).prop('selected', true);
            }

        });
        $('#modalEditarSucursal').find('#sucursaltel').val(data.attr('telsuc'));
		$('#modalEditarSucursal').find('#sucursalcel').val(data.attr('celsuc'));
        
    }

