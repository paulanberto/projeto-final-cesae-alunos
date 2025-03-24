
let fileSelected = false;

function selectAndUpload(fileType) {

    if (fileSelected && document.getElementById('selected-file-type').value !== fileType) {
        return;
    }


    document.getElementById('selected-file-type').value = fileType;


    const fileInput = document.getElementById('ficheiro');
    if (fileType === 'document') {
        fileInput.setAttribute('accept', '.pdf,.doc,.docx,.txt');
    } else if (fileType === 'image') {
        fileInput.setAttribute('accept', '.jpg,.jpeg,.png,.gif');
    } else if (fileType === 'video') {
        fileInput.setAttribute('accept', '.mp4,.mov,.avi');
    }


    fileInput.click();
}


document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('ficheiro').addEventListener('change', function() {
        if (this.files[0]) {
            const fileName = this.files[0].name;
            document.getElementById('file-name-display').textContent = fileName;
            document.getElementById('file-feedback-area').classList.remove('d-none');


            const selectedType = document.getElementById('selected-file-type').value;


            fileSelected = true;


            const selectedIcon = document.querySelector(`#${selectedType}-selector button i`);
            if (selectedIcon) {
                
                selectedIcon.classList.remove('fa-plus');
                selectedIcon.classList.add('fa-check');
            } else {
                console.error(`Elemento não encontrado: #${selectedType}-selector button i`);
                console.log('selectedType:', selectedType);
            }


            const fileTypes = ['document', 'image', 'video'];
            fileTypes.forEach(type => {
                if (type !== selectedType) {
                    const button = document.querySelector(`#${type}-selector button`);
                    button.style.opacity = '0.5';
                    button.style.pointerEvents = 'none';
                }
            });
        }
    });
});