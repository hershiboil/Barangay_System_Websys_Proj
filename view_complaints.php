<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Complaint Detail</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    .complaint { border: 1px solid #ccc; padding: 15px; border-radius: 10px; background-color: #f9f9f9; }
    .files a { display: inline-block; margin-right: 10px; margin-top: 5px; color: #007BFF; text-decoration: none; }
    .files a:hover { text-decoration: underline; }
  </style>
</head>
<body>

  <h1>Complaint Details</h1>
  <div id="complaintContainer">Loading...</div>

  <script>
    const params = new URLSearchParams(window.location.search);
    const complaintId = params.get('id');

    fetch(`fetch_complaints.php?id=${complaintId}`)
      .then(response => response.json())
      .then(data => {
        const container = document.getElementById('complaintContainer');
        if (data.error) {
          container.innerHTML = `<p>${data.error}</p>`;
          return;
        }

        container.innerHTML = `
          <div class="complaint">
            <h3>Complaint ID: ${data.id}</h3>
            <p><strong>Type:</strong> ${data.type}</p>
            <p><strong>Description:</strong> ${data.description}</p>
            <p><strong>Date:</strong> ${new Date(data.created_at).toLocaleString()}</p>
            <div class="files"><strong>Files:</strong><br>${
              data.files.length > 0
                ? data.files.map(file => `<a href="${file}" target="_blank">${file.split('/').pop()}</a>`).join('')
                : 'No files attached.'
            }</div>
          </div>
        `;
      })
      .catch(error => {
        document.getElementById('complaintContainer').innerHTML = `<p>Error loading complaint: ${error}</p>`;
      });
  </script>

</body>
</html>
