const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const btnBuscar = document.getElementById('btnBuscar');
const btnCancelar = document.getElementById('btnCancelar');
const btnLimpiar = document.getElementById('btnLimpiar');
const tablaClientes = document.getElementById('tablaClientes');
const formulario = document.querySelector('form');

btnModificar.parentElement.style.display = 'none';
btnCancelar.parentElement.style.display = 'none';

const getClientes = async (alerta = 'si') => {
    const nombre = formulario.cli_nombre.value.trim();
    const apellido = formulario.cli_apellido.value.trim();
    const telefono = formulario.cli_telefono.value.trim();
    const email = formulario.cli_email.value.trim();
    console.log(nombre, apellido, telefono, email);
    
    const url = `/libreria_crudjs/controladores/clientes/index.php?cli_nombre=${nombre}&cli_apellido=${apellido}&cli_telefono=${telefono}&cli_email=${email}`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data);

        tablaClientes.tBodies[0].innerHTML = '';
        const fragment = document.createDocumentFragment();
        let contador = 1;

        if (respuesta.status === 200) {
            if(alerta === 'si'){
                Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "success",
                    title: 'Clientes encontrados',
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                }).fire();
            }

            if (data.length > 0) {
                data.forEach(cliente => {
                    const tr = document.createElement('tr');
                    const celda1 = document.createElement('td');
                    const celda2 = document.createElement('td');
                    const celda3 = document.createElement('td');
                    const celda4 = document.createElement('td');
                    const celda5 = document.createElement('td');
                    const celda6 = document.createElement('td');
                    const celda7 = document.createElement('td');
                    const celda8 = document.createElement('td');
                    const buttonModificar = document.createElement('button');
                    const buttonEliminar = document.createElement('button');

                    celda1.innerText = contador;
                    celda2.innerText = cliente.cli_nombre;
                    celda3.innerText = cliente.cli_apellido;
                    celda4.innerText = cliente.cli_telefono;
                    celda5.innerText = cliente.cli_email;

                    buttonModificar.textContent = 'Modificar';
                    buttonModificar.classList.add('btn', 'btn-warning', 'w-100');
                    buttonModificar.onclick = () => {
                        formulario.cli_id.value = cliente.cli_id;
                        formulario.cli_nombre.value = cliente.cli_nombre;
                        formulario.cli_apellido.value = cliente.cli_apellido;
                        formulario.cli_telefono.value = cliente.cli_telefono;
                        formulario.cli_email.value = cliente.cli_email;

                        btnModificar.parentElement.style.display = '';
                        btnCancelar.parentElement.style.display = '';
                        btnGuardar.parentElement.style.display = 'none';
                        btnLimpiar.parentElement.style.display = 'none';
                    };

                    buttonEliminar.textContent = 'Eliminar';
                    buttonEliminar.classList.add('btn', 'btn-danger', 'w-100');
                    buttonEliminar.onclick = async () => {
                        const confirmacion = await Swal.fire({
                            title: '¿Estás seguro?',
                            text: "¡No podrás revertir esto!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, eliminarlo'
                        });
                        
                        if (confirmacion.isConfirmed) {
                            const eliminarUrl = `/libreria_crudjs/controladores/clientes/index.php?cli_id=${cliente.cli_id}&tipo=3`;
                            const config = {
                                method: 'POST'
                            };

                            try {
                                const respuestaEliminar = await fetch(eliminarUrl, config);
                                const dataEliminar = await respuestaEliminar.json();

                                if (respuestaEliminar.status === 200) {
                                    Swal.fire('Eliminado!', 'El cliente ha sido eliminado.', 'success');
                                    getClientes();
                                } else {
                                    Swal.fire('Error', 'No se pudo eliminar el cliente.', 'error');
                                }
                            } catch (error) {
                                console.error('Error en la eliminación:', error);
                            }
                        }
                    };

                    celda6.appendChild(buttonModificar);
                    celda7.appendChild(buttonEliminar);
                    tr.appendChild(celda1);
                    tr.appendChild(celda2);
                    tr.appendChild(celda3);
                    tr.appendChild(celda4);
                    tr.appendChild(celda5);
                    tr.appendChild(celda6);
                    tr.appendChild(celda7);
                    fragment.appendChild(tr);
                    contador++;
                });
                tablaClientes.tBodies[0].appendChild(fragment);
            } else {
                const tr = document.createElement('tr');
                const td = document.createElement('td');
                td.colSpan = 7;
                td.classList.add('text-center');
                td.innerText = 'No hay clientes registrados';
                tr.appendChild(td);
                tablaClientes.tBodies[0].appendChild(tr);
            }
        } else {
            Swal.fire('Error', 'No se pudieron encontrar los clientes.', 'error');
        }
    } catch (error) {
        console.error('Error en la búsqueda:', error);
    }
};

btnBuscar.addEventListener('click', (e) => {
    e.preventDefault();
    getClientes();
});

btnGuardar.addEventListener('click', async (e) => {
    e.preventDefault();
    const formData = new FormData(formulario);
    const url = `/libreria_crudjs/controladores/clientes/index.php?tipo=1`;
    const config = {
        method: 'POST',
        body: formData
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        if (respuesta.status === 200) {
            Swal.fire('Guardado!', 'El cliente ha sido guardado.', 'success');
            formulario.reset();
            getClientes();
        } else {
            Swal.fire('Error', 'No se pudo guardar el cliente.', 'error');
        }
    } catch (error) {
        console.error('Error en el guardado:', error);
    }
});

btnModificar.addEventListener('click', async (e) => {
    e.preventDefault();
    const formData = new FormData(formulario);
    const url = `/libreria_crudjs/controladores/clientes/index.php?tipo=2`;
    const config = {
        method: 'POST',
        body: formData
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        if (respuesta.status === 200) {
            Swal.fire('Modificado!', 'El cliente ha sido modificado.', 'success');
            formulario.reset();
            btnModificar.parentElement.style.display = 'none';
            btnCancelar.parentElement.style.display = 'none';
            btnGuardar.parentElement.style.display = '';
            btnLimpiar.parentElement.style.display = '';
            getClientes();
        } else {
            Swal.fire('Error', 'No se pudo modificar el cliente.', 'error');
        }
    } catch (error) {
        console.error('Error en la modificación:', error);
    }
});

btnCancelar.addEventListener('click', (e) => {
    e.preventDefault();
    formulario.reset();
    btnModificar.parentElement.style.display = 'none';
    btnCancelar.parentElement.style.display = 'none';
    btnGuardar.parentElement.style.display = '';
    btnLimpiar.parentElement.style.display = '';
});
