<?php
  $color = 'light';

  if ($data['toastsType'] === 'success') {
    $color = 'success';
  }
  else if ($data['toastsType'] === 'errors') {
    $color = 'danger';
  }

  foreach ($data['messages'] as $message) {
?>

<div class="ms-5 mb-5 toast align-items-center text-white bg-<?= $color ?> border-0" role="alert" aria-live="assertive" aria-atomic="true" style="autohide: none; position: absolute; bottom: 0; left:0;">
  <div class="d-flex">
    <div class="toast-body">
      <?= $message ?>
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>

<?php
  }
?>