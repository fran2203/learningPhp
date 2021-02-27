const postForm = document.getElementById('post_form');

postForm.addEventListener('submit', e => {
    e.preventDefault();
    const {nombre, apellido, edad, password} = e.target;
    
    if (comprobarDatos(nombre, apellido, edad, password)){
        const form = new FormData();

        form.append('nombre', nombre.value);
        form.append('apellido', apellido.value);
        form.append('edad', edad.value);
        form.append('password', password.value);

        console.log(form);
    } else {
        console.log('Debe llenar todos los datos');
    }
})

function comprobarDatos(nombre, apellido, edad, password){
    const nVal = nombre.value;
    const apVal = apellido.value;
    const edVal = edad.value;
    const paVal = password.value;


    let firstComp = false;
    let secondComp = false;

    if (nVal !== '' && apVal !== '' && edVal !== '' && paVal !== '') firstComp = true;
    secondComp = convertToNumber(nVal, apVal, edVal, paVal);

    return firstComp && secondComp;
}

function convertToNumber(name, lastName, age, pass){
    const numName = Number(name);
    const numLast = Number(lastName);
    const numAge = Number(age);
    const numPass = Number(pass);

    if(isNaN(numAge) === false && isNaN(numName) && isNaN(numLast) && isNaN(numPass)){
        return true;
    }
    return false;
}