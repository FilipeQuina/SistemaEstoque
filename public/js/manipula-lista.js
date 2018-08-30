var listaDeItens = [];
var totalDaVenda = 0;
var availableTags = [];
function addlista() {

    var id = document.getElementById("id").value;
    var name = document.getElementById("name").value;
    var price = document.getElementById("price").value;
    var qtd = document.getElementById("quantity").value;

    var VTotalItem = price * qtd;
    if (name != "") {
        var tr = document.createElement("tr");
        var tdId = document.createElement("td");
        var tdName = document.createElement("td");
        var tdPrice = document.createElement("td");
        var tdQtd = document.createElement("td");
        var tdVTotalItem = document.createElement("td");
        var tdAcao = document.createElement("td");

        tdId.innerHTML = id;
        tdName.innerHTML = name;
        tdPrice.innerHTML = price;
        tdQtd.innerHTML = qtd;
        tdVTotalItem.innerHTML = VTotalItem;
        tdAcao.innerHTML = '<input type="button" class="btn btn-danger btn-sm" value="Excluir" onclick="deleteRow(this.parentNode.parentNode.rowIndex)">';

        var itens = { id: id, qtd: qtd, price: price, VTotalItem: VTotalItem, };
        var valorAtual = totalDaVenda += VTotalItem;
        document.getElementById("valorTotal").value = valorAtual;
        document.getElementById("valorTotal_input").value = valorAtual;

        tr.appendChild(tdId);
        tr.appendChild(tdName);
        tr.appendChild(tdPrice);
        tr.appendChild(tdQtd);
        tr.appendChild(tdVTotalItem);
        tr.appendChild(tdAcao);

        document.getElementById("item").appendChild(tr);
        listaDeItens.push(itens);


        document.getElementById("id").value = '';
        document.getElementById("name").value = '';
        document.getElementById("price").value = '';
    }

}
function deleteRow(i) {
    document.getElementById('tabelaDeItens').deleteRow(i);
    var valorAtual = totalDaVenda -= listaDeItens[i - 1]['price'];
    document.getElementById("valorTotal").value = valorAtual;
    document.getElementById("valorTotal_input").value = valorAtual;
    listaDeItens.splice(i - 1, 1);

    console.log(totalDaVenda);
    console.log(listaDeItens);
}