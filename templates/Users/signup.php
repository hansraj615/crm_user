
<div class="users form">
    <?= $this->Form->create(null, ['id' => 'signup-form']) ?>
    <fieldset>
        <legend><?= __('Sign Up') ?></legend>
        <?= $this->Form->control('first_name', ['class' => 'form-control', 'label' => 'First Name']) ?>
        <?= $this->Form->control('last_name', ['class' => 'form-control', 'label' => 'Last Name']) ?>
        <?= $this->Form->control('contact_number', ['class' => 'form-control', 'label' => 'Contact Number']) ?>
        <?= $this->Form->control('email', ['class' => 'form-control', 'label' => 'Email']) ?>
        <?= $this->Form->control('password', ['class' => 'form-control', 'label' => 'Password']) ?>
        <?= $this->Form->control('confirm_password', ['type' => 'password', 'class' => 'form-control', 'label' => 'Confirm Password']) ?>
        <?= $this->Form->control('address', ['class' => 'form-control', 'label' => 'Address', 'type' => 'textarea']) ?>
        <?= $this->Form->control('state', ['class' => 'form-control', 'label' => 'State', 'options' => $states]) ?>
    </fieldset>
    <?= $this->Form->button('Sign Up', ['class' => 'btn btn-primary', 'type' => 'submit']) ?>
    <?= $this->Form->end() ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('signup-form').addEventListener('submit', function (event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });

        function validateForm() {
            var isValid = true;

            // Validate First Name
            var firstName = document.getElementById('first-name').value.trim();
            if (firstName === '' || !/^[a-zA-Z]+$/.test(firstName)) {
                alert('Please enter a valid First Name (alphabets only).');
                isValid = false;
            }

            // Validate Last Name
            var lastName = document.getElementById('last-name').value.trim();
            if (lastName === '' || !/^[a-zA-Z]+$/.test(lastName)) {
                alert('Please enter a valid Last Name (alphabets only).');
                isValid = false;
            }

            // Validate Contact Number
            var contactNumber = document.getElementById('contact-number').value.trim();
            if (contactNumber === '' || !/^[1-9]\d{9}$/.test(contactNumber)) {
                alert('Please enter a valid 10-digit Contact Number.');
                isValid = false;
            }

            // Validate Email
            var email = document.getElementById('email').value.trim();
            if (email === '' || !/^\S+@\S+\.\S+$/.test(email)) {
                alert('Please enter a valid Email address.');
                isValid = false;
            }

            // Validate Password
            var password = document.getElementById('password').value.trim();
            if (password === '' || password.length < 6 || password.length > 20) {
                alert('Password must be between 6 and 20 characters.');
                isValid = false;
            }

            // Validate Confirm Password
            var confirmPassword = document.getElementById('confirm-password').value.trim();
            if (confirmPassword !== password) {
                alert('Passwords do not match.');
                isValid = false;
            }

            // Validate Address (optional)

            // Validate State
            var state = document.getElementById('state').value.trim();
            if (state === '') {
                alert('Please select a State.');
                isValid = false;
            }

            return isValid;
        }
    });
</script>
