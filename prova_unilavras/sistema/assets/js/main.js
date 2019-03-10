function mensagens_resposta(response)
{
    var resposta = JSON.parse(response);
console.log(response);
    $.toast({
        heading:resposta['result'],
        text:resposta['mensagem'],
        showHideTransition: 'fade',
        icon:resposta['result'],
        position: 'top-right',
        hideAfter: 5000
    });
    
}

function isJSON(str)
{
    try {
        JSON.parse(str)
    }
    catch(e) {
        return false;
    }
    return true;
}
