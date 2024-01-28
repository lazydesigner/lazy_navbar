<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Masking Example</title>
</head>
<body>
    
<input type="text" id="originalvalue" hidden><br><br>
    <label for="password">Enter Password:</label>


    <input type="text" id="passwordInput">
    <button onclick="maskAndSubmit()">Submit</button>

    <script>
        document.getElementById('passwordInput').addEventListener('keyup',(e)=>{
            a = e.target.value
            document.getElementById('originalvalue').value += a.replace(/\*/g, '')
            const inputField = document.getElementById('passwordInput');
            const originalValue = inputField.value;
            const maskedValue = originalValue.replace(/./g, '*');
            inputField.value = maskedValue;
            // alert('Submitted Value: ' + originalValue);

        })
        function maskAndSubmit(){
            console.log(document.getElementById('originalvalue').value)
            document.getElementById('originalvalue').value = '';
            document.getElementById('passwordInput').value = '';
        }
    </script>
</body>
</html>
