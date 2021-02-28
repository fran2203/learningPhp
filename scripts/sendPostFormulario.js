const postForm = document.getElementById('post_form');

postForm.addEventListener('submit', e => {
    e.preventDefault();
    const {nombre, apellido, edad, password} = e.target;
    //Eliminar errorMsg o okMsg si los hay
    if(document.querySelector('.error') !== null) document.querySelector('.error').remove();
    if(document.querySelector('.ok') !== null) document.querySelector('.ok').remove();

    if (comprobarDatos(nombre, apellido, edad, password)){
        const form = new FormData();

        form.append('nombre', nombre.value);
        form.append('apellido', apellido.value);
        form.append('edad', edad.value);
        form.append('password', password.value);

        fetch('api/post_user.php', {
            method: 'POST',
            body: form,
        })
        .then(res => res.ok ? Promise.resolve(res) : Promise.reject(res))
        .then(res => res.json())
        .then(res => {
            postForm.before(okMessage(res.message));
        })
        .catch(err => postForm.before(errorMessage(err)));
    } else {
        postForm.before(errorMessage('Hubo un error al ingresar los datos.'));
    }

    postForm.reset();
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

function errorMessage(msg) {
    const errDiv = document.createElement('div');
    errDiv.classList.add('error');

    const errMsg = document.createElement('p');
    errMsg.textContent = msg;

    errDiv.append(errMsg);

    return errDiv;
}

function okMessage(msg){
    const okDiv = document.createElement('div');
    okDiv.classList.add('ok');

    const okMsg = document.createElement('p');
    okMsg.textContent = msg;

    okDiv.append(okMsg);

    return okDiv;
}