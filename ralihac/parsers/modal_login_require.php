<?php
$output = '';

if (isset($_POST['method']) == 'likeModal'){
  $method = 'like';
  $output .= "
  <div class='modal fade' id='likeModal' tabindex='-1' role='dialog'>
  <div class='modal-dialog modal-dialog-centered' role='document'>
    <div class='modal-content'>

      <div class='modal-header'>
        <h5 class='modal-title'>Oops! Sorry there</h5>
      </div>

      <div class='modal-body'>
        <p>You cannot <b class='text-info'>$method</b> this Hack yet, you would need to create an account here in Ralihac. Try to create your account later on or press the <b>Create Account</b> button below.</p>

        <p>
        If you're already a member of Ralihac, click <a href='login.php'>here</a> to login
        </p>
      </div>

      <div class='modal-footer'>
        <button type='button' class='btn btn-info border border-dark' data-dismiss='modal'>I Understand</button>
        <a class='btn btn-light border border-info text-info' href='cr.php'>Create Account</a>
      </div>

    </div>
  </div>
</div>
  ";
  echo $output;
}
if (isset($_POST['method']) == 'saveModal'){
  $method = 'save';
  $output .= "
  <div class='modal fade' id='saveModal' tabindex='-1' role='dialog'>
  <div class='modal-dialog modal-dialog-centered' role='document'>
    <div class='modal-content'>

      <div class='modal-header'>
        <h5 class='modal-title'>Oops! Sorry there</h5>
      </div>

      <div class='modal-body'>
        <p>You cannot <b class='text-success'>$method</b> this Hack yet, you would need to create an account here in Ralihac. Try to create your account later on or press the <b>Create Account</b> button below.</p>
        <p>
        If you're already a member of Ralihac, click <a href='login.php'>here</a> to login
        </p>
      </div>

      <div class='modal-footer'>
        <button type='button' class='btn btn-info border border-dark' data-dismiss='modal'>I Understand</button>
        <a class='btn btn-light border border-info text-info' href='cr.php'>Create Account</a>
      </div>

    </div>
  </div>
</div>
  ";
  echo $output;
}
?>
