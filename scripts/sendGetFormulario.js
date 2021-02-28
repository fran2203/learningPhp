const form = document.getElementById('formulario');
const tbody = document.getElementById('table_body');

form.addEventListener('submit', e => {
    e.preventDefault();
    const valorInput = e.target.valor.value;
    if(valorInput === '') return fetchAll(); //Si se cumple la condicion, el evento termina acá
    const optionValue = e.target.Dato.value;
    fetchParams(valorInput, optionValue);
    form.reset();
})

function errorMessage(msg) {
    const errDiv = document.createElement('div');
    errDiv.classList.add('error');

    const errMsg = document.createElement('p');
    errMsg.textContent = msg;

    errDiv.append(errMsg);

    return errDiv;
}

function deleteRows() {
    while (tbody.firstChild !== null) {
        tbody.removeChild(tbody.firstChild);
    }
}

function fetchParams(valor, param) {
    fetch(`api/users.php?search=true&${param}=${valor}`)
        .then(res => res.ok ? Promise.resolve(res) : Promise.reject(res))
        .then(res => res.json())
        .then(res => {
            if(tbody.firstChild !== null){
                deleteRows();
            }
            if(document.querySelector('.error') !== null) {
                document.querySelector('.error').remove()
            }
            for (let i = 0; i < res.length; i++) {
                const row = document.createElement('tr');
                const {nombre, apellido, edad, contraseña} = res[i];
                const fragment = document.createDocumentFragment();

                const td_name = document.createElement('td');
                const td_last = document.createElement('td');
                const td_age = document.createElement('td');
                const td_pass = document.createElement('td');

                td_name.textContent = nombre;
                td_last.textContent = apellido;
                td_age.textContent = edad;
                td_pass.textContent = contraseña;

                fragment.append(td_name);
                fragment.append(td_last);
                fragment.append(td_age);
                fragment.append(td_pass);

                row.append(fragment);
                tbody.append(row);
            }
        })
        .catch(err => {
            if(document.querySelector('.error') === null) {
                form.before(errorMessage(err.statusText));
            }
        });
}

function fetchAll() {
    fetch('api/users.php')
    .then(res => res.json())
    .then(res => {
        if(res.length > 0){
            if(tbody.firstChild !== null){
                deleteRows();
            }
            if(document.querySelector('.error') !== null) {
                document.querySelector('.error').remove()
            }
            for (let i = 0; i < res.length; i++) {
                const row = document.createElement('tr');
                const {nombre, apellido, edad, contraseña} = res[i];
                const fragment = document.createDocumentFragment();

                const td_name = document.createElement('td');
                const td_last = document.createElement('td');
                const td_age = document.createElement('td');
                const td_pass = document.createElement('td');

                td_name.textContent = nombre;
                td_last.textContent = apellido;
                td_age.textContent = edad;
                td_pass.textContent = contraseña;

                fragment.append(td_name);
                fragment.append(td_last);
                fragment.append(td_age);
                fragment.append(td_pass);

                row.append(fragment);
                tbody.append(row);
            }
        } else {
            form.before(errorMessage('No hay datos en la base de datos'))
        }
    });
}