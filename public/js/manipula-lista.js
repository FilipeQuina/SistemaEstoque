var listaDeItens = [];
var totalDaVenda = 0;
var availableTags = [];

var qtd = document.getElementById("quantity").value;

function addlista() {
    var id = document.getElementById("id").value;
    var name = document.getElementById("name").value;
    var price = document.getElementById("price").value;
    qtd = document.getElementById("quantity").value;
    var amntStock = document.getElementById("amntStock").value;

    var VTotalItem = price * qtd;

    if (name != "" && qtd != "") {
        var tr = document.createElement("tr");
        var tdId = document.createElement("td");
        var tdName = document.createElement("td");
        var tdPrice = document.createElement("td");
        var tdQtd = document.createElement("td");
        var tdVTotalItem = document.createElement("td");
        var tdAcao = document.createElement("td");
        if(amntStock >= 0+qtd){
        tdId.innerHTML = id;
        tdName.innerHTML = name;
        tdPrice.innerHTML = price;
        tdQtd.innerHTML = qtd;
        tdVTotalItem.innerHTML = VTotalItem;
        tdAcao.innerHTML = '<input type="button" class="btn btn-danger btn-sm" value="Excluir" onclick="deleteRow(this.parentNode.parentNode.rowIndex)">';

        var itens = { id: id, name: name, qtd: qtd, price: price, VTotalItem: VTotalItem };

        totalDaVenda += VTotalItem;
        document.getElementById("valorTotal").value = totalDaVenda;
        document.getElementById("valorTotal_input").value = totalDaVenda;

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
        document.getElementById("quantity").value = '';
        document.getElementById("amntStock").value = '';
        }
        else{
            alert("Produto sem estoque");
        }
    }
   

}
function deleteRow(i) {
    document.getElementById('tabelaDeItens').deleteRow(i);
    totalDaVenda -= listaDeItens[i - 1]['VTotalItem'];
    document.getElementById("valorTotal").value = totalDaVenda;
    document.getElementById("valorTotal_input").value = totalDaVenda;
    listaDeItens.splice(i - 1, 1);
}
function printar(){
    window.print();
}