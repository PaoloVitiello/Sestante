/*
  come funziona:
  - al caricamento della pagina aggiunge evento onclick a elementi con classe 'ordinatori'
  - al click sull'elemento prende l'attributo 'data-class2order'
  - questo attributo è la classe che verrà ordinata (le righe, per intenderci)
  - prende anche l'attributo 'data-child2order' che è l'indice del childnode a
    cui fa riferimento quell'ordinatore (se ordina la prima colonna, la seconda, etc etc)
  - all'ordinatore di puo' aggiungere l'attributo opzionale data-ordertype ('num' o 'alfa')
    per specificare come interpretare la colonna, se numericamente o alfanumericamente
  - a runtime, all'ordinatore viene anche aggiunto l'attributo 'data-orderdirection' per
    mantenere in memoria la direzione di ordinamento (ascendente o discendente)
  - al click successivo, la direzione di ordinamento viene invertita (1, -1, 1, -1, etc etc)
*/

document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
	ordina_init();
    }
});


function ordina_init() {
    var ordinatori = document.getElementsByClassName('ordinatori');
    Array.prototype.forEach.call(ordinatori, function(ordinatore) {
	ordinatore.onclick = function(event) {
	    var _ordinatore = event.target;
	    var classe_da_ordinare = _ordinatore.getAttribute('data-class2order');
	    var nodo_figlio = _ordinatore.getAttribute('data-child2order');
	    if (_ordinatore.hasAttribute('data-ordertype')) {
		var tipo_ordinamento = _ordinatore.getAttribute('data-ordertype');
	    } else {
		var tipo_ordinamento = 'alfa';
	    }
	    if (_ordinatore.hasAttribute('data-orderdirection')) {
		var direzione = _ordinatore.getAttribute('data-orderdirection');
	    } else {
		var direzione = 1;
	    };
	    ordina(classe_da_ordinare, nodo_figlio, tipo_ordinamento, direzione);
	    direzione = direzione * -1;
	    _ordinatore.setAttribute('data-orderdirection', direzione);
	};
    });
}

function ordina(classe, child_node_index, order_type, order_direction) {
    var cni = child_node_index;
    var elementi_da_ordinare = document.getElementsByClassName(classe);
    var array_elementi = Array.prototype.slice.call(elementi_da_ordinare, 0);
    array_elementi.sort(function (a,b) {
	if (order_direction == 1) {
	    var aa = a;
	    var bb = b;
	} else {
	    var aa = b;
	    var bb = a;
	}
	if(order_type.toLowerCase() === 'num' || order_type.toLowerCase() === 'numeric') {
	    return aa.childNodes[cni].textContent - bb.childNodes[cni].textContent;
	} else {
	    return aa.childNodes[cni].textContent.localeCompare(bb.childNodes[cni].textContent);
	}
    });
    var parent = elementi_da_ordinare[0].parentNode;
    parent.innerHTML = "";
    Array.prototype.forEach.call(array_elementi, function(el) {
	parent.appendChild(el);
    });
}