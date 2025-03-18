document.addEventListener('DOMContentLoaded', function() {
    const botaoSelecionar = document.getElementById('botaoSelecionar');
    const checkboxes = document.querySelectorAll('.material-checkbox');
    const botaoDeletar = document.getElementById('botaoDeletar');
    let selectMode = false;

    botaoSelecionar.addEventListener('click', function() {
        selectMode = !selectMode;


        checkboxes.forEach(function(checkbox) {
            checkbox.style.display = selectMode ? 'block' : 'none';
        });

        botaoSelecionar.textContent = selectMode ? 'Cancelar' : 'Selecionar';
        botaoSelecionar.classList.toggle('btn-danger', selectMode);
        botaoSelecionar.classList.toggle('btn-primary', !selectMode);


        if (!selectMode) {
            document.querySelectorAll('input[name="materials[]"]').forEach(function(box) {
                box.checked = false;
            });
            botaoDeletar.style.display = 'none';
        }
    });

    document.querySelectorAll('input[name="materials[]"]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const anyChecked = Array.from(
                document.querySelectorAll('input[name="materials[]"]')
            ).some(box => box.checked);

            botaoDeletar.style.display = anyChecked ? 'block' : 'none';
        });
    });
});