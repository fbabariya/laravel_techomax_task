@extends('layout')

@section('content')

<!-- resources/views/register.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #080505;
            border-radius: 20px 20px 0 0;
            font-weight: bold;
            text-align: center;
        }
        .card-body {
            padding: 30px;
        }
        .form-control {
            border-radius: 20px;
            border-color: #ced4da;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 20px;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .table th {
            text-align: center;
        }
    </style>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">User Registration</div>

                    <div class="card-body">
                        <form id="registrationForm" method="POST">
                            @csrf 
                            <div class="form-group">
                                <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" value="" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password"  value="" required>
                                <small class="text-muted">Password must be at least 8 characters long.</small>
                            </div>
                            
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Re-type Password" required>
                            </div>
                            <!-- Phone -->
                            <div class="form-group">
                                <input type="tel" class="form-control" name="phone" placeholder="Phone" required>
                            </div>

                        
                            <div class="form-group">
                                <select class="form-control" name="referrer">
                                    <option value="">How did you hear about Us?</option>
                                    <option value="LinkedIn">LinkedIn</option>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Google">Google</option>
                                    <option value="Friends">Friends</option>
                                    <option value="Website">Website</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group text-center"> 
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                  
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional, for certain components) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Your custom JavaScript -->
<script>

    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        fetch('/register', {
            method: 'POST',
            body: formData
        })
        .then(function(response) {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Registration failed');
            }
        })
        .then(function(data) {
            alert('Registration successful');
            // Redirect or do something 
            window.location.href = data.redirect_url;
        })
        .catch(function(error) {
            console.error('Error:', error);
            // Handle validation errors
        });
    });
</script>


</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


@endsection