<?php
// Basic secure PHP form handler that returns formatted HTML
function h($s){ return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
$method = $_SERVER['REQUEST_METHOD'];
if($method !== 'POST'){
  http_response_code(405);
  echo '<div class="preview-card"><strong>Method not allowed.</strong></div>';
  exit;
}
$fields = ['fullname','email','phone','dob','address','course','comments'];
$data = [];
foreach($fields as $f){ $data[$f] = isset($_POST[$f]) ? trim($_POST[$f]) : ''; }

// Basic server-side validation example
$errors = [];
if($data['fullname'] === '') $errors[] = 'Full name is required.';
if($data['email'] === '' || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';

if(count($errors) > 0){
  echo '<div class="preview-card"><h3>Submission error</h3><ul>';
  foreach($errors as $err) echo '<li>'.h($err).'</li>';
  echo '</ul></div>';
  exit;
}

// On success, return styled HTML that shows the submitted data and a print button
?>
<link rel="stylesheet" href="styles.css" />
<div class="preview-card">
  <h2>Application received</h2>
  <p class="small">Below is the submitted information — you can print this page using your browser's print command (Ctrl/Cmd+P).</p>
  <div class="preview-row"><strong>Full name</strong><div class="small"><?php echo h($data['fullname']); ?></div></div>
  <div class="preview-row"><strong>Email</strong><div class="small"><?php echo h($data['email']); ?></div></div>
  <div class="preview-row"><strong>Phone</strong><div class="small"><?php echo h($data['phone']); ?></div></div>
  <div class="preview-row"><strong>Date of birth</strong><div class="small"><?php echo h($data['dob']); ?></div></div>
  <div class="preview-row"><strong>Address</strong><div class="small"><?php echo nl2br(h($data['address'])); ?></div></div>
  <div class="preview-row"><strong>Course</strong><div class="small"><?php echo h($data['course']); ?></div></div>
  <div class="preview-row"><strong>Comments</strong><div class="small"><?php echo nl2br(h($data['comments'])); ?></div></div>

  <div style="margin-top:12px;text-align:right">
    <button onclick="window.print()" style="padding:8px 12px;border-radius:8px;border:0;background:#2563eb;color:#fff;cursor:pointer">Print / Save PDF</button>
  </div>
</div>
<?php
// Optionally: save to a CSV file (disabled by default). Uncomment to enable.
// $csv = _DIR_.'/submissions.csv';
// $fh = fopen($csv, 'a');
// fputcsv($fh, [$data['fullname'],$data['email'],$data['phone'],$data['dob'],$data['address'],$data['course'],$data['comments']]);
// fclose($fh);
?>
