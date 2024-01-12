<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="column">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'btn btn-outline-danger']
            ) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'btn btn-outline-success']) ?>
            </div>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user, ['id' => 'edit-form']) ?>
            <fieldset>
                <legend><?= __('Edit User') ?></legend>
                <?php
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('last_name');
                    echo $this->Form->control('contact_number');
                    echo $this->Form->control('email', ['readonly' => 'readonly']);
                    echo $this->Form->control('address');
                    echo $this->Form->control('state', ['options' => $states]);
                    echo $this->Form->control('is_admin', ['type' => 'checkbox']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('edit-form').addEventListener('submit', function (event) {
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
