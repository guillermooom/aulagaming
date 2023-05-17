<?php

function mostrarSweetAlert($opcion) {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>'; // Incluir la librería SweetAlert2

    echo '<script>';
    echo 'document.addEventListener("DOMContentLoaded", function() {';
    echo '  Swal.fire({';
    echo '    title: "¿Estás seguro?",';
    echo '    text: "Esta acción no se puede deshacer",';
    echo '    icon: "warning",';
    echo '    showCancelButton: true,';
    echo '    confirmButtonText: "Correcto",';
    echo '    cancelButtonText: "Incorrecto"';
    echo '  }).then((result) => {';
    echo '    if (result.isConfirmed) {';
    echo '      document.cookie = "hora=mañana";';
    echo '    } else {';
    echo '      document.cookie = "hora=tarde";';
    echo '    }';
    echo '  });';
    echo '});';
    echo '</script>';
}

// Ejemplo de uso:
$opcionSeleccionada = true; // Cambia esto por tu lógica o variable correspondiente
mostrarSweetAlert($opcionSeleccionada);

?>
