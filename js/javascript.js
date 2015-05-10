function carregarCidades(idCidade, chaveEstado, arquivoPHP, idCidadeSelecionada){
	$('#'+idCidade).html('<option value="">Carregando cidades...</option>');
	
	$.ajax({
		url: arquivoPHP,
		type: "POST",
		dataType: "text",
		data: {
			"id_estado":chaveEstado
		},
		success: function(resposta){
			var retorno = resposta;
			var cidades = eval(retorno);
			 
			$('#'+idCidade).html('');
			for(var count = 0; count < cidades.length; count++){
				var selected = '';
				if(idCidadeSelecionada != '' && idCidadeSelecionada == cidades[count].idCidade){
					selected = 'selected="selected"';
				}
				$('#'+idCidade).append('<option value="'+cidades[count].idCidade+'" '+selected+'>'+cidades[count].nomeCidade+'</option>');
			}
		}
	});
}