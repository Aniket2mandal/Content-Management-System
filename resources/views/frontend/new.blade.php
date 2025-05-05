<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Call API from Another Project</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Data from API:</h1>
    <div id="api-data"></div>



 
  
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'http://localhost:8000/api/send-data',  
                method: 'GET',
                success: function(response) {
                    console.log(response); 
                    $('#api-data').html('Message: ' + response.message); 
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    </script>
</body>
</html>
