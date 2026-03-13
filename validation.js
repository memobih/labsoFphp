document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        const errorDivs = form.querySelectorAll('.invalid-feedback');
        errorDivs.forEach(div => div.textContent = '');
        const inputs = form.querySelectorAll('.form-control, .form-check-input');
        inputs.forEach(inp => inp.classList.remove('is-invalid'));

        let hasError = false;
        const setError = (element, message) => {
            const errorDiv = document.getElementById(element.id + '_error');
            if (errorDiv) errorDiv.textContent = message;
            element.classList.add('is-invalid');
            hasError = true;
        };

        const requiredFields = ['fname', 'lname', 'address', 'country', 'gender', 'username', 'password', 'user_code'];
        requiredFields.forEach(id => {
            const el = document.getElementById(id);
            if (el && !el.value.trim()) {
                setError(el, 'This field is required');
            }
        });

        const namePattern = /^[A-Za-z]+$/;
        const fnameEl = document.getElementById('fname');
        if (fnameEl && fnameEl.value && !namePattern.test(fnameEl.value)) {
            setError(fnameEl, 'First name must contain only letters');
        }
        const lnameEl = document.getElementById('lname');
        if (lnameEl && lnameEl.value && !namePattern.test(lnameEl.value)) {
            setError(lnameEl, 'Last name must contain only letters');
        }

        const skillCheckboxes = document.querySelectorAll('input[name="skills[]"]');
        const anySkill = Array.from(skillCheckboxes).some(cb => cb.checked);
        if (!anySkill) {
            if (skillCheckboxes.length) {
                const firstSkill = skillCheckboxes[0];
                const errorDiv = document.getElementById(firstSkill.id + '_error');
                if (errorDiv) errorDiv.textContent = 'Select at least one skill';
                firstSkill.classList.add('is-invalid');
            }
            hasError = true;
        }

        const passwordEl = document.getElementById('password');
        if (passwordEl) {
            const pwd = passwordEl.value;
            const pwdPattern = /^[a-z0-9_]{8}$/;
            if (!pwdPattern.test(pwd)) {
                setError(passwordEl, 'Password must be exactly 8 characters, lowercase letters, numbers, or underscore');
            }
        }

        const profilePicInput = document.getElementById('profile_pic');
        if (profilePicInput && profilePicInput.files.length) {
            const file = profilePicInput.files[0];
            const allowedTypes = ['image/jpeg', 'image/png'];
            if (!allowedTypes.includes(file.type)) {
                setError(profilePicInput, 'Only JPG or PNG files are allowed');
            }
            const maxSize = 2 * 1024 * 1024; 
            if (file.size > maxSize) {
                setError(profilePicInput, 'File size must be less than 2MB');
            }
        }

        if (hasError) {
            e.preventDefault();
        }
    });
});
