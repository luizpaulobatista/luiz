
$(document).ready(function(){
  $('#celular_cliente').mask('(99)99999-9999');
  $('#cep').mask('999999-999');
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
  

// Submit modal setor
$('#id_form_setor').on('submit',function(){
  
  event.preventDefault();
  
  $.ajax({				
      
    url: "./put/put_modal_setor.php",
    type: "POST",
    data: $('#id_form_setor').serialize(),
    success: function (response)
    {
      var JSONArray = $.parseJSON(response);

      if (JSONArray['result'] == 'success') {
      
        mensagens_resposta(response);

        var Dados_JSON = JSONArray['data'];
   
        $("#id_form_setor")[0].reset();
        $('#modal_setor').modal('hide');
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


// Submit modal curso
$('#id_form_curso').on('submit',function(){
  
  event.preventDefault();
  
  $.ajax({				
      
    url: "./put/put_modal_curso.php",
    type: "POST",
    data: $('#id_form_curso').serialize(),
    success: function (response)
    {
      var JSONArray = $.parseJSON(response);

      if (JSONArray['result'] == 'success') {
      
        mensagens_resposta(response);

        var Dados_JSON = JSONArray['data'];
   
        $("#id_form_curso")[0].reset();
        $('#modal_curso').modal('hide');
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

// Submit modal curso
$('#id_form_solicitacao').on('submit',function(){
  
  event.preventDefault();

  $('#preload').css('display', 'block');
  
  $.ajax({				
      
    url: "./put/",
    type: "POST",
    data: $('#id_form_solicitacao').serialize(),
    success: function (response)
    {

      var JSONArray = $.parseJSON(response);

      if (JSONArray['result'] == 'success') {
        
        $('#preload').css('display', 'none');
        mensagens_resposta(response);
        $('#id_form_solicitacao')[0].reset();
      }
      else {
        $('#preload').css('display', 'none');
        mensagens_resposta(response);
      }

    },
    error:function() 
    {
      $('#preload').css('display', 'none');
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

function popula_cliente(codigo)
{

  $.ajax({
    url:"./get/get_dados_cliente.php",

    type: "POST",
    data: "codigo_cliente=" + $('#'+ codigo).val(),
    success: function(response){

      var JSONArray = $.parseJSON(response);
      
      if (JSONArray['result'] == 'success') {

        var Dados_JSON = JSONArray['data'];
       $('#nome').val(Dados_JSON.nome_cliente);
       $('#cliente_email').val(Dados_JSON.email);
       $('#celular').val(Dados_JSON.celular);
       $('#endereco').val(Dados_JSON.endereco);
       $('#celular_cliente').val(Dados_JSON.celular);
       $('#numero').val(Dados_JSON.numero);
       $('#bairro').val(Dados_JSON.bairro);
       $('#id_estado').val(Dados_JSON.id_estado);
       $('#id_cidade').html('<option value="'+ Dados_JSON.id_cidade +'">'+Dados_JSON.nome_cidade+'</option>');
       $('#cep').val(Dados_JSON.cep);
       $('#id_setor').val(Dados_JSON.id_setor);
       $('#id_curso').val(Dados_JSON.id_curso);
       $('#id_tipo_cliente').val(Dados_JSON.id_tipo_cliente);

        
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
