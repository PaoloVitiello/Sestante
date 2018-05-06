/*
  come funziona:
  - al caricamento della pagina aggiunge evento onchange a elementi con classe 'filtro-input'
  - al cambiamento dell'input i, prende l'attributo 'data-classedafiltrare' dell'elemento i
  - questo attributo è la classe che verrà filtrata (le righe, per intenderci)
  - prende anche l'attributo 'data-nodofigliodafiltrare' che è l'indice del childnode a
    cui fa riferimento quel campo input (se filtra la prima colonna, la seconda, etc etc)
  - alla fine della fase di filtraggio, se esiste un elemento con classe 'filtro-counter'
    ci scrive dentro il numero di elementi visualizzati (totale - filtrati)
*/

(function(document) {
	'use strict';

	var LightTableFilter = (function(Arr) {

		var _input;

		function _onInputEvent(e) {
			_input = e.target;
			var dafiltrare = document.getElementsByClassName(_input.getAttribute('data-classedafiltrare'));
    		        var counter = 0;
			Arr.forEach.call(dafiltrare, function(row) {
				var inputs = document.getElementsByClassName('filtro-input');
				var da_mostrare = true;
				Arr.forEach.call(inputs, function(inp) {
					var num_colonna = parseInt(inp.getAttribute('data-nodofigliodafiltrare'));
					var testo_colonna = row.childNodes[num_colonna].textContent.toLowerCase();
					var testo_filtro = inp.value.toLowerCase();
					if(testo_filtro !== "" && testo_colonna.indexOf(testo_filtro) === -1) {
						da_mostrare = false;
					}
				});
				row.style.display = da_mostrare ? 'table-row' : 'none';
			    counter = counter + (da_mostrare ? 1 : 0);
			});
		    var counter_elements = document.getElementsByClassName('filtro-counter');
		    Arr.forEach.call(counter_elements, function(e) { e.innerHTML = counter;});
		}

		return {
			init: function() {
				var inputs = document.getElementsByClassName('filtro-input');
				Arr.forEach.call(inputs, function(input) {
					input.oninput = _onInputEvent;
				});
			}
		};
	})(Array.prototype);

	document.addEventListener('readystatechange', function() {
		if (document.readyState === 'complete') {
			LightTableFilter.init();
		}
	});

})(document);

/* 
   funzione ausiliaria per il reset di tutti i campi filtro
*/

function reset_filter() {
    var inputs = document.getElementsByClassName('filtro-input');
    Array.prototype.forEach.call(inputs, function(inp) {
	if (inp.value !== "") {
	    inp.value = "";
	    var evt = document.createEvent("HTMLEvents");
	    evt.initEvent('input',false, true);
	    inp.dispatchEvent(evt);
	}
    });
}