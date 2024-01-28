<?php
// Get the POST data from the GitHub webhook
$postData = file_get_contents('php://input');

// Check if the data is valid JSON
if (!$postData || !($data = json_decode($postData))) {
  http_response_code(400);
  exit('Bad Request');
}

// Check if the webhook event is "push"
if ($data->event_type !== 'push') {
  http_response_code(204);
  exit('Event not supported');
}

// Check if the repository matches your configuration
$repository = $data->repository->full_name;
if ($repository !== 'lazydesigner/lazy_navbar.git') {
  http_response_code(204);
  exit('Repository not supported');
}

// Update these paths accordingly
$homeDirectory = '/home/vol4_3/infinityfree.com/if0_35857587';
$repoPath = "{$homeDirectory}/lazy_navbar"; // Updated to match your GitHub repository name
$webPath = "{$homeDirectory}/htdocs";

// Clone the repository or pull changes if already exists
if (!file_exists($repoPath)) {
  shell_exec("git clone https://github.com/lazydesigner/lazy_navbar.git {$repoPath}");
} else {
  shell_exec("cd {$repoPath} && git pull");
}

// Copy the files to your web directory
if (file_exists("{$repoPath}/public")) {
  shell_exec("rm -rf {$webPath}/* && cp -r {$repoPath}/public/* {$webPath}/");
} else {
  shell_exec("rm -rf {$webPath}/* && cp -r {$repoPath}/* {$webPath}/");
}

// Notify that the deployment was successful
http_response_code(200);
echo 'Deployment successful';
?>
