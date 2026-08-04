const select = document.getElementById("selecionarFiltro");

const filtroData = document.getElementById("filtroData");
const filtroStatus = document.getElementById("filtroStatus");
const filtroEntreData = document.getElementById("filtroEntreData");
const dataInicio = document.getElementById("txDataPrimeira");
const dataFim = document.getElementById("txDataSegunda");



function atualizarFiltros(){

    // Esconde tudo
    filtroData.style.display = "none";
    filtroStatus.style.display = "none";
    filtroEntreData.style.display = "none";

    // Mostra apenas o filtro escolhido
    if (select.value === "data") {
        filtroData.style.display = "block";
    }

    if (select.value === "status") {
        filtroStatus.style.display = "block";
    }

    if (select.value === "entreData") {
        filtroEntreData.style.display = "block";
    }
}
    select.addEventListener("change", atualizarFiltros);

// Executa quando a página carregar
    atualizarFiltros();

dataFim.addEventListener("change", function(){

    dataInicio.max = this.value;

});


dataInicio.addEventListener("change", function(){

    dataFim.min = this.value;

});