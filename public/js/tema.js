document.addEventListener('DOMContentLoaded', function() {
    const botaoSelecionar = document.getElementById('botaoSelecionar');
    const checkboxes = document.querySelectorAll('.tema-checkbox');
    const botaoDeletar = document.getElementById('botaoDeletar');
    const deleteForm = document.getElementById('deleteForm');
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
            document.querySelectorAll('input[name="temas[]"]').forEach(function(box) {
                box.checked = false;
            });
            botaoDeletar.style.display = 'none';
        }
    });

    document.querySelectorAll('input[name="temas[]"]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const anyChecked = Array.from(
                document.querySelectorAll('input[name="temas[]"]')
            ).some(box => box.checked);

            botaoDeletar.style.display = anyChecked ? 'block' : 'none';
        });
    });

    botaoDeletar.querySelector('button').addEventListener('click', function(e) {
        e.preventDefault();

        if (confirm('Tem certeza que deseja excluir os temas selecionados?')) {
            deleteForm.submit();
        }
    });
});