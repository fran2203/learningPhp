const form = document.getElementById('formulario');
const tbody = document.getElementById('table_body');

form.addEventListener('submit', e => {
    e.preventDefault();

    fetch('api/get_all_users.php')
        .then(res => res.json())
        .then(res => {
            if(res.length > 0){
                if(tbody.firstChild !== null){
                    deleteRows();
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
                form.before(errorMesage('No hay datos en la base de datos'))
            }
        });
})

function errorMesage(msg) {
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