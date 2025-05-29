document.addEventListener('DOMContentLoaded', function() {
    const steps = document.querySelectorAll('.stepper-step');
    const prevBtn = document.getElementById('prev-step');
    const nextBtn = document.getElementById('next-step');
    const submitBtn = document.getElementById('submit-form');
    const stepperNavItems = document.querySelectorAll('.stepper-nav-item');
    const stepperProgressBar = document.querySelector('.stepper-progress-bar');
    const form = document.getElementById('add-form');

    let currentStep = 1;
    const totalSteps = steps.length;

    function updateStepper() {
        steps.forEach((step, index) => {
            if (index + 1 === currentStep) {
                step.classList.add('active');
                step.classList.remove('d-none');
            } else {
                step.classList.remove('active');
                step.classList.add('d-none');
            }
        });

        stepperNavItems.forEach((item, index) => {
            if (index + 1 <= currentStep) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });

        prevBtn.disabled = currentStep === 1;
        nextBtn.classList.toggle('d-none', currentStep === totalSteps);
        submitBtn.classList.toggle('d-none', currentStep !== totalSteps);

        const progressWidth = ((currentStep - 1) / (totalSteps - 1)) * 100;
        stepperProgressBar.style.width = `${progressWidth}%`;
    }

    // Tombol Next
    nextBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (currentStep < totalSteps) {
            currentStep++;
            updateStepper();
        }
    });

    // Tombol Previous
    prevBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (currentStep > 1) {
            currentStep--;
            updateStepper();
        }
    });

    updateStepper();

    // Logika radio button untuk tampilkan/hidden detail
    document.querySelectorAll('input[name="riwayat_penyakit"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const detailField = document.getElementById('riwayat_penyakit_detail');
            const textareaField = document.getElementById('keterangan_riwayat_penyakit');

            if (this.value === 'Ya') {
                detailField.style.display = 'block';
                textareaField.setAttribute('required', '');
            } else {
                detailField.style.display = 'none';
                textareaField.removeAttribute('required');
                textareaField.classList.remove('is-invalid');
            }
        });
    });

    document.querySelectorAll('input[name="alergi"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const detailField = document.getElementById('alergi_detail');
            const textareaField = document.getElementById('keterangan_alergi');

            if (this.value === 'Ya') {
                detailField.style.display = 'block';
                textareaField.setAttribute('required', '');
            } else {
                detailField.style.display = 'none';
                textareaField.removeAttribute('required');
                textareaField.classList.remove('is-invalid');
            }
        });
    });

    // Panggil fungsi untuk menginisialisasi state dari radio buttons
    const riwayatChecked = document.querySelector('input[name="riwayat_penyakit"]:checked');
    if (riwayatChecked) {
        riwayatChecked.dispatchEvent(new Event('change'));
    }
    
    const alergiChecked = document.querySelector('input[name="alergi"]:checked');
    if (alergiChecked) {
        alergiChecked.dispatchEvent(new Event('change'));
    }
});