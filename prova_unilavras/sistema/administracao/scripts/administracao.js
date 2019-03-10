
$(document).ready(function(){
    get_solicitacoes();
    $('#celular_cliente').mask('(99)99999-9999');
    $('#cep').mask('999999-999');
});

function get_dados_solicitacao(id_solicitacao) {
    $.ajax({
      url: "./get/get_dados_solicitacao.php",
      type: "POST",
      dataType: 'html', 
      cache: false,
      data: "id_solicitacao="+id_solicitacao,
      
      success: function(response) {
       // limpa_forms();

        var JSONArray = $.parseJSON(response);
        if (JSONArray['result'] == 'success') {
        
           
            // OBTEM O OBJETO DA SOLICITACAO
            var solicitacao = JSONArray['data'];

            $('#codigo').val(solicitacao.codigo_cliente);
            $('#nome').val(solicitacao.nome_cliente);
            $('#cliente_email').val(solicitacao.email);
            $('#celular').val(solicitacao.celular);
            $('#endereco').val(solicitacao.endereco);
            $('#celular_cliente').val(solicitacao.celular);
            $('#numero').val(solicitacao.numero);
            $('#bairro').val(solicitacao.bairro);
            $('#id_estado').val(solicitacao.id_estado);
            $('#id_cidade').html('<option value="'+ solicitacao.id_cidade +'">'+solicitacao.nome_cidade+'</option>');
            $('#cep').val(solicitacao.cep);
            $('#id_setor').val(solicitacao.id_setor);
            $('#id_curso').val(solicitacao.id_curso);
            $('#id_tipo_cliente').val(solicitacao.id_tipo_cliente);
            $('#descricao_solicitacao').val(solicitacao.descricao_servico);
   
         $('#modal_solicitacao').modal('show'); // ABRE O MODAL POPULADO
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
  
  
  } // get_dados_solicitacao()
  

  // Submit modal solicitacao
$('#id_form_modal_solicitacao').on('submit',function(){
  
    event.preventDefault();
    
    $.ajax({				
        
      url: "./put/",
      type: "POST",
      data: $('#id_form_modal_solicitacao').serialize(),
      success: function (response)
      {
        var JSONArray = $.parseJSON(response);
        if (JSONArray['result'] == 'success') {

            mensagens_resposta(response);
            $('#modal_solicitacao').modal('hide');
            get_solicitacoes();
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
$('#id_form_curso_adm').on('submit',function(){
  
    event.preventDefault();
    
    $.ajax({				
        
      url: "./put/put_modal_curso.php",
      type: "POST",
      data: $('#id_form_curso_adm').serialize(),
      success: function (response)
      {
        var JSONArray = $.parseJSON(response);
  
        if (JSONArray['result'] == 'success') {
        
          mensagens_resposta(response);
  
          var Dados_JSON = JSONArray['data'];
     
          $("#id_form_curso_adm")[0].reset();
          $('#modal_curso_adm').modal('hide');
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
$('#id_form_setor_adm').on('submit',function(){
  
    event.preventDefault();
    
    $.ajax({				
        
      url: "./put/put_modal_setor.php",
      type: "POST",
      data: $('#id_form_setor_adm').serialize(),
      success: function (response)
      {
        var JSONArray = $.parseJSON(response);
  
        if (JSONArray['result'] == 'success') {
        
          mensagens_resposta(response);
  
          var Dados_JSON = JSONArray['data'];
     
          $("#id_form_setor_adm")[0].reset();
          $('#modal_setor_adm').modal('hide');
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
  

  /*-----------------------------------------------
	---- FUNCTION ALERT CONFIRM DELETE FOTP  ---- 
------------------------------------------------- */
function confirma_delete_solicitacao(id_solicitacao) {
  
    $('#modal_delete_solicitacao #id_solicitacao').val(id_solicitacao);
    $('#modal_delete_solicitacao').modal('show');

  }
  
$('#id_modal_delete_solicitacao').on('submit',function(){

    event.preventDefault();
    
    $.ajax({				
        
      url: "./put/put_delete_solicitacao.php",
      type: "POST",
      data: $('#id_modal_delete_solicitacao').serialize(),
      success: function (response)
      {
        var JSONArray = $.parseJSON(response);
          
        if (JSONArray['result'] == 'success') {
        
            mensagens_resposta(response);
            $('#modal_delete_solicitacao').modal('hide');
            get_solicitacoes();
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

function get_solicitacoes()
{
    $('#preload_registros').css('display', 'block');
    $.ajax({				
        
      url: "./get/get_solicitacoes.php",
      type: "POST",
      data: $('#id_form_curso_adm').serialize(),
      success: function (response)
      {
        if(isJSON(response)){
            mensagens_resposta(response);
        }
        else{
            $('#preload_registros').css('display', 'none');
            $('#dados_tabela_solicitacoes').html(response);
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
  
  