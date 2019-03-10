
$(document).ready(function(){
get_clientes();
  $('#celular_cliente').mask('(99)99999-9999');
  $('#cep').mask('999999-999');
});

function get_clientes()
{
    $('#preload_registros').css('display', 'block');
    $.ajax({				
        
      url: "./get/get_clientes.php",
      type: "POST",
      data: $('#id_form_clientes').serialize(),
      success: function (response)
      {
        if(isJSON(response)){
            mensagens_resposta(response);
        }
        else{
            $('#preload_registros').css('display', 'none');
            $('#dados_tabela_clientes').html(response);
         }
      },
      error:function() 
      {
        // Erro com retorno da api
        $.toast({
          heading:'error',
          text:'Ops, Algo deu errado. Ocorreu um erro!',
          showHideTransition: 'fade',
          icon:'error',
          position: 'top-right',
        });   
      }    
    }); 
  
}

function get_dados_cliente(codigo_cliente) {
  $.ajax({
    url: "./get/get_dados_cliente.php",
    type: "POST",
    dataType: 'html', 
    cache: false,
    data: "codigo_cliente="+codigo_cliente,
    
    success: function(response) {
     // limpa_forms();

      var JSONArray = $.parseJSON(response);
      if (JSONArray['result'] == 'success') {
      
         
          // OBTEM O OBJETO DA SOLICITACAO
          var cliente = JSONArray['data'];

          $('#codigo').val(cliente.codigo_cliente);
          $('#nome').val(cliente.nome_cliente);
          $('#cliente_email').val(cliente.email);
          $('#celular').val(cliente.celular);
          $('#endereco').val(cliente.endereco);
          $('#celular_cliente').val(cliente.celular);
          $('#numero').val(cliente.numero);
          $('#bairro').val(cliente.bairro);
          $('#id_estado').val(cliente.id_estado);
          $('#id_cidade').html('<option value="'+ cliente.id_cidade +'">'+cliente.nome_cidade+'</option>');
          $('#cep').val(cliente.cep);
          $('#id_setor').val(cliente.id_setor);
          $('#id_curso').val(cliente.id_curso);
          $('#id_tipo_cliente').val(cliente.id_tipo_cliente);
 
       $('#modal_cliente').modal('show'); // ABRE O MODAL POPULADO
      } 
      else {
        mensagens_resposta(response);
        //$('#preload').hide();     
      }

    },
    error:function () {
     // mensagens_erro('Erro! NÃ£o foi possÃ­vel obter os dados desta noticia no momento!');
     // $('#preload').hide();
    }
  });


} // get_dados_cliente()


  /*-----------------------------------------------
	---- FUNCTION ALERT CONFIRM DELETE FOTP  ---- 
------------------------------------------------- */
function confirma_delete_cliente(codigo_cliente) {
  
  $('#modal_delete_cliente #codigo_cliente').val(codigo_cliente);
  $('#modal_delete_cliente').modal('show');

}

$('#id_modal_delete_cliente').on('submit',function(){

  event.preventDefault();
  
  $.ajax({				
      
    url: "./put/put_delete_cliente.php",
    type: "POST",
    data: $('#id_modal_delete_cliente').serialize(),
    success: function (response)
    {
      var JSONArray = $.parseJSON(response);
        
      if (JSONArray['result'] == 'success') {
      
          mensagens_resposta(response);
          $('#modal_delete_cliente').modal('hide');
          get_clientes();
      }
      
      else{
          mensagens_resposta(response);
      }

    },
    error:function() 
    {
      // Erro com retorno da api
      $.toast({
        heading:'error',
        text:'Ops, Algo deu errado. Ocorreu um erro!',
        showHideTransition: 'fade',
        icon:'error',
        position: 'top-right',
      });   
    }    
  }); 

});


// Submit modal clientes
$('#id_form_modal_cliente').on('submit',function(){

  event.preventDefault();
  
  $.ajax({				
      
    url: "./put/",
    type: "POST",
    data: $('#id_form_modal_cliente').serialize(),
    success: function (response)
    {
      var JSONArray = $.parseJSON(response);
      if (JSONArray['result'] == 'success') {

          mensagens_resposta(response);
          $('#modal_cliente').modal('hide');
          get_clientes();
      }
      else{
          mensagens_resposta(response);
      }
    },
    error:function() 
    {
      // Erro com retorno da api
      $.toast({
        heading:'error',
        text:'Ops, Algo deu errado. Ocorreu um erro!',
        showHideTransition: 'fade',
        icon:'error',
        position: 'top-right',
      });   
    }    
  }); 


});




  // Submit modal curso
  $('#id_form_curso_cliente').on('submit',function(){
  
    event.preventDefault();
    
    $.ajax({				
        
      url: "./put/put_modal_curso.php",
      type: "POST",
      data: $('#id_form_curso_cliente').serialize(),
      success: function (response)
      {
        var JSONArray = $.parseJSON(response);
  
        if (JSONArray['result'] == 'success') {
        
          mensagens_resposta(response);
  
          var Dados_JSON = JSONArray['data'];
     
          $("#id_form_curso_cliente")[0].reset();
          $('#modal_curso_cliente').modal('hide');
          $('#id_curso').append('<option value ="'+ Dados_JSON.id+'">' + Dados_JSON.nome_curso + '</option>');        
          $('#id_curso').val(Dados_JSON.id);
        }
        else{
         mensagens_resposta(response);
  
        }
  
      },
      error:function() 
      {
        // Erro com retorno da api
        $.toast({
          heading:'error',
          text:'Ops, Algo deu errado. Ocorreu um erro!',
          showHideTransition: 'fade',
          icon:'error',
          position: 'top-right',
        });   
      }    
    }); 
  
  
  });

  // Submit modal setor
$('#id_form_setor_cliente').on('submit',function(){
  
    event.preventDefault();
    
    $.ajax({				
        
      url: "./put/put_modal_setor.php",
      type: "POST",
      data: $('#id_form_setor_cliente').serialize(),
      success: function (response)
      {
        var JSONArray = $.parseJSON(response);
  
        if (JSONArray['result'] == 'success') {
        
          mensagens_resposta(response);
  
          var Dados_JSON = JSONArray['data'];
     
          $("#id_form_setor_cliente")[0].reset();
          $('#modal_setor_cliente').modal('hide');
          $('#id_setor').append('<option value ="'+ Dados_JSON.id+'">' + Dados_JSON.nome_setor + '</option>');        
          $('#id_setor').val(Dados_JSON.id);
        }
        else{
         mensagens_resposta(response);
  
        }
  
      },
      error:function() 
      {
        // Erro com retorno da api
        $.toast({
          heading:'error',
          text:'Ops, Algo deu errado. Ocorreu um erro!',
          showHideTransition: 'fade',
          icon:'error',
          position: 'top-right',
        });   
      }    
    }); 
  
  
  });
  

  // GET_CIDADES
function get_cidades(id_estado, id_cidade) {

  // LIMPA O SELECT DE CIDADES
  $('#'+ id_cidade).html('<option value="0" >Aguarde...</option>');
  
  $.ajax({
    url:"./get/get_cidades.php",

    type: "POST",
    data: "id_estado=" + $('#'+ id_estado).val(),
    success: function(response){

      var JSONArray = $.parseJSON(response);
      
      if (JSONArray['result'] == 'success') {

        var Dados_JSON = JSONArray['data'];
        
        // POPULA O SELECT DE CIDADES
        var options = '<option>Selecione a Cidade</option>';

        // console.clear();
        var i = 0;
        for (i = 0; i < Dados_JSON.length; i++) {
          options += '<option value="' + Dados_JSON[i].id + '">' + Dados_JSON[i].nome + '</option>';
          // console.log("Cidade "+i+": "+Dados_JSON[i].nome_cidade); // Nome da cidade CONSOLE
        } 
        // console.log(i + " Cidades"); // Numero de cidades CONSOLE
        
        // Repassa as cidades para o Select
        $('#'+id_cidade).html(options);
        
      } 
      else {
        mensagens_resposta(response);
      }
    },
    error:function () {
      $.toast({
        heading:'error',
        text:'Dados não encontrados. Atualize a página e tente novamente!',
        showHideTransition: 'fade',
        icon:'error',
        position: 'top-right',
    });
    }
  });
}

