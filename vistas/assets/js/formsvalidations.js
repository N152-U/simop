
/*************************************
        Function: $(".uppercase").on("input",(e));
        Params: e - objeto que detono el evento
        Action: Cambia a mayuscula el valor del campo que detono el evento
        Return: 
  **************************************/

 $(".uppercase").on("input", (e) => {
    e.target.value = e.target.value.toUpperCase();
  });
  
  
/*************************************
        Function: simpleValidation(valor)
        Action: Cambia a mayuscula el valor del campo que detono el evento
        Return: valid - boolean 
  **************************************/


function simpleValidation(str_validate){
    let valid=false;
    if(e.target.value.test("/^[a-zA-Z_]+( [a-zA-Z0-9_]+)*/"))
    {
        valid=true;
    }
    return valid;
}


