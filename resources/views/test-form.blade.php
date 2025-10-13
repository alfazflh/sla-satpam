<!DOCTYPE html>
<html>
<head>
    <title>Simple File Upload Test</title>
</head>
<body>
    <h1>Simple File Upload Test</h1>
    
    <form action="{{ route('test.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="test_file" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>
    
    <script>
        document.querySelector('form').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const form = e.target;
            const formData = new FormData(form);
            
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            console.log('Response:', data);
            alert(JSON.stringify(data, null, 2));
        });
    </script>
</body>
</html>