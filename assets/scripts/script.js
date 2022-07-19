var controleCampo = 1;
function adicionarCampo() {
    controleCampo++;
    console.log(controleCampo);

    document.getElementById('formulario-players').insertAdjacentHTML('beforeend', '<div class="form-group" id="campo'+ controleCampo +'"><div><input type="text" placeholder="Nome" name="nome[]" class="nome" /></div><div><input type="number" placeholder="Inic." name="inic[]" class="iniciativa" /></div><div><input type="button" value="-" name="remove" id="' + controleCampo +'" class="remover" onclick="removerCampo('+ controleCampo +')" readonly /></div></div>');
};

function removerCampo(idCampo){
    document.getElementById('campo' + idCampo).remove();
}