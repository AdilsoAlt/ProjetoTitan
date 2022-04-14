function excluir(id) {
    $.ajax({
        type: 'post',
        data: {
            "id": id
        },
        success:function(){
            alert("Excluido com sucesso");
            location.reload();
        }
    })
};

function editar(id){
    $.ajax({
        type: 'post',
        data: {
            "id":id
        },
        url:'./modalEditar.php',
        success: function(resposta){
            $("#modalContent").html(resposta);
        }
    })
};

/*
function 
var selectCor = document.getElementById("buscaCor");
selectCor.onchange(()=>{
    document.getElementById("formCor").submit();
});
*/