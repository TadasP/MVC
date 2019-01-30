<?php if(isset($this->form)): ?>
    <h2>Add Comment</h2>
    <?= $this->form ?>
<?php endif; ?>
<?php if(isset($this->editForm)): ?>
    <h2>Edit Comment</h2>
    <?= $this->editForm ?>
<?php endif; ?>