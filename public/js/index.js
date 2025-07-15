class ValidacoesIndex{
  constructor(){
    this.validarTelefone();
  }

  validarTelefone(){
    const telefoneInput = document.getElementById('telefone');
    
    telefoneInput.addEventListener('input', function (e) {
      let value = e.target.value.replace(/\D/g, '');
    
      if (value.length > 11) value = value.slice(0, 11);
    
      if (value.length > 6) {
        value = value.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
      } else if (value.length > 2) {
        value = value.replace(/(\d{2})(\d{0,5})/, '($1) $2');
      } else {
        value = value.replace(/(\d{0,2})/, '($1');
      }
    
      e.target.value = value;
    });
  }

}

document.addEventListener('DOMContentLoaded', function () {
  new ValidacoesIndex();
});