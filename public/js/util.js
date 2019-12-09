function Eliminar(id, obj) {
    Swal.fire({
        title: 'Estas seguro que deseas eliminar?',
        text: "Si quieres eliminar " + obj + " no podra ser recuperado",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar'
    }).then((result) => {
        if (result.value) {
            var f = document.forms['delete-form'];
            f.action = id;
            f.submit(); //envía el form
        }
    })
}
